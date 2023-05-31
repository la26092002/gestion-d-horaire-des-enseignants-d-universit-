<?php
session_start();

include('conn.php');

if (!isset($_SESSION['id']) && (!isset($_SESSION['chef_departement']))) {
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

        <link rel="stylesheet" href="css/all.min.FA.css">
        <style>
            ul {
                list-style-type: none;
            }

            li {
                margin-top: 10px;
            }
        </style>
    </head>

    <body>
        <?php include "include_chefDepartement/header.php"; ?>
        <section class="mt-2">
            <div class="container-fluids">
                <div class="row">
                <?php
                    include("MenuBar.php");
                    ?>
                    <div class="col-12 col-md-9 col-lg-9 pb-3 p-3">
                        <div class="card" style="background-color: #f8f9fa;">
                            <div class="card-body shadow">
                                <?php
                                $nom = mysqli_real_escape_string($conn, $_POST['Nom']);
                                $prenom = mysqli_real_escape_string($conn, $_POST['Prenom']);
                                $email = mysqli_real_escape_string($conn, $_POST['Email']);
                                $password = rand();

                                $id_departement = $_SESSION['chef_departement'];
                                $ajouter = $_POST['ajouter'];
                                if (isset($ajouter)) {
                                    if (empty($nom) || empty($prenom) || empty($email)) {
                                        echo "<div class='alert alert-danger'>" . "الحقل فارغ" . "</div>";
                                    } else {


                                        $verifie = 1;
                                        $statut = 1;
                                        $query = "INSERT INTO enseignant(
                                        Email_enseignant,
                                        Nom_enseignant,
                                        Prenom_enseignant,
                                        Motpass_enseignant,
                                        chef_departement,
                                        directeur_detude,
                                        id_departement,
                                        verifie,
                                        statut) VALUES(
                                        '$email',
                                        '$nom',
                                        '$prenom',
                                        '$password',
                                        NULL,
                                        '0',
                                        '$id_departement',
                                        '$verifie',
                                        '$statut')";
                                        $s = mysqli_query($conn, $query);
                                        if (isset($s)) {
                                            echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
                                        }
                                    }
                                }
                                ?>
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <div>
                                        <label class="form-label" for="">Nom</label>
                                        <input type="text" class="form-control " name="Nom" id="Nom" required>
                                    </div>
                                    <div>
                                        <label class="form-label" for="">Prenom</label>
                                        <input type="text" class="form-control " name="Prenom" id="Prenom" required>
                                    </div>
                                    <div>
                                        <label class="form-label" for="">Email</label>
                                        <input type="email" class="form-control " name="Email" id="Email" required>
                                    </div>
                                    <div class="mt-4">
                                        <button name="ajouter" class="btn btn-success ">Ajouter</button>
                                    </div>
                            </div>


                            </form>
                        </div>
                    </div>
                </div>
        </section>
        <br><br>
        <?php include "footer/footer.php"; ?>



    </body>

    </html>
<?php
    /*
    echo ('id enseignant est: ');
    echo ($_SESSION['id']);
    echo ('          departement est: ');
    echo ($_SESSION['chef_departement']);*/
}
?>