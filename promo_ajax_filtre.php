


<?php

if (isset($_GET['specialiteID']) && !empty($_GET['specialiteID'])) {
    include('conn.php');

    $id = mysqli_real_escape_string($conn, $_GET['specialiteID']);

    $query = "SELECT * FROM promotion WHERE id_specialite='$id'";
    $do = mysqli_query($conn, $query);
    $count = mysqli_num_rows($do);


    if ($count > 0) {
        echo '<table class="table table-hover mt-4 table-fixed">
           
        <tr>
        <th>N:</th>
        <th>Nom promotion</th>
        <th>quantité groupe</th>
        <th>Action</th>
    </tr>';
        $num = 1;


        while ($row = mysqli_fetch_array($do)) {
            //echo '<option value="'.$row['id_specialite'].'">'.$row['Nom_specialite'].'</option>';
            echo '<tr>
            <th>' . $num++ . '</th>
            <th>' . $row['Nom_promotion'] . '</th>
            <th>' . $row['quantité_groupe'] . '</th>
            <th><a href="promotion.php?id=' . $row['id_promotion'] . '"><i style="" class="fas fa-user-times link-success"></i></a>
            <a href="promotionUpdate.php?id=' . $row['id_promotion'] . '"><i class="fas fa-edit link-success"></i></a></th>
            </tr>';
        }
        echo "</table>";
    } else {
        echo '<option>Not  availble </option>';
    }
} else {
    echo '<h1>error</h1>';
}
