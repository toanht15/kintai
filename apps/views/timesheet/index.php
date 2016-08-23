<?php write_html($this->Widgets->loadWidget('UserHeader')->render()) ?>

<?php if($this->flash_message): ?>
<div class="alert"><?php echo $this->flash_message; ?></div>
<?php endif; ?>

<div class="row">
	<?php if($this->checked_in): ?>
		<div class= "col-md-4">
			<a href="" class="btn btn-primary btn-large disabled">Check-in</a>
		</div>

		<?php if($this->hasReport): ?>
			<div class="col-md-4">
				<a href="/report/add" class="btn btn-info btn-large disabled">Write daily-report</a>
			</div>
		<?php else: ?>
			<div class="col-md-4">
				<a href="/report/add" class="btn btn-info btn-large">Write daily-report</a>
			</div>
		<?php endif; ?>

		<?php if($this->checked_out || !$this->hasReport): ?>
			<div class="col-md-4">
				<a href="/timesheet/checkout" data-toggle="checked-out" class="btn btn-danger btn-large disabled">Check-out</a>
			</div>
		<?php else: ?>
			<div class="col-md-4">
				<a href="/timesheet/checkout" class="btn btn-danger btn-large">Check-out</a>
			</div>
		<?php endif; ?>

	<?php else: ?>
		<div class= "col-md-4">
			<a href="/timesheet/create" class="btn btn-primary btn-large">Check-in</a>
		</div>
		<div class="col-md-4">
			<a href="/report/add" class="btn btn-info btn-large disabled">Write daily-report</a>
		</div>
		<div class="col-md-4">
			<a href="/timesheet/checkout" class="btn btn-danger btn-large disabled">Check-out</a>
		</div>
	<?php endif; ?>
</div>
<?php write_html ( $this->Widgets->loadWidget( 'UserFooter' )->render () )?>