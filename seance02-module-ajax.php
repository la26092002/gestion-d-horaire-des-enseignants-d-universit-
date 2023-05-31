<?php

if (isset($_GET['promotion']) && !empty($_GET['promotion']) && isset($_GET['semestre']) && !empty($_GET['semestre'])) {

    include('conn.php');

    $semestre = mysqli_real_escape_string($conn, $_GET['semestre']);
    $id = mysqli_real_escape_string($conn, $_GET['promotion']);
    $filiere = mysqli_real_escape_string($conn, $_GET['filiere']);

    $query = "SELECT * FROM module WHERE id_promotion='$id' AND semestre ='$semestre'";
    $do = mysqli_query($conn, $query);
    $count = mysqli_num_rows($do);

    echo '<div class="card mt-4">
    <div class="card-body shadow bg-light text-dark">
    <table class="table table-hover"><thead>
                                                <tr>
                                                    <th>Module</th>
                                                    <th>Cour</th>
                                                    <th>Td</th>
                                                    <th>Tp</th>
                                                    <th>Action</th>
                                                </tr></thead>';




    if ($count > 0) {
        while ($row = mysqli_fetch_array($do)) {
            echo '<tr>';
            echo '<th>' . $row['Nom_module'] . '';




            if ($row['cour'] == 'Oui') {
                echo '<th><i class="fas fa-check"></i></th>';
            } else {
                echo '<th><i class="fas fa-times"></i></th>';
            }

            if ($row['td'] == 'Oui') {
                echo '<th><i class="fas fa-check"></i></th>';
            } else {
                echo '<th><i class="fas fa-times"></i></th>';
            }

            if ($row['tp'] == 'Oui') {
                echo '<th><i class="fas fa-check"></i></th>';
            } else {
                echo '<th><i class="fas fa-times"></i></th>';
            }

            echo '<th><a href="seance02_ajouter.php?id=' . $row['id_module'] . '&f=' . $filiere . '&promotion=' . $id . '"><i class="fas fa-folder-plus"style="color: #28a745;"></i></a>
            <a href="seance02_module_aafficher.php?id=' . $row['id_module'] . '"><i  class="fas fa-clipboard-list"style="color: #28a745;"></i></a>
            </th>
       </tr>';
        }
    }
    echo '</table></div></div>';
} else {
    echo '<h1>error</h1>';
}
