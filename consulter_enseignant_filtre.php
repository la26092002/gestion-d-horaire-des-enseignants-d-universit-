<?php
session_start();
if (isset($_GET['status']) && !empty($_GET['status'])) {
    include('conn.php');

    $status = $_GET['status'];
    $nom = $_GET['nom'];
    $filiere = $_GET['filiere'];


?>
    
<?php

} else {
    echo '<h1>error</h1>';
}
?>