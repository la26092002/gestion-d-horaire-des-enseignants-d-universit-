<?php
session_start();

include('conn.php');


if (!isset($_SESSION['id']) && (!isset($_SESSION['chef_departement']))) {
    echo "<div class='alert alert-danger'>" . "غير مسموح لك فتح هذه الصفحة" . "</div>";
    header('REFRESH:2;URL=connect.php');
} else {
    $Nom = mysqli_real_escape_string($conn, $_POST['Nom']);
    $Prenom = mysqli_real_escape_string($conn, $_POST['Prenom']);
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $verifie = mysqli_real_escape_string($conn, $_POST['verifie']);
    $filiere = mysqli_real_escape_string($conn, $_POST['filiere']);
    $modifier = $_POST['modifier'];
    $cancel = $_POST['cancel'];


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
        <section class="mt-2">
            <div class="container-fluids">
                <div class="row">
                <?php
                    include("MenuBar.php");
                    ?>
                    <div class="col-12 col-sm-12 col-md-9 col-lg-9 pb-3 p-3">
                        <div class="card">
                            <div class="card-body shadow">
                                <?php
                                $iddd = mysqli_real_escape_string($conn, $_GET['id']);
                                if (isset($modifier)) {
                                    if (empty($Nom) || empty($Prenom) || empty($Email)) {
                                        echo "<div class='alert alert-danger'>" . "الحقل فارغ" . "</div>";
                                    } else {
                                        $sql = "UPDATE enseignant SET Nom_enseignant='$Nom', Prenom_enseignant='$Prenom', Email_enseignant='$Email', verifie='$verifie' WHERE id_enseignant='$iddd'";
                                        $query = mysqli_query($conn, $sql);
                                        if (isset($query)) {
                                            echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
                                            header('REFRESH:2;URL=consulter_enseignant.php');
                                        } else {
                                            echo "<div class='alert alert-danger'>" . "votre informations sont incorrectes" . "</div>";
                                            header('REFRESH:2;URL=consulter_enseignant.php');
                                        }
                                    }
                                }

                                ?>
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <?php
                                    $s = "SELECT * FROM enseignant WHERE id_enseignant = '$iddd'";
                                    $q = mysqli_query($conn, $s);
                                    while ($row = mysqli_fetch_assoc($q)) {
                                    ?>
                                        <div >
                                        <label for="Nom" class="form-label">Nom promotion: </label>
                                            <input type="text" class="form-control" name="Nom" id="Nom" placeholder="<?php echo $row['Nom_enseignant']; ?>">
                                            
                                        </div>
                                        <div >
                                        <label for="Prenom" class="form-label">Prenom: </label>
                                            <input type="text" class="form-control" name="Prenom" id="Prenom" placeholder="<?php echo $row['Prenom_enseignant']; ?>">
                                            
                                        </div>
                                        <div >
                                        <label for="Email" class="form-label">Email: </label>
                                            <input type="text" class="form-control" name="Email" id="Email" placeholder="<?php echo $row['Email_enseignant']; ?>">
                                            
                                        </div>
                                        <div >
                                        <label for="" class="form-label">vérification </label>
                                            <select class="form-control" name="verifie" id="verifie">
                                            <option disabled="disabled" selected="selected">Selectionner la v&eacute;rification</option>
                                                <option value="1">vérifier</option>
                                                <option value="0">non vérifier</option>
                                            </select>
                                        </div><?php
                                            }
                                                ?>
                                    

                                    <?php
                                    $location = $_GET['location'];
                                    ?>
                                    <button name="modifier" class="btn btn-success mt-3">Modifier</button>
                                    <a name="cancel"  class="btn btn-primary mt-3" href="<?php if($location == 1){echo "consulter_enseignant_tous.php";}else{echo "consulter_enseignant.php";} ?>">Annuler</a>
                                </form>
                            </div>
                        </div>
                    </div>
        </section>
        <?php include "footer/footer.php"; ?>
    </body>

    </html><?php
        }
            ?>