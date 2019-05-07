<?php
include "DBConnection.php";
$db = getDBConnection();
$col = $_POST["question"];
$sql = "SELECT `COL 1` as `type`,`COL $col` as `response`, (count(`COL $col`)/ `groupCount`) *100.0 as 'count' FROM `TABLE 1` natural join (select `COL 1`, count(*) as groupCount from `TABLE 1` group by `COL 1`) as `chicken` group by `COL 1`, `COL $col`";

$stmt = $db ->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll();

$sql = "select `col $col` from `TABLE 2`";

$stmt = $db ->prepare($sql);
$stmt->execute();
$result2 = $stmt->fetch();
array_unshift($results , $result2);
echo json_encode($results)
?>