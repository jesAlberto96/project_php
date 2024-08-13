<?php
require 'helpers/validate.php';
require 'config/database.php';
require 'routes/web.php';

$url = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

route($url, $method);