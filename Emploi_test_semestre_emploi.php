<?php
session_start();
if (isset($_GET['semestre']) && !empty($_GET['semestre'])) {
    include('conn.php');

    $semestre = $_GET['semestre'];
    $dep = $_SESSION['chef_departement'];

    $dep = $_SESSION['chef_departement'];
    $sql = "SELECT * FROM filiere WHERE id_departement='$dep'";
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
?>
        <option value="<?php echo $row['id_filiere']; ?>"><?php echo $row['Nom_filiere']; ?></option>
    <?php
    } ?>
    </select>
<?php
} else {
    echo '<h1>error</h1>';
}
?>