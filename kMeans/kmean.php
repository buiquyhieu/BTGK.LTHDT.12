<?php
require_once 'docExcel.php';
$dulieu= excel();
//$dulieu = array(
//            0 => array(
//                'toan' => 5.5,
//                'van' => 4.5,
//                'nhom' => NULL
//            ),
//            1 => array(
//                'toan' => 4,
//                'van' => 4.25,
//                'nhom' => NULL
//            ),
//            2 => array(
//                'toan' => 4,
//                'van' => 4.5,
//                'nhom' => NULL
//            ),
//            3 => array(
//                'toan' => 6,
//                'van' => 5.75,
//                'nhom' => NULL
//            ),
//            4 => array(
//                'toan' => 6,
//                'van' => 5.25,
//                'nhom' => NULL
//            ),
//            5 => array(
//                'toan' => 6,
//                'van' => 5.25,
//                'nhom' => NULL
//            ),
//            6 => array(
//                'toan' => 4,
//                'van' => 6,
//                'nhom' => NULL
//            ),
//            7 => array(
//                'toan' => 4.5,
//                'van' => 4,
//                'nhom' => NULL
//            ),
//            8 => array(
//                'toan' => 3,
//                'van' => 5.25,
//                'nhom' => NULL),
//            9 => array(
//                'toan' => 2,
//                'van' => 3.25,
//                'nhom' => NULL
//            )
//        );
        $N = count($dulieu);
//        echo $N;
        $cum = array(
            1 => array(
                'tamcum' => array()
            ),
            2 => array(
                'tamcum' => array()
            ),
            3=>array(
                'tamcum'=>array()
            )
        );
        $cum[1]['tamcum'] = $dulieu[0];
        $cum[2]['tamcum'] = $dulieu[1];
        $cum[3]['tamcum']=$dulieu[2];
        $temp = 1000;
        $t = 0;
        do {
//    $t++;
            for ($i = 1; $i < 4; $i++) {
                $cum[$i]['tamcum']['nhom'] = 0;
            }
            for ($i = 0; $i < $N; $i++) {
                $min = 1000;
                for ($j = 1; $j < 4; $j++) {
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
//        if ($t==5) {
//            echo '<pre>';
//            print_r($cum);
//            break;
//        }
            $tongKC = 0;
//        echo $cum[1][0]['toan'];
            for ($i = 1; $i < 4; $i++) {
                $m = count($cum[$i]) - 1;
                for ($j = 0; $j < $m; $j++) {
//               $kc=sqrt(pow($cum[$i]['tamcum']['toan']-$cum[$i][$j]['toan'], 2)+pow($cum[$i]['tamcum']['van']-$cum[$i][$j]['van'], 2));
//               echo $kc.'<br/>';
                    $tongKC = $tongKC + sqrt(pow($cum[$i]['tamcum']['toan'] - $cum[$i][$j]['toan'], 2) + pow($cum[$i]['tamcum']['van'] - $cum[$i][$j]['van'], 2));
                }
            }
//       echo $tongKC;
            if (abs($tongKC - $temp) < 0.00001) {
                die(json_encode($cum));
        
                break;
            } else {
                $temp = $tongKC;
            }
//        echo '<pre>';
//        print_r($cum);
            for ($i = 1; $i < 4; $i++) {
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
