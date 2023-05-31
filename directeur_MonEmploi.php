<?php
session_start();

include('conn.php');
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
    <?php include"inc_dr/header.php"; ?>
        <!-- End Nav bar -->
    
    <section class=" p-5">
        <div class="card">
            <?php
            $id = $_SESSION['id_enseignant_directeur'];
            ?>
            <div class="card-body shadow">
                <h5>S1</h5>
                <table class="table table-striped mt-3 ">
                    <tr>
                        <th>Module</th>
                        <th>heure</th>
                        <th>type</th>
                        <th>salle</th>
                        <th>promotion</th>
                    </tr>
                    <?php
                    //afficher;
                    $query = "SELECT * FROM seance,module,salle,promotion,heure,specialite WHERE module.semestre='1' AND seance.id_module=module.id_module AND heure.id_heure=seance.id_heure AND seance.Id_enseignant='$id'AND salle.id_salle=seance.id_salle AND promotion.id_promotion=seance.id_promotion AND specialite.id_specialite=promotion.id_specialite";
                    //$query = "SELECT*FROM seance WHERE Id_enseignant='$id'";
                    $res = mysqli_query($conn, $query);
                    $no == 0;

                    while ($row = mysqli_fetch_assoc($res)) {
                        $no++;
                    ?>
                        <tr>
                            <th><?php echo $row['Nom_module']; ?></th>
                            <th><?php echo $row['heure']; ?></th>
                            <th><?php echo $row['type']; ?></th>
                            <th><?php echo $row['Nom_salle'];
                                echo ',N:';
                                echo $row['Num_salle']; ?></th>
                            <th><?php echo $row['Nom_promotion'];
                                echo " "; ?></th>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
                <h5>S2:</h5>
                <table class="table table-striped mt-3 ">
                    <tr>
                        <th>Module</th>
                        <th>heure</th>
                        <th>type</th>
                        <th>salle</th>
                        <th>promotion</th>
                    </tr>
                    <?php
                    //afficher;
                    $query = "SELECT * FROM seance,module,salle,promotion,heure,specialite WHERE module.semestre='2' AND seance.id_module=module.id_module AND heure.id_heure=seance.id_heure AND seance.Id_enseignant='$id'AND salle.id_salle=seance.id_salle AND promotion.id_promotion=seance.id_promotion AND specialite.id_specialite=promotion.id_specialite";
                    //$query = "SELECT*FROM seance WHERE Id_enseignant='$id'";
                    $res = mysqli_query($conn, $query);
                    $no == 0;
                    while ($row = mysqli_fetch_assoc($res)) {
                        $no++;
                    ?>
                        <tr>
                            <th><?php echo $row['Nom_module']; ?></th>
                            <th><?php echo $row['heure']; ?></th>
                            <th><?php echo $row['type']; ?></th>
                            <th><?php echo $row['Nom_salle'];
                                echo ',N:';
                                echo $row['Num_salle']; ?></th>
                            <th><?php echo $row['Nom_promotion'];
                                echo " "; ?></th>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </section>
    <?php include "footer/footer.php"; ?>

</body>

</html>