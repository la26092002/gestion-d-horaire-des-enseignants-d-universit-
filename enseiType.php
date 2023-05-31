<?php
session_start();
if (isset($_GET['enseiType']) && !empty($_GET['enseiType'])) {
    include('conn.php');
    if ($_GET['enseiType'] == '1') {
        echo '<label class="form-label">Enseignant</label>
        
        <select name="enseignant" id="enseignant" class="form-select" required>';

        $id_depa =  $_SESSION['chef_departement'];
        $query = "SELECT * FROM enseignant WHERE id_departement='$id_depa' and verifie='1' and statut='1'";
        $do = mysqli_query($conn, $query);
        $count = mysqli_num_rows($do);
        echo '<option value="">' . "selectionner l'enseignant" . '</option>';
        if ($count > 0) {
            while ($row = mysqli_fetch_array($do)) {
                echo '<option value="' . $row['id_enseignant'] . '">' . $row['Nom_enseignant'] . " " . $row['Prenom_enseignant'] . '</option>';
            }
        }
        echo '</select>';
    } elseif ($_GET['enseiType'] == '2') {
        echo '<label class="form-label">(Enseignant:';
        $A = $_GET['Ajouter_Enseignant'];
        if ($A) {
            $s = "SELECT Nom_enseignant,Prenom_enseignant FROM enseignant WHERE id_enseignant='$A'";
            $q = mysqli_query($conn, $s);
            $row = mysqli_fetch_assoc($q);
            echo $row['Nom_enseignant'];
            echo " ";
            echo $row['Prenom_enseignant'];
        } else {
            echo "NO";
        }
        $id = $_SESSION['id_module'];
        $f = $_SESSION['f_filiere'];
        $promotion = $_SESSION['promotion_seance'];
        echo ')</label><br>
        <a href="Ajouter_ici_Enseignant.php?id=' . $id . '&f=' . $f . '&promotion=' . $promotion . '" class="btn btn-primary">Ajouter ici Enseignant</a>';
    }
}
