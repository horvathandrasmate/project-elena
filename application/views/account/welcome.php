<?php

?>

<link rel="stylesheet" href="<?php echo css_url('account/welcome.css') ?>">
<div class="center">
    <h1>

        <?php echo lang("welcome_message");?> <i><b><?php echo $this->config->item("project_title")?></b></i>

    </h1>
    <div class="bottom-center">
        <a class="btn btn-primary " href="<?php echo base_url('account/login')?>" >
        <?php echo lang("login");?>
        </a>
    </div>
</div>
