<section id="small-appointment">
	<div class="appointment-title waitForLoad fadeInUp">
		<h3>Haga una <span>cita</span></h3>
		<div class="header-line">
			<div class="gray-line"></div>
			<div class="color-line"></div>
		</div>
	</div>
	<div class="appointment-form">
		<form method="get">
			<div class="input">
				<div class="input-helper">
					<i class="icon-calendar"></i>
				</div>
				<input type="text" placeholder="Día de la Cita" class="appointment-datepicker" readonly />
				<div class="clear"></div>
			</div>
			<div class="input approximate-time-input">
				<div class="input-helper">
					<i class="icon-time"></i>
				</div>
				<input type="text" placeholder="Hora de la Cita" class="approximate-time" readonly />
				<div class="clear"></div>
				<div class="approximate-time-box animated fadeInDown">
					<div class="approximate-time-box-arrow"></div>
					<div class="element element-first">
						<i class="icon-chevron-up element-up hours hours-up time-change-action-event"></i>
						<span class="element-value time-selector-hours" data-value="8">8</span>
						<i class="icon-chevron-down element-down hours hours-down time-change-action-event"></i>
					</div>
					<div class="element">
						<i class="icon-chevron-up element-up mins mins-up time-change-action-event"></i>
						<span class="element-value time-selector-mins" data-value="0">00</span>
						<i class="icon-chevron-down element-down mins mins-down time-change-action-event"></i>
					</div>
					<div class="element">
						<i class="icon-chevron-up element-up time-change-action-event time-type"></i>
						<span class="element-value time-selector-type" data-value="am">am</span>
						<i class="icon-chevron-down element-down time-change-action-event time-type"></i>
					</div>
				</div>
			</div>
			<input type="button" value="Siguiente Paso" class="button button-brown open-appointment-box-with-data" />
		</form>
	</div>
	<div class="clear"></div>
</section>