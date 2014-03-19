<?php

include "bootstrap.php";
include "assets.php";

// In your controller.php
use \BuboBox\Assets as Assets;
Assets::css('modules/asset/assets/style1.css');
Assets::css('modules/asset/assets/style2.css');

// In your view.php
echo Assets::render(false, true);