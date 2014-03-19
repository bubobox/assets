<?php

include "bootstrap.php";
include "assets.php";

// In your controller.php
use \BuboBox\Assets as Assets;
Assets::js('modules/asset/assets/script1.js');
Assets::js('modules/asset/assets/script2.js');

// In your view.php
echo Assets::render(true, false);