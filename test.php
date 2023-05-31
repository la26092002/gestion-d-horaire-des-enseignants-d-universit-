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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                            "Emploi_test_promotion_emploi.php", {
                                promotionEmploi: promotionIDD
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

        <div class="">
            <div class="card">
                <div class="card-body shadow">
                    <div>
                        <select name="filiere" id="filiere">
                            <option value="">select</option>
                            <?php
                            $sql = "SELECT * FROM filiere WHERE id_departement='1'";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                                <option value="<?php echo $row['id_filiere']; ?>"><?php echo $row['Nom_filiere']; ?></option>
                            <?php
                            } ?>
                        </select>
                    </div>
                    <div>
                        <select name="specialite" id="specialite">
                            <option value="">select</option>
                        </select>
                    </div>
                    <div>
                        <select name="promotion" id="promotion">
                            <option value="">select</option>
                        </select>
                    </div>
                    <div name="emploi" class="emploi" id="emploi">
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php } ?>