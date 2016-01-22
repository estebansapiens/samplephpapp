-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2016 at 08:19 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `studio7data`
--
USE `studolle_website`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_js`
--

DROP TABLE IF EXISTS `admin_js`;
CREATE TABLE IF NOT EXISTS `admin_js` (
`js_id` int(11) NOT NULL,
  `js_content` longtext NOT NULL,
  `js_filename` varchar(255) NOT NULL,
  `js_service` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_js`
--

INSERT INTO `admin_js` (`js_id`, `js_content`, `js_filename`, `js_service`) VALUES
(1, 'var PicMailDashboard = {	''opt'': {		''activeUsersRefreshDelay'': 3500,		''adminLogsRefreshDelay'': 3500,		''activeUsersDatatable'' : '''',		''activeUsersDatatableSelector'' : ''#activeuserstable'',		''adminLogsDatatable'' : '''',		''adminLogsDatatableSelector'' : ''#adminlogstable'',		''activeUsersRefreshInterval'' : '''',		''adminLogsRefreshInterval'' : '''',			},	''init'': // Initializer function	function() {		// Set DataTable errors to "throw" instead of "alert"		$.fn.dataTableExt.sErrMode = ''throw'';		// Refresh Active Users via Interval		PicMailDashboard.activeUsersRefreshInterval();		// Refresh Admin Logs via Interval		PicMailDashboard.adminLogsRefreshInterval();		// Initialize Active Users Datatable		PicMailDashboard.initActiveUsers();		// Initialize Admin Logs Datatable		PicMailDashboard.initAdminLogs();		// Ajaxify new elements		PicMailMain.ajaxifyElements();	},	''activeUsersRefreshInterval'': // Refresh the users DataTable via AJAX by Interval	function() {		PicMailDashboard.opt.activeUsersRefreshInterval = setInterval(function(){			// Check if the DataTable is still present			if ( $(PicMailDashboard.opt.activeUsersDatatableSelector).length ) {				PicMailDashboard.opt.activeUsersDatatable.ajax.reload(null, false);			} else {				clearInterval(PicMailDashboard.opt.activeUsersRefreshInterval);			}		}, PicMailDashboard.opt.activeUsersRefreshDelay);	},	''adminLogsRefreshInterval'': // Refresh the users DataTable via AJAX by Interval	function() {		PicMailDashboard.opt.adminLogsRefreshInterval = setInterval(function(){			// Check if the DataTable is still present			if ( $(PicMailDashboard.opt.adminLogsDatatableSelector).length ) {				PicMailDashboard.opt.adminLogsDatatable.ajax.reload(null, false);			} else {				clearInterval(PicMailDashboard.opt.adminLogsRefreshInterval);			}		}, PicMailDashboard.opt.adminLogsRefreshDelay);	},	''initActiveUsers'': // Initialize the DataTable for Active Users	function() {		// DataTable Functionality		PicMailDashboard.opt.activeUsersDatatable = $(PicMailDashboard.opt.activeUsersDatatableSelector).DataTable({			"ajax": {			  "url": "/dashboard/activeusers.php?postrequest=1"			},		    "order": [[ 0, "desc" ]],	        "columnDefs": [	            {	                "targets": [ 0 ],	                "visible": false,	                "searchable": false	            }	        ],            "pagingType": "simple"		});	},	''initAdminLogs'': // Initialize the DataTable for Active Users	function() {		// DataTable Functionality		PicMailDashboard.opt.adminLogsDatatable = $(PicMailDashboard.opt.adminLogsDatatableSelector).DataTable({			"ajax": {			  "url": "/dashboard/adminlogs.php?postrequest=1"			},			"order": [[ 0, "desc" ]],	        "columnDefs": [	            {	                "targets": [ 0 ],	                "visible": false,	                "searchable": false	            }	        ],            "pagingType": "simple"		});	}}// Initialize the DashboardPicMailDashboard.init();', 'dashboard.js', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_logs`
--

DROP TABLE IF EXISTS `admin_logs`;
CREATE TABLE IF NOT EXISTS `admin_logs` (
`id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_ip` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=573 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_logs`
--

INSERT INTO `admin_logs` (`id`, `user`, `message`, `time`, `user_ip`) VALUES
(538, 'admin@studio7saloncr.com', 'Successfully logged into the Administrative Dashboard.', '2015-12-07 20:42:13', '127.0.0.1'),
(539, 'admin@studio7saloncr.com', 'Logged out from the Admin.', '2015-12-07 20:42:39', '127.0.0.1'),
(540, 'admin@studio7saloncr.com', 'Successfully logged into the Administrative Dashboard.', '2015-12-07 20:42:56', '127.0.0.1'),
(541, 'admin@studio7saloncr.com', 'Logged out from the Admin.', '2015-12-07 20:45:24', '127.0.0.1'),
(542, 'admin@studio7saloncr.com', 'Successfully logged into the Administrative Dashboard.', '2015-12-07 20:53:10', '127.0.0.1'),
(543, 'admin@studio7saloncr.com', 'Successfully logged into the Administrative Dashboard.', '2015-12-07 23:11:12', '127.0.0.1'),
(544, 'admin@studio7saloncr.com', 'Logged out by Session Timeout.', '2015-12-08 00:02:21', '127.0.0.1'),
(545, 'admin@studio7saloncr.com', 'Successfully logged into the Administrative Dashboard.', '2015-12-08 00:02:35', '127.0.0.1'),
(546, 'admin@studio7saloncr.com', 'Logged out by Session Timeout.', '2015-12-08 12:18:47', '127.0.0.1'),
(547, 'admin@studio7saloncr.com', 'Successfully logged into the Administrative Dashboard.', '2015-12-08 12:19:08', '127.0.0.1'),
(548, 'admin@studio7saloncr.com', 'Logged out by Session Timeout.', '2015-12-08 13:52:29', '127.0.0.1'),
(549, 'admin@studio7saloncr.com', 'Successfully logged into the Administrative Dashboard.', '2015-12-08 13:52:42', '127.0.0.1'),
(550, 'admin@studio7saloncr.com', 'Logged out by Session Timeout.', '2015-12-08 16:13:26', '127.0.0.1'),
(551, 'admin@studio7saloncr.com', 'Successfully logged into the Administrative Dashboard.', '2015-12-08 16:28:51', '127.0.0.1'),
(552, 'admin@studio7saloncr.com', 'Logged out by Session Timeout.', '2015-12-08 17:22:00', '127.0.0.1'),
(553, 'admin@studio7saloncr.com', 'Successfully logged into the Administrative Dashboard.', '2015-12-08 17:22:11', '127.0.0.1'),
(554, 'admin@studio7saloncr.com', 'Logged out by Session Timeout.', '2015-12-08 23:35:45', '127.0.0.1'),
(555, 'Anonymous', 'Failed login attempt for user: admin@studio7saloncr.com.', '2015-12-08 23:36:04', '127.0.0.1'),
(556, 'admin@studio7saloncr.com', 'Successfully logged into the Administrative Dashboard.', '2015-12-08 23:36:18', '127.0.0.1'),
(557, 'admin@studio7saloncr.com', 'Logged out by Session Timeout.', '2015-12-09 11:57:21', '127.0.0.1'),
(558, 'admin@studio7saloncr.com', 'Successfully logged into the Administrative Dashboard.', '2015-12-09 12:04:42', '127.0.0.1'),
(559, 'admin@studio7saloncr.com', 'Logged out from the Admin.', '2015-12-09 12:06:16', '127.0.0.1'),
(560, 'admin@studio7saloncr.com', 'Successfully logged into the Administrative Dashboard.', '2015-12-09 12:06:35', '127.0.0.1'),
(561, 'admin@studio7saloncr.com', 'Logged out from the Admin.', '2015-12-09 12:16:23', '127.0.0.1'),
(562, 'admin@studio7saloncr.com', 'Inicio sesión exitosamente en el panel de administración.', '2015-12-09 12:16:35', '127.0.0.1'),
(563, 'admin@studio7saloncr.com', 'Logged out from the Admin.', '2015-12-09 12:21:21', '127.0.0.1'),
(564, 'admin@studio7saloncr.com', 'Inicio sesión exitosamente en el panel de administración.', '2015-12-09 12:21:45', '127.0.0.1'),
(565, 'admin@studio7saloncr.com', 'Desconectado por inactividad de la sesion.', '2015-12-09 13:54:08', '127.0.0.1'),
(566, 'admin@studio7saloncr.com', 'Inicio sesión exitosamente en el panel de administración.', '2015-12-09 13:55:51', '127.0.0.1'),
(567, 'admin@studio7saloncr.com', 'Inicio sesión exitosamente en el panel de administración.', '2015-12-10 00:28:33', '::1'),
(568, 'admin@studio7saloncr.com', 'Desconectado por inactividad de la sesion.', '2015-12-10 12:10:18', '::1'),
(569, 'admin@studio7saloncr.com', 'Inicio sesión exitosamente en el panel de administración.', '2015-12-10 12:10:23', '::1'),
(570, 'admin@studio7saloncr.com', 'Inicio sesión exitosamente en el panel de administración.', '2015-12-10 12:17:02', '127.0.0.1'),
(571, 'admin@studio7saloncr.com', 'Inicio sesión exitosamente en el panel de administración.', '2015-12-10 22:52:18', '::1'),
(572, 'admin@studio7saloncr.com', 'Inicio sesión exitosamente en el panel de administración.', '2015-12-11 12:45:03', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
`element_id` int(11) NOT NULL,
  `element_title` varchar(255) NOT NULL,
  `element_order` int(11) NOT NULL,
  `element_image` varchar(255) NOT NULL,
  `element_service` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`element_id`, `element_title`, `element_order`, `element_image`, `element_service`) VALUES
(1, 'Tratamiento de Queratina', 1, 'http://studio7.localhost/uploads/gallery/gallery48.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hours_of_service`
--

DROP TABLE IF EXISTS `hours_of_service`;
CREATE TABLE IF NOT EXISTS `hours_of_service` (
`service_id` int(11) NOT NULL,
  `day_of_service` int(11) NOT NULL,
  `service_start_time` varchar(255) NOT NULL,
  `service_end_time` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hours_of_service`
--

INSERT INTO `hours_of_service` (`service_id`, `day_of_service`, `service_start_time`, `service_end_time`) VALUES
(1, 1, '9:00 am', '6:30 pm'),
(2, 2, '9:00 am', '6:30 pm'),
(3, 3, '9:00 am', '6:30 pm'),
(4, 4, '9:00 am', '6:30 pm'),
(5, 5, '9:00 am', '6:30 pm'),
(6, 6, '9:00 am', '6:30 pm'),
(7, 7, '9:00 am', '6:30 pm');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
`attempt_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userIP` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`attempt_id`, `username`, `timestamp`, `userIP`) VALUES
(101, 'admin@studio7saloncr.com', '2015-12-08 23:36:04', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
CREATE TABLE IF NOT EXISTS `promotions` (
`promotion_id` int(11) NOT NULL,
  `promotion_title` varchar(255) NOT NULL,
  `promotion_description` text NOT NULL,
  `promotion_picture` varchar(255) NOT NULL,
  `promotion_status` int(11) NOT NULL,
  `promotion_startdate` datetime NOT NULL,
  `promotion_enddate` datetime NOT NULL,
  `promotion_order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`promotion_id`, `promotion_title`, `promotion_description`, `promotion_picture`, `promotion_status`, `promotion_startdate`, `promotion_enddate`, `promotion_order`) VALUES
(1, 'Corte & Tratamiento - 20% descuento!', 'Consiga un corte de cabello con un 20% de descuento.\r\n\r\nPara hacer efectiva esta promoción solo tiene que mencionar que visitó el sitio y que encontró el descuento aquí. ', 'http://studio7.localhost/_assets/_img/hairdresser.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'Promocion de Prueba!...dsafadf', 'Consiga un corte de cabello con un 20% de descuento.\r\n\r\nPara hacer efectiva esta promoción solo tiene que mencionar que visitó el sitio y que encontró el descuento aquí. ', 'http://studio7.localhost/_assets/_img/hairdresser.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(3, 'Promocion de Ejemplo', 'Esta es una descripcion de ejemplo ', 'http://dymer.test/imagen.png', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(4, 'Corte & Tratamiento - 20% descuento!', 'Consiga un corte de cabello con un 20% de descuento.\r\n\r\nPara hacer efectiva esta promoción solo tiene que mencionar que visitó el sitio y que encontró el descuento aquí. ', 'http://studio7.localhost/_assets/_img/hairdresser.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 6);

-- --------------------------------------------------------

--
-- Table structure for table `session_handle`
--

DROP TABLE IF EXISTS `session_handle`;
CREATE TABLE IF NOT EXISTS `session_handle` (
`entry_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `timeout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `username` varchar(255) NOT NULL,
  `userIP` varchar(255) NOT NULL,
  `latest_activity` timestamp NOT NULL,
  `access_type` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `session_handle`
--

INSERT INTO `session_handle` (`entry_id`, `session_id`, `timeout`, `username`, `userIP`, `latest_activity`, `access_type`, `user_id`) VALUES
(73, '3q257e8dhslksbbjd5gg328uj4', '2015-12-11 17:48:43', 'admin@studio7saloncr.com', '127.0.0.1', '2015-12-11 12:48:43', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `team_main`
--

DROP TABLE IF EXISTS `team_main`;
CREATE TABLE IF NOT EXISTS `team_main` (
`setting_id` int(11) NOT NULL,
  `section_header` varchar(255) NOT NULL,
  `section_content` text NOT NULL,
  `section_background` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team_main`
--

INSERT INTO `team_main` (`setting_id`, `section_header`, `section_content`, `section_background`) VALUES
(1, 'Algunas palabras sobre nuestro Salón', 'Somos madre e hija y gracias a esto somos un buen equipo de trabajo. Nos esforzamos por dar siempre lo mejor de nosotras a nuestros clientes y nos mantenemos siempre al tanto sobre las nuevas tendencias en nuestras especialidades.\r\n\r\nNos ubicamos en San Antonio de Escazú, con una vista espectacular de las montañas y ubicados en una zona fresca y tranquila. Usted se sentirá en casa desde el momento de su llegada hasta el de su partida. ', 'http://studio7.localhost/_assets/_img/julyandmaribacknobg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

DROP TABLE IF EXISTS `team_members`;
CREATE TABLE IF NOT EXISTS `team_members` (
`member_id` int(11) NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `member_position` varchar(255) NOT NULL,
  `member_googleplus` varchar(255) NOT NULL,
  `member_facebook` varchar(255) NOT NULL,
  `member_picture` varchar(255) NOT NULL,
  `member_description` text NOT NULL,
  `member_makeuplevel` int(11) NOT NULL,
  `member_manicurelevel` int(11) NOT NULL,
  `member_order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`member_id`, `member_name`, `member_position`, `member_googleplus`, `member_facebook`, `member_picture`, `member_description`, `member_makeuplevel`, `member_manicurelevel`, `member_order`) VALUES
(1, 'July234', 'Estilista y maquilladora', '#', '#', 'http://studio7.localhost/_assets/_img/july.jpg', ' Juliana Durán "July", es estilista desde los 18 años, llegó a Costa Rica hace 15 años y comenzó su carrera como profesional de belleza.\r\n\r\nEl trabajo de July es su pasión y gracias a esto está en continuo aprendizaje. Sus especialidades son peinado y maquillaje, que ha perfeccionado en bodas de playa alrededor de todo el país. ', 9, 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

DROP TABLE IF EXISTS `testimonial`;
CREATE TABLE IF NOT EXISTS `testimonial` (
`testimonial_id` int(11) NOT NULL,
  `testimonial_service` int(11) NOT NULL,
  `testimonial_title` varchar(255) NOT NULL,
  `testimonial_content` text NOT NULL,
  `testimonial_author` varchar(255) NOT NULL,
  `testimonial_picture` varchar(255) NOT NULL,
  `testimonial_order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`testimonial_id`, `testimonial_service`, `testimonial_title`, `testimonial_content`, `testimonial_author`, `testimonial_picture`, `testimonial_order`) VALUES
(1, 1, 'Testimonio de Roxana', 'Soy cliente del Salón hace más de seis meses, y mi experiencia ha sido completamente agradable.\r\n\r\nUn trato profesional, responsable y respetuoso. Recomendado al cien por ciento. ', 'Roxana González S.', 'http://studio7.localhost/_assets/_img/makeup.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
`userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_status` int(11) NOT NULL,
  `nickname` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `account_status`, `nickname`) VALUES
(1, 'admin@studio7saloncr.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'Administrador');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_js`
--
ALTER TABLE `admin_js`
 ADD PRIMARY KEY (`js_id`), ADD KEY `js_id` (`js_id`);

--
-- Indexes for table `admin_logs`
--
ALTER TABLE `admin_logs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
 ADD PRIMARY KEY (`element_id`);

--
-- Indexes for table `hours_of_service`
--
ALTER TABLE `hours_of_service`
 ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
 ADD PRIMARY KEY (`attempt_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
 ADD PRIMARY KEY (`promotion_id`);

--
-- Indexes for table `session_handle`
--
ALTER TABLE `session_handle`
 ADD PRIMARY KEY (`entry_id`);

--
-- Indexes for table `team_main`
--
ALTER TABLE `team_main`
 ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
 ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
 ADD PRIMARY KEY (`testimonial_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_js`
--
ALTER TABLE `admin_js`
MODIFY `js_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admin_logs`
--
ALTER TABLE `admin_logs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=573;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
MODIFY `element_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hours_of_service`
--
ALTER TABLE `hours_of_service`
MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
MODIFY `attempt_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
MODIFY `promotion_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `session_handle`
--
ALTER TABLE `session_handle`
MODIFY `entry_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `team_main`
--
ALTER TABLE `team_main`
MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
MODIFY `testimonial_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
