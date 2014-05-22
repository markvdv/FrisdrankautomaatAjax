<?php

use Src\Business\ApplicatieService;
use Doctrine\Common\ClassLoader;

require_once ('Doctrine/Common/ClassLoader.php');
$classLoader = new ClassLoader("Src");
$classLoader->register();
$classLoader->setFileExtension(".class.php"); // </editor-fold>

session_start();

if (empty($_GET)) {
    $automaat = ApplicatieService::getApplicationData();
}
else{
   $data= json_decode($_GET);
   
   
   
   
   $automaat= json_decode($_GET);
}



echo (json_encode($automaat));





/*if (isset($_GET['id']) && (isset($_GET['type']) && (isset($_GET['prijs'])))) {
    $drankid = $_GET['id'];
    $dranktype = $_GET['type'];
    $drankprijs = $_GET['prijs'];
   // unset($_SESSION['saldo']);
    
}
if (!isset($_SESSION['saldo'])) {
    $saldo = new SaldoDTO();
}
$saldo = unserialize($_SESSION['saldo']);
if (isset($_GET['id']) && (!isset($_GET['type']))) {
    $munten = $saldo->getMunten();
    $munten[$_GET['id']]+=1;
    $saldo->setMunten($munten);
    $_SESSION['saldo'] = serialize($saldo);
}
include "Src/Business/Ajax_JSON.php";
 * 
 * 
 * 
if (isset($drankid) && isset($dranktype)) {
    //FrisdrankService::geefFrisdrank($drankid);
    try{
    $arr['teruggave'] = AankoopService::verkoopDrank($saldo, $drankprijs, $drankid);
    $arr['dranktype'] = $dranktype;
    $saldo->leegSaldo();
    }
    catch (TeLaagSaldoException $TLSe){
       $arr['error']=$TLSe; 
    }
    catch (GeenGeldException $GGe){
       $arr['error']=$GGe; 
    }
}

$arr['saldo'] = $saldo;
$arr['munten'] = MuntService::getMunten();
$arr['dranken'] = FrisdrankService::haalFrisdrankenOp();

$json = json_encode($arr);
echo $json;
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 *  */
