
<?php

if (isset($_GET['typeName']) && !empty($_GET['typeName'])) {
    include('conn.php');

    $typeName = mysqli_real_escape_string($conn, $_GET['typeName']);

    if ($typeName == 'td' or $typeName == 'tp') {

        echo '<label class="form-label" for="numeroGroupe">Numero Groupe</label>
        <input type="number" name="numeroGroupe" class="form-control" name="numeroGroupe" id="numeroGroupe"required>
        ';
    }
} else {
    echo '<h1>error</h1>';
}
?>