<?php
session_start();

include('conn.php');

$module = mysqli_real_escape_string($conn, $_POST['module']);
$cour = mysqli_real_escape_string($conn, $_POST['cour']);
$td = mysqli_real_escape_string($conn, $_POST['td']);
$tp = mysqli_real_escape_string($conn, $_POST['tp']);
$filiere = mysqli_real_escape_string($conn, $_POST['filiere']);

$MOD = mysqli_real_escape_string($conn, $_POST['MOD']);

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
        <script>
            $(document).ready(function() {
                $('#filiere').on('change', function() {
                    var filiereIDD = $(this).val();
                    if (filiereIDD) {
                        $.get(
                            "Emploi_test_filiere_specialite.php", {
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
                $('#specialite').on('change', function() {
                    var specialiteIDD = $(this).val();
                    if (specialiteIDD) {
                        $.get(
                            "Emploi_test_specialite_promotion.php", {
                                specialitepromotion: specialiteIDD
                            },
                            function(data) {
                                $('#promotion').html(data);
                            }
                        );
                    } else {
                        $('#promotion').html('<option>select filiere first</option>')
                    }
                });
            });
        </script>
    </head>

    <body>
        <!-- Nav bar -->
        <?php include "include_chefDepartement/header.php"; ?>
        <!-- End Nav bar -->
        <section class="mt-2 ">
            <div class="container-fluids">
                <div class="row">
                <?php
                    include("MenuBar.php");
                    ?>
                    <div class="col-12 col-md-9 col-lg-9 pb-3 p-3 ">
                        <div class="card" style="background-color: #f8f9fa;">
                            <div class="card-body shadow">
                                <?php
                                $specialite = mysqli_real_escape_string($conn, $_POST['specialite']);
                                $promotion = mysqli_real_escape_string($conn, $_POST['promotion']);
                                $semestre = mysqli_real_escape_string($conn, $_POST['semestre']);

                                $id = mysqli_real_escape_string($conn, $_GET['id']);
                                if (isset($MOD)) {

                                    if (empty($module)) {
                                        echo "<div class='alert alert-danger'>" . "قم بادخال معلوماتك" . "</div>";
                                    } else {

                                        $modify = "UPDATE module 
                                        SET Nom_module='$module',cour='$cour', td='$td', tp='$tp', id_promotion='$promotion', semestre='$semestre'
                                        WHERE id_module='$id'";
                                        $res = mysqli_query($conn, $modify);
                                        if (isset($res)) {
                                            echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
                                            header('REFRESH:2;URL=module.php');
                                        } else {
                                            echo "<div class='alert alert-danger'>" . "votre informations sont incorrectes" . "</div>";
                                        }
                                    }
                                }


                                $sql = "SELECT * FROM module WHERE id_module='$id'";
                                $query = mysqli_query($conn, $sql);
                                $r = mysqli_fetch_assoc($query);
                                ?>
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <div class="container-fluids">
                                        <div class="row">
                                            <div class="col-6">

                                                <label id="module" class="form-label">Module</label>
                                                <input type="text" placeholder="<?php echo $r['Nom_module']; ?>" class="form-control " name="module">

                                                <label id="cour" class="form-label ">Cour</label>
                                                <select name="cour" class="form-select ">
                                                    <option name="cour">Oui</option>
                                                    <option name="cour">Non</option>
                                                </select>

                                                <label id="" class="form-label">Fili&eacute;re</label>
                                                <select name="filiere" id="filiere" class="form-select filiere">
                                                    <option disabled="disabled" selected="selected">S&eacute;lectionner la fili&eacute;re </option>
                                                    <?php
                                                    $chef_departement = $_SESSION['chef_departement'];
                                                    $query = "SELECT * FROM filiere WHERE id_departement='$chef_departement'";
                                                    $res = mysqli_query($conn, $query);
                                                    while ($row = mysqli_fetch_assoc($res)) {
                                                    ?>
                                                        <option value="<?php echo $row['id_filiere']; ?>">
                                                            <?php echo $row['Nom_filiere']; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                                <label class="form-label">sp&eacute;cialit&eacute;</label>
                                                <select class="form-select specialite" id="specialite" name="specialite">
                                                    <option disabled="disabled" selected="selected">S&eacute;lectionner la sp&eacute;cialit&eacute; </option>

                                                </select>


                                            </div>
                                            <div class="col-6">
                                                <label id="td" class="form-label">Td</label>
                                                <select name="td" class="form-select ">
                                                    <option name="td">Oui</option>
                                                    <option name="td">Non</option>
                                                </select>
                                                <label id="tp" class="form-label ">Tp</label>
                                                <select name="tp" class="form-select">
                                                    <option name="tp">Oui</option>
                                                    <option name="tp">Non</option>
                                                </select>

                                                <label id="semestre" class="form-label ">Semestre</label>
                                                <select name="semestre" class="form-select">
                                                    <option value="1">S1</option>
                                                    <option value="2">S2</option>
                                                </select>

                                                <label class="form-label">promotion</label>
                                                <select name="promotion" id="promotion" class="promotion form-select">
                                                    <option disabled="disabled" selected="selected">S&eacute;lectionner la promotion</option>

                                                </select>
                                            </div>

                                        </div>
                                    </div>



                                    <button class="btn btn-success mt-3" name="MOD">Mofifier</button>
                                    <a name="cancel" class="btn btn-primary mt-3" href="module.php">Annuler</a>
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