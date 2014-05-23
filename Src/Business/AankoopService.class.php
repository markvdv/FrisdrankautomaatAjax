<?php

namespace Src\Business;

use Src\Exceptions\TeLaagSaldoException;
use Src\Exceptions\GeenGeldException;
use Src\Exceptions\InvalidParameterException;

class AankoopService {

    /** verkoopDrank
     * 
     * @param array $ingegevengeld associatieve array voor munten; muntwaarden zijn keys en aantallen values
     * @param integer $prijs
     * @param object $obj automaat object
     */
    public function verkoopDrank($oSaldo, $iDrankid) {
        //checken 
        $frisdrank=FrisdrankService::getFrisdrankById($iDrankid);
        if ($frisdrank==null){
            throw new InvalidParameterException("ongeldige parameter",2);
        }
        //check of er genoeg geld is ingeven om een drank aan te kopen
        $totaalSaldo = $oSaldo->geefTotaalSaldo();
        if ($totaalSaldo < $frisdrank->getPrijs()) {
            throw new TeLaagSaldoException("niet genoeg geld ingegeven",0);
        }
       //check of er genoeg geld is om weer te geven 
        $teruggaveBedrag = $totaalSaldo -  $frisdrank->getPrijs();
       $totaalGeld = MuntService::berekenTotaalInGeldLade();
        if ($totaalGeld < $teruggaveBedrag) {
            throw new GeenGeldException("niet genoeg geld om weer te geven",1);
        }
        
       

        //berekenen array van teruggave
        $aTeruggave = array(200 => 0, 100 => 0, 50 => 0, 20 => 0, 10 => 0);
        foreach ($aTeruggave as $key => $value) {
            while ($teruggaveBedrag >= $key) {
                $teruggaveBedrag-=$key;
                $aTeruggave[$key]+=1;
            }
        }
        if ($teruggaveBedrag > 0) {
            throw new GeenGeldException("niet genoeg geld om weer te geven",1);
        } else {
            foreach ($aTeruggave as $key => $value) {
                MuntService::haalMuntUitGeldLade($key, $value);
            }
        }
         //saldo munten in geldlade steken
        foreach ($oSaldo->getMunten() as $muntWaarde => $muntAantal) {
            if ($muntAantal > 0) {
                MuntService::steekMuntInGeldLade($muntWaarde, $muntAantal);
            }
        }
        FrisdrankService::geefFrisdrank($iDrankid);
        return $aTeruggave;
    }

}
