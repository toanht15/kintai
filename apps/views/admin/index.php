<?php write_html($this->Widgets->loadWidget('UserHeader')->render()) ?>

<div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Date Created</th>
                <th>Status</th>
                <th>Check in time</th>          
                <th>Check out time</th>          
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->users_checked_in as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['date_created']; ?></td>
                    <td><?php echo $user['status']; ?></td>
                    <td><?php echo $user['check_in_time']; ?></td>
                    <td><?php echo $user['check_out_time']; ?></td>
                </tr>
            <?php endforeach; ?>

            <?php foreach ($this->users_not_check_in as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['date_created']; ?></td>
                    <td>Not check in</td>
                    <td></td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
<?php write_html ( $this->Widgets->loadWidget( 'UserFooter' )->render () )?>
