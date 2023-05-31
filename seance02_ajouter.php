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
                <?php
                    include("MenuBar.php");
                    ?>

                    <!--  -->
                    <div class="col-12 col-sm-12 col-md-9 col-lg-9  pb-3 p-3">
                        <?php
                        $id = mysqli_real_escape_string($conn, $_GET['id']);
                        $f = mysqli_real_escape_string($conn, $_GET['f']);
                        $ajouter = $_POST['ajouter'];
                        $heure = mysqli_real_escape_string($conn, $_POST['heure']);
                        $jour = mysqli_real_escape_string($conn, $_POST['jour']);
                        $salle = mysqli_real_escape_string($conn, $_POST['salle']);
                        $type = mysqli_real_escape_string($conn, $_POST['type']);
                        $numeroGroupe = mysqli_real_escape_string($conn, $_POST['numeroGroupe']);
                        $promotion = mysqli_real_escape_string($conn, $_GET['promotion']);
                        if ($_GET['Ajouter_Enseignant']) {
                            $enseignant = mysqli_real_escape_string($conn, $_GET['Ajouter_Enseignant']);
                        } else {
                            $enseignant = mysqli_real_escape_string($conn, $_POST['enseignant']);
                        }
                        if (isset($ajouter)) {
                            if ($type == 'td' or $type == 'tp') {
                                $query = "INSERT INTO seance(id_module,Id_enseignant,type,id_salle,id_promotion,id_heure,jour,Numero_groupe)
                                VALUES('$id','$enseignant','$type','$salle','$promotion','$heure','$jour','$numeroGroupe')"; //'$Nom_promotion','$quantité_groupe','$id_specialite','$id_filiere','$id_departement','$id_domaine','$id_faculte'
                            } else {
                                $query = "INSERT INTO seance(id_module,Id_enseignant,type,id_salle,id_promotion,id_heure,jour,Numero_groupe)
                                VALUES('$id','$enseignant','$type','$salle','$promotion','$heure','$jour',NULL)"; //'$Nom_promotion','$quantité_groupe','$id_specialite','$id_filiere','$id_departement','$id_domaine','$id_faculte'
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
                                        <div class="col-6">
                                            <label class="form-label">Type Enseignant</label>
                                            <select name="enseiType" id="enseiType" class="form-select" required>
                                                <option disabled="disabled" selected="selected">S&eacute;lectionner le type enseignant</option>
                                                <option value="1">Notre departement</option>
                                                <option value="2">tout les departements</option>
                                            </select>
                                        </div>
                                        <?php
                                        $id = mysqli_real_escape_string($conn, $_GET['id']);
                                        $f = mysqli_real_escape_string($conn, $_GET['f']);
                                        $promotion = mysqli_real_escape_string($conn, $_GET['promotion']);
                                        $_SESSION['id_module'] = $id;
                                        $_SESSION['f_filiere'] = $f;
                                        $_SESSION['promotion_seance'] = $promotion;
                                        ?>

                                        <div class="col-6" id="selection">
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
                                                $s = "SELECT * FROM heure WHERE id_filiere='$f' order by ordre";
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
                                            <option disabled="disabled" selected="selected">S&eacute;lectionner le jour</option>
                                            
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
                                                $f = $_GET['f'];
                                                $s = "SELECT * FROM salle WHERE id_filiere='$f'";
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
                                                <option disabled="disabled" selected="selected">S&eacute;lectionner le type </option>
                                                <?php
                                                $id = mysqli_real_escape_string($conn, $_GET['id']);

                                                $query = "SELECT * FROM module WHERE id_module='$id'";
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