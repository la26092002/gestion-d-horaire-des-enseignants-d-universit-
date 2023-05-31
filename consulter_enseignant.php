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
                    <?php
                    include("MenuBar.php");
                    ?>
                    <script>
                        $(document).ready(function() {
                            $("#live_search").keyup(function() {
                                var input = $(this).val();
                                var statut = document.getElementById("statut").value;
                                //alert(input);
                                if (input != "") {
                                    $.ajax({
                                        url: "livesearch_Consulté_Enseignant.php",
                                        method: "POST",
                                        data: {
                                            input: input,
                                            statut: statut
                                        },

                                        success: function(data) {
                                            $("#searchresult").html(data);
                                            $("#searchresult").css("display", "block");
                                        }
                                    });
                                } else {
                                    $("#searchresult").css("display", "none");
                                }
                            });
                        });
                    </script>
                    <div class="col-12 col-sm-12 col-md-9 col-lg-9 pb-3 p-3">
                        <div class="card " style="background-color: #f8f9fa;">
                            <div class="card-body shadow">
                                <div class="row">
                                    <div class="col-4">
                                        <label id="" class="form-label"><i class="fas fa-filter"></i> Statut</label>
                                        <select class="form-select" name="statut" id="statut">
                                            <option value="10">tous</option>
                                            <option value="1">actif</option>
                                            <option value="0">inactif</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label"><i class="fas fa-filter"></i> Nom</label>
                                        <div class="col-12 "><input type="text" name="live_search" id="live_search" class="form-control" placeholder="search ..."></div>
                                    </div>

                                    <div class="col-4">
                                        <button onclick="afficher_tous()" class="btn btn-success " style="margin-top: 32px;">Afficher tous</button>
                                    </div>
                                    <script>
                                        function afficher_tous(){
                                        window.location.href = "consulter_enseignant_tous.php";
                                        }
                                    </script>
                                    
                                </div>
                            </div>
                        </div>

                        <?php
                        //delete-enseignant
                        $id_enseignant = mysqli_real_escape_string($conn, $_GET['id']);
                        if (!empty($id_enseignant)) {
                            $queryy = "DELETE FROM enseignant WHERE id_enseignant='$id_enseignant'";
                            $delete = mysqli_query($conn, $queryy);
                            if (isset($delete)) {
                                echo "<div class='alert alert-success'>" . "fait avec succès" . "</div>";
                            } else {
                                echo "<div class='alert alert-danger'>" . "votre informations sont incorrectes" . "</div>";
                            }
                        }
                        ?>
                        <div class="searchresult" id="searchresult">
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