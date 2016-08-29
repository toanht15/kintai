<?php write_html($this->Widgets->loadWidget('UserHeader')->render()) ?>

<?php if($this->flash_message): ?>
    <div class="alert alert-info"><?php echo $this->flash_message; ?></div>
<?php endif; ?>

<div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Date Created</th>
                <th>Role</th> 
                <th>Action</th>                       
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->users as $user): ?>
                <tr>
                    <td><?php echo $user->id; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->date_created; ?></td>
                    <td><?php if($user->isAdmin) echo "Admin"; else echo "Normal"; ?></td>                 
                    <td>
                        <?php if(!$user->isAdmin): ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="<?php echo "/user/index_reports?user_id=".$user->id."" ?>" class="btn btn-xs btn-primary">Daily-reports</a>
                                </div>                           
                                <div class="col-md-3">
                                    <form action='set_admin' method='post'>
                                        <?php write_html($this->formHidden('user_id', $user->id)) ?>
                                        <button class="btn btn-xs btn-info" type="submit">Set admin</button>
                                    </form>
                                </div>
                                <div class="col-md-3">
                                    <form action='delete_user' method='post'>
                                        <?php write_html($this->formHidden('user_id', $user->id)) ?>
                                        <button class="btn btn-xs btn-danger" type="submit">Delete</button>
                                    </form> 
                                </div>
                            </div>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php write_html ( $this->Widgets->loadWidget( 'UserFooter' )->render () )?>