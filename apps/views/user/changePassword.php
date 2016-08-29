<?php write_html($this->Widgets->loadWidget('UserHeader')->render()) ?>

<?php if($this->flash_message): ?>
<div class="alert alert-danger"><?php echo $this->flash_message; ?></div>
<?php endif; ?>

<div class='row'>
	<form action="/user/update_password" class='form-signin' method='post'>
		<h3 class='form-singin-heading'>Change password</h3>
		<?php if ($this->ActionError): ?>
			<div class='alert alert-error'>
				<?php 
				if($this->AcitonError && $this->ActionError->getMessage('login'))
					echo $this->ActionError->getMessage('login');?>  
				Input error.	
			</div>		
		<?php endif; ?>		
		
		<?php write_html($this->formPassword('password', 'ActionForm', array("class" => "input-block-level", "placeholder" => "New password"))) ?>
		<?php if ($this->ActionError && !$this->ActionError->isValid('password')): ?>
			<p class='text-error'><?php assign($this->ActionError->getMessage('password')) ?> </p>
		<?php endif; ?>

		<?php write_html($this->formPassword('retype_password', 'ActionForm', array("class" => "input-block-level", "placeholder" => "Retype new password"))) ?>

		<div>
			<button class='btn btn-large btn-primary' type='submit'>Update</button>
		</div>
	</div>			
</form>
</div>
<?php write_html($this->Widgets->loadWidget('UserFooter')->render()) ?>
