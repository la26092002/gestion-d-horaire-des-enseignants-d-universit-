<?php

if(isset($_GET['filiere']) && !empty($_GET['filiere'])){
    include('conn.php');

    $id = $_GET['filiere'];

    $query = "SELECT * FROM specialite WHERE id_filiere='$id'";
    $do = mysqli_query($conn,$query);
    $count = mysqli_num_rows($do);

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