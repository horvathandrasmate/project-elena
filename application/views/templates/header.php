<html>
<head>
    <meta charset="utf-8">
    <title>
        <?php
        echo isset($page_title) ? $page_title . " - ".$this->config->item("project_name") : $this->config->item("project_name");
        ?>
    </title>

    <link rel="stylesheet" href="<?php echo css_url("bootstrap.min.css")?>" integrity="anonymous" crossorigin="anonymous">

    <link
            href="<?php echo css_url("fonts.css")?>"
            rel="stylesheet">
    <script src="<?php echo js_url("jquery.min.js")?>"></script>
    <script src="<?php echo js_url("sweetalert2.all.min.js")?>"></script>
    <link rel="stylesheet" href="<?php echo css_url("font-awesome.min.css")?>">

    <link rel="icon" href="<?php echo img_url("logo.png") ?>" type="image/x-icon"/>
    <link rel="shortcut icon" href="<?php echo img_url("logo.png") ?>" type="image/x-icon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Custom fonts for this template-->
    <link href="<?php echo css_url("all.min.css")?>" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="<?php echo css_url("dataTables.bootstrap4.css")?>" rel="stylesheet"> 

    <!-- Custom styles for this template-->
    <link href="<?php echo css_url("sb-admin.min.css")?>" rel="stylesheet">
    <link href="<?php echo css_url("main.css")?>" rel="stylesheet">
    <script src="<?php echo js_url("jquery.easing.min.js")?>"></script>
    <script src="<?php echo js_url("all.min.js")?>"></script>
    <script src="<?php echo js_url("bootstrap.bundle.min.js")?>"></script>

    <!-- Page level plugin JavaScript-->
    <script src="<?php echo js_url("Chart.min.js")?>"></script>
    <script src="<?php echo js_url("jquery.dataTables.min.js")?>"></script>
    <script src="<?php echo js_url("dataTables.bootstrap4.min.js")?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo js_url("sb-admin.js")?>"></script>



</head>
<body>