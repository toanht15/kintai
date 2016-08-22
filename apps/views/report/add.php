<?php write_html($this->Widgets->loadWidget('UserHeader')->render(array('User' => $this->user))) ?>

<form class="form-daily-report" action="/report/create" method="post">
			<h3 class="form-report-heading">Create new daily-report</h3>

			<?php if ($this->ActionError): ?>
				<div class="alert alert-error">
					Input error.
				</div>
			<?php endif; ?>

			<?php write_html($this->formTextArea('content', 'ActionForm', array("class" => "input-block-level",
				"placeholder" => "to-do, progress, next-todo, issue...", "rows" => 20))) ?>
			<br>
			<button class="btn btn-large btn-primary" type="submit">Submit</button>
		</form>

<?php write_html($this->Widgets->loadWidget('UserFooter')->render()) ?>