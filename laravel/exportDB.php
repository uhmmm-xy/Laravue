<?php
$file = file_get_contents('db.md');
$reg = '/[\[begin\]*\[end\]]+/';
$tables = preg_split($reg,$file);
var_dump($tables);