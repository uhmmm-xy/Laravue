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

var_dump($tables);
