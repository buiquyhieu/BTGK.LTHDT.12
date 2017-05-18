<?php

require_once 'docExcel.php';
require_once 'connectDB.php';
require_once 'update.php';
$dulieu = DB();

$N = count($dulieu);
$cum = array();
$soCum = 4;
for ($i = 0; $i < $soCum; $i++) {
    $cum[$i + 1] = array('tamcum' => array());
}
/*$tempCum = array();
for ($i = 0; $i < $soCum; $i++) {
    $tempCum[$i + 1] = array('tamcum' => array());
}*/

for ($i = 1; $i < $soCum + 1; $i++) {
    $cum[$i]['tamcum'] = $dulieu[$i - 1];
}
/*for ($i = 1; $i < $soCum + 1; $i++) {
    $tempCum[$i]['tamcum']['toan'] = $cum[$i]['tamcum']['toan'];
    $tempCum[$i]['tamcum']['van'] = $cum[$i]['tamcum']['van'];
    $tempCum[$i]['tamcum']['ok'] = 0;
}
        echo '<pre>';
        print_r($tempCum);*/
$temp = 10000;

$eps = 0.000001;
do {
//    $t = 0;
    for ($i = 1; $i < $soCum + 1; $i++) {
        $cum[$i]['tamcum']['nhom'] = 0;
    }
    for ($i = 0; $i < $N; $i++) {
        $min = 1000;
        for ($j = 1; $j < $soCum + 1; $j++) {
            $khoangcach = pow($dulieu[$i]['toan'] - $cum[$j]['tamcum']['toan'], 2) + pow($dulieu[$i]['van'] - $cum[$j]['tamcum']['van'], 2);
            if ($khoangcach < $min) {
                $min = $khoangcach;
                $dulieu[$i]['nhom'] = $j;
            }
        }
        $abc = $cum[$dulieu[$i]['nhom']]['tamcum']['nhom'];
        $cum[$dulieu[$i]['nhom']]['tamcum']['nhom'] = $cum[$dulieu[$i]['nhom']]['tamcum']['nhom'] + 1;

        $cum[$dulieu[$i]['nhom']][$abc] = $dulieu[$i];
    }

    //So sánh tâm cụm
    /*for ($i = 1; $i < $soCum + 1; $i++) {
        $toan = abs($tempCum[$i]['tamcum']['toan'] - $cum[$i]['tamcum']['toan']);
        $van = abs($tempCum[$i]['tamcum']['van'] - $cum[$i]['tamcum']['van']);
        if (($toan <= $eps) && ($van <= $eps)) {
            $tempCum[$i]['tamcum']['ok'] = 1;
        }
    }

    for ($i = 1; $i < $soCum + 1; $i++) {
        if ($tempCum[$i]['tamcum']['ok'] == 1) {
            $t = $t + 1;
        }
    }
    if ($t < 4) {
        for ($i = 1; $i < $soCum + 1; $i++) {
            $tempCum[$i]['tamcum']['toan'] = $cum[$i]['tamcum']['toan'];
            $tempCum[$i]['tamcum']['van'] = $cum[$i]['tamcum']['van'];
            $tempCum[$i]['tamcum']['ok'] = 0;
        }
    } else {
        die(json_encode($cum));
        break;
    }*/
    //khoảng cách đến tâm cụm
    $tongKC = 0;
    for ($i = 1; $i < $soCum + 1; $i++) {
        $m = count($cum[$i]) - 1;
        for ($j = 0; $j < $m; $j++) {
//               $kc=sqrt(pow($cum[$i]['tamcum']['toan']-$cum[$i][$j]['toan'], 2)+pow($cum[$i]['tamcum']['van']-$cum[$i][$j]['van'], 2));
//               echo $kc.'<br/>';
            $tongKC = $tongKC + sqrt(pow($cum[$i]['tamcum']['toan'] - $cum[$i][$j]['toan'], 2) + pow($cum[$i]['tamcum']['van'] - $cum[$i][$j]['van'], 2));
        }
    }
    if (abs($tongKC - $temp) < $eps) {
//        for($i=0;$i<$N;$i++){
//            upDate($dulieu[$i]['SOBAODANH'], $dulieu[$i]['nhom']);
//        }
        die(json_encode($cum));
        break;
    } else {
        $temp = $tongKC;
    }

    //Tính lại tâm cụm
    for ($i = 1; $i < $soCum + 1; $i++) {
        $tongToan = 0;
        $tongVan = 0;
        $soluong = count($cum[$i]) - 1;
        for ($j = 0; $j < $soluong; $j++) {
            $tongToan = $tongToan + $cum[$i][$j]['toan'];
            $tongVan = $tongVan + $cum[$i][$j]['van'];
        }
        $cum[$i]['tamcum']['toan'] = $tongToan / $soluong;
        $cum[$i]['tamcum']['van'] = $tongVan / $soluong;
        for ($k = 0; $k < $soluong; $k++) {
            unset($cum[$i][$k]);
        }
    }
} while (true);
