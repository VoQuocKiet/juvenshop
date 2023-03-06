<?php
include_once("connectju.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <?php
    session_start();
    if (isset($_POST['btnLogin'])) {
        if (isset($_POST['txtPass']) && isset($_POST['txtName'])) {
            $pwd = $_POST['txtPass'];
            $name = $_POST['txtName'];
            $c = new connectju();
            $dblink = $c->connectToPDO();
            $sql = "SELECT * FROM users WHERE Nameurs = ? and Password1 = ?";
            $stmt = $dblink->prepare($sql);
            $re = $stmt->execute(array("$name","$pwd"));
            $numrow = $stmt->rowCount();
            $row = $stmt->fetch(PDO::FETCH_BOTH);
            if ($numrow == 1) {
                echo "Login successfully";
                $_SESSION['user_name'] = $row['Nameurs'];
                $_SESSION['user_id'] = $row['IDurs'];
                $_SESSION['user'] = $row;
                // setcookie("cc_username", $row['Nameurs'],time()+600);
                // setcookie("cc_id", $row['IDurs'],time()+600);
                header("Location: homepage.php");
            } else {
                echo "Something wrong with your info";
            }
        } else {
            echo "Please enter your info";
        }
    }
    ?>
    <form class="vh-100 login" method="POST" action="login.php" style="background-color: #EFF5F5;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-4 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-5">Sign in</h3>
                            <div class="name form-group row">
                                <label for="txtEmail" class="col-sm-4 control-label">User Name*: </label>
                                <div class="col-sm-8">
                                    <input type="text" name="txtName" id="txtName" class="form-control" placeholder="User Name" value="" />
                                </div>
                            </div>
                            <div class="pass form-group row">
                                <label for="txtPass" class="col-sm-4 control-label">Password*: </label>
                                <div class="col-sm-8">
                                    <input type="password" name="txtPass" id="txtPass" class="form-control" placeholder="Password" value="" />
                                </div>
                            </div>
                            <button class="btnLogin btn btn-primary btn-lg btn-block" type="submit" name="btnLogin">Login</button>
                            <hr class="my-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>