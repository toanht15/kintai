<?php write_html($this->Widgets->loadWidget('UserHeader')->render(array('User' => $this->user))) ?>
<table class="table table-hover">
	<thead>
		<tr>
			<th>Report Id</th>
			<th>User</th>
			<th>Report</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($this->reports as $report): ?> 	
		<tr>
			<td><?php echo $report['id']; ?></td>
			<td><a href="<?php echo "/user/index_reports?user_id=".$report['user_id']."" ?>" title=""><?php echo $report['email']; ?></a></td>
			<td><a href="<?php echo "/report/show?id=".$report['id']."" ?>" title="">Daily-report of <?php echo $report['day']; ?></a></td>
		</tr>
		<?php endforeach; ?>	
	</tbody>
</table>

<?php write_html(aafwWidgets::getInstance()->loadWidget('KintaiPager')->render(array(
               'TotalCount' => $this->total_file_count,
               'CurrentPage' => $this->params['p'],
               'Count' => $this->page_limited,
           ))) ?>

<?php write_html($this->Widgets->loadWidget('UserFooter')->render()) ?>