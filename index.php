<?php
ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);

define ('DIRSEP', DIRECTORY_SEPARATOR);
define ('SITE_PATH', realpath(dirname(__FILE__)) . DIRSEP);
define("CLASSES_DIR", SITE_PATH . "classes" . DIRSEP);
define("PAGES_DIR", SITE_PATH . "pages" . DIRSEP);
define("UPLOADS_DIR", SITE_PATH . "uploads" .DIRSEP);
define("TEMP_DIR", SITE_PATH . "tmp" .DIRSEP);

require_once "classes/app.php";
$app = new App();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Resumable Uploads</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/material.min.css">
    <link rel="stylesheet" href="assets/css/material_icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/jquery-1.11.3.min.js"></script>
    <script src="assets/js/material.min.js"></script>
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
        <div aria-expanded="false" role="button" tabindex="0" class="mdl-layout__drawer-button"><i class="mdi mdi-24px mdi-menu"></i></div>
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title">Resumable Uploads</span>
            <div class="mdl-layout-spacer"></div>
            <nav class="mdl-navigation mdl-layout--large-screen-only">
                <a class="mdl-navigation__link" href="index.php"><i class='mdi mdi-home'></i>&nbsp;Home</a>
                <a class="mdl-navigation__link" href="index.php?route=upload"><i class='mdi mdi-upload'></i>&nbsp;Upload</a>
                <a class="mdl-navigation__link" target="_blank" href="http://shulga.makels.site"><i class='mdi mdi-account'></i>&nbsp;About me</a>
            </nav>
        </div>
    </header>
    <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">Menu</span>
        <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="index.php"><i class='mdi mdi-home'></i>&nbsp;Home</a>
            <a class="mdl-navigation__link" href="index.php?route=upload"><i class='mdi mdi-upload'></i>&nbsp;Uploads</a>
            <a class="mdl-navigation__link" target="_blank" href="http://shulga.makels.site"><i class='mdi mdi-account'></i>&nbsp;About me</a>
        </nav>
    </div>
    <main class="mdl-layout__content">
        <div class="page-content">
            <?php $app->run(); ?>
        </div>
    </main>
</div>
</body>
</html>