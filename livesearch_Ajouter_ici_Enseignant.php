<?php
include('conn.php');

if (isset($_POST['input'])) {
    $input = mysqli_real_escape_string($conn, $_POST['input']);
    $query = "SELECT * FROM enseignant,departement,domaine,faculte WHERE  enseignant.verifie='1' and enseignant.statut='1' and departement.id_departement = enseignant.id_departement and domaine.id_domaine = departement.id_domaine and faculte.id_faculte = domaine.id_faculte and ( enseignant.Nom_enseignant LIKE '{$input}%' or enseignant.Prenom_enseignant LIKE '{$input}%') ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) { ?>
        <table class="table">
            <thread>
                <tr>
                    <th>Nom_enseignant</th>
                    <th>Prenom_enseignant</th>
                    <th>Email_enseignant</th>
                    <th>departement</th>
                    <th>domaine</th>
                    <th>faculte</th>
                    <th>Action</th>
                </tr>
            </thread>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $id_enseignant = $row['id_enseignant'];
                    $Email_enseignant = $row['Email_enseignant'];
                    $Nom_enseignant = $row['Nom_enseignant'];
                    $Prenom_enseignant = $row['Prenom_enseignant'];
                    $id_departement = $row['Nom_departement'];
                    $id_domaine = $row['Nom_domaine'];
                    $id_faculte = $row['Nom_faculte'];
                
                ?>
                <tr>
                    <td><?php echo $Nom_enseignant; ?></td>
                    <td><?php echo $Prenom_enseignant; ?></td>
                    <td><?php echo $Email_enseignant; ?></td>
                    <td><?php echo $id_departement; ?></td>
                    <td><?php echo $id_domaine; ?></td>
                    <td><?php echo $id_faculte; ?></td>
                    <td><a href="seance02_ajouter_tout.php?Ajouter_Enseignant=<?php echo $id_enseignant; ?>" class="btn btn-info">Choisir</a></td>
                </tr>
            </tbody>
            <?php
            }?>
        </table>
<?php
    } else {
        echo "<h6 class='text-danger text-center mt-3'>No data Found</h6>";
    }
}
?>