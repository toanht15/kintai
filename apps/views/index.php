
<?php write_html($this->Widgets->loadWidget('UserHeader')->render()) ?>
    <div class="row-fluid">
        <div class="span12">
            <p align="center"><a href="/user/register" class = "btn btn-primary">Register</a></p>
        </div>
    </div>
<?php write_html ( $this->Widgets->loadWidget( 'UserFooter' )->render () )?>