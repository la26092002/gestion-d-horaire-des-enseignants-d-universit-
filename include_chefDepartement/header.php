<!-- Nav bar -->
        <header>
            <nav  class="navbar navbar-expand-lg navbar-light bg-light text-capitalize navbarr">
                <div class="container">
                    <a href="chef_departement.php"  class="navbar-brand fs-2 h1 text-primary pb-0"><img src="logoUniv.png" width="550" alt=""></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="menu">
                        <ul class="navbar-nav ms-auto px-5 fs-5 ">
                            <li class="nav-item">
                                <a href="Mon_emploi_du_temps.php" style="color: #003d7a;" class="nav-link" data-current="page">Mon emploi du temps</a>
                            </li>
                        </ul>
                        <ul style="color: #003d7a;" class="navbar-nav">
                            <?php
                            $id = $_SESSION['id'];
                            $_SESSION['chef_departement'];
                            $query = "SELECT * FROM enseignant WHERE id_enseignant='$id' ";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            ?>
                            <li class="nav-item">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo ($row['Nom_enseignant']);
                                        echo (' ');
                                        echo ($row['Prenom_enseignant']); ?>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="parametres.php">paramètres</a></li>
                                        <li><a class="dropdown-item" href="logout.php">Se déconnecter</a></li>
                                    </ul>
                                </div>

                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
        </header>
        <!-- End Nav bar -->