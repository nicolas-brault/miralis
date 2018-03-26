<?php
require ('Test/TestListe.php');
/**
 * Created by PhpStorm.
 * User: c16000805
 * Date: 26/03/18
 * Time: 13:51
 */

function charger () {
     $json_source = file_get_contents("/dev/players.json");
     $json_data = json_decode($json_source, true);
     return $json_data;
}

function compter ($json_data) {

    $cpt = 0;

    foreach ($json_data as $value) {
        if(isset($value['playerID']) && isset($value))
            $cpt += 1;
    }
    if ($cpt == 100)
        return true;
    else
        return false;
}