<?php

require_once "vendor/autoload.php";

$config = require "config.php";

echo new ApplicationRouter($config);