<?php

if (isset($_GET['faculteIDD']) && !empty($_GET['faculteIDD'])) {
    include('conn.php');

    $id = $_GET['faculteIDD'];

    $query = "SELECT * FROM domaine WHERE id_faculte='$id'";
    $do = mysqli_query($conn, $query);
    $count = mysqli_num_rows($do);

    echo '<option value="">'."selectionner la promotion".'</option>';

    if ($count > 0) {
        while ($row = mysqli_fetch_array($do)) {
            echo '<option value="' . $row['id_domaine'] . '">' . $row['Nom_domaine'] .'</option>';
        }
    } else {
        echo '<option>Not  availble </option>';
    }
} else {
    echo '<h1>error</h1>';
}