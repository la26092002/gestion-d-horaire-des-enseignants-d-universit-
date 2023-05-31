<?php
session_start();

include('conn.php');

$Nom = mysqli_real_escape_string($conn, $_POST['Nom']);
$Prenom = mysqli_real_escape_string($conn, $_POST['Prenom']);
$Email = mysqli_real_escape_string($conn, $_POST['Email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$confirmer_password = mysqli_real_escape_string($conn, $_POST['confirmer_password']);
$faculte = mysqli_real_escape_string($conn, $_POST['faculte']);
$domaine = mysqli_real_escape_string($conn, $_POST['domaine']);
$departement = mysqli_real_escape_string($conn, $_POST['departement']);
$filiere = mysqli_real_escape_string($conn, $_POST['filiere']);
$verifie = 0;
$inscrir = $_POST['inscrir'];






?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horaire</title>
    <link rel="stylesheet" href="css/all.min.FA.css">
    <link rel="stylesheet" type="text/css" href="bootst.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            text-decoration: none;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#faculte').on('change', function() {
                var faculteIDD = $(this).val();
                if (faculteIDD) {
                    $.get(
                        "faculte_inscrir.php", {
                            faculte: faculteIDD
                        },
                        function(data) {
                            $('#domaine').html(data);
                        }
                    );
                } else {
                    $('#domaine').html('<option>select filiere first</option>')
                }
            });
        });

        $(document).ready(function() {
            $('#domaine').on('change', function() {
                var domaineIDD = $(this).val();
                if (domaineIDD) {
                    $.get(
                        "domaine_departement_inscrir.php", {
                            domaine: domaineIDD
                        },
                        function(data) {
                            $('#departement').html(data);
                        }
                    );
                } else {
                    $('#departement').html('<option>select filiere first</option>')
                }
            });
        });

        $(document).ready(function() {
            $('#departement').on('change', function() {
                var departementIDD = $(this).val();
                if (departementIDD) {
                    $.get(
                        "departement_filiere_inscrir.php", {
                            departement: departementIDD
                        },
                        function(data) {
                            $('#filiere').html(data);
                        }
                    );
                } else {
                    $('#filiere').html('<option>select filiere first</option>')
                }
            });
        });
    </script>

</head>

<body>
    <!-- Nav bar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light text-capitalize navbarr">
            <div class="container">
                <a href="index.html" class="navbar-brand pb-0"><img src="logo1.png" alt="1" class="img-fluid up-animation" style="max-width: 60%;"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav ms-auto px-5 fs-5 ">
                        <li class="nav-item">
                            <a href="index.html" class="nav-link" data-current="page"><i class="fas fa-home"></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="connect.php" class="nav-link" data-current="page">se connecter</a>
                        </li>
                        <li class="nav-item">
                            <a href="inscrir-enseignant.php" class="nav-link" data-current="page">s' inscrire</a>
                        </li>
                        <li class="nav-item">
                            <a href="about.html" class="nav-link" data-current="page"><i class="fas fa-info-circle"></i></a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">

                        </li>
                    </ul>

                </div>
            </div>
        </nav>
    </header>
    <!-- Hero -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto p-2">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <?php
                        if (isset($inscrir)) {
                            if (empty($Nom) || empty($Prenom) || empty($Email) || empty($password) || empty($filiere) || empty($departement) || empty($domaine) || empty($faculte) || ($confirmer_password != $password)) {
                                echo "<div class='alert alert-danger'>" . " Les informations incorrect" . "</div>";
                            } else {
                                $s = "SELECT * FROM enseignant WHERE Email_enseignant='$Email'";
                                $q = mysqli_query($conn, $s);
                                $exist = mysqli_num_rows($q);
                                if ($exist == 0) {
                                    $verifie = 0;

                                    $query = "INSERT INTO enseignant (Email_enseignant,Nom_enseignant,Prenom_enseignant,Motpass_enseignant,chef_departement,directeur_detude,id_departement,verifie)
                                VALUES('$Email','$Nom','$Prenom','$password',NULL,'0','$departement','$verifie')";
                                    $res = mysqli_query($conn, $query);
                                    if (isset($res)) {
                                        echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
                                    } else {
                                        echo "<div class='alert alert-danger'>" . "votre informations sont incorrectes" . "</div>";
                                    }
                                }else{
                                    echo "<div class='alert alert-danger'>" . "vous avez d&eacute;j&aacute; un compte" . "</div>";
                                }
                            }
                        }
                        ?>
                        <div class="inscrir ">

                        </div>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                            <label class="form-label">Nom</label>
                            <input type="text" placeholder="Nom" class="form-control" name="Nom"><br>

                            <label class="form-label">Pr&eacute;nom</label>
                            <input type="text" placeholder="Prenom" class="form-control" name="Prenom"><br>

                            <label class="form-label">Email</label>
                            <input type="mail" placeholder="Email" class="form-control" name="Email"><br>


                            <label class="form-label">Mot de passe</label>
                            <input type="password" placeholder="Mot de passe" class="form-control" name="password"><br>

                            <label class="form-label">Confirmer mot de passe</label>
                            <input type="password" placeholder="Confirmer mot de passe" class="form-control" name="confirmer_password"><br>

                            <label class="form-label">Facult&eacute;</label>
                            <select name="faculte" id="faculte" class="faculte form-control">
                                <option disabled="disabled" selected="selected">Selectionner la facult&eacute;</option>
                                <?php
                                $query = "SELECT * FROM faculte";
                                $res = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($res)) {
                                ?>
                                    <option value="<?php echo $row['id_faculte']; ?>">
                                        <?php echo $row['Nom_faculte']; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select><br>

                            <label class="form-label">Domaine</label>
                            <select name="domaine" id="domaine" class="domaine form-control">

                            </select><br>

                            <label class="form-label">D&eacute;partement</label>
                            <select name="departement" id="departement" class="departement form-control">

                            </select><br>

                            <label class="form-label">Fili&eacute;re</label>
                            <select name="filiere" id="filiere" class="filiere form-control">

                            </select><br>
                            <div class="mt-3">
                                <button class="btn btn-primary " name="inscrir">Inscrir</button>
                                <a href="connect.php" class="nav-link text-center">j'ai un compte ?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer/footer.php"; ?>

</body>


</html>