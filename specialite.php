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
                $('#filiereSelect').on('change', function() {
                    var filiereID = $(this).val();
                    if (filiereID) {
                        $.get(
                            "specialite_ajax_filtre.php", {
                                filiere: filiereID
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
    </head>

    <body>
        <!-- Nav bar -->
        <?php
        include "include_chefDepartement/header.php";
        ?>
        <!-- End Nav bar -->
        <?php
        $Nom_specialite = mysqli_real_escape_string($conn, $_POST['Nom_specialite']);
        $filiere = mysqli_real_escape_string($conn, $_POST['filiere']);
        $ajouter = $_POST['ajouter'];
        ?>
        <section class="mt-2">
            <div class="container-fluids">
                <div class="row">
                <?php
                    include("MenuBar.php");
                    ?>
                    <div class="col-12 col-md-9 col-lg-9 pb-3 p-3">
                        <div class="card">
                            <div class="card-body shadow" style="background-color: #f8f9fa;">
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <?php
                                    if (isset($ajouter)) {
                                        if (empty($Nom_specialite) || empty($filiere)) {
                                            echo "<div class='alert alert-danger'>" . "قم بادخال معلوماتك" . "</div>";
                                        } else {

                                            $query = "INSERT INTO specialite(Nom_specialite,id_filiere)VALUES('$Nom_specialite','$filiere')";
                                            $res = mysqli_query($conn, $query);
                                            if (isset($res)) {
                                                echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
                                            } else {
                                                echo "<div class='alert alert-danger'>" . "votre informations sont incorrectes" . "</div>";
                                            }
                                        }
                                    }
                                    ?>
                                    <label class="form-label">Nom sp&eacute;cialit&eacute;</label>
                                    <input type="text" placeholder="Nom specialite" class="form-control" name="Nom_specialite"><br>

                                    <label class="form-label">Fili&eacute;re</label>
                                    <select name="filiere" id="filiere" class="form-select">
                                        <option disabled="disabled" selected="selected">S&eacute;lectionner la fili&eacute;re </option>
                                        <?php
                                        /*
                                        $_SESSION['id'] = $row['id_enseignant'];
                                        $_SESSION['chef_departement'] = $row['chef_departement'];
                                        */
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


                                    <button class="btn btn-success mt-4" name="ajouter">Ajouter</button>
                                </form>


                            </div>
                        </div>
                        <div class="card  mt-3">
                            <div class="card-body shadow" style="background-color: #f8f9fa;">
                                <?php
                                $id = mysqli_real_escape_string($conn, $_GET['id']);
                                //delete-module
                                if (!empty($id)) {
                                    $sqll = "SELECT * FROM promotion WHERE id_specialite='$id'";
                                    $qu = mysqli_query($conn, $sqll);
                                    $s = mysqli_num_rows($qu);
                                    if ($s == 0) {
                                        $query = "DELETE FROM specialite WHERE id_specialite='$id'";
                                        $delete = mysqli_query($conn, $query);
                                        if (isset($delete)) {
                                            echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
                                        } else {
                                            echo "<div class='alert alert-danger'>" . "votre informations sont incorrectes" . "</div>";
                                        }
                                    } else {
                                        echo "<div class='alert alert-danger'>" . "cette specialite est déjà utilisé, vous pouvez pas le supprimer" . "</div>";
                                    }
                                } ?>
                                <label class="form-label"><i class="fas fa-filter"></i>Fili&eacute;re</label>
                                <select name="filiereSelect" id="filiereSelect" class="filiereSelect form-select">
                                    <option disabled="disabled" selected="selected">S&eacute;lectionner la fili&eacute;re </option>
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
    /*
    echo ('id enseignant est: ');
    echo ($_SESSION['id']);
    echo ('          departement est: ');
    echo ($_SESSION['chef_departement']);*/
}
?>