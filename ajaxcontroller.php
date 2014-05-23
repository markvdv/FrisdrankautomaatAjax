<?php

use Src\Business\ApplicatieService;
use Src\DTO\SaldoDTO;
use Doctrine\Common\ClassLoader;

require_once ('Doctrine/Common/ClassLoader.php');
$classLoader = new ClassLoader("Src");
$classLoader->register();
$classLoader->setFileExtension(".class.php"); // </editor-fold>

session_start();
$automaat = ApplicatieService::getApplicationData(); //stdclass met de algemene data die wordt aangepast naargelang het saldo verandert
if (!isset($_SESSION['saldo'])) {
    $saldo = new SaldoDTO();
    $_SESSION['saldo'] = serialize($saldo);
}
$saldo = unserialize($_SESSION['saldo']);
if (!empty($_GET)) {
    switch ($_GET['action']) {
        case "steekgeldin":
            $saldo->steekMuntInSaldo($_GET['id']);
            $_SESSION['saldo'] = serialize($saldo);
            break;
        case "aankoop":
            $return = ApplicatieService::verkoopFrisdrank($saldo, $_GET['drankid']);
            $saldo->leegSaldo();
            $_SESSION['saldo']=serialize($saldo);
            if (is_array($return)) {
                $automaat->teruggave = $return;
            } elseif (is_object($return)) {
                $automaat->error = $return;
            }
            break;
        case "geldterug":
            $saldo->leegSaldo();
            $_SESSION['saldo'] = serialize($saldo);
    }
}
$automaat->totaalsaldo = $saldo->geefTotaalSaldo(); //misschien gewoon nul?
echo (json_encode($automaat));
