<?php
require ('Test/TestListe.php');
/**
 * Created by PhpStorm.
 * User: c16000805
 * Date: 26/03/18
 * Time: 13:51
 */

function charger () {
     $json_source = file_get_contents("/players.json"); //à mettre à jour quand le site sera en ligne
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

function getVet ($json_data) {

    $json_data_vet = [];

    foreach ($json_data as $value) {
        if ($value['HR'] >= 50)
            $json_data_vet += $value;
    }
    return $json_data_vet;
}

function getNew ($json_data) {

    $json_data_new = [];

    foreach ($json_data as $value) {
        if ($value['HR'] < 50)
            $json_data_new += $value;
    }
    return $json_data_new;
}

function getRole ($json_data, $role) {

    $json_data_role = [];

    foreach ($json_data as $value) {
        if ($value['role'] == $role)
            $json_data_role += $value;
    }
    return $json_data_role;
}

function matchmaking($json_data) {
    $json_data_vet = getVet($json_data);
    $json_data_new = getNew($json_data);
    $json_data_equipe = [];

    $rand = rand(0,sizeof($json_data_vet)-1);
    array_push($json_data_equipe,$json_data_vet[$rand]);
    array_splice($json_data_vet, $rand, 1 );

    $rand = rand(0,sizeof($json_data_vet)-1);
    array_push($json_data_equipe,$json_data_vet[$rand]);

    $rand = rand(0,sizeof($json_data_vet)-1);
    array_push($json_data_equipe, $json_data_new[$rand]);
    array_splice($json_data_new, $rand, 1);

    $rand = rand(0,sizeof($json_data_vet)-1);
    array_push($json_data_equipe, $json_data_new[$rand]);

    return $json_data_equipe;
}