<?php

if (isset($_GET['module']) && !empty($_GET['module'])) {

    include('conn.php');

    $id = $_GET['module'];

    $query = "SELECT * FROM module WHERE id_module='$id'";
    $do = mysqli_query($conn, $query);
    $count = mysqli_num_rows($do);

    
    if ($count > 0) {
        while ($row = mysqli_fetch_array($do)) {
            if ($row['cour'] == 'Oui') {
                echo '<option value="cour">cour</option>';
            }
            if ($row['td'] == 'Oui') {
                echo '<option value="td">td</option>';
            }
            if ($row['tp'] == 'Oui') {
                echo '<option value="tp">tp</option>';
            }
        }
    } else {
        echo '<option>Not  availble </option>';
    }
} else {
    echo '<h1>error</h1>';
}
