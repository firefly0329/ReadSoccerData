<?php

require_once("../DatabasePDO.php");

class GetDataToAPI
{
    function getDataList()
    {
        $pdo = new DatabasePDO;
        for($i = 0; $i <= 9; $i++){
            $id = ($i * 3) + 1;
            $grammer = "SELECT `time`, `name`, `team` FROM `Game` WHERE `id` = :id";
            $paramArray = [':id' => $id];
            $data[] = $pdo->selectOnce($grammer, $paramArray);
        }

        return $data;
    }


    function getSingleData($id)
    {
        $pdo = new DatabasePDO;

            $grammer = "SELECT * FROM `Game` WHERE `id` = :id";
            $paramArray = [':id' => $id];
            $data = $pdo->selectOnce($grammer, $paramArray);
        return $data;
    }
}