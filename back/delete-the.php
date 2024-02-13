<?php
include_once('function.php');

$id_the_to_delete = $_POST['id_the'];
deleteRecord('30h_the', 'id_the = '.$id_the_to_delete);
