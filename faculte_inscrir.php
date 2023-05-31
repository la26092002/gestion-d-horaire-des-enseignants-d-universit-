<?php
if(isset($_GET['faculte']) && !empty($_GET['faculte'])){
    include('conn.php');

    $id = $_GET['faculte'];

    $query = "SELECT * FROM domaine WHERE id_faculte='$id'";
    $do = mysqli_query($conn,$query);
    $count = mysqli_num_rows($do);

    echo '<option disabled="disabled" selected="selected">Selectionner le domaine</option>';
    if($count>0){
        while($row = mysqli_fetch_array($do)){
            echo '<option value="'.$row['id_domaine'].'">'.$row['Nom_domaine'].'</option>';
        }
    }else{
        echo '<option>Not  availble </option>';
    }

}else{
    echo '<h1>error</h1>';
}
?>