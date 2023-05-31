<?php
session_start();
if (!isset($_SESSION['id_admin'])) {
    echo "<div class='alert alert-danger'>" . "غير مسموح لك فتح هذه الصفحة" . "</div>";
    header('REFRESH:2;URL=Admin_log.php');
} else {
?>
    <?php
    include('conn.php');
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="css/all.min.FA.css">
        <style>
            ul {
                list-style-type: none;
            }

            li {
                margin-top: 10px;
            }
        </style>
        <script>
            $(document).ready(function() {
                $('#faculte').on('change', function() {
                    var faculteIDD = $(this).val();
                    if (faculteIDD) {
                        $.get(
                            "faculte_inscrir.php", {
                                faculte: faculteIDD
                            },
                            function(data) {
                                $('#domaine').html(data);
                            }
                        );
                    } else {
                        $('#domaine').html('<option>select filiere first</option>')
                    }
                });
            });

            $(document).ready(function() {
                $('#domaine').on('change', function() {
                    var domaineIDD = $(this).val();
                    if (domaineIDD) {
                        $.get(
                            "domaine_departement_inscrir.php", {
                                domaine: domaineIDD
                            },
                            function(data) {
                                $('#departement').html(data);
                            }
                        );
                    } else {
                        $('#departement').html('<option>select filiere first</option>')
                    }
                });
            });
        </script>


    </head>

    <body>
        <!-- Nav bar -->
        <?php
        include "admin-header.php";
        ?>
        <!-- End Nav bar -->

        <section class="mt-2 ">
            <div class="container-fluids">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 pb-3 p-3 ">
                        <div class="accordion shadow" id="accordionExample">
                            <div class="accordion-item" s>
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        System
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>
                                                <a href="admin.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Faculté</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="admin_domaine.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Domaine</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="admin_departement.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Departement</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="admin_filiere.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Filiére</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Chef departement
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>
                                                <a href="admin_Ajouter_Chef_Departement.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Ajouter</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="admin_Consulter_Chef_Departement.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Consulté</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="admin_Select_Chef_Departement.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Selectionner</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        directeur des études
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>
                                                <a href="admin_Ajouter_directeur.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Ajouter</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="admin_Consulter_directeur.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Consulté</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="admin_Select_directeur.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Selectionner</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-9 col-lg-9 pb-3 p-3 ">
                        <?php
                        $ajouter = $_POST['ajouter'];
                        $nom = $_POST['nom'];
                        $prenom = $_POST['prenom'];
                        $email = $_POST['email'];
                        $faculte = $_POST['faculte'];
                        $domaine = $_POST['domaine'];
                        $departement = $_POST['departement'];
                        if (isset($ajouter)) {

                            if (empty($nom) || empty($prenom) || empty($email) || empty($faculte) || empty($domaine) || empty($departement)) {
                                echo "<div class='alert alert-danger'>" . "قم بادخال معلوماتك" . "</div>";
                            } else {

                                $query = "INSERT INTO enseignant(Nom_enseignant,Prenom_enseignant,Email_enseignant,id_departement,chef_departement,Motpass_enseignant,verifie,statut,directeur_detude)VALUES('$nom','$prenom','$email','$departement','$departement','univ','1','1','0')";
                                $res = mysqli_query($conn, $query);
                                if (isset($res)) {
                                    echo "<div class='alert alert-success'>" . "تمت الاضافة بنجاح" . "</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>" . "حدث خطاا ما" . "</div>";
                                }
                            }
                        }
                        ?>
                        <div class="card" style="background-color: #f8f9fa;">
                            <div class="card-body shadow">
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <label class="form-label">Nom</label>
                                    <input type="text" placeholder="Nom" class="form-control " id="nom" name="nom" required>
                                    <label class="form-label">Prenom</label>
                                    <input type="text" placeholder="Prenom" class="form-control " id="prenom" name="prenom" required>
                                    <label class="form-label">Email</label>
                                    <input type="mail" placeholder="Email" class="form-control " id="email" name="email" required>

                                    <label class="form-label">faculte</label>
                                    <select name="faculte" id="faculte" class="faculte form-select" required>
                                        <option value="">select</option>
                                        <?php
                                        $query = "SELECT * FROM faculte";
                                        $res = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($res)) {
                                        ?>
                                            <option value="<?php echo $row['id_faculte']; ?>">
                                                <?php echo $row['Nom_faculte']; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>

                                    <label class="form-label">domaine</label>
                                    <select name="domaine" id="domaine" class="domaine form-select" required>

                                    </select>

                                    <label class="form-label">departement</label>
                                    <select name="departement" id="departement" class="departement form-select" required>

                                    </select>
                                    <button class="btn btn-success mt-3" name="ajouter">Ajouter</button>
                                </form>






                            </div>
                        </div>
                    </div>
        </section>



        <?php include "footer/footer.php"; ?>


    </body>

    </html>
<?php
} ?>