<?php
include_once 'classes/Vine.php';

use Vine\Vine;

$whisky = new Vine();

$data = $whisky->getAllData();

echo $data;

return;





