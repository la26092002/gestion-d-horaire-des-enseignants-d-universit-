<?php
session_start();

include('conn.php');
if (!isset($_SESSION['id']) && (!isset($_SESSION['chef_departement']))) {
    echo "<div class='alert alert-danger'>" . "غير مسموح لك فتح هذه الصفحة" . "</div>";
    header('REFRESH:2;URL=connect.php');
} else {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $numero = mysqli_real_escape_string($conn, $_POST['numero']);
    $filiere = mysqli_real_escape_string($conn, $_POST['filiere']);
    $update = $_POST['update'];
    $id = mysqli_real_escape_string($conn, $_GET['id']);

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
    </head>

    <body>
        <!-- Nav bar -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light text-capitalize navbarr">
                <div class="container">
                    <a href="#" class="navbar-brand fs-2 h1 text-primary pb-0"><img src="logoUniv.png" width="550" alt=""></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="menu">
                        <ul class="navbar-nav ms-auto px-5 fs-5 ">
                            <li class="nav-item">
                                <a href="Mon_emploi_du_temps.php" style="color: #003d7a;" class="nav-link" data-current="page">Mon emploi du temps</a>
                            </li>
                        </ul>
                        <ul style="color: #003d7a;" class="navbar-nav">
                            <?php
                            $id = $_SESSION['id'];
                            $_SESSION['chef_departement'];
                            $query = "SELECT * FROM enseignant WHERE id_enseignant='$id' ";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            ?>
                            <li class="nav-item">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo ($row['Nom_enseignant']);
                                        echo (' ');
                                        echo ($row['Prenom_enseignant']); ?>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="parametres.php">paramètres</a></li>
                                        <li><a class="dropdown-item" href="logout.php">Se déconnecter</a></li>
                                    </ul>
                                </div>

                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
        </header>
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
                            <div class="card-body shadow" style="background-color: #f8f9fa;">
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <?php
                                    //update-module
                                    $iddd = mysqli_real_escape_string($conn, $_GET['id']);
                                    if (isset($update) && (!empty($nom)) && (!empty($numero)) && (!empty($filiere))) {
                                        $query = "UPDATE salle SET Nom_salle='$nom', id_filiere='$filiere',Num_salle='$numero' WHERE id_salle='$iddd'";
                                        $upda = mysqli_query($conn, $query);
                                        if (isset($upda)) {
                                            echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
                                            header('REFRESH:2;URL=salle.php');
                                        } else {
                                            echo "<div class='alert alert-danger'>" . "votre informations sont incorrectes" . "</div>";
                                        }
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">filiere</label>
                                            <select name="filiere" id="filiere" class="form-select">
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
                                        </div>
                                    </div>
                                    <?php
                                    $iddd = mysqli_real_escape_string($conn, $_GET['id']);
                                    $sq = "SELECT Num_salle,Nom_salle FROM salle WHERE id_salle='$iddd'";
                                    $qu = mysqli_query($conn, $sq);
                                    $roww = mysqli_fetch_assoc($qu);
                                    ?>
                                    <div class="row">
                                        <div class="col-6 pt-2">
                                            <label class="form-label">Nom salle</label>
                                            <input type="text" class="form-control" name="nom" id="nom" placeholder="<?php echo $roww['Nom_salle']; ?>" value="" required>
                                        </div>
                                        <div class="col-6 pt-2">
                                            <label class="form-label">Num salle</label>
                                            <input type="number" class="form-control" name="numero" id="numero" placeholder="<?php echo $roww['Num_salle']; ?>" value="" required>
                                        </div>

                                    </div>
                                    <div>
                                        <button name="update" class="btn btn-success mt-3">Modifier</button>
                                        <a name="cancel" class="btn btn-primary mt-3" href="salle.php">Annuler</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
        </section>
        <?php include "footer/footer.php"; ?>
    </body>

    </html>
<?php }
?>