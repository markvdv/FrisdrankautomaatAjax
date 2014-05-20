<?php
use Src\Business\MuntService;
use Src\Business\FrisdrankService;





$arr['munten']=MuntService::getMunten();
$arr['dranken']=FrisdrankService::haalFrisdrankenOp();



$arr['saldo']=$saldo;



$json= json_encode($arr);
echo $json;

