<?php
if(isset($_GET['domaine']) && !empty($_GET['domaine'])){
    include('conn.php');

    $id = $_GET['domaine'];

    $query = "SELECT * FROM departement WHERE id_domaine='$id'";
    $do = mysqli_query($conn,$query);
    $count = mysqli_num_rows($do);

    echo '<option disabled="disabled" selected="selected">Selectionner le d&eacute;partement</option>';
    if($count>0){
        while($row = mysqli_fetch_array($do)){
            echo '<option value="'.$row['id_departement'].'">'.$row['Nom_departement'].'</option>';
        }
    }else{
        echo '<option>Not  availble </option>';
    }

}else{
    echo '<h1>error</h1>';
}
?>