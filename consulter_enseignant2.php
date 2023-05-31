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

    </head>

    <body>
        <!-- Nav bar -->
        <?php include "include_chefDepartement/header.php"; ?>
        <!-- End Nav bar -->
        <section class="mt-2">
            <div class="container-fluids">
                <div class="row">
                    <div class="col-12-light col-sm-12 col-md-3 col-lg-3 pb-3 p-3 ">
                        <div class="accordion shadow" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Enseignant
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>
                                                <a href="chef_departement.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Ajouter</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="consulter_enseignant.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Consulter</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Insertion des données
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>
                                                <a href="module.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Module</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="salle.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Salle</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="heure.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>Heure</span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="promotion.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>promotion</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="specialite.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>specialite</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="seance02.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>seance</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Emploi du temp
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>
                                                <a href="enmploie_du_temp.php" class="nav-link">
                                                    <span><i class="fas fa-plus"></i></span>
                                                    <span>emploie du temp</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-9 col-lg-9 pb-3 p-3">
                        <div class="card " style="background-color: #f8f9fa;">
                            <div class="card-body shadow">
                                <table class="table table-hover">
                                    <thread>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Email</th>
                                            <th>S1</th>
                                            <th>S2</th>
                                            <th>N°tlph</th>
                                            <th>statut</th>
                                            <th>verifier</th>
                                            <th>image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thread>
                                    <tbody>
                                        <?
                                        $id_dep = $_SESSION['chef_departement'];
                                        $query = "SELECT * FROM enseignant";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id_enseignant = $row['id_enseignant'];
                                            $Email_enseignant = $row['Email_enseignant'];
                                            $Nom_enseignant = $row['Nom_enseignant'];
                                            $Prenom_enseignant = $row['Prenom_enseignant'];
                                            $Ntlph = $row['N_tlphn']; ?>
                                        <tr>
                                        <td><?php echo $Nom_enseignant; ?></td>
                                <td><?php echo $Prenom_enseignant; ?></td>
                                <td><?php echo $Email_enseignant; ?></td>
                                            <th>S1</th>
                                            <th>S2</th>
                                            <th>N°tlph</th>
                                            <th>statut</th>
                                            <th>verifier</th>
                                            <th>image</th>
                                            <th>Action</th>
                                        </tr>
                                        <?}?>
                                    </tbody>
                                </table>
                            </div>
                        </div>



                    </div>
        </section>
        <br><br>
        <?php include "footer/footer.php"; ?>




    </body>

    </html>
<?php
    /*echo ('id enseignant est: ');
    echo ($_SESSION['id']);
    echo ('          departement est: ');
    echo ($_SESSION['chef_departement']);*/
}
?>