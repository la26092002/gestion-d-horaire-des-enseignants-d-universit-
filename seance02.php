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
                    var filiere = document.getElementById("filiere").value;
                    if (promotionIDD) {
                        $.get(
                            "seance02-module-ajax.php", {
                                promotion: promotionIDD,
                                semestre: semestre,
                                filiere: filiere
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
                <?php
                    include("MenuBar.php");
                    ?>

                    <!--  -->
                    <div class="col-12 col-sm-12 col-md-9 col-lg-9  ">
                        <div class="card">
                            <div class="card-body shadow bg-light text-dark">
                                <?php
                                //insert data 
                                $filiere = mysqli_real_escape_string($conn, $_POST['filiere']);
                                $module = mysqli_real_escape_string($conn, $_POST['module']);
                                if ($_GET['Ajouter_Enseignant']) {
                                    $enseignant = mysqli_real_escape_string($conn, $_GET['Ajouter_Enseignant']);
                                } else {
                                    $enseignant = mysqli_real_escape_string($conn, $_POST['enseignant']);
                                }
                                $type = mysqli_real_escape_string($conn, $_POST['type']);
                                $salle = mysqli_real_escape_string($conn, $_POST['salle']);
                                $specialite = mysqli_real_escape_string($conn, $_POST['specialite']);
                                $promotion = mysqli_real_escape_string($conn, $_POST['promotion']);
                                $heure = mysqli_real_escape_string($conn, $_POST['heure']);

                                $numeroGroupe = mysqli_real_escape_string($conn, $_POST['numeroGroupe']);
                                $jour = mysqli_real_escape_string($conn, $_POST['jour']);



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
                                        echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
                                    } else {
                                        echo "<div class='alert alert-danger'>" . "votre informations sont incorrectes" . "</div>";
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
                                                    <option disabled="disabled" selected="selected">S&eacute;lectionner le semestre</option>
                                                    <option value="1">S1</option>
                                                    <option value="2">S2</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label">Fili&eacute;re</label>
                                                <select name="filiere" id="filiere" class="form-select">
                                                    <option disabled="disabled" selected="selected">S&eacute;lectionner la fili&eacute;re</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label">Sp&eacute;cialit&eacute;</label>
                                                <select name="specialite" id="specialite" class="form-select">
                                                    <option disabled="disabled" selected="selected">S&eacute;lectionner la Sp&eacute;cialit&eacute;</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label">Promotion</label>
                                                <select name="promotion" id="promotion" class="form-select">
                                                <option disabled="disabled" selected="selected">S&eacute;lectionner la Promotion</option>
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                            </div>


                            </form>
                        </div>

                        <div class="col-12" id="module">

                        </div>

                    </div>
        </section>
        <br><br><br><br>
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