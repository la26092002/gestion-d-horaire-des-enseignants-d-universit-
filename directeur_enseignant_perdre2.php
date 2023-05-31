<?php
session_start();
include('conn.php');
if (!isset($_SESSION['id_enseignant_directeur'])) {
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
        <link rel="stylesheet" href="css/all.min.FA.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </head>

    <body>
        <!-- Nav bar -->
        <?php include "inc_dr/header.php";
        echo $_SESSION['departement'];
        echo $_SESSION['semestre'];
        $sem = $_GET['sem'];
        $dep = $_GET['dep'];
        ?>
        <!-- End Nav bar -->
        <table class="table table-hover">
            <thread>
                <tr>
                    <th>Email</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Departement</th>
                    <th>Consulter</th>
                </tr>
            </thread>
            <tbody>
                <?php
                $query = "SELECT * FROM enseignant,departement where departement.id_departement=enseignant.id_departement AND enseignant.id_departement='$dep'";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    //trouver Nombre d'heure d'enseignant
                    $idE = $row['id_enseignant'];
                    $sqlll = "SELECT * FROM seance,heure,module WHERE module.id_module = seance.id_module AND module.semestre='$sem' AND seance.id_heure=heure.id_heure AND seance.id_enseignant=$idE ";
                    $queryyy = mysqli_query($conn, $sqlll);
                    $s = 0;
                    $cour = 0;
                    while ($rowww = mysqli_fetch_assoc($queryyy)) {
                        if ($rowww['type'] == "cour") {
                            $cour = $cour + 1;
                        }
                        $h = $rowww['d_heure'] * 60;
                        $m = $rowww['d_min'];
                        $t = $h + $m;
                        $s = $s + $t;
                    }
                    $m1 = $s % 60;
                    $h1 = ($s - $m1) / 60; //$h1 c'est juste heure sans minute 
                    if ($h1 < 9) {
                        if ($cour < 3) {
                ?>
                            <tr>
                                <td><?php echo $row['Email_enseignant']; ?></td>
                                <td><?php echo $row['Nom_enseignant']; ?></td>
                                <td><?php echo $row['Prenom_enseignant']; ?></td>
                                <td><?php echo $row['Nom_departement']; ?></td>
                                <td><a href="directeur_enseignant_profil.php?id=<?php echo $row['id_enseignant']; ?>" class="btn btn-info">Consulter</a></td>
                            </tr>
                <?php
                        }
                    }
                }
                ?>
            </tbody>

        </table>
        <br><br><br><br><br><br><br><br>
        <?php include "footer/footer.php"; ?>

    </body>

    </html>
<?php
}
?>