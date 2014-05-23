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
        return $automaat;
    }

    /*     * verkoopFrisdrank MISSCHIEN hernoemen?: verkoopt een frisdrank en update de database,
     * 
     * @param object $oSaldo
     * @param int $iPrijs
     * @param int $iDrankid
     * @return \Src\Exceptions\TeLaagSaldoException|\Src\Exceptions\GeenGeldException|array van teruggave
     */

    public static function verkoopFrisdrank($oSaldo, $iDrankid) {
        /*
        $outputObj = new \stdClass();
        $exceptions = array();
        if (naamveld leeg) {
            $exceptions[] = "NAME_IS_EMPTY";
        }
        if (pwd te kort) {
            $exceptions[] = "PWD_TOO_SHORT";
        }
        if (count($exceptions) > 0) {
            $outputObj->exceptions = $exceptions;
            return $outputObj;
        }
        $outputObj->iets = "";
        return $outputObj;
         */
        
        /*
        $outputObj = new \stdClass();
        $exceptions = array();
        try {
            if (naamveld leeg) {
                $exceptions[] = "NAME_IS_EMPTY";
            }
            if (ernstige fout stop direct) {
                $exceptions[] = "NU_STOPPEN";
                throw new Exception();
            }
            if (pwd te kort) {
                $exceptions[] = "PWD_TOO_SHORT";
            }
            if (count($exceptions) > 0) {
                throw new Exception();
            }
            $outputObj->iets = "";
        } catch (Exception $ex) {
            $outputObj->exceptions = $exceptions;
            return $outputObj;
        }
        return $outputObj;
        */
        
        
        
        
        
        try {
            $aTeruggave = AankoopService::verkoopDrank($oSaldo, $iDrankid);
            return $aTeruggave;
        } catch (TeLaagSaldoException $TLSe) {
            //return 'te laag saldo';
            //hier al error als object instellen met properties en returnen
            return $TLSe;
        } catch (GeenGeldException $GGe) {
            return $GGe;
        }
    }

}
