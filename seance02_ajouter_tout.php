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
        <link rel="stylesheet" href="css/all.min.FA.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                    <div class="col-12-light col-sm-12 col-md-3 col-lg-3  pb-3 p-3">
                        <div class="accordion shadow" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Enseignant
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>
                                                <a href="chef_departement.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Ajouter</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="consulter_enseignant.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Consulter</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Insertion des données
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>
                                                <a href="module.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Module</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="salle.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Salle</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="heure.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Heure</span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="promotion.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>promotion</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="specialite.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>specialite</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="seance02.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>seance</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Emploi du temp
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>
                                                <a href="enmploie_du_temp.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>emploie du temp</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--  -->
                    <div class="col-12 col-sm-12 col-md-9 col-lg-9  pb-3 p-3">
                        <?php


                        $Ajouter_Enseignant = $_GET['Ajouter_Enseignant'];
                        $id_module = $_SESSION['id_module'];
                        $f_filiere = $_SESSION['f_filiere'];

                        $promotion = $_SESSION['promotion_seance'];
                        $heure = $_POST['heure'];
                        $jour = $_POST['jour'];
                        $salle = $_POST['salle'];
                        $type = $_POST['type'];
                        $numeroGroupe = $_POST['numeroGroupe'];
                        $ajouter = $_POST['ajouter'];


                        if (isset($ajouter)) {
                            if ($type == 'td' or $type == 'tp') {
                                $query = "INSERT INTO seance(id_module,Id_enseignant,type,id_salle,id_promotion,id_heure,jour,Numero_groupe)
                                VALUES('$id_module','$Ajouter_Enseignant','$type','$salle','$promotion','$heure','$jour','$numeroGroupe')"; //'$Nom_promotion','$quantité_groupe','$id_specialite','$id_filiere','$id_departement','$id_domaine','$id_faculte'
                            } else {
                                $query = "INSERT INTO seance(id_module,Id_enseignant,type,id_salle,id_promotion,id_heure,jour,Numero_groupe)
                                VALUES('$id_module','$Ajouter_Enseignant','$type','$salle','$promotion','$heure','$jour',NULL)"; //'$Nom_promotion','$quantité_groupe','$id_specialite','$id_filiere','$id_departement','$id_domaine','$id_faculte'
                            }
                            $res = mysqli_query($conn, $query);
                            if (isset($res)) {
                                echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
                            } else {
                                echo "<div class='alert alert-danger'>" . "votre informations sont incorrectes" . "</div>";
                            }
                        }
                        ?>
                        <script>
                            $(document).ready(function() {
                                $('#enseiType').on('change', function() {
                                    var enseiType = $(this).val();
                                    if (enseiType) {
                                        $.get(
                                            "enseiType.php", {
                                                enseiType: enseiType
                                            },
                                            function(data) {
                                                $('#selection').html(data);
                                            }
                                        );
                                    } else {
                                        $('#selection').html('<p>selectionner Type Enseignant</p>')
                                    }
                                });
                            });
                        </script>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="card">
                                <div class="card-body shadow bg-light text-dark">
                                    <div class="row">
                                        <div class="col-6"><?php
                                                            $ss = "SELECT Nom_enseignant,Prenom_enseignant FROM enseignant WHERE id_enseignant='$Ajouter_Enseignant'";
                                                            $qqq = mysqli_query($conn, $ss);
                                                            $ro = mysqli_fetch_assoc($qqq);
                                                            ?>
                                            <h5>Enseignant:</h5>
                                            <p><?php echo $ro['Nom_enseignant'];
                                                echo ' ';
                                                echo $ro['Prenom_enseignant']; ?></p>
                                        </div>
                                        <div class="col-6"><?php
                                                            $sm = "SELECT Nom_module FROM module WHERE id_module='$id_module'";
                                                            $qqqm = mysqli_query($conn, $sm);
                                                            $rom = mysqli_fetch_assoc($qqqm);
                                                            ?>
                                            <h5>Module:</h5>
                                            <p><?php echo $rom['Nom_module']; ?></p>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <script>
                                            $(document).ready(function() {
                                                $('#type').on('change', function() {
                                                    var typeName = $(this).val();
                                                    if (typeName) {
                                                        $.get(
                                                            "seance_type_groupe_ajax.php", {
                                                                typeName: typeName
                                                            },
                                                            function(data) {
                                                                $('#groupe').html(data);
                                                            }
                                                        );
                                                    } else {
                                                        $('#groupe').html('<option>select specialite first</option>')
                                                    }
                                                });
                                            });
                                        </script>
                                        <div class="col-4 ">
                                            <label class="form-label">Heure</label>
                                            <select name="heure" id="heure" class="form-select" required>
                                            <option disabled="disabled" selected="selected">S&eacute;lectionner l'heure</option>
                                                
                                                <?php

                                                $s = "SELECT * FROM heure WHERE id_filiere='$f_filiere' order by ordre";
                                                $q = mysqli_query($conn, $s);
                                                while ($r = mysqli_fetch_assoc($q)) {
                                                    echo '<option value="' . $r['id_heure'] . '">' . $r['heure'] . '</option>';
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label" for="jour">Jour</label>
                                            <select name="jour" id="jour" class="form-select" required>
                                                <option disabled="disabled" selected="selected">S&eacute;lectionner le jour </option>
                                                <option value="dimanche">dimanche</option>
                                                <option value="Lundi">Lundi</option>
                                                <option value="mardi">mardi</option>
                                                <option value="mercredi">mercredi</option>
                                                <option value="jeudi">jeudi</option>
                                                <option value="vendredi">vendredi</option>
                                                <option value="samedi">samedi</option>
                                            </select>
                                            </label>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">Salle</label>
                                            <select name="salle" id="salle" class="form-select" required>
                                                <option disabled="disabled" selected="selected">S&eacute;lectionner la salle</option>
                                                <?php

                                                $s = "SELECT * FROM salle WHERE id_filiere='$f_filiere'";
                                                $q = mysqli_query($conn, $s);
                                                while ($r = mysqli_fetch_assoc($q)) {
                                                    echo '<option value="' . $r['id_salle'] . '">' . $r['Nom_salle'] . ',N°' . $r['Num_salle'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-6">

                                            <label class="form-label">Type</label>
                                            <select name="type" id="type" class="form-select" required>
                                                <option disabled="disabled" selected="selected">S&eacute;lectionner le type</option>
                                                <?php
                                                $query = "SELECT * FROM module WHERE id_module='$id_module'";
                                                $do = mysqli_query($conn, $query);
                                                $count = mysqli_num_rows($do);


                                                if ($count > 0) {
                                                    while ($row = mysqli_fetch_array($do)) {
                                                        if ($row['cour'] == 'Oui') {
                                                            echo '<option value="cour">cour</option>';
                                                        }
                                                        if ($row['td'] == 'Oui') {
                                                            echo '<option value="td">td</option>';
                                                        }
                                                        if ($row['tp'] == 'Oui') {
                                                            echo '<option value="tp">tp</option>';
                                                        }
                                                    }
                                                } else {
                                                    echo '<option>Not  availble </option>';
                                                }
                                                ?>
                                            </select>

                                        </div>
                                        <div class="col-6">
                                            <div name="groupe" id="groupe">

                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button name="ajouter" class="btn btn-success mt-3">Ajouter</button>
                                        <a href="seance02.php" class="btn btn-primary mt-3">Annuler</a>
                                    </div>



                        </form>
                    </div>

                    <div class="col-12" id="module">

                    </div>

                </div>
        </section>
        <?php include "footer/footer.php"; ?>




    </body>

    </html>
<?php
    /*
    echo ('id enseignant est: ');
    echo ($_SESSION['id']);
    echo ('          departement est: ');
    echo ($_SESSION['chef_departement']);*/
}
?>