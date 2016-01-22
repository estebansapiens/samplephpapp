<?php
// Page Head
include_once "./sections/head.php";
?>
<div id="preloader">
	<div id="status">&nbsp;</div>
</div>

<div id="appointment-popup">
	<div class="appointment-popup-background">
	</div>
	<div class="appointment-popup-content">
	</div>
</div>

<section id="home">
</section>

<?php
// Homepage Head
include_once "./views/homepage/head.php";

// Responsive Menu
include_once "./views/homepage/responsivemenu.php";

// Scroll Menu
include_once "./views/homepage/scrollmenu.php";
?>


<div id="main-content">
	<div id="container">
		<?php
		// Appointment Top
		include_once "./views/homepage/appointment-top.php";
		
		// Promotions
		include_once "./views/homepage/promotions.php";
		
		// About Us
		include_once "./views/homepage/about-us.php";
		
		// Opening Hours
		include_once "./views/homepage/opening-hours.php";
		
		// References
		include_once "./views/homepage/references.php";
		
		// Gallery
		include_once "./views/homepage/gallery.php";
		
		// Contact Form
		include_once "./views/homepage/contact-form.php";
		?>
	</div>
</div>
<div id="go-top">
	<i class="icon-angle-up"></i>
</div>