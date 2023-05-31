<?php
session_start();

include('conn.php');

if (!isset($_SESSION['id']) && (!isset($_SESSION['chef_departement']))) {
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="css/all.min.FA.css">
        <style>
            ul {
                list-style-type: none;
            }

            li {
                margin-top: 10px;
            }
        </style>

    </head>

    <body>
        <!-- Nav bar -->
        <?php include "include_chefDepartement/header.php"; ?>
        <!-- End Nav bar -->
        <section class="mt-2">
            <div class="container-fluids">
                <div class="row">
                <?php
                    include("MenuBar.php");
                    ?>
                    <div class="col-12 col-sm-12 col-md-9 col-lg-9 pb-3 p-3">
                        <div class="card " style="background-color: #f8f9fa;">
                            <div class="card-body shadow">
                                <div class="row">
                                    <div>
                                        <?php
                                        //delete-enseignant
                                        $id_enseignant = mysqli_real_escape_string($conn, $_GET['id']);
                                        if (!empty($id_enseignant)) {
                                            $queryy = "DELETE FROM enseignant WHERE id_enseignant='$id_enseignant'";
                                            $delete = mysqli_query($conn, $queryy);
                                            if (isset($delete)) {
                                                echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
                                            } else {
                                                echo "<div class='alert alert-danger'>" . "votre informations sont incorrectes" . "</div>";
                                            }
                                        }
                                        ?>

                                        <?php
                                        $id_dep = $_SESSION['chef_departement'];

                                        $query = "SELECT * FROM enseignant WHERE id_departement='$id_dep' order by id_enseignant desc";


                                        $result = mysqli_query($conn, $query);
                                        if (mysqli_num_rows($result) > 0) { //id_departement='$id_dep'AND ( 
                                        ?>

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
                                                                    echo '<p><a class="btn btn-outline-success" href="statut_tous.php?id=' . $row['id_enseignant'] . '&statut=0">actif</a></p>';
                                                                } else {
                                                                    echo '<p><a class="btn btn-outline-danger" href="statut_tous.php?id=' . $row['id_enseignant'] . '&statut=1">inactif</a></p>';
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
                                                            <th><a href="consulter_enseignant_tous.php?id=<?php echo $row['id_enseignant']; ?>"><i style="" class="fas fa-user-times link-success"></i></a>
                                                                <a href="Consulter_enseignant_Update.php?id=<?php echo $row['id_enseignant']; ?>&location=1"><i style="" class="fas fa-edit link-success"></i></a>

                                                            </th>
                                                        </tr>
                                                </tbody>
                                            <?php
                                                    } ?>
                                            </table>
                                        <?php
                                        } else {
                                            echo "<h6 class='text-danger text-center mt-3'>No data Found</h6>";
                                        }

                                        ?>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
        </section>
        <br><br>
        <?php include "footer/footer.php"; ?>




    </body>

    </html>
<?php
    /*echo ('id enseignant est: ');
    echo ($_SESSION['id']);
    echo ('          departement est: ');
    echo ($_SESSION['chef_departement']);*/
}
?>