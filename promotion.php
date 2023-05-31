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
        <!-- ce script pour utuliser ajax avec php dans la relation de specialite et filiere -->
        <script>
            $(document).ready(function() {
                $('#filiere').on('change', function() {
                    var filiereID = $(this).val();
                    if (filiereID) {
                        $.get(
                            "promotion-ajax.php", {
                                filiere: filiereID
                            },
                            function(data) {
                                $('#specialite').html(data);
                            }
                        );
                    } else {
                        $('#specialite').html('<option>select filiere first</option>')
                    }
                })
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
                    <div class="col-12 col-sm-12 col-md-9 col-lg-9 pb-3 p-3">
                        <?php
                        $filiere = mysqli_real_escape_string($conn, $_POST['filiere']);
                        $specialite = mysqli_real_escape_string($conn, $_POST['specialite']);
                        $Nom_promotion = mysqli_real_escape_string($conn, $_POST['Nom_promotion']);
                        $quantité_groupe = mysqli_real_escape_string($conn, $_POST['quantité_groupe']);
                        $ajouter = $_POST['ajouter'];
                        if (isset($ajouter)) {
                            if (empty($specialite) || empty($filiere) || empty($Nom_promotion) || empty($quantité_groupe) || $filiere == '' || $specialite == '') {
                                echo "<div class='alert alert-danger'>" . "قم بادخال معلوماتك" . "</div>";
                            } else {
                                $promo = "INSERT INTO promotion(Nom_promotion,quantité_groupe,id_specialite)VALUES('$Nom_promotion','$quantité_groupe','$specialite')"; //'$Nom_promotion','$quantité_groupe','$id_specialite','$id_filiere','$id_departement','$id_domaine','$id_faculte'
                                $promores = mysqli_query($conn, $promo);
                                if (isset($promores)) {
                                    echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>" . "votre informations sont incorrectes" . "</div>";
                                }
                            }
                        }
                        ?>
                        <div class="card">
                            <div class="card-body shadow" style="background-color: #f8f9fa;">
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label">fili&eacute;re</label>
                                            <select class="form-select" id="filiere" name="filiere" aria-label="Floating label select example">
                                                <option disabled="disabled" selected="selected">S&eacute;lectionner la fili&eacute;re </option>
                                                <?php
                                                $id_departement = $_SESSION['chef_departement'];
                                                $query = "SELECT * FROM filiere WHERE id_departement='$id_departement'";
                                                $res = mysqli_query($conn, $query);
                                                while ($row = mysqli_fetch_assoc($res)) {
                                                ?>
                                                    <option value="<?php echo ($row['id_filiere']); ?>"><?php echo ($row['Nom_filiere']) ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>

                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">specialite</label>
                                            <select class="form-select" id="specialite" name="specialite" aria-label="Floating label select example">
                                                <option disabled="disabled" selected="selected">S&eacute;lectionner la sp&eacute;cialit&eacute; </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="Nom_promotion">Nom promotion</label>
                                            <input type="text" class="form-control" name="Nom_promotion" id="Nom_promotion" placeholder="Nom promotion">

                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="quantité_groupe">quantité groupe</label>
                                            <input type="number" class="form-control" name="quantité_groupe" id="quantité_groupe" placeholder="quantité groupe">
                                        </div>
                                    </div>
                                    <button class="btn btn-success mt-1" name="ajouter">Ajouter</button>
                                </form>






                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body shadow" style="background-color: #f8f9fa;">
                                <?php
                                $id = mysqli_real_escape_string($conn, $_GET['id']);
                                //delete-module
                                if (!empty($id)) {
                                    $sqll = "SELECT * FROM seance WHERE id_promotion='$id'";
                                    $qu = mysqli_query($conn, $sqll);
                                    $s = mysqli_num_rows($qu);
                                    if ($s == 0) {
                                        $query = "DELETE FROM promotion WHERE id_promotion='$id'";
                                        $delete = mysqli_query($conn, $query);
                                        if (isset($delete)) {
                                            echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
                                        } else {
                                            echo "<div class='alert alert-danger'>" . "votre informations sont incorrectes" . "</div>";
                                        }
                                    } else {
                                        echo "<div class='alert alert-danger'>" . "cette promotion est déjà utilisé, vous pouvez pas le supprimer" . "</div>";
                                    }
                                } ?>
                                <script>
                                    $(document).ready(function() {
                                        $('#filieree').on('change', function() {
                                            var filiereIDD = $(this).val();
                                            if (filiereIDD) {
                                                $.get(
                                                    "Emploi_test_filiere_specialite.php", {
                                                        filierespecialite: filiereIDD
                                                    },
                                                    function(data) {
                                                        $('#specialitee').html(data);
                                                    }
                                                );
                                            } else {
                                                $('#specialitee').html('<option>select filiere first</option>')
                                            }
                                        });
                                    });

                                    $(document).ready(function() {
                                        $('#specialitee').on('change', function() {
                                            var specialiteID = $(this).val();
                                            if (specialiteID) {
                                                $.get(
                                                    "promo_ajax_filtre.php", {
                                                        specialiteID: specialiteID
                                                    },
                                                    function(data) {
                                                        $('#Select').html(data);
                                                    }
                                                );
                                            } else {
                                                $('#Select').html('<option>select filiere first</option>')
                                            }
                                        })
                                    });
                                </script>

                                <div>
                                    <label class="form-label"><i class="fas fa-filter"></i> filiére</label>
                                    <select name="filieree" id="filieree" class="filieree form-select">
                                        <option disabled="disabled" selected="selected">S&eacute;lectionner la fili&eacute;re</option>
                                        <?php
                                        $dep = $_SESSION['chef_departement'];
                                        $sql = "SELECT * FROM filiere WHERE id_departement='$dep'";
                                        $query = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <option value="<?php echo $row['id_filiere']; ?>"><?php echo $row['Nom_filiere']; ?></option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                                <div class="mt-2">
                                    <label class="form-label"><i class="fas fa-filter"></i> spécialité</label>
                                    <select name="specialitee" id="specialitee" class="specialitee form-select">
                                        <option disabled="disabled" selected="selected">S&eacute;lectionner la sp&eacute;cialit&eacute;</option>
                                    </select>
                                </div>

                                <div class="Select" id="Select">
                                </div>
                            </div>
                        </div>
                    </div>
        </section>
        <?php include "footer/footer.php"; ?>






    </body>

    </html>
<?php
}
?>