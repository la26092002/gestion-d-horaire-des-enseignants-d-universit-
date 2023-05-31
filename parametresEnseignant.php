<?php
session_start();

include('conn.php');

if ((!isset($_SESSION['id_enseignant']))) {
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
        <link rel="stylesheet" href="css/all.min.FA.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </head>

    <body>
        <!-- Nav bar -->
        <?php include "inc_En/header.php"; ?>
        <!-- End Nav bar -->
        <?php
        $mail = mysqli_real_escape_string($conn, $_POST['mail']);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               //BENYAKHOU ELHADJ LARBI MONSIEUR SALEM MOHAMMED
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
        $motpass = mysqli_real_escape_string($conn, $_POST['motpass']);
        $modifier = $_POST['modifier'];

        $id_enseignant = $_SESSION['id_enseignant'];

        //Image  postImage
        $imageName = $_FILES['postImage']['name'];
        $imageTmp = $_FILES['postImage']['tmp_name'];
        //modifier-les infos
        if (isset($modifier)) {
            $postImage = rand(0, 1000) . "_" . $imageName;
            move_uploaded_file($imageTmp, "uploads\\" . $postImage);

            $query = "UPDATE enseignant SET Email_enseignant = '$mail', Nom_enseignant = '$nom',Prenom_enseignant = '$prenom',Motpass_enseignant = '$motpass', 	Image_E = '$postImage'  WHERE id_enseignant='$id_enseignant'";
            $UPDATE = mysqli_query($conn, $query);
            if (isset($UPDATE)) {
                echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
            } else {
                echo "<div class='alert alert-danger'>" . "votre informations sont incorrectes" . "</div>";
            }
        }

        ?>
        <div class="row">
            <section class="col-1"></section>
            <section class="col-6">
                <div class="p-3">
                    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <?php
                        $sql = "SELECT * FROM enseignant WHERE id_enseignant='$id_enseignant' ";
                        $query = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($query)) { ?>
                            <label class="form-label">Email</label>
                            <input type="mail" name="mail" placeholder="<?php echo $row['Email_enseignant']; ?>" class="form-control w-50" required="required">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" placeholder="<?php echo $row['Nom_enseignant']; ?>" class="form-control w-50">
                            <label class="form-label">Prenom</label>
                            <input type="text" name="prenom" placeholder="<?php echo $row['Prenom_enseignant']; ?>" class="form-control w-50">
                            <label class="form-label">Motpass</label>
                            <input type="text" name="motpass" placeholder="<?php echo $row['Motpass_enseignant']; ?>" class="form-control w-50">

                            <div class="form-group">
                                <label for="image">Modifier votre photo</label>
                                <input type="file" id="image" name="postImage" class="form-control w-50">
                            </div>

                            <button name="modifier" class="btn btn-success mt-4">Modifier</button>
                        <?php } ?>
                    </form>
                </div>
            </section>
            <section class="col-3">
                <?php
                $im = $row['Image_E'];
                if ($im == NULL) { ?>
                    <img src="user.png" class="card-img-top" alt="...">
                <?php } else { ?>
                    <img src="uploads/<?php echo $im; ?>" class="card-img-top" alt="">
                <?php } ?>
            </section>
        </div>


        < </body>
            <?php include "footer/footer.php"; ?>

    </html>
<?php
}
?>