<?php
session_start();

include('conn.php');

$mail = mysqli_real_escape_string($conn,$_POST['mail']);
$password = mysqli_real_escape_string($conn,$_POST['password']);
$login = $_POST['login'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="bootst.css">
    <link rel="stylesheet" href="css/all.min.FA.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>

    <!-- Nav bar -->
    <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light text-capitalize navbarr lg-m-5">
                
                <div class="container">
                    
                    <a href="#" class="mx-auto"  class="navbar-brand fs-2 h1 text-primary pb-0"><img src="logoUniv.png"  class="img-fluid "></a>
                    
                </div>
            </nav>
        </header>
    <!-- End Nav bar -->
    <?php
    if (isset($login)) {

        $query = "SELECT * FROM admin WHERE email_admin='$mail'AND pass_admin='$password' ";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        if ($row['email_admin'] == $mail && $row['pass_admin'] == $password) {
            echo "<div class='alert alert-success'>" . "مرحبا بك ادمن سيتم تحويلك الي لوحة التحكم" . "</div>";
            $_SESSION['id_admin'] = $row['id_admin'];
            header("REFRESH:2;URL=admin.php");
        }else {
            echo "<div class='alert alert-danger'>" . "كلمة المرور أو البريد الالكتروني غير صحيحة" . "</div>";
        }
    }

    ?>
    <section>
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <center>
                                <svg class="my-3 mx-auto" xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                                <h3>Admin</h3>
                            </center>
                            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                                <input type="email" name="mail" id="mail" class="form-control my-3 py-2" placeholder="mail">
                                <input type="password" name="password" class="form-control my-3 py-2" placeholder="password">
                                <div class="text-center mt-3">
                                    <button name="login" class="btn btn-primary">Login</button>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include "footer/footer.php"; ?>
</body>

</html>