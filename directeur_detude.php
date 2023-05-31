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
                $("#live_search").keyup(function() {
                    var input = $(this).val();
                    //alert(input);
                    if (input != "") {
                        $.ajax({
                            url: "livesearch.php",
                            method: "POST",
                            data: {
                                input: input
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

    </head>

    <body>
        <!-- Nav bar -->
        <?php include"inc_dr/header.php"; ?>
        <!-- End Nav bar -->

        <section class="mt-2">
            <div class="row">
                <div class="col-3">
                </div>
                <div class="col-6">
                    <h1 class="mt-2">selectionner les enseignements </h1>
                    <div class="row">
                        <div class="col-12 "><input type="text" name="live_search" id="live_search" class="form-control" placeholder="search ..."></div>
                        
                    </div>
                    
                    
                </div>
                <div class="col-3">
                </div>
            </div>
            <div id="searchresult"></div>
        </section>
        <br><br><br><br><br><br><br><br>
        <?php include "footer/footer.php";?>

    </body>

    </html>
<?php
}
?>