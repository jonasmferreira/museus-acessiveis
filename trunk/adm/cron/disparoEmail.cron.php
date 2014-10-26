<?php
$path_root_emailmktController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_emailmktController = "{$path_root_emailmktController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_emailmktController}adm{$DS}class{$DS}emailmkt.class.php";
$obj = new emailmkt();
$obj->disparo();