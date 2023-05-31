<?php
session_start();

include('conn.php');

$idd = $_GET['id'];
if (!isset($_SESSION['id_enseignant_directeur'])) {
    echo "<div class='alert alert-danger'>" . "غير مسموح لك فتح هذه الصفحة" . "</div>";
    header('REFRESH:2;URL=connect.php');
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="css/all.min.FA.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <style>

        </style>
    </head>

    <body>
        <!-- Nav bar -->
        <?php include "inc_dr/header.php"; ?>
        <!-- End Nav bar -->
        <div class="">

            <div class="row">
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 p-3">
                    <div class="card">
                        <div class="card-body shadow">
                            <h5>S1</h5>
                            <table class="table table-striped mt-3 ">
                                <tr>
                                    <th>Module</th>
                                    <th>heure</th>
                                    <th>type</th>
                                    <th>salle</th>
                                    <th>promotion</th>
                                </tr>
                                <?php
                                //afficher;
                                $query = "SELECT * FROM seance,module,salle,promotion,heure,specialite WHERE module.semestre='1' AND seance.id_module=module.id_module AND heure.id_heure=seance.id_heure AND seance.Id_enseignant='$idd'AND salle.id_salle=seance.id_salle AND promotion.id_promotion=seance.id_promotion AND specialite.id_specialite=promotion.id_specialite";
                                //$query = "SELECT*FROM seance WHERE Id_enseignant='$id'";
                                $res = mysqli_query($conn, $query);
                                $no == 0;

                                while ($row = mysqli_fetch_assoc($res)) {
                                    $no++;
                                ?>
                                    <tr>
                                        <th><?php echo $row['Nom_module']; ?></th>
                                        <th><?php echo $row['heure']; ?></th>
                                        <th><?php echo $row['type']; ?></th>
                                        <th><?php echo $row['Nom_salle'];
                                            echo ',N:';
                                            echo $row['Num_salle']; ?></th>
                                        <th><?php echo $row['Nom_promotion'];
                                            echo " "; ?></th>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                            <h5>S2:</h5>
                            <table class="table table-striped mt-3 ">
                                <tr>
                                    <th>Module</th>
                                    <th>heure</th>
                                    <th>type</th>
                                    <th>salle</th>
                                    <th>promotion</th>
                                </tr>
                                <?php
                                //afficher;
                                $query = "SELECT * FROM seance,module,salle,promotion,heure,specialite WHERE module.semestre='2' AND seance.id_module=module.id_module AND heure.id_heure=seance.id_heure AND seance.Id_enseignant='$idd'AND salle.id_salle=seance.id_salle AND promotion.id_promotion=seance.id_promotion AND specialite.id_specialite=promotion.id_specialite";
                                //$query = "SELECT*FROM seance WHERE Id_enseignant='$id'";
                                $res = mysqli_query($conn, $query);
                                $no == 0;
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $no++;
                                ?>
                                    <tr>
                                        <th><?php echo $row['Nom_module']; ?></th>
                                        <th><?php echo $row['heure']; ?></th>
                                        <th><?php echo $row['type']; ?></th>
                                        <th><?php echo $row['Nom_salle'];
                                            echo ',N:';
                                            echo $row['Num_salle']; ?></th>
                                        <th><?php echo $row['Nom_promotion'];
                                            echo " "; ?></th>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 p-3">
                    <?php
                    $sql = "SELECT * FROM enseignant,departement,domaine,faculte WHERE domaine.id_faculte=faculte.id_faculte AND departement.id_domaine=domaine.id_domaine AND enseignant.id_departement=departement.id_departement AND enseignant.id_enseignant='$idd'";
                    $query = mysqli_query($conn, $sql);
                    ?>
                    <div class="card shadow" style="width: 18rem;">
                        <img src="user.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <?php $row = mysqli_fetch_assoc($query); ?>

                            <h5 class="p">Nom Prenom: </h5>
                            <p><?php echo  $row['Nom_enseignant'];
                                echo ' ';
                                echo $row['Prenom_enseignant']; ?> </p>

                            <h5 class="p">Email: </h5>
                            <p><?php echo $row['Email_enseignant'] ?> </p>
                            <h5 class="p">N tlphn: </h5>
                            <p><?php echo $row['N_tlphn'] ?> </p>

                            <?php if ($row['chef_departement'] != NULL) { ?>
                                <h5 class="p">chef_departement: </h5>
                                <p><?php $chef = $row['chef_departement'];
                                    $s = "SELECT * FROM departement WHERE id_departement='$chef'";
                                    $q = mysqli_query($conn, $s);
                                    $res = mysqli_fetch_assoc($q);
                                    echo $res['Nom_departement'];
                                    ?> </p><?php } ?>

                            <h5 class="p">Departement: </h5>
                            <p><?php echo $row['Nom_departement'] ?> </p>

                            <h5 class="p">Domaine: </h5>
                            <p><?php echo $row['Nom_domaine'] ?> </p>

                            <h5 class="p">Faculte: </h5>
                            <p><?php echo  $row['Nom_faculte'] ?> </p>

                            <h5 class="p">S1: </h5>
                            <p><?php
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
                            </p>
                            <h5 class="p">S2: </h5>
                            <p><?php
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
                            </p>


                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php include "footer/footer.php"; ?>

    </body>

    </html>
<?php
}
?>