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
        <link rel="stylesheet" href="css/all.min.FA.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
        <?php include "inc_dr/header.php"; ?>
        <!-- End Nav bar -->
        
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <label class="form-label">faculte</label>
                    <select name="faculte" id="faculte" class="faculte form-control">
                        <option disabled="disabled" selected="selected">select</option>
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
                    </select><br>

                    <label class="form-label">domaine</label>
                    <select name="domaine" id="domaine" class="domaine form-control">

                    </select><br>

                    <label class="form-label">departement</label>
                    <select name="departement" id="departement" class="departement form-control">

                    </select><br>
                    <label class="form-label">Semestre</label>
                    <select name="semestre" id="semestre" class="semestre form-control">

                        <option value="1">S1</option>
                        <option value="2">S2</option>
                    </select><br>
                    <?php
                    //<a href="directeur_enseignant_perdre2.php?" name="continue" class="btn btn-success ">Continuer</a>
                    ?>
                </form>


                <a onclick="btn()" class="btn btn-success">Continuer</a>
                <script>
                    function btn() {
                        var semestre = document.getElementById("semestre").value;
                        var depart = document.getElementById("departement").value;
                        
                        window.location.href = "directeur_enseignant_perdre2.php?sem=" + semestre + "&dep=" + depart;
                    }
                </script>
            </div>
            <div class="col-2"></div>
        </div>

        <br><br><br><br><br><br><br><br>
        <?php include "footer/footer.php"; ?>

    </body>

    </html>
<?php
}
?>