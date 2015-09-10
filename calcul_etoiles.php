<?php


include("getArray_etoiles_ennemyWin.php");
include("getArray_etoiles_teamLost.php");

$tot_battles = N_VILLAGES*2;

function getArray_etoiles_ennemyWin($ve_1,$ve_2,$ve_3,$ve_4,$ve_5,$ve_6,$ve_7,$ve_8,$ve_9,$ve_10,$ve_11,$ve_12,$ve_13,$ve_14,$ve_15,$ve_16,$ve_17,$ve_18,$ve_19,$ve_20) {
    return array(
        $ve_1, # 1
        $ve_2, # 2
        $ve_3, # 3
        $ve_4, # 4
        $ve_5, # 5
        $ve_6, # 6
        $ve_7, # 7
        $ve_8, # 8
        $ve_9, # 9
        $ve_10, # 10
        $ve_11, # 11
        $ve_12, # 12
        $ve_13, # 13
        $ve_14, # 14
        $ve_15, # 15
        $ve_16, # 16
        $ve_17, # 17
        $ve_18, # 18
        $ve_19, # 19
        $ve_20 # 20
        );
}

function getArray_etoiles_teamLost($vt_1,$vt_2,$vt_3,$vt_4,$vt_5,$vt_6,$vt_7,$vt_8,$vt_9,$vt_10,$vt_11,$vt_12,$vt_13,$vt_14,$vt_15,$vt_16,$vt_17,$vt_18,$vt_19,$vt_20) {
    return array(
        $vt_1, # 1
        $vt_2, # 2
        $vt_3, # 3
        $vt_4, # 4
        $vt_5, # 5
        $vt_6, # 6
        $vt_7, # 7
        $vt_8, # 8
        $vt_9, # 9
        $vt_10, # 10
        $vt_11, # 1
        $vt_12, # 2
        $vt_13, # 3
        $vt_14, # 4
        $vt_15, # 5
        $vt_16, # 6
        $vt_17, # 7
        $vt_18, # 8
        $vt_19, # 9
        $vt_20 # 10
    	);
}



$n = getArray_etoiles_ennemyWin($ve_1,$ve_2,$ve_3,$ve_4,$ve_5,$ve_6,$ve_7,$ve_8,$ve_9,$ve_10,$ve_11,$ve_12,$ve_13,$ve_14,$ve_15,$ve_16,$ve_17,$ve_18,$ve_19,$ve_20);
$n_team_victory = array_sum($n);
foreach ($n as $value) {
    if($value==4){$n_team_victory = $n_team_victory - 4;}
}

$n = getArray_etoiles_teamLost($vt_1,$vt_2,$vt_3,$vt_4,$vt_5,$vt_6,$vt_7,$vt_8,$vt_9,$vt_10,$vt_11,$vt_12,$vt_13,$vt_14,$vt_15,$vt_16,$vt_17,$vt_18,$vt_19,$vt_20);
$n_ennemy_victory = array_sum($n);
foreach ($n as $value) {
    if($value==4){$n_ennemy_victory = $n_ennemy_victory - 4;}
}

?>