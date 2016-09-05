<?php write_html($this->Widgets->loadWidget('UserHeader')->render()) ?>

<?php if($this->flash_message): ?>
<div class="alert alert-info"><?php echo $this->flash_message; ?></div>
<?php endif; ?>

<div class="row" style="margin-top: 200px;">
	<?php if($this->status->checked_in): ?>
		<div class= "col-md-4">
			<a href="" class="btn btn-primary btn-large disabled btn-big">Check-in</a>
		</div>

		<?php if($this->status->has_report): ?>
			<div class="col-md-4">
				<a href="/report/add" class="btn btn-info btn-large disabled btn-big">Write daily-report</a>
			</div>
		<?php else: ?>
			<div class="col-md-4">
				<a href="/report/add" class="btn btn-info btn-large btn-big">Write daily-report</a>
			</div>
		<?php endif; ?>

		<?php if($this->status->checked_out || !$this->status->has_report): ?>
			<div class="col-md-4">
				<a href="/timesheet/checkout" data-toggle="checked-out" class="btn btn-danger btn-large disabled btn-big">Check-out</a>
			</div>
		<?php else: ?>
			<div class="col-md-4">
				<a href="/timesheet/checkout" class="btn btn-danger btn-large btn-big">Check-out</a>
			</div>
		<?php endif; ?>

	<?php else: ?>
		<div class= "col-md-4">
			<a href="/timesheet/create" class="btn btn-primary btn-large btn-big">Check-in</a>
		</div>
		<div class="col-md-4">
			<a href="/report/add" class="btn btn-info btn-large disabled btn-big">Write daily-report</a>
		</div>
		<div class="col-md-4">
			<a href="/timesheet/checkout" class="btn btn-danger btn-large disabled btn-big">Check-out</a>
		</div>
	<?php endif; ?>
</div>

<?php write_html ( $this->Widgets->loadWidget( 'UserFooter' )->render () )?>
