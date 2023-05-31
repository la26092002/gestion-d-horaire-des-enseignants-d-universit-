<?php

if (isset($_GET['departementt']) && !empty($_GET['departementt'])) {
    include('conn.php');

    $id = $_GET['departementt']; 
    echo '<table class="table table-striped mt-4">
    <tr>
        <th>N°</th>
        <th>Filiere</th>
        <th>Action</th>
    </tr>';
        $sql = "SELECT * FROM filiere WHERE id_departement='$id'";
        $query = mysqli_query($conn, $sql);
        $n = 1;
        while ($row = mysqli_fetch_assoc($query)) {
        
            echo'<tr>
                <th>'.$n.'</th>
                <th>'.$row['Nom_filiere'].'</th>
                <th><a href="admin_filiere.php?id='.$row['id_filiere'].'"><i class="fas fa-user-times link-success"></i></a>
                    <a href="admin_filiere_update.php?id='.$row['id_filiere'].'"><i class="fas fa-edit link-success"></i></a>
                </th>
            </tr>';
        
            $n++;
        }
        
    echo'</table>';
        } else {
            echo '<h1>error</h1>';
        }