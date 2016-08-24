<?php write_html($this->Widgets->loadWidget('UserHeader')->render(array('User' => $this->user))) ?>

<div class='row'>
	<form action="" class='form-signin' method='post'>
		<h3 class='form-singin-heading'>Change password</h3>
		<?php if ($this->ActionError): ?>
			<div class='alert alert-error'>
				<?php 
				if($this->AcitonError && $this->ActionError->getMessage('login'))
					echo $this->ActionError->getMessage('login');?>  
				Input error.	
			</div>		
		<?php endif; ?>
		
		<?php write_html($this->formPassword('old-password', 'ActionForm', array('class' => 'input-block-level', 'placeholder' => 'Old password'))) ?>
		<?php if ($this->ActionError && !$this->ActionError->isValid('email')): ?>
			<p class='text-error'><?php assign($this->ActionError->getMessage('email')) ?> </p>
		<?php endif; ?>
		<?php if ($this->ActionError && !$this->ActionError->isValid('login')): ?>
			<p class='text-error'><?php assign($this->ActionError->getMessage('login')) ?> </p>
		<?php endif; ?>
		
		<?php write_html($this->formPassword('password', 'ActionForm', array("class" => "input-block-level", "placeholder" => "New password"))) ?>
		<?php if ($this->ActionError && !$this->ActionError->isValid('password')): ?>
			<p class='text-error'><?php assign($this->ActionError->getMessage('password')) ?> </p>
		<?php endif; ?>

		<?php write_html($this->formPassword('retype-password', 'ActionForm', array("class" => "input-block-level", "placeholder" => "Retype new password"))) ?>

		<div>
			<button class='btn btn-large btn-primary' type='submit'>Update</button>
		</div>
	</div>			
</form>
</div>
<?php write_html($this->Widgets->loadWidget('UserFooter')->render()) ?>
