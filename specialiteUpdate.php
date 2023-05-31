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
        <section class="mt-2 ">
            <div class="container-fluids">
                <div class="row">
                <?php
                    include("MenuBar.php");
                    ?>
                    <div class="col-12 col-md-9 col-lg-9 pb-3 p-3 ">
                        <div class="card">
                            <div class="card-body shadow" style="background-color: #f8f9fa;">
                                <?php
                                $Nom_specialite = mysqli_real_escape_string($conn, $_POST['Nom_specialite']);
                                $filiere = mysqli_real_escape_string($conn, $_POST['filiere']);
                                $update = $_POST['update'];

                                //update-specialite
                                if (isset($update) && (!empty($Nom_specialite))) {
                                    $idd = mysqli_real_escape_string($conn, $_GET['id']);
                                    $query = "UPDATE specialite SET Nom_specialite='$Nom_specialite', id_filiere='$filiere' WHERE id_specialite='$idd'";
                                    $upda = mysqli_query($conn, $query);
                                    if (isset($upda)) {
                                        echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
                                        
                                        header('REFRESH:1;URL=./specialite.php');
                                    } else {
                                        echo "<div class='alert alert-danger'>" . "votre informations sont incorrectes" . "</div>";
                                        
                                        header('REFRESH:1;URL=./specialite.php');
                                    }
                                }
                                ?>
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <?php
                                    $iddd = mysqli_real_escape_string($conn, $_GET['id']);
                                    $sqldd = "SELECT * FROM specialite WHERE id_specialite='$iddd'";
                                    $querydd = mysqli_query($conn, $sqldd);
                                    $ro = mysqli_fetch_assoc($querydd);
                                    ?>
                                    <label class="form-label">Nom specialite</label>
                                    <input type="text" placeholder="<?php echo $ro['Nom_specialite'] ?>" class="form-control" name="Nom_specialite"><br>

                                    <label class="form-label">filiere</label>
                                    <select name="filiere" id="filiere" class="form-select">
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

                                    <button class="btn btn-success mt-3" name="update">Modifier</button>
                                    <a name="cancel" class="btn btn-primary mt-3" href="specialite.php">Annuler</a>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
        <?php include "footer/footer.php"; ?>
    </body>

    </html><?php }
            ?>