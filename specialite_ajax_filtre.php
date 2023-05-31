



<?php
include('conn.php');
if (isset($_GET['filiere']) && !empty($_GET['filiere'])) {
  

    $id = $_GET['filiere'];

    $query = "SELECT * FROM specialite WHERE id_filiere='$id'";
    $do = mysqli_query($conn, $query);
    $count = mysqli_num_rows($do);


    if ($count > 0) {
        echo '<table class="table table-hover mt-4">
        <thead>
        <tr>
        <th>N:</th>
                                        <th>Nom specialite</th>
                                        <th>Action</th>
    </tr></thead>';
        $num = 1;


        while ($row = mysqli_fetch_array($do)) {
            //echo '<option value="'.$row['id_specialite'].'">'.$row['Nom_specialite'].'</option>';
            echo '<tr>
            <th>' . $num++ . '</th>
            <th>' . $row['Nom_specialite'] . '</th>
            <th><a href="specialite.php?id=' . $row['id_specialite'] . '" ><i style="" class="fas fa-user-times link-success"></i></a>
                                            <a href="specialiteUpdate.php?id=' . $row['id_specialite'] . '" ><i class="fas fa-edit link-success"></i></a></th>';
        }
    } else {
        echo '<option>Not  availble </option>';
    }
} else {
    echo '<h1>error</h1>';
} ?>