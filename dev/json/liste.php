<?php
require ('test/TestListe.php');
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
            array_push($json_data_vet, $value);
    }
    return $json_data_vet;
}

function getNew ($json_data) {

    $json_data_new = [];

    foreach ($json_data as $value) {
        if ($value['HR'] < 50)
            array_push($json_data_new, $value);
    }
    return $json_data_new;
}

function getRole ($json_data, $role) {

    $json_data_role = [];

    foreach ($json_data as $value) {
        if ($value['role'] == $role)
            array_push($json_data_role, $value);
    }
    return $json_data_role;
}

function matchmaking() {
    $json_data_compo = ["DPS", "DPS", "Healer", "Tank"];
    $json_data = charger();
    $json_data_vet = getVet($json_data);
    $json_data_new = getNew($json_data);
    $json_data_equipe = [];

    $randRole = rand(0,sizeof($json_data_compo)-1);
    $json_data_role = getRole($json_data_vet,$json_data_compo[$randRole]);
    $rand = rand(0,sizeof($json_data_role)-1);
    array_splice($json_data_role, $rand, 1 );
    array_splice($json_data_compo, $randRole, 1 );
    array_push($json_data_equipe,$json_data_role[$rand]);

    $randRole = rand(0,sizeof($json_data_compo)-1);
    if ($json_data_compo[$randRole] == "DPS" && $json_data_compo[1] != "DPS")
        array_push($json_data_equipe,$json_data_role[$rand]);
    else {
        $json_data_role = getRole($json_data_vet, $json_data_compo[$randRole]);
        $rand = rand(0, sizeof($json_data_role) - 1);
        array_splice($json_data_compo, $randRole, 1 );
        array_push($json_data_equipe, $json_data_role[$rand]);
    }

    $randRole = rand(0,sizeof($json_data_compo)-1);
    $json_data_role = getRole($json_data_new,$json_data_compo[$randRole]);
    $rand = rand(0,sizeof($json_data_role)-1);
    array_splice($json_data_role, $rand, 1 );
    array_splice($json_data_compo, $randRole, 1 );
    array_push($json_data_equipe,$json_data_role[$rand]);

    $randRole = rand(0,sizeof($json_data_compo)-1);
    if ($json_data_compo[$randRole] == "DPS" && $json_data_compo[1] != "DPS")
        array_push($json_data_equipe,$json_data_role[$rand]);
    else {
        $json_data_role = getRole($json_data_new, $json_data_compo[$randRole]);
        $rand = rand(0, sizeof($json_data_role) - 1);
        array_push($json_data_equipe, $json_data_role[$rand]);
    }
    return $json_data_equipe;
}