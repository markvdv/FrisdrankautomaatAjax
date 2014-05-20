<?php

use Doctrine\Common\ClassLoader;
use Src\DTO\Src\DTO\SaldoDTO;

require_once ('Doctrine/Common/ClassLoader.php');
$classLoader = new ClassLoader("Src");
$classLoader->register();
$classLoader->setFileExtension(".class.php"); // </editor-fold>

session_start();

if (!isset($_SESSION['saldo'])) {
    //$_SESSION['saldo']= array(10=>0,20=>0,50=>0,100=>0,200=>0);
    $saldo = new SaldoDTO();
    $_SESSION['saldo'] = serialize($saldo);
    
}
$saldo = unserialize($_SESSION['saldo']);
if (isset($_GET['id'])) {
    $saldo->munten[$_GET['id']]+=1;
    $_SESSION['saldo'] = serialize($saldo);
}
include "Src/Business/Ajax_JSON.php";
