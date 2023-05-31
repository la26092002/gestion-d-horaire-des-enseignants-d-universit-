<?php
session_start();

include('conn.php');

if (!isset($_SESSION['id_enseignant_directeur'])) {
    echo "<div class='alert alert-danger'>" . "غير مسموح لك فتح هذه الصفحة" . "</div>";
    header('REFRESH:2;URL=connect.php');
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </head>

    <body>
        <!-- Nav bar -->
        <?php include "inc_dr/header.php"; ?>
        <!-- End Nav bar -->
        <?php
        $mail = $_POST['mail'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $motpass = $_POST['motpass'];
        $modifier = $_POST['modifier'];
        $tlphn = $_POST['tlphn'];
        

        $id_enseignant = $_SESSION['id_enseignant_directeur'];

        //Image  postImage
        $imageName = $_FILES['postImage']['name'];
        $imageTmp = $_FILES['postImage']['tmp_name'];
        //modifier-les infos
        if (isset($modifier)) {
            $postImage = rand(0, 1000) . "_" . $imageName;
            move_uploaded_file($imageTmp, "uploads\\" . $postImage);
            $query = "UPDATE enseignant SET Email_enseignant = '$mail', Nom_enseignant = '$nom',Prenom_enseignant = '$prenom',Motpass_enseignant = '$motpass',N_tlphn = '$tlphn', 	Image_E = '$postImage'  WHERE id_enseignant='$id_enseignant'";
            $UPDATE = mysqli_query($conn, $query);
            if (isset($UPDATE)) {
                echo "<div class='alert alert-success'>" . "تم بنجاح" . "</div>";
            } else {
                echo "<div class='alert alert-danger'>" . "عفوا حدث خطأ ما" . "</div>";
            }
        }

        ?>
        <div class="row">
            <section class="col-1"></section>
            <section class="col-6">
                <div class="p-3">
                    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <?
                        $sql = "SELECT * FROM enseignant WHERE id_enseignant='$id_enseignant' ";
                        $query = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($query)) { ?>
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" value="<?php echo $row['Nom_enseignant']; ?>" class="form-control w-50">
                            <label class="form-label">Prenom</label>
                            <input type="text" name="prenom" value="<?php echo $row['Prenom_enseignant']; ?>" class="form-control w-50">
                            <label class="form-label">Email</label>
                            <input type="mail" name="mail" value="<?php echo $row['Email_enseignant']; ?>" class="form-control w-50" required="required">
                            <label class="form-label">Motpass</label>
                            <input type="text" name="motpass" value="<?php echo $row['Motpass_enseignant']; ?>" class="form-control w-50">
                            <label class="form-label">N tlphn</label>
                            <input type="tel" name="tlphn" value="<?php echo $row['N_tlphn']; ?>" class="form-control w-50">

                            <div class="form-group">
                                <label for="image">Modifier votre photo</label>
                                <input type="file" id="image" name="postImage" class="form-control w-50">
                            </div>

                            <button name="modifier" class="btn btn-success mt-4">Modifier</button>
                        <? } ?>
                    </form>
                </div>
            </section>
            <section class="col-3">
                <?php
                if ($row['Image_E'] == NULL) { ?>
                    <img src="user.png" class="card-img-top" alt="...">
                <?php } else { ?>
                    <img src="uploads/<?php echo $row['Image_E']; ?>" class="card-img-top" alt="">
                <?php } ?>
            </section>
        </div>
        <?php include "footer/footer.php"; ?>
    </body>

    </html>
<?php
}
?>