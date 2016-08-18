<?php
header("content-type: text/html; charset=utf-8");
require_once("../DatabasePDO.php");
ignore_user_abort();

$delay = 60;
do{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://www.228365365.com/sports.php");
    curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
    $pageContent = curl_exec($ch);

    curl_setopt($ch, CURLOPT_URL, "http://www.228365365.com/app/member/FT_browse/body_var.php?uid=test00&rtype=r&langx=zh-cn&mtype=3&page_no=0&league_id=&hot_game=undefined");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $pageContent = curl_exec($ch);

    curl_close($ch);


    $dataArray = explode('parent.GameFT', $pageContent);
    echo $dataArrayLength =  count($dataArray);

    for($i = 1; $i <= 3; $i++){
        $dataArray[$i] = explode(',', $dataArray[$i]);
        for($j = 1; $j <= 10; $j++){
            $dataArray[$i][$j] = str_replace("'", "", $dataArray[$i][$j]);
            setVariable($dataArray[$i], $i);

        }
    }
    $number++;
    sleep($delay);
}while(true);


//=========================  FUNCTION  ==============================

function setVariable($dataArray, $i)
{
    $time = substr($dataArray[1], 9, 5);
    $name = $dataArray[2];
    $team = $dataArray[5] . ' ' . $dataArray[6];
    $fullAlone = $dataArray[15];
    $fullBall = $dataArray[9];
    $fullSize = $dataArray[12] . ' ' . $dataArray[14];
    $fullSingleDouble = $dataArray[18] . ' ' . $dataArray[20];
    $halfAloneWin = $dataArray[31] . ' ';
    $halfBall = $dataArray[25] . ' ';
    $halfSize = $dataArray[28] . ' ' . $dataArray[30];
    $id = ($i * 3) - 2;
    updateData($time, $name, $team, $fullAlone, $fullBall, $fullSize, $fullSingleDouble, $halfAloneWin, $halfBall, $halfSize, $id);

    $time = substr($dataArray[1], 9, 5);
    $name = $dataArray[2];
    $team = $dataArray[5] . ' ' . $dataArray[6];
    $fullAlone = $dataArray[16];
    $fullBall = $dataArray[10];
    $fullSize = $dataArray[11] . ' ' . $dataArray[13];
    $fullSingleDouble = $dataArray[19] . ' ' . $dataArray[21];
    $halfAloneWin = $dataArray[32] . ' ';
    $halfBall = $dataArray[26] . ' ';
    $halfSize = $dataArray[27] . ' ' . $dataArray[29];
    $id = ($i * 3) - 1;
    updateData($time, $name, $team, $fullAlone, $fullBall, $fullSize, $fullSingleDouble, $halfAloneWin, $halfBall, $halfSize, $id);

    $time = substr($dataArray[1], 9, 5);
    $name = $dataArray[2];
    $team = $dataArray[5] . ' ' . $dataArray[6];
    $fullAlone = $dataArray[17];
    $fullBall = null;
    $fullSize = null;
    $fullSingleDouble = null;
    $halfAloneWin = $dataArray[33] . ' ';
    $halfBall = null;
    $halfSize = null;
    $id = $i * 3;
    $result = updateData($time, $name, $team, $fullAlone, $fullBall, $fullSize, $fullSingleDouble, $halfAloneWin, $halfBall, $halfSize, $id);
}





function updateData($time, $name, $team, $fullAlone, $fullBall, $fullSize, $fullSingleDouble, $halfAloneWin, $halfBall, $halfSize, $id)
{
    $pdo = new DatabasePDO;
    $grammer = "UPDATE `Game` SET
        `time` = :time,
        `name` = :name,
        `team` = :team,
        `fullAlone` = :fullAlone,
        `fullBall` = :fullBall,
        `fullSize` = :fullSize,
        `fullSingleDouble` = :fullSingleDouble,
        `halfAloneWin` = :halfAloneWin,
        `halfBall` = :halfBall,
        `halfSize` = :halfSize
        WHERE `id` = :id";
    $paramArray = [
        ':time' => $time,
        ':name' => $name,
        ':team' => $team,
        ':fullAlone' => $fullAlone,
        ':fullBall' => $fullBall,
        ':fullSize' => $fullSize,
        ':fullSingleDouble' => $fullSingleDouble,
        ':halfAloneWin' => $halfAloneWin,
        ':halfBall' => $halfBall,
        ':halfSize' => $halfSize,
        ':id' => $id
    ];
    $result = $pdo->change($grammer, $paramArray);
}






