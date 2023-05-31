<?php

if (isset($_GET['domaineeIDD']) && !empty($_GET['domaineeIDD'])) {
    include('conn.php');

    $id = $_GET['domaineeIDD'];

    $query = "SELECT * FROM departement WHERE id_domaine='$id'";
    $do = mysqli_query($conn, $query);
    $count = mysqli_num_rows($do);

    echo '<option value="">'."selectionner la promotion".'</option>';

    if ($count > 0) {
        while ($row = mysqli_fetch_array($do)) {
            echo '<option value="' . $row['id_departement'] . '">' . $row['Nom_departement'] .'</option>';
        }
    } else {
        echo '<option>Not  availble </option>';
    }
} else {
    echo '<h1>error</h1>';
}