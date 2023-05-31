<?php
include('conn.php');

if (isset($_POST['input'])) {
    $input = $_POST['input'];
    $query = "SELECT * FROM enseignant,departement WHERE departement.id_departement=enseignant.id_departement AND (enseignant.Nom_enseignant LIKE '{$input}%'  or enseignant.Prenom_enseignant LIKE '{$input}%' )";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) { ?>
        <table class="table">
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
                while ($row = mysqli_fetch_assoc($result)) {
                    $id_enseignant = $row['id_enseignant'];
                    $Email_enseignant = $row['Email_enseignant'];
                    $Nom_enseignant = $row['Nom_enseignant'];
                    $Prenom_enseignant = $row['Prenom_enseignant'];
                    $departement = $row['Nom_departement'];

                ?>
                    <tr>
                        <td><?php echo $Email_enseignant; ?></td>
                        <td><?php echo $Nom_enseignant; ?></td>
                        <td><?php echo $Prenom_enseignant; ?></td>
                        <td><?php echo $departement; ?></td>
                        <td><a href="directeur_enseignant_profil.php?id=<?php echo $id_enseignant; ?>" class="btn btn-info">Consulter</a></td>
                    </tr>
            </tbody>
        <?php
                } ?>
        </table>
        <?php
    } else {
        echo "<h6 class='text-danger text-center mt-3'>No data Found</h6>";
    }
}
?>