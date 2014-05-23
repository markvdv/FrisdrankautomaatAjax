<?php

namespace Src\Business;

use Src\Business\FrisdrankService;
use Src\Business\AankoopService;
use Src\Business\MuntService;
use Src\DTO\SaldoDTO;
use Src\Exceptions\TeLaagSaldoException;
use Src\Exceptions\GeenGeldException;

class ApplicatieService {
    /*      *getApplicationData
     *: ophaalpunt voor ajaxcalls die alle nodige startdata klaarzet;
     * 
     * @return \stdClass
     */

    public static function getApplicationData() {
        $automaat = new \stdClass();
        $automaat->munten = MuntService::getMunten();
        $automaat->dranken = FrisdrankService::haalFrisdrankenOp();
        $automaat->saldo = new SaldoDTO();
        return $automaat;
    }

    /*     * verkoopFrisdrank MISSCHIEN hernoemen?: verkoopt een frisdrank en update de database,
     * 
     * @param object $oSaldo
     * @param int $iPrijs
     * @param int $iDrankid
     * @return \Src\Exceptions\TeLaagSaldoException|\Src\Exceptions\GeenGeldException|array van teruggave
     */

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

}
