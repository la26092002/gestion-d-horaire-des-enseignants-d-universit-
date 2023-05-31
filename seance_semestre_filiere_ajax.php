<?php
session_start();
include('conn.php');
if (isset($_GET['semestre']) && !empty($_GET['semestre'])) {

    $id = mysqli_real_escape_string($conn, $_GET['semestre']);

    $id_departement = $_SESSION['chef_departement'];
    $query = "SELECT * FROM filiere WHERE id_departement='$id_departement'";
    $res = mysqli_query($conn, $query);
    $count = mysqli_num_rows($res);


    if ($count > 0) {
        ?><option value=""></option><?php
        while ($row = mysqli_fetch_assoc($res)) {
            ?>
                <option value="<?php echo ($row['id_filiere']); ?>"><?php echo ($row['Nom_filiere']) ?></option>
            <?php
            }
            
        
    } else {
        echo '<option>Not  availble </option>';
    }
} else {
    echo '<h1>error</h1>';
}
