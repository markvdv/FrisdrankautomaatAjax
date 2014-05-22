<?php

namespace Src\Business;
use Src\Business\FrisdrankService;
use Src\Business\MuntService;
use Src\DTO\SaldoDTO;

class ApplicatieService {

    public static function getApplicationData() {
        $automaat= new \stdClass();
        $automaat->munten=MuntService::getMunten();
        $automaat->dranken=  FrisdrankService::haalFrisdrankenOp();
        $automaat->saldo= new SaldoDTO();
        $automaat->errors= array();
      //  $automaat->aangekocht= false;
        return $automaat;
    }
    
    public static function verkoopFrisdrank(){
        
    }
    
  /*  public static function schrijfGegevensWeg($obj) {
        $drankenlijst = $obj->frisdranken;
        FrisdrankService::UpdateDranken($drankenlijst);
        $muntenlijst = $obj->munten;
        MuntService::UpdateMunten($muntenlijst);
    }*/

}
