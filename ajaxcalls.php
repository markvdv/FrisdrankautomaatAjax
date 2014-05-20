<?php
use Doctrine\Common\ClassLoader;

require_once ('Doctrine/Common/ClassLoader.php');
$classLoader = new ClassLoader("Src");
$classLoader->register();
$classLoader->setFileExtension(".class.php"); // </editor-fold>

session_start();

if(!isset($_SESSION['saldo'])){
    $_SESSION['saldo']= array(10=>0,20=>0,50=>0,100=>0,200=>0);
}
if (isset($_GET['id'])){
    $_SESSION['saldo'][$_GET['id']]+=1;
}
$saldo=unserialize($_SESSION['saldo']);
include "Src/Business/Ajax_JSON.php";