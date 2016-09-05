<?php write_html($this->Widgets->loadWidget('UserHeader')->render(array('User' => $this->user))) ?>
<h2>All daily-report of <?php echo $this->user->email; ?></h2>
<table class="table table-hover">
	<thead>
		<tr>
			<th>Report Id</th>
			<th>Date Created</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($this->reports as $report): ?>
		<tr>
			<td><?php echo $report->id; ?></td>
			<td><?php echo $report->date_created; ?></td>
			<td><a href="<?php echo "/report/show?id=".$report->id ?>" title="">View</a></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php write_html($this->Widgets->loadWidget('UserFooter')->render()) ?>