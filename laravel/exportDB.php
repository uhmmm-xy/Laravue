<?php
$file = @fopen('db.md', 'r');
$tables = [];
$tableName = false;
$db = [];

if ($file) {
    while (!feof($file)) {
        $row = @fgets($file, 4096);
        $row = trim($row);
        if (strpos($row, '[begin]') !== false) {
            $tableName = explode(':', $row)[1];
            $tables[$tableName] = [];
        }

        if (strpos($row, '>') !== false) {
            if (strpos($row, '**')) {
                $reg = "/(\*\*?).*(\*\*)/";
                preg_match($reg, $row, $db);
                if (trim($db[0], '**') !== 'MySql') {
                    unset($tables[$tableName]);
                    $tableName = false;
                }
                $db = [];
                continue;
            }
        }

        if (strpos($row, '|') !== false && $tableName) {
            $str = trim($row, '|');
            $arr = explode('|', $str);
            if (trim($arr[0]) == 'col' || strpos($arr[0], '-')) {
                continue;
            }
            $cols = [
                'name' => trim(trim($arr[0]), '**'),
                'type' => trim(trim($arr[1]), '`'),
                'mark' => trim(trim($arr[3]), '_'),
                'key' => trim(trim($arr[2]), '_')
            ];
            array_push($tables[$tableName],$cols);
            // $table[$tableName] = $cols;
        }
    }
    fclose($file);
}

$str = "";
foreach($tables as $name=>$attr){
    $str .= "create table `$name` ( \r\n";
    $pk = "";
    $uniques = [];
    foreach($attr as $value){
        $key = "";
        if($value['key']=="unique"){
            $key = "not null";
            array_push($uniques,$value['name']);
        }
        if($value['key']=="pk,increment"){
            $pk = $value['name'];
            $key = "not null AUTO_INCREMENT";
        }
        if(strpos($value['type'],"varchar") !== false || strpos($value['type'],"text") !== false ){
            $key = "CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ";
        }
        $str .= "`{$value['name']}` {$value['type']} {$key} COMMENT '{$value['mark']}',\r\n";
    }

    foreach($uniques as $value){
        $str.= "UNIQUE INDEX `{$value}_key`(`{$value}`) USING BTREE, \r\n";
    }

    $str.= "PRIMARY KEY (`{$pk}`) USING BTREE \r\n";

    $str .= ") ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic; \r\n";
}

file_put_contents("./db.sql",$str);