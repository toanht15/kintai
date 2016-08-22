<?php write_html($this->Widgets->loadWidget('UserHeader')->render(array('User' => $this->user))) ?>
<table class="table table-hover">
	<thead>
		<tr>
			<th>Id</th>
			<th>Date</th>
			<th>Content</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($this->reports as $report): ?> 	
		<tr>
			<td><?php echo $report->id; ?></td>
			<td><a href="<?php echo "/report/show?id=$report->id" ?>" title=""><?php echo $report->date_created; ?></a></td>
			<td><?php echo $report->content; ?></td>
		</tr>
		<?php endforeach; ?>	
	</tbody>
</table>

<?php write_html($this->Widgets->loadWidget('UserFooter')->render()) ?>