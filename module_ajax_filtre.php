<?php

if (isset($_GET['promotion']) && !empty($_GET['promotion'])) {
    include('conn.php');

    $id = mysqli_real_escape_string($conn, $_GET['promotion']);

    $query = "SELECT * FROM module WHERE id_promotion='$id'";
    $do = mysqli_query($conn, $query);
    $count = mysqli_num_rows($do);

    if ($count > 0) {
        echo '<table class="table table-hover mt-4">
            
        <tr>
        <th>N:</th>
        <th>Module</th>
        <th>Cours</th>
        <th>Td</th>
        <th>Tp</th>
        <th>Action</th>
    </tr>';
        

    $num = 0;
        while ($row = mysqli_fetch_array($do)) {
            //echo '<option value="'.$row['id_specialite'].'">'.$row['Nom_specialite'].'</option>';
            echo '<tr>
            <th>' . $num . '</th>
            <th>' . $row['Nom_module'] . '</th>
            <th>' . $row['cour'] . '</th>
            <th>' . $row['td'] . '</th>
            <th>' . $row['tp'] . '</th>
            <th><a href="module.php?id=' . $row['id_module'] . '"><i style="" class="fas fa-user-times link-success"></i></a>
            <a href="moduleUpdate.php?id=' . $row['id_module'] . '"><i class="fas fa-edit link-success"></i></a></th>
            </tr>';
            $num++;
        }
        echo"</table>";
    } else {
        echo '<option>Not  availble </option>';
    }
} else {
    echo '<h1>error</h1>';
}
