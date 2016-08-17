<?php write_html($this->Widgets->loadWidget('UserHeader')->render(array('User' => $this->user))) ?>

<div class="row">

		<form class="form-signin" action="create_user" method="post">
			<h3 class="form-signin-heading">Create an account</h3>

			<?php if ($this->ActionError): ?>
				<div class="alert alert-error">
					入力エラーが存在します。
				</div>
			<?php endif; ?>

			<?php write_html($this->formText('email', 'ActionForm', array("class" => "input-block-level",
				"placeholder" => "Email"))) ?>

			<?php if ($this->ActionError && !$this->ActionError->isValid('email')): ?>
				<p class="text-error"><?php assign($this->ActionError->getMessage('email')) ?></p>
			<?php endif; ?>
			
			<?php write_html($this->formText('password', 'ActionForm', array("class" => "input-block-level",
				"placeholder" => "Password"))) ?>

			<?php if ($this->ActionError && !$this->ActionError->isValid('password')): ?>
				<p class="text-error"><?php assign($this->ActionError->getMessage('password')) ?></p>
			<?php endif; ?>

			<?php if ($this->ActionError && !$this->ActionError->isValid('login')): ?>
				<p class="text-error"><?php assign($this->ActionError->getMessage('login')) ?></p>
			<?php endif; ?>

			<?php write_html($this->formPassword('password', 'ActionForm', array("class" => "input-block-level", "placeholder" => "Retype password"))) ?>

			<?php if ($this->ActionError && !$this->ActionError->isValid('password')): ?>
			<p class="text-error"><?php assign($this->ActionError->getMessage('password')) ?></p>
			<p class="text-error"></p>
			<?php endif; ?>
			<button class="btn btn-large btn-primary" type="submit">Submit</button>
		</form>
</div>

<?php write_html($this->Widgets->loadWidget('UserFooter')->render()) ?>