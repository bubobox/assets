<?php

/**
 * Something that is a common practice in web development is loading your CSS files in the header
 * and your javascript files in the footer. 
 * This example shows you how that is done
 */

include "bootstrap.php";
include "assets.php";

// In your controller.php
use \BuboBox\Assets as Assets;
Assets::js('modules/asset/assets/script.js');
Assets::css('modules/asset/assets/style.css');

// In your view.php
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Assets example</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <?php echo Assets::render(false, true) ?>
    </head>
    <body>
    	<p>Hello world!</p>
        <?php echo Assets::render(true, false) ?>
    </body>
</html>