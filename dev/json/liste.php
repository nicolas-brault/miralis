<?php
require ('test/TestListe.php');
/**
 * Created by PhpStorm.
 * User: c16000805
 * Date: 26/03/18
 * Time: 13:51
 */

function charger () {
     $json_source = file_get_contents("/home/miralis/players.json");
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
    $json_data = charger();
    $json_data_vet = getVet($json_data);
    $json_data_new = getNew($json_data);

    $json_DPS_Vet = getRole($json_data_vet,"DPS");
    $json_Healer_Vet = getRole($json_data_vet,"Healer");
    $json_Tank_Vet = getRole($json_data_vet,"Tank");

    $json_DPS_New = getRole($json_data_new,"DPS");
    $json_Healer_New = getRole($json_data_new,"Healer");
    $json_Tank_New = getRole($json_data_new,"Tank");


    $rPlayerType = True;

    for ($i=0; $i < 25; $i++) {
        $json_data_compo = ["DPS", "DPS", "Healer", "Tank"];
        $json_data_equipe = [];
        while (sizeof($json_data_equipe) < 4) {
            if ($rPlayerType) {

                $rRole = rand(0,sizeof($json_data_compo)-1);

                switch ($json_data_compo[$rRole]) {
                    case "DPS":
                        $rPlayer = rand(0,sizeof($json_DPS_Vet)-1);
                        array_push($json_data_equipe, $json_DPS_Vet[$rPlayer]);
                        array_splice($json_DPS_Vet, $rPlayer, 1 );
                        break;
                    case "Healer":
                        $rPlayer = rand(0,sizeof($json_Healer_Vet)-1);
                        array_push($json_data_equipe, $json_Healer_Vet[$rPlayer]);
                        array_splice($json_Healer_Vet, $rPlayer, 1 );
                        break;
                    case "Tank":
                        $rPlayer = rand(0,sizeof($json_Tank_Vet)-1);
                        array_push($json_data_equipe, $json_Tank_Vet[$rPlayer]);
                        array_splice($json_Tank_Vet, $rPlayer, 1 );
                        break;
                }
                if (count($json_DPS_Vet) == 0 || count($json_Healer_Vet) == 0 || count($json_Tank_Vet) == 0)
                    array_splice($json_data_compo, $rRole, 1);
                $rPlayerType = !$rPlayerType;

            } else {

                $rRole = rand(0,sizeof($json_data_compo)-1);

                switch ($json_data_compo[$rRole]) {
                    case "DPS":
                        $rPlayer = rand(0,sizeof($json_DPS_New)-1);
                        array_push($json_data_equipe, $json_DPS_New[$rPlayer]);
                        array_splice($json_DPS_New, $rPlayer, 1 );
                        break;
                    case "Healer":
                        $rPlayer = rand(0,sizeof($json_Healer_New)-1);
                        array_push($json_data_equipe, $json_Healer_New[$rPlayer]);
                        array_splice($json_Healer_New, $rPlayer, 1 );
                        break;
                    case "Tank":
                        $rPlayer = rand(0,sizeof($json_Tank_New)-1);
                        array_push($json_data_equipe, $json_Tank_New[$rPlayer]);
                        array_splice($json_Tank_New, $rPlayer, 1 );
                        break;
                }
                if (count($json_DPS_New) == 0 || count($json_Healer_New) == 0 || count($json_Tank_New) == 0)
                    array_splice($json_data_compo, $rRole, 1);
                $rPlayerType = !$rPlayerType;
            }
        }
        $json_data_equipeS[$i] = $json_data_equipe;
    }
    return $json_data_equipeS;
}
