<?php


if(isset($_GET['filieresalle']) && !empty($_GET['filieresalle'])){
    include('conn.php');

    $id = mysqli_real_escape_string($conn, $_GET['filieresalle']);
    //$query = "SELECT * FROM salle WHERE id_filiere='$id' AND id_salle NOT IN (SELECT id_salle FROM seance WHERE jour='$jour' AND id_heure='$heure')";
    
    $query = "SELECT * FROM salle WHERE id_filiere='$id'";
    $do = mysqli_query($conn,$query);
    $count = mysqli_num_rows($do);

    echo '<option value="">'."selectionner la salle".'</option>';
    if($count>0){
        while($row = mysqli_fetch_array($do)){
            echo '<option value="'.$row['id_salle'].'">'.$row['Nom_salle'].' , N:'.$row['Num_salle'] .'</option>';
        }
    }else{
        echo '<option>Not  availble </option>';
    }

}else{
    echo '<h1>error</h1>';
}
