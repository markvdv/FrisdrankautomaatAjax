<?php

namespace Src\Business;

use Src\Business\FrisdrankService;
use Src\Business\AankoopService;
use Src\Business\MuntService;
use Src\DTO\SaldoDTO;
use Src\Exceptions\TeLaagSaldoException;
use Src\Exceptions\GeenGeldException;

class ApplicatieService {

    public static function getApplicationData() {
        $automaat = new \stdClass();
        $automaat->munten = MuntService::getMunten();
        $automaat->dranken = FrisdrankService::haalFrisdrankenOp();
        $automaat->saldo = new SaldoDTO();
        return $automaat;
    }

    public static function verkoopFrisdrank($oSaldo, $iPrijs, $iDrankid) {


        try {
            $aTeruggave = AankoopService::verkoopDrank($oSaldo, $iPrijs, $iDrankid);
            return $aTeruggave;
        } catch (TeLaagSaldoException $TLSe) {
            //return 'te laag saldo';
            return $TLSe;
        } catch (GeenGeldException $GGe) {
            return $GGe;
        }
    }

    /*  public static function schrijfGegevensWeg($obj) {
      $drankenlijst = $obj->frisdranken;
      FrisdrankService::UpdateDranken($drankenlijst);
      $muntenlijst = $obj->munten;
      MuntService::UpdateMunten($muntenlijst);
      } */
}
