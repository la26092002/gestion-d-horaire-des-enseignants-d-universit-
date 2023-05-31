<?php
session_start();
include('conn.php');

if (!empty($_POST['input'])) {
    $input = mysqli_real_escape_string($conn, $_POST['input']);
    $id_dep = $_SESSION['chef_departement'];
    $statut = mysqli_real_escape_string($conn, $_POST['statut']);
    if ($statut == 1 || $statut == 0) {
        $query = "SELECT * FROM enseignant WHERE statut='$statut'and id_departement='$id_dep'and (Nom_enseignant LIKE '{$input}%' or Prenom_enseignant LIKE '{$input}%' )";
    } else {
        $query = "SELECT * FROM enseignant WHERE id_departement='$id_dep'and (Nom_enseignant LIKE '{$input}%' or Prenom_enseignant LIKE '{$input}%' )";
    }

    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) { //id_departement='$id_dep'AND ( 
?>
        <div class="card mt-2" style="background-color: #f8f9fa;">
            <div class="card-body shadow">
                <table class="table table-hover">
                    <thread>
                        <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Email</th>
                            <th>S1</th>
                            <th>S2</th>
                            <th>N°tlph</th>
                            <th>statut</th>
                            <th>verifier</th>
                            <th>image</th>
                            <th>Action</th>
                        </tr>
                    </thread>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id_enseignant = $row['id_enseignant'];
                            $Email_enseignant = $row['Email_enseignant'];
                            $Nom_enseignant = $row['Nom_enseignant'];
                            $Prenom_enseignant = $row['Prenom_enseignant'];
                            $Ntlph = $row['N_tlphn'];

                        ?>
                            <tr>
                                <td><?php echo $Nom_enseignant; ?></td>
                                <td><?php echo $Prenom_enseignant; ?></td>
                                <td><?php echo $Email_enseignant; ?></td>
                                <th>
                                    <?php
                                    //trouver Nombre d'heure d'enseignant
                                    $idE = $row['id_enseignant'];
                                    $sqlll = "SELECT * FROM seance,heure,module WHERE module.id_module = seance.id_module AND module.semestre='1' AND seance.id_heure=heure.id_heure AND seance.id_enseignant=$idE ";
                                    $queryyy = mysqli_query($conn, $sqlll);
                                    $s = 0;
                                    while ($rowww = mysqli_fetch_assoc($queryyy)) {
                                        $h = $rowww['d_heure'] * 60;
                                        $m = $rowww['d_min'];
                                        $t = $h + $m;
                                        $s = $s + $t;
                                    }
                                    $m1 = $s % 60;
                                    $h1 = ($s - $m1) / 60;

                                    ?>
                                    <p><?php echo $h1;
                                        echo "h";
                                        if ($m1 != 0) { ?> : <?php echo $m1;
                                                                echo "min";
                                                            } ?></p>
                                </th>
                                <th>
                                    <?php
                                    //trouver Nombre d'heure d'enseignant
                                    $idE = $row['id_enseignant'];
                                    $sqlll = "SELECT * FROM seance,heure,module WHERE module.id_module = seance.id_module AND module.semestre='2' AND seance.id_heure=heure.id_heure AND seance.id_enseignant=$idE ";
                                    $queryyy = mysqli_query($conn, $sqlll);
                                    $s = 0;
                                    while ($rowww = mysqli_fetch_assoc($queryyy)) {
                                        $h = $rowww['d_heure'] * 60;
                                        $m = $rowww['d_min'];
                                        $t = $h + $m;
                                        $s = $s + $t;
                                    }
                                    $m1 = $s % 60;
                                    $h1 = ($s - $m1) / 60;

                                    ?>
                                    <p><?php echo $h1;
                                        echo "h";
                                        if ($m1 != 0) { ?> : <?php echo $m1;
                                                                echo "min";
                                                            } ?></p>
                                </th>
                                <th><?php echo $Ntlph; ?></th>
                                <th><?php if ($row['statut'] == "1") {
                                        echo '<p><a class="btn btn-outline-success" href="statut.php?id=' . $row['id_enseignant'] . '&statut=0">actif</a></p>';
                                    } else {
                                        echo '<p><a class="btn btn-outline-danger" href="statut.php?id=' . $row['id_enseignant'] . '&statut=1">inactif</a></p>';
                                    } ?></th>

                                <th><?php
                                    if ($row['verifie'] == "1") {
                                        echo '<center><i class="fas fa-check"></i></center>';
                                    } else {
                                        echo '<center><i class="fas fa-times"></i></center>';
                                    }
                                    ?>
                                </th>
                                <th>image</th>
                                <th><a href="consulter_enseignant.php?id=<?php echo $row['id_enseignant']; ?>"><i style="" class="fas fa-user-times link-success"></i></a>
                                    <a href="Consulter_enseignant_Update.php?id=<?php echo $row['id_enseignant']; ?>"><i style="" class="fas fa-edit link-success"></i></a>

                                </th>
                            </tr>
                    </tbody>
                <?php
                        } ?>
                </table>
            </div>
        </div>
<?php
    } else {
        echo "<h6 class='text-danger text-center mt-3'>No data Found</h6>";
    }
}
?>