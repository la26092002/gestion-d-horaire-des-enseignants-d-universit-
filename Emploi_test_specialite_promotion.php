<?php

if(isset($_GET['specialitepromotion']) && !empty($_GET['specialitepromotion'])){
    include('conn.php');

    $id = mysqli_real_escape_string($conn, $_GET['specialitepromotion']);

    $query = "SELECT * FROM promotion WHERE id_specialite='$id'";
    $do = mysqli_query($conn,$query);
    $count = mysqli_num_rows($do);

    echo '<option value="">select</option>';
    if($count>0){
        while($row = mysqli_fetch_array($do)){
            echo '<option value="'.$row['id_promotion'].'">'.$row['Nom_promotion'].'</option>';
        }
    }else{
        echo '<option>Not  availble </option>';
    }

}else{
    echo '<h1>error</h1>';
}
