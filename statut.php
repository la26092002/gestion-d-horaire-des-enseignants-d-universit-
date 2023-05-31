<?php
session_start();

include('conn.php');

if (!isset($_SESSION['id']) && (!isset($_SESSION['chef_departement']))) {
    echo "<div class='alert alert-danger'>" . "غير مسموح لك فتح هذه الصفحة" . "</div>";
    header('REFRESH:2;URL=connect.php');
} else {
    $id = $_GET['id'];
    $statut = $_GET['statut'];
    $q = "UPDATE enseignant SET statut='$statut' WHERE id_enseignant='$id'";
    mysqli_query($conn,$q);
    header('location:consulter_enseignant.php');


}