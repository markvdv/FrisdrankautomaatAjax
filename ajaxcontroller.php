<?php

use Src\Business\ApplicatieService;
use Src\DTO\SaldoDTO;
use Doctrine\Common\ClassLoader;

require_once ('Doctrine/Common/ClassLoader.php');
$classLoader = new ClassLoader("Src");
$classLoader->register();
$classLoader->setFileExtension(".class.php"); // </editor-fold>

session_start();
$automaat = ApplicatieService::getApplicationData();

if (!empty($_GET)) {
    $automaat->test = "met get";
    $oSaldo = new SaldoDTO;
    $oSaldo->setMunten($_GET['saldo']['munten']);
    $return = ApplicatieService::verkoopFrisdrank($oSaldo, $_GET['aankoopdrankprijs'], $_GET['aankoopdrankid']);
    if (is_array($return)) {
        $automaat->teruggave = $return;
    } elseif (is_object($return)) {
        $automaat->error = $return;
    }
}
echo (json_encode($automaat));
