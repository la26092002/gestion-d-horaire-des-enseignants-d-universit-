<?php

if (isset($_GET['faculteeIDD']) && !empty($_GET['faculteeIDD'])) {
    include('conn.php');

    $id = $_GET['faculteeIDD']; 
    echo '<table class="table table-striped mt-4">
    <tr>
        <th>N°</th>
        <th>Domaine</th>
        <th>Action</th>
    </tr>';
        $sql = "SELECT * FROM domaine WHERE id_faculte='$id'";
        $query = mysqli_query($conn, $sql);
        $n = 1;
        while ($row = mysqli_fetch_assoc($query)) {
        
            echo'<tr>
                <th>'.$n.'</th>
                <th>'.$row['Nom_domaine'].'</th>
                <th><a href="admin_domaine.php?id='.$row['id_domaine'].'"><i class="fas fa-user-times link-success"></i></a>
                    <a href="domaine_update.php?id='.$row['id_domaine'].'"><i class="fas fa-edit link-success"></i></a>
                </th>
            </tr>';
        
            $n++;
        }
        
    echo'</table>';
        } else {
            echo '<h1>error</h1>';
        }
