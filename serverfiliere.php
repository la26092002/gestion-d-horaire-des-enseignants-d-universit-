<?php
//DataBase connection
require_once"conn.php";
$add_task = $_GET['task'];
    //Select logic
    $queryy="SELECT * FROM filiere WHERE Nom_filiere='informatique'";
    $res = mysqli_query($conn,$queryy);
    $count = mysqli_num_rows($res);
    if($count>0){
        if(isset($res)){
            while($row = mysqli_fetch_assoc($res)){
                ?>
                <div class="task"> 
                    <p><?php echo $row['Nom_specialite']; ?></p><br>
                </div>
                <?php
            }
        }
    }
?>