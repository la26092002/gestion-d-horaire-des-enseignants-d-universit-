<?php

if(isset($_GET['promotion']) && !empty($_GET['promotion']) && isset($_GET['semestre']) && !empty($_GET['semestre'])){
    
    include('conn.php');

    $semestre = $_GET['semestre'];
    $id = $_GET['promotion'];

    $query = "SELECT * FROM module WHERE id_promotion='$id' AND semestre ='$semestre'";
    $do = mysqli_query($conn,$query);
    $count = mysqli_num_rows($do);

    echo '<option value="">'."selectionner le module".'</option>';
    if($count>0){
        while($row = mysqli_fetch_array($do)){
            echo '<option value="'.$row['id_module'].'">'.$row['Nom_module'].'</option>';
        }
    }else{
        echo '<option>Not  availble </option>';
    }

}else{
    echo '<h1>error</h1>';
}
?>