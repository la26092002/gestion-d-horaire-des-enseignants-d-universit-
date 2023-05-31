<?php
session_start();

include('conn.php');

if (!isset($_SESSION['id_admin'])) {
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
    <?php
    include "admin-header.php";
    ?>
    <!-- End Nav bar -->
        <?php
        $mail = $_POST['mail'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $motpass = $_POST['motpass'];
        
        $modifier = $_POST['modifier'];

        $id_Admin = $_SESSION['id_admin'];

        
        //modifier-les infos
        if (isset($modifier)) {
            $query = "UPDATE admin SET email_admin = '$mail', nom_admin = '$nom',prenom_admin = '$prenom',pass_admin = '$motpass' WHERE id_admin='$id_Admin'";
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
                        $sql = "SELECT * FROM admin WHERE id_admin='$id_Admin' ";
                        $query = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($query)) { ?>
                            <label class="form-label">Email</label>
                            <input type="mail" name="mail" value="<?php echo $row['email_admin']; ?>" class="form-control w-50" required="required">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" value="<?php echo $row['nom_admin']; ?>" class="form-control w-50">
                            <label class="form-label">Prenom</label>
                            <input type="text" name="prenom" value="<?php echo $row['prenom_admin']; ?>" class="form-control w-50">
                            <label class="form-label">Motpass</label>
                            <input type="text" name="motpass" value="<?php echo $row['pass_admin']; ?>" class="form-control w-50">
                            

                            <button name="modifier" class="btn btn-success mt-4">Modifier</button>
                        <? } ?>
                    </form>
                </div>
            </section>
            <section class="col-3">
                
                    <img src="user.png" class="card-img-top" alt="...">
                
            </section>
        </div>

    </body>
    <?php include "footer/footer.php"; ?>

    </html>
<?php
}
?>