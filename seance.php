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
        <script>
            $(document).ready(function() {
                $('#promotion').on('change', function() {
                    var promotionIDD = $(this).val();
                    var semestre = document.getElementById("semestre").value;
                    if (promotionIDD) {
                        $.get(
                            "seance_module_ajax.php", {
                                promotion: promotionIDD,
                                semestre: semestre
                            },
                            function(data) {
                                $('#module').html(data);
                            }
                        );
                    } else {
                        $('#module').html('<option>select filiere first</option>')
                    }
                });
            });

            $(document).ready(function() {
                $('#filiere').on('change', function() {
                    var filiereIDD = $(this).val();

                    if (filiereIDD) {
                        $.get(
                            "seance_salle_ajax.php", {
                                filieresalle: filiereIDD,

                            },
                            function(data) {
                                $('#salle').html(data);
                            }
                        );
                    } else {
                        $('#salle').html('<option>select filiere first</option>')
                    }
                });
            });

            $(document).ready(function() {
                $('#filiere').on('change', function() {
                    var filiereIDD = $(this).val();
                    if (filiereIDD) {
                        $.get(
                            "seance_specialite_ajax.php", {
                                filierespecialite: filiereIDD
                            },
                            function(data) {
                                $('#specialite').html(data);
                            }
                        );
                    } else {
                        $('#specialite').html('<option>select filiere first</option>')
                    }
                });
            });

            $(document).ready(function() {
                $('#filiere').on('change', function() {
                    var filiereIDD = $(this).val();
                    if (filiereIDD) {
                        $.get(
                            "seance_heure_ajax.php", {
                                filiereheure: filiereIDD
                            },
                            function(data) {
                                $('#heure').html(data);
                            }
                        );
                    } else {
                        $('#heure').html('<option>select filiere first</option>')
                    }
                });
            });
            $(document).ready(function() {
                $('#specialite').on('change', function() {
                    var specialiteIDD = $(this).val();
                    if (specialiteIDD) {
                        $.get(
                            "seance_promotion_ajax.php", {
                                specialitepromotion: specialiteIDD
                            },
                            function(data) {
                                $('#promotion').html(data);
                            }
                        );
                    } else {
                        $('#promotion').html('<option>select specialite first</option>')
                    }
                });
            });
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
    </head>

    <body>

        <!-- Nav bar -->
        <?php include "include_chefDepartement/header.php"; ?>
        <!-- End Nav bar -->
        <section class="mt-2">
            <div class="container-fluids">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3  ">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item" s>
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
                                                <a href="seance.php" class="nav-link">
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
                    <div class="col-12 col-sm-12 col-md-9 col-lg-9  ">
                        <div class="card">
                            <div class="card-body shadow bg-light text-dark">
                                <?php
                                //insert data 
                                $filiere = $_POST['filiere'];
                                $module = $_POST['module'];
                                if ($_GET['Ajouter_Enseignant']) {
                                    $enseignant = $_GET['Ajouter_Enseignant'];
                                } else {
                                    $enseignant = $_POST['enseignant'];
                                }
                                $type = $_POST['type'];
                                $salle = $_POST['salle'];
                                $specialite = $_POST['specialite'];
                                $promotion = $_POST['promotion'];
                                $heure = $_POST['heure'];

                                $numeroGroupe = $_POST['numeroGroupe'];
                                $jour = $_POST['jour'];



                                $ajouter = $_POST['ajouter'];
                                

                                if (isset($ajouter)) {
                                    if ($type == 'td' or $type == 'tp') {
                                        $query = "INSERT INTO seance(id_module,Id_enseignant,type,id_salle,id_promotion,id_heure,jour,Numero_groupe)
                                        VALUES('$module','$enseignant','$type','$salle','$promotion','$heure','$jour','$numeroGroupe')"; //'$Nom_promotion','$quantité_groupe','$id_specialite','$id_filiere','$id_departement','$id_domaine','$id_faculte'
                                    } else {
                                        $query = "INSERT INTO seance(id_module,Id_enseignant,type,id_salle,id_promotion,id_heure,jour,Numero_groupe)
                                        VALUES('$module','$enseignant','$type','$salle','$promotion','$heure','$jour',NULL)"; //'$Nom_promotion','$quantité_groupe','$id_specialite','$id_filiere','$id_departement','$id_domaine','$id_faculte'
                                    }
                                    $res = mysqli_query($conn, $query);
                                    if (isset($res)) {
                                        echo "<div class='alert alert-success'>" . "تمت الاضافة بنجاح" . "</div>";
                                    } else {
                                        echo "<div class='alert alert-danger'>" . "حدث خطاا ما" . "</div>";
                                    }
                                }
                                ?>
                                <script>
                                    $(document).ready(function() {
                                        $('#semestre').on('change', function() {
                                            var semestre = $(this).val();
                                            if (semestre) {
                                                $.get(
                                                    "seance_semestre_filiere_ajax.php", {
                                                        semestre: semestre
                                                    },
                                                    function(data) {
                                                        $('#filiere').html(data);
                                                    }
                                                );
                                            } else {
                                                $('#filiere').html('<option>select specialite first</option>')
                                            }
                                        });
                                    });
                                </script>
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <div class="">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label  ">Semestre</label>
                                                <select name="semestre" id="semestre" class="form-select semestre">
                                                    <option value=""></option>
                                                    <option value="1">S1</option>
                                                    <option value="2">S2</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label">Filiere</label>
                                                <select name="filiere" id="filiere" class="form-select">
                                                    <option>select</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label">specialite</label>
                                                <select name="specialite" id="specialite" class="form-select">
                                                    <option>selectionner la filiere</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label">Promotion</label>
                                                <select name="promotion" id="promotion" class="form-select">
                                                    <option>selectionner la specialite</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-3">
                                                <label class="form-label">Module</label>
                                                <select name="module" id="module" class="form-select">
                                                    <option>selectionner la filiere</option>
                                                </select>

                                            </div>
                                            <div class="col-3 ">
                                                <label class="form-label">Heure</label>
                                                <select name="heure" id="heure" class="form-select">
                                                    <option>selectionner la filiere</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label" for="jour">Jour</label>
                                                <select name="jour" id="jour" class="form-select">
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

                                            <div class="col-3">
                                                <label class="form-label">Salle</label>
                                                <select name="salle" id="salle" class="form-select">
                                                    <option>selectionner la filiere</option>
                                                </select>
                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label">Enseignant</label>
                                                <select name="enseignant" id="enseignant" class="form-select">
                                                    <?php
                                                    $id_depa =  $_SESSION['chef_departement'];
                                                    $query = "SELECT * FROM enseignant WHERE id_departement='$id_depa'";
                                                    $do = mysqli_query($conn, $query);
                                                    $count = mysqli_num_rows($do);
                                                    echo '<option value="">' . "selectionner l'enseignant" . '</option>';
                                                    if ($count > 0) {
                                                        while ($row = mysqli_fetch_array($do)) {
                                                            echo '<option value="' . $row['id_enseignant'] . '">' . $row['Nom_enseignant'] . " " . $row['Prenom_enseignant'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-3">

                                                <label class="form-label">(Enseignant:<?php $A = $_GET['Ajouter_Enseignant'];
                                                                                        if ($A) {
                                                                                            $s = "SELECT Nom_enseignant,Prenom_enseignant FROM enseignant WHERE id_enseignant='$A'";
                                                                                            $q = mysqli_query($conn, $s);
                                                                                            $row = mysqli_fetch_assoc($q);
                                                                                            echo $row['Nom_enseignant'];
                                                                                            echo " ";
                                                                                            echo $row['Prenom_enseignant'];
                                                                                        } else {
                                                                                            echo "NO";
                                                                                        } ?>)</label>
                                                <a href="Ajouter_ici_Enseignant.php" class="btn btn-primary">Ajouter ici Enseignant</a>
                                            </div>

                                            <div class="col-3">
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#module').on('change', function() {
                                                            var module = $(this).val();
                                                            if (module) {
                                                                $.get(
                                                                    "seance_module_type_ajax.php", {
                                                                        module: module
                                                                    },
                                                                    function(data) {
                                                                        $('#type').html(data);
                                                                    }
                                                                );
                                                            } else {
                                                                $('#type').html('<option>select specialite first</option>')
                                                            }
                                                        });
                                                    });
                                                </script>
                                                <label class="form-label">Type</label>
                                                <select name="type" id="type" class="form-select">
                                                    <?php
                                                    echo '<option value="">' . "selectionner le module" . '</option>';
                                                    ?>
                                                </select>

                                            </div>
                                            <div class="col-3">
                                                <div name="groupe" id="groupe">

                                                </div>
                                            </div>





                                        </div>
                                        <script>


                                        </script>
                                        <div class="row">




                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div name="groupe" id="groupe">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="">
                                            <button class="btn btn-success " style=" margin-top: 32px; width: 990px; height: 39px;  " name="ajouter">Ajouter</button>
                                        </div>

                                </form>
                            </div>
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