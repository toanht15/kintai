<?php write_html($this->Widgets->loadWidget('UserHeader')->render()) ?>

	<div class="row">
        <?php if($this->timesheet->status == 'working'): ?>
            <div class= "col-md-4">
                <a href="" class="btn btn-primary btn-large disabled">Check-in</a>
            </div>
        <?php else: ?>
		<div class= "col-md-4">
			<a href="/timesheet/create" class="btn btn-primary btn-large">Check-in</a>
		</div>
        <?php endif; ?>
		<div class="col-md-4">
			<a href="/report/add" class="btn btn-info btn-large">Write daily-report</a>
		</div>
		<div class="col-md-4">
			<a href="/timesheet/checkout" class="btn btn-danger btn-large">Check-out</a>
		</div>
	</div>
<?php write_html ( $this->Widgets->loadWidget( 'UserFooter' )->render () )?>