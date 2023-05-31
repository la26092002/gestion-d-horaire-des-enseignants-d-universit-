<?php
if(isset($_GET['departement']) && !empty($_GET['departement'])){
    include('conn.php');

    $id = $_GET['departement'];

    $query = "SELECT * FROM filiere WHERE id_departement='$id'";
    $do = mysqli_query($conn,$query);
    $count = mysqli_num_rows($do);

    echo '<option disabled="disabled" selected="selected">Selectionner la La fili&eacute;re </option>';
    if($count>0){
        while($row = mysqli_fetch_array($do)){
            echo '<option value="'.$row['id_filiere'].'">'.$row['Nom_filiere'].'</option>';
        }
    }else{
        echo '<option>Not  availble </option>';
    }

}else{
    echo '<h1>error</h1>';
}
?>