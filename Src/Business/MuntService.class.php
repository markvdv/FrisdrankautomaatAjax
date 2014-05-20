<?php

namespace Src\Business;

use Src\Data\MuntDAO;

class MuntService {

    private static $wisselgeldAantal = 10;

    /*     * getMunten():haalt alle muntgegevens opp uit de db en maakt er objecten van
     * 
     * @return array van muntobjecten
     */
    public static function getMunten() {
        $lijst = MuntDAO::getAll();
        return $lijst;
    }
    public static function getMuntenJson(){
        $lijst = MuntDAO::getAll();
        return json_encode($lijst);
    }

    /*     * maakGeldLadeLeeg: Haalt al het geld uit de geldlade
     * 
     */
    public static function maakGeldLadeLeeg() {
        MuntDAO::update(0);
    }

    /*     * steekWisselGeldIn: steekt wisselgeld in de geldlade
     * 
     */
    public static function steekWisselGeldIn() {
        MuntDAO::update(self::$wisselgeldAantal);
    }

    /*     * haalMuntUitGeldLade:Haalt een munt uit de geldlade
     * 
     * @param object $munt
     */
    public static function haalMuntUitGeldLade($muntId, $aantal) {
        $munt = MuntDAO::getById($muntId);
        $huidigAantal = $munt->getAantal();
        $nieuwAantal =$huidigAantal - $aantal;
        MuntDAO::update($nieuwAantal, $muntId);
    }

    /*     * steekMuntInGeldLade:steekt een munt in de geldlade
     * 
     * @param object $munt
     */

    public static function steekMuntInGeldLade($muntId, $aantal) {
        $munt = MuntDAO::getById($muntId);
       $munt->setAantal($munt->getAantal()+1);
        MuntDAO::update($munt->getAantal(), $muntId);
    }

    public static function berekenTotaalInGeldLade() {
        $muntlijst = MuntDAO::getAll();
        $totaalGeld = 0;
        foreach ($muntlijst as $munt) {
            $totaalGeld+=$munt->getAantal() * $munt->getWaarde();
        }
        return $totaalGeld;
    }

}
