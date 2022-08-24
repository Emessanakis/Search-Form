<?php
include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>PJ04.02 Web Developer</title>
    <!-- Bootstrap -- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <!--  Search user form -->
    <div class="container mt-5 w-25 border border-secondary border-2">
        <form class="col g-3" method="post">
            <div class="col-md-12">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" name="FirstName">
            </div>
            <div class="col-md-12">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="LastName">
            </div>
            <div class="col-md-12">
                <label for="emailInfo" class="form-label">E-mail</label>
                <input type="email" class="form-control" name="emailInfo">
            </div>
            <div class="row">
                <div class="col-md-4 mt-2 mb-2">
                    <button type="submit" class="btn btn-primary" name=btnSearch>Search user</button>
                </div>

                <div class="col-md-4 mt-2 mb-2">
                    <button type="submit" class="btn btn-primary" name=allUsers>Show all users</button>
                </div>
            </div>
        </form>
        <!--  --!Search user form-- -->
    </div>

    <!--  Category List -->
    <div class="container mt-4 w-50 border border-secondary border-2 overflow-auto">
        <div class=" row mt-2 border-bottom">
            <div class="col-sm-4">
                <label for="firstName" class="form-label">
                    <h4>First Name</h4>
                </label>
            </div>
            <div class="col-sm-4">
                <label for="LastName" class="form-label">
                    <h4>Last Name</h4>
                </label>
            </div>
            <div class="col-sm-4">
                <label for="emailInfo" class="form-label">
                    <h4>E-mail</h4>
                </label>
            </div>
        </div>
        <!--  --!Category List-- -->

        <?php

        if ((!isset($_POST['btnSearch'])) and !isset($_POST['allUsers'])) {
            $all_users = mysqli_query($conn, "select * from users");
        } elseif (isset($_POST['btnSearch'])) {
            /*--  Validation Form  --*/
            $wFirstName = $_POST['FirstName'];
            $wLastName = $_POST['LastName'];
            $wemailInfo = $_POST['emailInfo'];
            if (empty($wFirstName) && empty($wLastName) && empty($wemailInfo)) {
                echo "<script>
                    alert('Fill at least one field!')
                </script>";
                $all_users = mysqli_query($conn, "select * from users");
            } else {
                /*  --!Validation Form-- */

                /*  Fetch user data */
                if (!empty($wFirstName)) {
                    $all_users = mysqli_query($conn, "select * from users where user_first like '%$wFirstName%'");
                } else if (!empty($wLastName)) {
                    $all_users = mysqli_query($conn, "select * from users where user_last like '%$wLastName%'");
                } else {
                    $all_users = mysqli_query($conn, "select * from users where user_email like '%$wemailInfo%'");
                }
            }
        } else if (isset($_POST['allUsers'])) {
            $all_users = mysqli_query($conn, "select * from users");
        }

        /*  --!Fetch user data-- */
        while ($row = mysqli_fetch_array($all_users)) {
            $user_first = $row['user_first'];
            $user_last = $row['user_last'];
            $user_email = $row['user_email'];
        ?>
            <!--  Display users -->
            <div class="row mt-2">
                <div class="col-sm-4">
                    <label for="firstName" class="form-label">
                        <?php echo "$user_first" ?>
                    </label>
                </div>
                <div class="col-sm-4">
                    <label for="LastName" class="form-label">
                        <?php echo "$user_last" ?>
                    </label>
                </div>
                <div class="col-sm-4">
                    <label for="emailInfo" class="form-label">
                        <?php echo "$user_email" ?>
                    </label>
                </div>
            </div>
            <!--  --!Display users-- -->
        <?php
        }
        ?>
    </div>

    <!-- Bootstrap -- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>