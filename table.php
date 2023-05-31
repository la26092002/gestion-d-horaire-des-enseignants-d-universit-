<table class="table">
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
        echo $count;
        $n = 1;
        while (mysqli_fetch_assoc($query) and $n <= $count) {
        ?>

            <tr>
                <?php
                $h = "SELECT * FROM heure WHERE id_filiere='$id_filiere' AND ordre='$n'";
                $q = mysqli_query($conn, $h);
                $h = mysqli_fetch_assoc($q);
                ?>
                <th><?php echo $h['heure'] ?></th>




                <?php
                $h2 = "SELECT * FROM seance,heure,module,enseignant,salle WHERE enseignant.id_enseignant=seance.id_enseignant AND module.id_module=seance.id_module AND seance.id_promotion='$id_promotion' AND heure.ordre='$n' And heure.id_heure=seance.id_heure AND seance.jour='dimanche' And salle.id_salle=seance.id_salle";
                $q2 = mysqli_query($conn, $h2);
                ?>
                <th class="">
                    <?php while ($h2 = mysqli_fetch_assoc($q2)) {
                    ?>
                        <div>
                            <?php
                            if ($h2['type'] == 'cour') {
                            ?>
                                <p><?php echo "*";
                                    echo $h2['type'];
                                    echo " :";
                                    echo $h2['Nom_module'];
                                    echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                    echo " ";
                                                    echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?></p>
                            <?php } else { ?>
                                <p><?php echo "*";
                                    echo $h2['type'];
                                    echo " :";
                                    echo $h2['Nom_module'];
                                    echo "  G:";
                                    echo $h2['Numero_groupe'];

                                    echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                    echo " ";
                                                    echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?></p>
                            <?php }
                            ?>
                        </div><?php } ?>
                </th>




                <?php
                $h2 = "SELECT * FROM seance,heure,module,enseignant,salle WHERE enseignant.id_enseignant=seance.id_enseignant AND module.id_module=seance.id_module AND seance.id_promotion='$id_promotion' AND heure.ordre='$n' And heure.id_heure=seance.id_heure AND seance.jour='Lundi' And salle.id_salle=seance.id_salle";
                $q2 = mysqli_query($conn, $h2);
                ?>
                <th class="">
                    <?php while ($h2 = mysqli_fetch_assoc($q2)) {
                    ?>
                        <div>
                            <?php
                            if ($h2['type'] == 'cour') {
                            ?>
                                <p><?php echo "*";
                                    echo $h2['type'];
                                    echo " :";
                                    echo $h2['Nom_module'];
                                    echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                    echo " ";
                                                    echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?></p>
                            <?php } else { ?>
                                <p><?php echo "*";
                                    echo $h2['type'];
                                    echo " :";
                                    echo $h2['Nom_module'];
                                    echo "  G:";
                                    echo $h2['Numero_groupe'];

                                    echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                    echo " ";
                                                    echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?></p>
                            <?php }
                            ?>
                        </div><?php } ?>
                </th>





                <?php
                $h2 = "SELECT * FROM seance,heure,module,enseignant,salle WHERE enseignant.id_enseignant=seance.id_enseignant AND module.id_module=seance.id_module AND seance.id_promotion='$id_promotion' AND heure.ordre='$n' And heure.id_heure=seance.id_heure AND seance.jour='mardi' And salle.id_salle=seance.id_salle";
                $q2 = mysqli_query($conn, $h2);
                ?>
                <th class="">
                    <?php while ($h2 = mysqli_fetch_assoc($q2)) {
                    ?>
                        <div>
                            <?php
                            if ($h2['type'] == 'cour') {
                            ?>
                                <p><?php echo "*";
                                    echo $h2['type'];
                                    echo " :";
                                    echo $h2['Nom_module'];
                                    echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                    echo " ";
                                                    echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?></p>
                            <?php } else { ?>
                                <p><?php echo "*";
                                    echo $h2['type'];
                                    echo " :";
                                    echo $h2['Nom_module'];
                                    echo "  G:";
                                    echo $h2['Numero_groupe'];

                                    echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                    echo " ";
                                                    echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?></p>
                            <?php }
                            ?>
                        </div><?php } ?>
                </th>






                <?php
                $h2 = "SELECT * FROM seance,heure,module,enseignant,salle WHERE enseignant.id_enseignant=seance.id_enseignant AND module.id_module=seance.id_module AND seance.id_promotion='$id_promotion' AND heure.ordre='$n' And heure.id_heure=seance.id_heure AND seance.jour='mercredi' And salle.id_salle=seance.id_salle";
                $q2 = mysqli_query($conn, $h2);
                ?>
                <th class="">
                    <?php while ($h2 = mysqli_fetch_assoc($q2)) {
                    ?>
                        <div>
                            <?php
                            if ($h2['type'] == 'cour') {
                            ?>
                                <p><?php echo "*";
                                    echo $h2['type'];
                                    echo " :";
                                    echo $h2['Nom_module'];
                                    echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                    echo " ";
                                                    echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?></p>
                            <?php } else { ?>
                                <p><?php echo "*";
                                    echo $h2['type'];
                                    echo " :";
                                    echo $h2['Nom_module'];
                                    echo "  G:";
                                    echo $h2['Numero_groupe'];

                                    echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                    echo " ";
                                                    echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?></p>
                            <?php }
                            ?>
                        </div><?php } ?>
                </th>






                <?php
                $h2 = "SELECT * FROM seance,heure,module,enseignant,salle WHERE enseignant.id_enseignant=seance.id_enseignant AND module.id_module=seance.id_module AND seance.id_promotion='$id_promotion' AND heure.ordre='$n' And heure.id_heure=seance.id_heure AND seance.jour='jeudi' And salle.id_salle=seance.id_salle";
                $q2 = mysqli_query($conn, $h2);
                ?>
                <th class="">
                    <?php while ($h2 = mysqli_fetch_assoc($q2)) {
                    ?>
                        <div>
                            <?php
                            if ($h2['type'] == 'cour') {
                            ?>
                                <p><?php echo "*";
                                    echo $h2['type'];
                                    echo " :";
                                    echo $h2['Nom_module'];
                                    echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                    echo " ";
                                                    echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?></p>
                            <?php } else { ?>
                                <p><?php echo "*";
                                    echo $h2['type'];
                                    echo " :";
                                    echo $h2['Nom_module'];
                                    echo "  G:";
                                    echo $h2['Numero_groupe'];

                                    echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                    echo " ";
                                                    echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?></p>
                            <?php }
                            ?>
                        </div><?php } ?>
                </th>






                <?php
                $h2 = "SELECT * FROM seance,heure,module,enseignant,salle WHERE enseignant.id_enseignant=seance.id_enseignant AND module.id_module=seance.id_module AND seance.id_promotion='$id_promotion' AND heure.ordre='$n' And heure.id_heure=seance.id_heure AND seance.jour='samedi' And salle.id_salle=seance.id_salle";
                $q2 = mysqli_query($conn, $h2);
                ?>
                <th class="">
                    <?php while ($h2 = mysqli_fetch_assoc($q2)) {
                    ?>
                        <div>
                            <?php
                            if ($h2['type'] == 'cour') {
                            ?>
                                <p><?php echo "*";
                                    echo $h2['type'];
                                    echo " :";
                                    echo $h2['Nom_module'];
                                    echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                    echo " ";
                                                    echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?></p>
                            <?php } else { ?>
                                <p><?php echo "*";
                                    echo $h2['type'];
                                    echo " :";
                                    echo $h2['Nom_module'];
                                    echo "  G:";
                                    echo $h2['Numero_groupe'];

                                    echo " "; ?> Mr:<?php echo $h2['Nom_enseignant'];
                                                    echo " ";
                                                    echo $h2['Prenom_enseignant']; ?> S:<?php echo $h2['Nom_salle']; ?></p>
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