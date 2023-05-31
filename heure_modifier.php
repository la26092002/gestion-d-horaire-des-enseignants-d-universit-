<?php
session_start();

include('conn.php');





$heure = mysqli_real_escape_string($conn, $_POST['heure']);
$cancel = $_POST['cancel'];
$modifier = $_POST['modifier'];

$ordre = mysqli_real_escape_string($conn, $_POST['ordre']);
$min_fin = mysqli_real_escape_string($conn, $_POST['min_fin']);
$h_fin = mysqli_real_escape_string($conn, $_POST['h_fin']);
$min_debut = mysqli_real_escape_string($conn, $_POST['min_debut']);
$h_debut = mysqli_real_escape_string($conn, $_POST['h_debut']);
$filiere = mysqli_real_escape_string($conn, $_POST['filiere']);



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
                            <?php
                            $t_debut = ($h_debut * 60) + $min_debut;
                            $t_fin = ($h_fin * 60) + $min_fin;
                            $t = $t_fin - $t_debut;
                            $heure2 = $h_debut . ':' . $min_debut . '-' . $h_fin . ':' . $min_fin;
                            //echo $t;
                            $M = $t % 60;
                            $H = (($t - $M) / 60);
                            //echo $H;
                            $id = $_GET['id'];
                            if (isset($modifier)) {
                                if ($t_fin <= $t_debut) {
                                    echo "<div class='alert alert-danger'>" . "Il existe un problème" . "</div>";
                                } else {
                                    $query = "UPDATE heure SET heure='$heure2',id_filiere='$filiere',ordre='$ordre',d_heure='$H',d_min='$M' WHERE id_heure='$id'";
                                    $res = mysqli_query($conn, $query);
                                    if (isset($res)) {
                                        echo "<div class='alert alert-success'>" . "Ajouté avec succès" . "</div>";
                                    } else {
                                        echo "<div class='alert alert-danger'>" . "Il existe un problème" . "</div>";
                                    }
                                }
                            }
                            ?>
                            <div class="card-body shadow" style="background-color: #f8f9fa;">
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <div class="row">
                                        <div class="container-fluids col-3">
                                            <label for="" class="form-label">Heure/debut</label>
                                            <select name="h_debut" id="" class="heure form-control" required>
                                                <?php
                                                for ($i = 7; $i < 19; $i++) {
                                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="container-fluids col-3">
                                            <label for="" class="form-label">Min/debut</label>
                                            <select name="min_debut" id="" class="heure form-control" required>
                                                <option value="00">00</option>
                                                <option value="05">05</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                                <option value="25">25</option>
                                                <option value="30">30</option>
                                                <option value="35">35</option>
                                                <option value="40">40</option>
                                                <option value="45">45</option>
                                                <option value="50">50</option>
                                                <option value="55">55</option>
                                            </select>
                                        </div>
                                        <div class="container-fluids col-3">
                                            <label for="" class="form-label">Heure/fin</label>
                                            <select name="h_fin" id="" class="heure form-control" required>
                                                <?php
                                                for ($j = 7; $j < 20; $j++) {
                                                    echo '<option value="' . $j . '">' . $j . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="container-fluids col-3">
                                            <label for="" class="form-label">Min/fin</label>
                                            <select name="min_fin" id="" class="heure form-control" required>
                                                <option value="00">00</option>
                                                <option value="05">05</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                                <option value="25">25</option>
                                                <option value="30">30</option>
                                                <option value="35">35</option>
                                                <option value="40">40</option>
                                                <option value="45">45</option>
                                                <option value="50">50</option>
                                                <option value="55">55</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-9">
                                            <label id="filiere" class="form-label">Filiere</label>
                                            <select name="filiere" id="filiere" class="form-select" required>
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
                                        </div>
                                        <div class="col-3">
                                            <div class="container-fluids">
                                                <?php
                                                $sqlOrdre = "SELECT ordre FROM heure WHERE id_heure='$id'";
                                                $queryOrdre = mysqli_query($conn, $sqlOrdre);
                                                $n = 1;
                                                $rowOrdre = mysqli_fetch_assoc($queryOrdre);
                                                ?>
                                                <label id="ordre" class="form-label">Ordre</label>
                                                <input type="number" value="<?php echo ($rowOrdre['ordre']); ?>" class="ordre form-control " name="ordre" required>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-success mt-3" name="modifier">Modifier</button>
                                    <a name="cancel" class="btn btn-primary mt-3" href="heure.php">Annuler</a>
                                </form>
                            </div>
                        </div>
                    </div>
        </section>
        <?php include "footer/footer.php"; ?>






    </body>

    </html><?php } ?>