<?php

if(isset($_GET['filierespecialite']) && !empty($_GET['filierespecialite'])){
    include('conn.php');

    $id = mysqli_real_escape_string($conn, $_GET['filierespecialite']);

    $query = "SELECT * FROM specialite WHERE id_filiere='$id'";
    $do = mysqli_query($conn,$query);
    $count = mysqli_num_rows($do);

    echo '<option value="">  select  </option>';
    if($count>0){
        while($row = mysqli_fetch_array($do)){
            echo '<option value="'.$row['id_specialite'].'">'.$row['Nom_specialite'].'</option>';
        }
    }else{
        echo '<option>Not  availble </option>';
    }

}else{
    echo '<h1>error</h1>';
}
?>