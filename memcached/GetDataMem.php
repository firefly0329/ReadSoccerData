<?php

require_once("../DatabasePDO.php");

class GetDataToMem
{
    function getDataList()
    {
        $pdo = new DatabasePDO;
        for($i = 0; $i <= 9; $i++){
            $id = ($i * 3) + 1;
            $grammer = "SELECT `time`, `name`, `team` FROM `Game`";
            $paramArray = [];
            $data[] = $pdo->selectOnce($grammer, $paramArray);
        }

        return $data;
    }
}