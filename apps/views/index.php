
<?php write_html($this->Widgets->loadWidget('UserHeader')->render()) ?>

    <div class="row">
    	<div class="col-md-2">
    		<a href="/user/register" class = "btn btn-primary">Register</a>
    	</div>
    	<?php if( !isset($_SESSION['login_id']) ): ?>
    	<div class="col-md-6">
    		<a href="/user/login" class = "btn btn-primary">Login</a>
    	</div>
    <?php endif; ?>

    	<div class="col-md-3">
    		<a href="/user/logout" class = "btn btn-primary">Logout</a>
    	</div>	
    </div>

<?php write_html ( $this->Widgets->loadWidget( 'UserFooter' )->render () )?>
