<?php

if (isset($_GET['filiereheure']) && !empty($_GET['filiereheure'])) {
    include('conn.php');

    $id = mysqli_real_escape_string($conn, $_GET['filiereheure']);

    $query = "SELECT * FROM heure WHERE id_filiere='$id'";
    $do = mysqli_query($conn, $query);
    $count = mysqli_num_rows($do);

    echo '<option value="">'."selectionner l'heure".'</option>';
    if ($count > 0) {
        while ($row = mysqli_fetch_array($do)) {
            echo '<option value="' . $row['id_heure'] . '">' . $row['heure'] .'</option>';
        }
    } else {
        echo '<option>Not  availble </option>';
    }
} else {
    echo '<h1>error</h1>';
}