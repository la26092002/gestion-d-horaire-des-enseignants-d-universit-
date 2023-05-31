<?php

if (isset($_GET['domaineIDD']) && !empty($_GET['domaineIDD'])) {
    include('conn.php');

    $id = $_GET['domaineIDD']; 
    echo '<table class="table table-striped mt-4">
    <tr>
        <th>N°</th>
        <th>departement</th>
        <th>Action</th>
    </tr>';
        $sql = "SELECT * FROM departement WHERE id_domaine='$id'";
        $query = mysqli_query($conn, $sql);
        $n = 1;
        while ($row = mysqli_fetch_assoc($query)) {
        
            echo'<tr>
                <th>'.$n.'</th>
                <th>'.$row['Nom_departement'].'</th>
                <th><a href="admin_departement.php?id='.$row['id_departement'].'"><i class="fas fa-user-times link-success"></i></a>
                    <a href="admin_departement_update.php?id='.$row['id_departement'].'"><i class="fas fa-edit link-success"></i></a>
                </th>
            </tr>';
        
            $n++;
        }
        
    echo'</table>';
        } else {
            echo '<h1>error</h1>';
        }
