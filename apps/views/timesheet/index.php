<?php write_html($this->Widgets->loadWidget('UserHeader')->render()) ?>

	<div class="row">
		<div class= "col-md-4">
			<a href="/timesheet/create" class="btn btn-primary btn-large">Check-in</a>
		</div>
		<div class="col-md-4">
			<a href="/timesheet/check-in" class="btn btn-info btn-large">Write daily-report</a>
		</div>
		<div class="col-md-4">
			<a href="/timesheet/check-in" class="btn btn-danger btn-large">Check-out</a>
		</div>
	</div>
<?php write_html ( $this->Widgets->loadWidget( 'UserFooter' )->render () )?>