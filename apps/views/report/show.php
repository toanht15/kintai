<?php write_html($this->Widgets->loadWidget('UserHeader')->render(array('User' => $this->user))) ?>

<h2>Daily-report of <strong style="color: green"><?php echo $this->user->email; ?></strong> at <strong style="color: green"><?php echo $this->date; ?></strong></h2>

<?php write_html($this->formTextArea('content', $this->report->content, array("class" => "input-block-level",
				"rows"=> 20, "readonly"=>true))) ?>
<br>				

<form action='edit' method='post'>

<?php if($this->check): ?>
<?php write_html($this->formHidden('report_id', $this->report->id)) ?>
	<button class="btn btn-large btn-primary" type="submit">Edit</button>
</form>
<?php endif; ?>

<?php write_html($this->Widgets->loadWidget('UserFooter')->render()) ?>