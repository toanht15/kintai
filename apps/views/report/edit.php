<?php write_html($this->Widgets->loadWidget('UserHeader')->render(array('User' => $this->user))) ?>

<form class="form-daily-report" action="/report/update" method="post">
			<h3 class="form-report-heading">Edit daily-report</h3>
			<?php write_html($this->formHidden('report_id', $this->report->id)) ?>
			<?php if ($this->ActionError): ?>
				<div class="alert alert-error">
					Input error.
				</div>
			<?php endif; ?>

			<?php write_html($this->formTextArea('content', $this->report->content, array("class" => "input-block-level",
				"rows"=> 20))) ?>
			<br>
			<button class="btn btn-large btn-primary" type="submit">Update</button>
		</form>

<?php write_html($this->Widgets->loadWidget('UserFooter')->render()) ?>