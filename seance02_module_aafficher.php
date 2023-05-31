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
                    <div class="col-12 col-sm-12 col-md-9 col-lg-9  ">
                        <div class="card">
                            <div class="card-body shadow bg-light text-dark">
                                <?php
                                $id_seance = mysqli_real_escape_string($conn, $_GET['idseance']);
                                //delete-module
                                if (!empty($id_seance)) {
                                    $query = "DELETE FROM seance WHERE id_seance='$id_seance'";
                                    $delete = mysqli_query($conn, $query);
                                    if (isset($delete)) {
                                        echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
                                    } else {
                                        echo "<div class='alert alert-danger'>" . "votre informations sont incorrectes" . "</div>";
                                    }
                                } ?>


                                <?php
                                $idd = mysqli_real_escape_string($conn, $_GET['id']);
                                $sql = "SELECT * FROM module WHERE module.id_module='$idd'";
                                $qq = mysqli_query($conn, $sql);
                                $r = mysqli_fetch_assoc($qq);
                                ?>
                                <p class="h4">Module:</p>
                                <p><?php echo $r['Nom_module'] ?></p>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>enseignant</th>
                                            <th>type</th>
                                            <th>salle</th>
                                            <th>heure</th>
                                            <th>jour</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <?php
                                    $id = mysqli_real_escape_string($conn, $_GET['id']);
                                    //,enseignant,module,heure
                                    //seance.Id_enseignant=enseignant.id_enseignant AND seance.id_module=module.id_module AND seance.id_salle=salle.id_salle AND seance.id_heure=heure.id_heure AND
                                    $select = "SELECT * FROM seance,enseignant,salle,heure WHERE seance.id_heure=heure.id_heure AND salle.id_salle=seance.id_salle AND seance.Id_enseignant=enseignant.id_enseignant AND  seance.id_module='$id'";
                                    $query = mysqli_query($conn, $select);
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <tr>
                                            <th><?php echo $row['Nom_enseignant'];
                                                echo ' ';
                                                echo $row['Prenom_enseignant']; ?></th>
                                            <th><?php echo $row['type'];
                                                if ($row['type'] == 'tp' || $row['type'] == 'td') {
                                                    echo ' G:';
                                                    echo $row['Numero_groupe'];
                                                } ?> </th>
                                            <th><?php echo $row['Nom_salle'];
                                                echo 'N°';
                                                echo $row['Num_salle']; ?></th>
                                            <th><?php echo $row['heure']; ?></th>
                                            <th><?php echo $row['jour']; ?></th>
                                            <?php
                                            echo '<th><a href="seance02_module_aafficher.php?idseance=' . $row['id_seance'] . '&id=' . $id . '"><i style="" class="fas fa-user-times link-success"></i></a>
                                            </th>'; ?>
                                        </tr>
                                    <?php
                                    }

                                    ?>

                                </table>
                            </div>
                        </div>
                    </div>
        </section>
        <br><br><br><br>
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