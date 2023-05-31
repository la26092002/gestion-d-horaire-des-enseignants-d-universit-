<?php
include('conn.php');
$idd = $_GET['id'];
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
    <?php
    include "admin-header.php";
    ?>
    <!-- End Nav bar -->

    <div class="">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 pb-3 p-3 ">
                <div class="accordion shadow" id="accordionExample">
                    <div class="accordion-item" s>
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                System
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul>
                                    <li>
                                        <a href="admin.php" class="nav-link">
                                            <span><i class="fas fa-plus"></i></span>
                                            <span>Faculté</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="admin_domaine.php" class="nav-link">
                                            <span><i class="fas fa-plus"></i></span>
                                            <span>Domaine</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="admin_departement.php" class="nav-link">
                                            <span><i class="fas fa-plus"></i></span>
                                            <span>Departement</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="admin_filiere.php" class="nav-link">
                                            <span><i class="fas fa-plus"></i></span>
                                            <span>Filiére</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Chef departement
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul>
                                    <li>
                                        <a href="admin_Ajouter_Chef_Departement.php" class="nav-link">
                                            <span><i class="fas fa-plus"></i></span>
                                            <span>Ajouter</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="admin_Consulter_Chef_Departement.php" class="nav-link">
                                            <span><i class="fas fa-plus"></i></span>
                                            <span>Consulté</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="admin_Select_Chef_Departement.php" class="nav-link">
                                            <span><i class="fas fa-plus"></i></span>
                                            <span>Selectionner</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                directeur des études
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul>
                                    <li>
                                        <a href="admin_Ajouter_directeur.php" class="nav-link">
                                            <span><i class="fas fa-plus"></i></span>
                                            <span>Ajouter</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="admin_Consulter_directeur.php" class="nav-link">
                                            <span><i class="fas fa-plus"></i></span>
                                            <span>Consulté</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="admin_Select_directeur.php" class="nav-link">
                                            <span><i class="fas fa-plus"></i></span>
                                            <span>Selectionner</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 p-3">
            <?php
            $id_enseignant = $_GET['id'];
            $modifier = $_POST['modifier'];
            $departementSELECT = $_POST['departementSELECT'];
            if(isset($modifier)){
                $mod = "UPDATE enseignant SET chef_departement='$departementSELECT' WHERE id_enseignant='$id_enseignant'";
                $query = mysqli_query($conn,$mod);
                if (isset($query)) {
                    echo "<div class='alert alert-success'>" . "تمت الاضافة بنجاح" . "</div>";
                } else {
                    echo "<div class='alert alert-danger'>" . "حدث خطاا ما" . "</div>";
                }
            }
            ?>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div>
                        <label class="form-label">Departement</label>
                        <select name="departementSELECT" id="departementSELECT" class="departementSELECT form-select" required>
                            <option value="">select</option>
                            <?php
                            $sql = "SELECT * FROM departement";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                                <option value="<?php echo $row['id_departement']; ?>"><?php echo $row['Nom_departement']; ?></option>
                            <?php
                            } ?>
                        </select>
                    </div>
                    <button name="modifier">Modifier</button>
                </form>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 p-3">

                <?php
                $sql = "SELECT * FROM enseignant,departement,domaine,faculte WHERE  domaine.id_faculte=faculte.id_faculte AND domaine.id_domaine=departement.id_domaine AND enseignant.id_departement=departement.id_departement AND enseignant.id_enseignant='$idd'";
                $query = mysqli_query($conn, $sql);
                ?>
                <div class="card shadow" style="width: 18rem;">
                    <img src="user.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <?php $row = mysqli_fetch_assoc($query); ?>
                        <h5 class="p">Email: </h5>
                        <p><?php echo $row['Email_enseignant'] ?> </p>
                        <h5 class="p">Nom Prenom: </h5>
                        <p><?php echo  $row['Nom_enseignant'];
                            echo ' ';
                            echo $row['Nom_enseignant']; ?> </p>
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

        <?php include "footer/footer.php"; ?>


</body>

</html>