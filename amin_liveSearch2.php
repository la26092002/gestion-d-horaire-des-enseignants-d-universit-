<?php
include('conn.php');

if (isset($_POST['input'])) {
    $input = $_POST['input'];
    $query = "SELECT * FROM enseignant,departement WHERE departement.id_departement=enseignant.id_departement AND enseignant.Nom_enseignant LIKE '{$input}%' or enseignant.Prenom_enseignant LIKE '{$input}%'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) { ?>
        <table class="table">
            <thread>
                <tr>
                    <th>Email_enseignant</th>
                    <th>Nom_enseignant</th>
                    <th>Prenom_enseignant</th>
                    <th>departement</th>
                    <th>Consulter</th>
                </tr>
            </thread>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $Email_enseignant = $row['Email_enseignant'];
                    $Nom_enseignant = $row['Nom_enseignant'];
                    $Prenom_enseignant = $row['Prenom_enseignant'];
                    $chef_departement = $row['chef_departement'];
                    $departement = $row['Nom_departement'];
                
                ?>
                <tr>
                    <td><?php echo $Email_enseignant; ?></td>
                    <td><?php echo $Nom_enseignant; ?></td>
                    <td><?php echo $Prenom_enseignant; ?></td>
                    <td><?php echo $departement; ?></td>
                    <td><a href="admin_select_enseignant2.php?id=<?php echo $row['id_enseignant']; ?>" class="btn btn-info">Choisir</a></td>
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