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
                        //update-promotion
                        $filiere = mysqli_real_escape_string($conn, $_POST["filiere"]);
                        $specialite = mysqli_real_escape_string($conn, $_POST["specialite"]);
                        $Nom_promotion = mysqli_real_escape_string($conn, $_POST["Nom_promotion"]);
                        $quantité_groupe = mysqli_real_escape_string($conn, $_POST["quantité_groupe"]);
                        $update = $_POST["update"];
                        $iddd = mysqli_real_escape_string($conn, $_GET['id']);
                        if (isset($update) && (!empty($Nom_promotion)) && (!empty($quantité_groupe)) && (!empty($specialite)) && (!empty($filiere))) {
                            $query = "UPDATE promotion SET Nom_promotion='$Nom_promotion',quantité_groupe='$quantité_groupe',id_specialite='$specialite' WHERE id_promotion='$iddd'";
                            $upda = mysqli_query($conn, $query);
                            if (isset($upda)) {
                                echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
                                header('REFRESH:2;URL=promotion.php');
                            } else {
                                echo "<div class='alert alert-danger'>" . "votre informations sont incorrectes" . "</div>";
                                header('REFRESH:2;URL=promotion.php');
                            }
                        } ?>
                        <div class="card">
                            <div class="card-body shadow" style="background-color: #f8f9fa;">
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label">Filière</label>
                                            <select class="form-select" id="filiere" name="filiere" aria-label="Floating label select example" required>
                                                <option disabled="disabled" selected="selected">S&eacute;lectionner la fili&eacute;re</option>
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
                                            <label class="form-label">Sp&eacute;cialit&eacute;</label>
                                            <select class="form-select" id="specialite" name="specialite" aria-label="Floating label select example" required>
                                                <option disabled="disabled" selected="selected">S&eacute;lectionner la sp&eacute;cialit&eacute;</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <?php
                                            $id = mysqli_real_escape_string($conn, $_GET['id']);
                                            $sq = "SELECT * FROM promotion WHERE id_promotion='$id'";
                                            $q = mysqli_query($conn, $sq);
                                            $r = mysqli_fetch_assoc($q);
                                            ?>
                                            <label class="form-label">Nom promotion:</label>
                                            <input type="text" class="form-control" name="Nom_promotion" id="Nom_promotion" value="<?php echo $r['Nom_promotion']; ?>" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">quantité groupe:</label>
                                            <input type="number" class="form-control" name="quantité_groupe" id="quantité_groupe" value="<?php echo $r['quantité_groupe']; ?>" required>
                                        </div>
                                    </div>
                                    <button class="btn btn-success mt-3" name="update">Modifier</button>
                                    <a name="cancel" class="btn btn-primary mt-3" href="promotion.php">Annuler</a>
                                </form>
                            </div>
                        </div>
                    </div>
        </section>
        <?php include "footer/footer.php"; ?>






    </body>

    </html><?php } ?>