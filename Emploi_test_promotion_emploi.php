<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <style>

    </style>
</head>
<?php

if (isset($_GET['promotionEmploi']) && !empty($_GET['promotionEmploi']) && isset($_GET['semestre']) && !empty($_GET['semestre'])) {
    include('conn.php');

    $semestre = mysqli_real_escape_string($conn, $_GET['semestre']);
    $id = mysqli_real_escape_string($conn, $_GET['promotionEmploi']);
    $sql = "SELECT * FROM promotion,specialite WHERE specialite.id_specialite=promotion.id_specialite AND promotion.id_promotion='$id'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    $id_filiere = $row['id_filiere'];
    $id_promotion = mysqli_real_escape_string($conn, $_GET['promotionEmploi']);

    $sqlll = "SELECT * FROM seance,module WHERE module.id_module=seance.id_module AND module.semestre='$semestre' AND seance.id_promotion='$id_promotion'";
    $qu = mysqli_query($conn, $sqlll);
    $countt = mysqli_num_rows($qu);

    if ($countt != 0) {

        $s = "SELECT * FROM promotion WHERE id_promotion='$id_promotion'";
        $q = mysqli_query($conn, $s);
        $result = mysqli_fetch_assoc($q);
        $sql = "SELECT * FROM specialite WHERE id_filiere='$id_filiere'";
        $qq = mysqli_query($conn, $sql);
        $resultt = mysqli_fetch_assoc($qq);

?>
        <center> <button class="btn btn-success" id="doPrint">imprimer</button></center>
        <script type="text/javascript">
            document.getElementById("doPrint").addEventListener("click", function() {
                var printContents = document.getElementById('printDiv').innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            });
        </script>
        <div id="printDiv">
            <center>
                <p style="color: green;font-family: 'Open Sans', sans-serif;">l'emplois du temps de <?php echo $result['Nom_promotion'];
                                                                                                    echo " ";
                                                                                                    echo $resultt['Nom_specialite'];  ?></p>
            </center>

            <table class="table table-bordered " style="border: black; border-style: outset; font-family: 'Times New Roman';font-size: 10px;">
                <tr>
                    <th>Heure</th>
                    <th>dimanche</th>
                    <th>Lundi</th>
                    <th>mardi</th>
                    <th>mercredi</th>
                    <th>jeudi</th>
                    <th>samedi</th>
                </tr>
                <?php
                $sql = "SELECT * FROM heure WHERE id_filiere='$id_filiere'";
                $query = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($query);
                $n = 1;
                while ($n <= $count) {
                ?>

                    <tr>
                        <?php
                        $h = "SELECT * FROM heure WHERE id_filiere='$id_filiere' AND ordre='$n'";
                        $q = mysqli_query($conn, $h);
                        $h = mysqli_fetch_assoc($q);
                        ?>
                        <th><?php echo $h['heure'] ?></th>




                        <?php
                        //////////////////////////////////////////////$semestre
                        $h2 = "SELECT * FROM seance,heure,module,enseignant,salle WHERE module.semestre='$semestre' AND enseignant.id_enseignant=seance.id_enseignant AND module.id_module=seance.id_module AND seance.id_promotion='$id_promotion' AND heure.ordre='$n' And heure.id_heure=seance.id_heure AND seance.jour='dimanche' And salle.id_salle=seance.id_salle";
                        $q2 = mysqli_query($conn, $h2);
                        ?>
                        <th class="">
                            <?php while ($h2 = mysqli_fetch_assoc($q2)) {
                            ?>
                                <div>
                                    <?php
                                    if ($h2['type'] == 'cour') {
                                    ?>
                                        <p class="" style=""><?php
                                                                echo $h2['type'];
                                                                echo "s :";
                                                                echo $h2['Nom_module'];
                                                                echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                                                echo " ";
                                                                                echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?>,<?php echo $h2['Num_salle']; ?> </p>
                                    <?php } else { ?>
                                        <p style=""><?php
                                                    echo $h2['type'];
                                                    echo " :";
                                                    echo $h2['Nom_module'];
                                                    echo "  G:";
                                                    echo $h2['Numero_groupe'];

                                                    echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                                    echo " ";
                                                                    echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?>,<?php echo $h2['Num_salle']; ?> </p>
                                    <?php }
                                    ?>
                                </div><?php } ?>
                        </th>




                        <?php
                        ////////////////////////////////////////////////////////////////////////////////////////////
                        $h2 = "SELECT * FROM seance,heure,module,enseignant,salle WHERE module.semestre='$semestre' AND enseignant.id_enseignant=seance.id_enseignant AND module.id_module=seance.id_module AND seance.id_promotion='$id_promotion' AND heure.ordre='$n' And heure.id_heure=seance.id_heure AND seance.jour='Lundi' And salle.id_salle=seance.id_salle";
                        $q2 = mysqli_query($conn, $h2);
                        ?>
                        <th class="">
                            <?php while ($h2 = mysqli_fetch_assoc($q2)) {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      //BENYAKHOU ELHADJ LARBI MONSIEUR SALEM MOHAMMED
                            ?>
                                <div>
                                    <?php
                                    if ($h2['type'] == 'cour') {
                                    ?>
                                        <p><?php
                                            echo $h2['type'];
                                            echo "s :";
                                            echo $h2['Nom_module'];
                                            echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                            echo " ";
                                                            echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?>,<?php echo $h2['Num_salle']; ?> </p>
                                    <?php } else { ?>
                                        <p><?php
                                            echo $h2['type'];
                                            echo " :";
                                            echo $h2['Nom_module'];
                                            echo "  G:";
                                            echo $h2['Numero_groupe'];

                                            echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                            echo " ";
                                                            echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?>,<?php echo $h2['Num_salle']; ?> </p>
                                    <?php }
                                    ?>
                                </div><?php } ?>
                        </th>





                        <?php
                        ///////////////////////////////////////////////////////////////////////////
                        $h2 = "SELECT * FROM seance,heure,module,enseignant,salle WHERE module.semestre='$semestre' AND enseignant.id_enseignant=seance.id_enseignant AND module.id_module=seance.id_module AND seance.id_promotion='$id_promotion' AND heure.ordre='$n' And heure.id_heure=seance.id_heure AND seance.jour='mardi' And salle.id_salle=seance.id_salle";
                        $q2 = mysqli_query($conn, $h2);
                        ?>
                        <th class="">
                            <?php while ($h2 = mysqli_fetch_assoc($q2)) {
                            ?>
                                <div>
                                    <?php
                                    if ($h2['type'] == 'cour') {
                                    ?>
                                        <p><?php
                                            echo $h2['type'];
                                            echo "s :";
                                            echo $h2['Nom_module'];
                                            echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                            echo " ";
                                                            echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?>,<?php echo $h2['Num_salle']; ?> </p>
                                    <?php } else { ?>
                                        <p><?php
                                            echo $h2['type'];
                                            echo " :";
                                            echo $h2['Nom_module'];
                                            echo "  G:";
                                            echo $h2['Numero_groupe'];

                                            echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                            echo " ";
                                                            echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?>,<?php echo $h2['Num_salle']; ?> </p>
                                    <?php }
                                    ?>
                                </div><?php } ?>
                        </th>






                        <?php
                        /////////////////////////////////////////////////////////////////////////////////////
                        $h2 = "SELECT * FROM seance,heure,module,enseignant,salle WHERE module.semestre='$semestre' AND enseignant.id_enseignant=seance.id_enseignant AND module.id_module=seance.id_module AND seance.id_promotion='$id_promotion' AND heure.ordre='$n' And heure.id_heure=seance.id_heure AND seance.jour='mercredi' And salle.id_salle=seance.id_salle";                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      //BENYAKHOU ELHADJ LARBI MONSIEUR SALEM MOHAMMED
                        $q2 = mysqli_query($conn, $h2);
                        ?>
                        <th class="">
                            <?php while ($h2 = mysqli_fetch_assoc($q2)) {
                            ?>
                                <div>
                                    <?php
                                    if ($h2['type'] == 'cour') {
                                    ?>
                                        <p><?php
                                            echo $h2['type'];
                                            echo "s :";
                                            echo $h2['Nom_module'];
                                            echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                            echo " ";
                                                            echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?>,<?php echo $h2['Num_salle']; ?> </p>
                                    <?php } else { ?>
                                        <p><?php
                                            echo $h2['type'];
                                            echo " :";
                                            echo $h2['Nom_module'];
                                            echo "  G:";
                                            echo $h2['Numero_groupe'];

                                            echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                            echo " ";
                                                            echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?>,<?php echo $h2['Num_salle']; ?> </p>
                                    <?php }
                                    ?>
                                </div><?php } ?>
                        </th>






                        <?php
                        ////////////////////////////////////////////////////////////////////////////////////////////////
                        $h2 = "SELECT * FROM seance,heure,module,enseignant,salle WHERE module.semestre='$semestre' AND enseignant.id_enseignant=seance.id_enseignant AND module.id_module=seance.id_module AND seance.id_promotion='$id_promotion' AND heure.ordre='$n' And heure.id_heure=seance.id_heure AND seance.jour='jeudi' And salle.id_salle=seance.id_salle";
                        $q2 = mysqli_query($conn, $h2);
                        ?>
                        <th class="">
                            <?php while ($h2 = mysqli_fetch_assoc($q2)) {
                            ?>
                                <div>
                                    <?php
                                    if ($h2['type'] == 'cour') {
                                    ?>
                                        <p><?php
                                            echo $h2['type'];
                                            echo "s :";
                                            echo $h2['Nom_module'];
                                            echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                            echo " ";
                                                            echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?>,<?php echo $h2['Num_salle']; ?> </p>
                                    <?php } else { ?>
                                        <p><?php
                                            echo $h2['type'];
                                            echo " :";
                                            echo $h2['Nom_module'];
                                            echo "  G:";
                                            echo $h2['Numero_groupe'];

                                            echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                            echo " ";
                                                            echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?>,<?php echo $h2['Num_salle']; ?> </p>
                                    <?php }
                                    ?>
                                </div><?php } ?>
                        </th>






                        <?php
                        ////////////////////////////////////////////////////////////////////////////////////////
                        $h2 = "SELECT * FROM seance,heure,module,enseignant,salle WHERE module.semestre='$semestre' AND enseignant.id_enseignant=seance.id_enseignant AND module.id_module=seance.id_module AND seance.id_promotion='$id_promotion' AND heure.ordre='$n' And heure.id_heure=seance.id_heure AND seance.jour='samedi' And salle.id_salle=seance.id_salle";
                        $q2 = mysqli_query($conn, $h2);
                        ?>
                        <th class="">
                            <?php while ($h2 = mysqli_fetch_assoc($q2)) {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      //BENYAKHOU ELHADJ LARBI MONSIEUR SALEM MOHAMMED
                            ?>
                                <div>
                                    <?php
                                    if ($h2['type'] == 'cour') {
                                    ?>
                                        <p><?php
                                            echo $h2['type'];
                                            echo "s :";
                                            echo $h2['Nom_module'];
                                            echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                            echo " ";
                                                            echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?>,<?php echo $h2['Num_salle']; ?> </p>
                                    <?php } else { ?>
                                        <p><?php
                                            echo $h2['type'];
                                            echo " :";
                                            echo $h2['Nom_module'];
                                            echo "  G:";
                                            echo $h2['Numero_groupe'];

                                            echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                            echo " ";
                                                            echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?>,<?php echo $h2['Num_salle']; ?> </p>
                                    <?php }
                                    ?>
                                </div><?php } ?>
                        </th>







                    </tr>



                <?php
                    $n = $n + 1;
                }
                ?>


            </table>
        </div>

<?php
    } else {
        echo '<center><h1>vide</h1></center>';
    }
} else {
    echo '<h1>error</h1>';
}
?>