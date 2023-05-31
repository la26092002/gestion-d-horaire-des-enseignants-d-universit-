
<?php

if (isset($_GET['filiere']) && !empty($_GET['filiere'])) {
    include('conn.php');

    $id = mysqli_real_escape_string($conn, $_GET['filiere']);

    $query = "SELECT * FROM salle WHERE id_filiere='$id'";
    $do = mysqli_query($conn, $query);
    $count = mysqli_num_rows($do);


    if ($count > 0) {
        echo '<table class="table table-hover mt-4">
            
        <tr>
        <th>N:</th>
        <th>Nom salle</th>
        <th>Num salle</th>
        <th>Action</th>
    </tr>';
        $num = 1;


        while ($row = mysqli_fetch_array($do)) {
            //echo '<option value="'.$row['id_specialite'].'">'.$row['Nom_specialite'].'</option>';
            echo '<tr>
            <th>' . $num++ . '</th>
            <th>' . $row['Nom_salle'] . '</th>
            <th>' . $row['Num_salle'] . '</th>
            <th><a href="salle.php?id=' . $row['id_salle'] . '"><i style="" class="fas fa-user-times link-success"></i></a>
            <a href="salleUpdate.php?id=' . $row['id_salle'] . '"><i class="fas fa-edit link-success"></i></a></th>
            </tr>';
        }
    } else {
        echo '<option>Not  availble </option>';
    }
} else {
    echo '<h1>error</h1>';
}
