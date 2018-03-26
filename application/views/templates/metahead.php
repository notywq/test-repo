<!doctype html>
<head>
    <title><?= $page_title ?> - WebKape</title>

    <!--MANDATORY to enable device-width response on different screens-->
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" type="text/css" href="<?= site_url('css/sandstone.bootstrap.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= site_url('css/fontawesome-all.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= site_url('css/custom/navbar-standard.css') ?>" />

    <!--OPTIONAL COMPONENTS-->
    <?php if (isset($sidebar) && $sidebar == TRUE) { ?>
        <link rel="stylesheet" type="text/css" href="<?= site_url('css/custom/collapsiblesidebar.css') ?>" />
    <?php } ?>

    <?php if (isset($datetimepicker) && $datetimepicker == TRUE) { ?>
        <link href="<?= site_url('css/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet" media="screen" />
    <?php } ?>

</head>
<body>