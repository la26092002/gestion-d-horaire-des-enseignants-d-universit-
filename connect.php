<?php
session_start();

include('conn.php');

$mail = mysqli_real_escape_string($conn, $_POST['mail']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$login = $_POST['login'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horaire</title>
    <link rel="stylesheet" type="text/css" href="bootst.css">
    <link rel="stylesheet" href="css/all.min.FA.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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

    <section>
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <?php
                            if (isset($login)) {
                                $query = "SELECT * FROM enseignant WHERE Email_enseignant='$mail'AND Motpass_enseignant='$password' and verifie='1' ";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_assoc($result);
                                if ($row['Email_enseignant'] == $mail && $row['Motpass_enseignant'] == $password &&  $row['directeur_detude'] == '1') {
                                    echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
                                    $_SESSION['id_enseignant_directeur'] = $row['id_enseignant'];
                                    header("REFRESH:2;URL=directeur_detude.php");
                                } elseif ($row['Email_enseignant'] == $mail && $row['Motpass_enseignant'] == $password && $row['chef_departement'] == Null &&  $row['directeur_detude'] != '1') {

                                    echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
                                    $_SESSION['id_enseignant'] = $row['id_enseignant'];

                                    header("REFRESH:2;URL=Mon_emploi_du_temps_Enseignant.php");
                                }
                                //


                                //!in_array
                                elseif ($row['Email_enseignant'] == $mail && $row['Motpass_enseignant'] == $password && $row['chef_departement'] != Null &&  $row['directeur_detude'] != '1') {
                                    echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
                                    $_SESSION['id'] = $row['id_enseignant'];
                                    $_SESSION['chef_departement'] = $row['chef_departement'];

                                    header("REFRESH:2;URL=chef_departement.php");
                                } else {
                                    echo "<div class='alert alert-danger'>" . "votre informations sont incorrectes" . "</div>";
                                }
                            }

                            ?>
                            <center>
                                <svg class="my-3 mx-auto" xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                            </center>
                            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                                <input type="email" name="mail" id="mail" class="form-control my-3 py-2" placeholder="Email">
                                <input type="password" name="password" class="form-control my-3 py-2" placeholder="Mot de passe ">
                                <div class="text-center mt-3">
                                    <button name="login" class="btn btn-primary">se connecter</button>
                                    <a href="password.php" class="nav-link">Mot de passe oublié ?</a>
                                    <a href="inscrir-enseignant.php" class="nav-link">Vous avez un compte?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include "footer/footer.php"; ?>
</body>

</html>