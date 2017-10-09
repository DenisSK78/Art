<?php

$connBDsql=mysqli_connect("localhost", "root", "", "gallery");
$bdConnSql=mysqli_select_db($connBDsql,"gallery");
mysqli_set_charset($connBDsql, "utf-8");

if (!$connBDsql || !$bdConnSql){
    exit(mysqli_error($connBDsql));
}
