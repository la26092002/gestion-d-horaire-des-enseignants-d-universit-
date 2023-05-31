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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#faculte').on('change', function() {
                var faculteID = $(this).val();
                if (faculteID) {
                    $.get(
                        "inscrir-ajax.php", {
                            faculte: faculteID
                        },
                        function(data) {
                            $('#domaine').html(data);
                        }
                    );
                } else {
                    $('#domaine').html('<option>select faculte first</option>')
                }
            })
        });

        $(document).ready(function() {
            $('#domaine').on('change', function() {
                var domaineID = $(this).val();
                if (domaineID) {
                    $.get(
                        "inscrir-ajax.php", {
                            domaine: domaineID
                        },
                        function(data) {
                            $('#departement').html(data);
                        }
                    );
                } else {
                    $('#departement').html('<option>select domaine first</option>')
                }
            })
        });
    </script>
</head>

<body>
    <label class="form-label">faculte</label>
    <select name="faculte" id="faculte" class="form-control">
        <option>select first</option>
        <?php
        $query = "SELECT * FROM faculte";
        $res = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($res)) {
        ?>
            <option>
            <option value="<?php echo ($row['id_faculte']) ?>"><?php echo ($row['Nom_faculte']) ?></option>
            </option>
        <?php
        }
        ?>
    </select><br>

    <label class="form-label">domaine</label>
    <select name="domaine" id="domaine" class="form-control">
        <?php
        $query = "SELECT * FROM domaine";
        $res = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($res)) {
        ?>
            <option>select faculte first</option>
        <?php
        }
        ?>
    </select><br>

    <label class="form-label">departement</label>
    <select name="departement" id="departement" class="form-control">
        <?php
        $query = "SELECT * FROM departement";
        $res = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($res)) {
        ?>
            <option>
                <?php echo $row['Nom_departement']; ?>
            </option>
        <?php
        }
        ?>
    </select><br>

    <label class="form-label">filiere</label>
    <select name="filiere" id="filiere" class="form-control">
        <?php
        $query = "SELECT * FROM filiere";
        $res = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($res)) {
        ?>
            <option>
                <?php echo $row['Nom_filiere']; ?>
            </option>
        <?php
        }
        ?>
    </select><br>
</body>

</html>