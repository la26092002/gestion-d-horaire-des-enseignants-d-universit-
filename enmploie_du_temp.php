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
        <script>
            $(document).ready(function() {
                $('#filiere').on('change', function() {
                    var filiereIDD = $(this).val();
                    if (filiereIDD) {
                        $.get(
                            "Emploi_test_filiere_specialite.php", {
                                filierespecialite: filiereIDD
                            },
                            function(data) {
                                $('#specialite').html(data);
                            }
                        );
                    } else {
                        $('#specialite').html('<option>select filiere first</option>')
                    }
                });
            });
            $(document).ready(function() {
                $('#specialite').on('change', function() {
                    var specialiteIDD = $(this).val();
                    if (specialiteIDD) {
                        $.get(
                            "Emploi_test_specialite_promotion.php", {
                                specialitepromotion: specialiteIDD
                            },
                            function(data) {
                                $('#promotion').html(data);
                            }
                        );
                    } else {
                        $('#promotion').html('<option>select filiere first</option>')
                    }
                });
            });

            $(document).ready(function() {
                $('#promotion').on('change', function() {
                    var promotionIDD = $(this).val();
                    if (promotionIDD) {
                        $.get(
                            "Emploi_test_promotion_semestre.php", {
                                promotion: promotionIDD
                            },
                            function(data) {
                                $('#semestre').html(data);
                            }
                        );
                    } else {
                        $('#semestre').html('<option>select filiere first</option>')
                    }
                });
            });



            $(document).ready(function() {
                $('#semestre').on('change', function() {

                    var semestre = $(this).val();
                    var promotionIDD = document.getElementById("promotion").value;
                    if (promotionIDD) {
                        $.get(
                            "Emploi_test_promotion_emploi.php", {
                                promotionEmploi: promotionIDD,
                                semestre: semestre
                            },
                            function(data) {
                                $('#emploi').html(data);
                            }
                        );
                    } else {
                        $('#emploi').html('<option>select filiere first</option>')
                    }
                });
            });
        </script>
    </head>

    <body>
        <!-- Nav bar -->
        <?php include "include_chefDepartement/header.php"; ?>
        <!-- End Nav bar -->
        <section class="mt-2">
            <div class="container-fluids">
                <div class="row">
                <?php
                    include("MenuBar.php");
                    ?>
                    <div class="col-12 col-md-9 col-lg-9 pb-3 p-3">
                        <div class="card">
                            <div class="card-body shadow" style="background-color: #f8f9fa;">

                                <div>
                                    <label class="form-label"><i class="fas fa-filter"></i> filiére</label>
                                    <select name="filiere" id="filiere" class="filiere form-select">
                                        <option value=""></option>
                                        <?php
                                        $dep = $_SESSION['chef_departement'];
                                        $sql = "SELECT * FROM filiere WHERE id_departement='$dep'";
                                        $query = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <option value="<?php echo $row['id_filiere']; ?>"><?php echo $row['Nom_filiere']; ?></option>
                                        <?php
                                        }  ?>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label"><i class="fas fa-filter"></i> spécialité</label>
                                    <select name="specialite" id="specialite" class="specialite form-select">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label"><i class="fas fa-filter"></i> promotion</label>
                                    <select name="promotion" id="promotion" class="promotion form-select">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label "><i class="fas fa-filter"></i> Semestre</label>
                                    <select name="semestre" id="semestre" class="form-select">
                                        <option value=""></option>

                                    </select>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <section>

            <div name="emploi" class="emploi p-3" id="emploi">
            </div>
        </section>
        <?php include "footer/footer.php"; ?>
    <?php
}
    ?>