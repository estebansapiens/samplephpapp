<?php
// Configuration data
include_once "../../classes/config.php";

// Main class
include_once "../../classes/main.php";

// Session class
include_once "../../classes/session.php";

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "promotion_id";
/* DB table to use */
$sTable = "promotions";
 
/*
* Columns
* If you don't want all of the columns displayed you need to hardcode $aColumns array with your elements.
* If not this will grab all the columns associated with $sTable
*/
$aColumns = array(
    "promotion_id",
	"promotion_title",
	"promotion_description",
	"promotion_picture",
	"promotion_status",
	"promotion_startdate",
	"promotion_enddate",
	"promotion_order"
);
$bColumns = array(
	"ID",
	"Titulo",
	"Descripcion",
	"Imagen",
	"Estado",
	"Fecha de Inicio",
	"Fecha de Finalizacion",
	"Orden"
);
$dbLink = $GLOBALS['systemconfigs']->dbConnection;
$params = array();

/* Ordering */
$sOrder = "";
if ( isset( $_GET['order'] ) ) {
    $sOrder = "ORDER BY  ";
    foreach ($_GET['order'] as $order) {
            $sOrder .= $aColumns[ $order['column'] ]."
            ".addslashes( $order['dir'] ) .", ";
    }
    $sOrder = substr_replace( $sOrder, "", -2 );
    if ( $sOrder == "ORDER BY" ) {
        $sOrder = "";
    }
}
   
/* Filtering */
$sWhere = "";
if ( isset($_GET['search']['value']) && strlen($_GET['search']['value']) > 0 ) {
    $sWhere = "WHERE (";
    for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
        $sWhere .= $aColumns[$i]." LIKE '%".addslashes( $_GET['search']['value'] )."%' OR ";
    }
    $sWhere = substr_replace( $sWhere, "", -3 );
    $sWhere .= ')';
}
/* Individual column filtering */
for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
    if ( isset($_GET['columns'][$i]) && $_GET['columns'][$i]['searchable'] == "true" && strlen($_GET['columns'][$i]['search']['value']) > 0 )  {
        if ( $sWhere == "" ) {
            $sWhere = "WHERE ";
        } else {
            $sWhere .= " AND ";
        }
        $sWhere .= $aColumns[$i]." LIKE '%".addslashes($_GET['columns'][$i]['search']['value'])."%' ";
    }
}
   
/* Paging */
$top = (isset($_GET['start']))?((int)$_GET['start']):0 ;
$limit = (isset($_GET['length']))?((int)$_GET['length'] ):10;
$sQuery = "SELECT ".implode(",",$aColumns)."
    FROM $sTable
    $sWhere ".(($sWhere=="")?" WHERE ":" AND ")." $sIndexColumn NOT IN
    (
        SELECT $sIndexColumn FROM
        (
            SELECT ".implode(",",$aColumns)."
            FROM $sTable
            $sWhere 
            $sOrder 
            LIMIT $top 
        )
        as virtTable
    )
    $sOrder 
    LIMIT $limit";
 
$rResult = $dbLink->query($sQuery);

$sQueryCnt = "SELECT * FROM $sTable $sWhere";
    $rResultCnt = $dbLink->query($sQueryCnt);
    $iFilteredTotal = mysqli_num_rows($rResultCnt);
  
    $sQuery = " SELECT * FROM $sTable ";
$rResultTotal = $dbLink->query($sQuery);
$iTotal = mysqli_num_rows($rResultTotal);
   
$output = array(
    "draw" => $_GET['draw'],
    "recordsTotal" => $iTotal,
    "recordsFiltered" => $iFilteredTotal,
    "data" => array()
);
   
while ( $aRow = mysqli_fetch_array( $rResult ) ) {
    $row = array();
    for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
        if ( $bColumns[$i] != ' ' ) {
        	$v = $aRow[ $aColumns[$i] ];
            $v = mb_check_encoding($v, 'UTF-8') ? $v : utf8_encode($v);
            $row[$bColumns[$i]]=$v;
        }
    }
    // Format Specifics
    $row['actions'] = "
    <button special-action='//".$GLOBALS['maincontrol']->adminDirectory."forms/promotions/update.php?entity_id=".$row['ID']."' title='Editar...' class='btn btn-success btn-xs editbtn'><i class='fa fa-pencil-square-o'></i></button>
	||
	<button title='Eliminar...' class='btn btn-danger btn-xs deletebtn'><i class='fa fa-trash-o'></i></button>
    ";
	$row = array(
		$row['ID'], 
		$row['Orden'], 
		$row['Titulo'],
		$row['Estado'],
		$row['Fecha de Inicio'], 
		$row['Fecha de Finalizacion'],
		$row['actions']
	);
    If (!empty($row)) { $output['data'][] = $row; }
}   
echo json_encode( $output );
exit;
