<?php
include_once('function.php');

$theRecords = readRecords('30h_the');

echo json_encode($theRecords);

?>