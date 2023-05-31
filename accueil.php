<!DOCTYPE html>

<html>

<head>


    <title></title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="bootst.css">
    <link rel="stylesheet" href="css/all.min.FA.css">

    <style>
        .fixed {
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            background-color: white;
            color: black;
            opacity: .85;
            padding: .5em;
            /*   transition: all 1s ease-in-out */
        }
    </style>
</head>

<body>
    <!-- Nav bar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light text-capitalize navbarr lg-m-5">

            <div class="container">

                <a href="#" class="mx-auto" class="navbar-brand fs-2 h1 text-primary pb-0"><img src="logoUniv.png" class="img-fluid "></a>

            </div>
        </nav>
    </header>
    <!-- End Nav bar -->
    <!-- Hero -->
    <section id="hero" class="pt-4 pt-md-4">
        <div class="container pt-4">
            <div class="row align-items-center ">
                <div class="col-12 col-md-6 col-lg-6 text-center text-md-start pb-3 ">
                    <h1 class="h1 display-3">
                        Bienvenue pour<br>Découvrez votre emploi du temps.
                    </h1>

                </div>
                <div class="col-12 col-md-6 col-lg-6 mt-5">
                    <?php
                    include "accueil-slideShow.php";
                    ?>
                </div>
            </div>
        </div>
        </div>
    </section>

    <?php include "footer/footer.php"; ?>

</body>

</html>