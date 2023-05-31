<?php
$id = $_GET['id'];
include('conn.php');
$sql = "UPDATE enseignant SET directeur_detude='1' WHERE id_enseignant='$id'";
$query = mysqli_query($conn,$sql);
header('REFRESH:2;URL=admin_Select_directeur.php');
?>