<?php

if (isset($_GET['filiere']) && !empty($_GET['filiere'])) {
    include('conn.php');

    $id = $_GET['filiere'];

    $query = "SELECT * FROM heure WHERE id_filiere='$id' ORDER BY ordre";
    $do = mysqli_query($conn, $query);
    $count = mysqli_num_rows($do);


    if ($count > 0) {
        echo '<table class="table table-hover mt-4">
            
            <tr>
                <th>N:</th>
                <th>heure</th>
                <th>ordre</th>
                <th>h:min</th>
                <th>Action</th>
            </tr>';
        $num = 1;
        
        
        while ($row = mysqli_fetch_array($do)) {
            //echo '<option value="'.$row['id_specialite'].'">'.$row['Nom_specialite'].'</option>';
            echo '<tr>
            <th>' . $num++ . '</th>
            <th>' . $row['heure'] . '</th>
            <th>' . $row['ordre'] . '</th>
            <th>' . $row['d_heure'] .':'. $row['d_min'] .' </th>
            <th><a href="heure.php?id=' . $row['id_heure'] . '"><i style="" class="fas fa-user-times link-success"></i></a>
            <a href="heure_modifier.php?id=' . $row['id_heure'] . '"><i class="fas fa-edit link-success"></i></a></th>
            </tr>';
        
        }
        
    } else {
        echo '<option>Not  availble </option>';
    }
} else {
    echo '<h1>error</h1>';
}
