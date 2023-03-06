<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="../css/register.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark  ">
        <div class="container-fluid">
            <a href="homepage.php" class="navbar-brand col-sm-2 col-form-div">
                <img src="../image/juventusicon.png" alt="" width="40" height="36"></a>
        </div>
        </div>
    </nav>
    <div class="container">
        <?php
        include_once 'connectju.php';
        if (isset($_POST['btnRegister'])) {
            $c = new connectju();
            $dblink = $c->connectToPDO();
            $fname = $_POST['usrName'];
            $email = $_POST['mail'];
            $phone = $_POST['phone'];
            $pwd = $_POST['pass1'];
            $address = $_POST['address'];
            $sql = "INSERT INTO `users`(`Nameurs`, `Password1`, `Phone`, `Email`, `Address`, `Role`) VALUES (?,?,?,?,?,?)";
            if (isset($_POST['btnRegister'])) {
                if (preg_match("^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$^", $fname)) {
                    if (isset($_POST['pass1']) && strlen($_POST['pass1']) > 5) {
                        if ($_POST['pass1'] == $_POST['pass2']) {
                            $re = $dblink->prepare($sql);
                            $stmt = $re->execute(array("$fname", "$pwd", "$phone", "$email", "$address", "User"));
                            echo "Successfully, All information has been saved and you can log in now";
                        } else {
                            echo "Confirm password is not true";
                        }
                    } else {
                        echo "Password must be than 5";
                    }
                } else {
                    echo "Username from 8-20 characters and not include special characters";
                }
            }
            // $stmt = $re->execute(array("$fname", "$pwd", "$phone", "$email", "$address", "User"));
            // if ($stmt) {
            //     echo "Congrats";
            // } else {
            //     echo "Failed";
            // }
        }
        ?>
        <section class="banner h-100">
            <form id="frmRegister" name="frmRegister" action="" method="POST" onsubmit="return formValid();" require_once>
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col">
                            <div class="card card-registration my-4">
                                <div class="row g-0">
                                    <div class="img col-xl-4 d-none d-xl-block">
                                        <img src="../image/regbanner.jpg" alt="Sample photo" class="img-fluid" style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                                    </div>
                                    <div class="col-xl-8">
                                        <div class="card-body p-md-5 text-black">
                                            <h3 class="mb-5 text-uppercase">Registration form</h3>
                                            <div class="form-outline mb-4">
                                                <div class="row pb-3">
                                                    <label class="col-sm-4 col-form-label" for="Username">Username</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="usrName" id="Username" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <div class="row pb-3">
                                                    <label class="col-sm-4 col-form-label" for="password1">Password</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" name="pass1" id="password" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <div class="row pb-3">
                                                    <label class="pass2 col-sm-4 col-form-label" for="password2">Confirm Password</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" name="pass2" id="password2" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <div class="row pb-3">
                                                    <label class="col-sm-4 col-form-label" for="phone">Phone</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="phone" id="phone" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <div class="row pb-3">
                                                    <label class="col-sm-4 col-form-label" for="mail">Email</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="mail" id="mail" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <div class="row pb-3">
                                                    <label class="col-sm-4 col-form-label" for="address">Address</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="address" id="address" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class=" col-12 col-md-10 col-sm-2">
                                                    <div class="register d-grid col-2 mx-auto">
                                                        <input type="submit" value="Register" class="btn btn-primary" name="btnRegister" id="btnRegister">
                                                    </div>
                                                </div>
                                                <div class=" col-12 col-md-10 col-sm-2 mt-5">
                                                    <div class="register d-grid col-2 mx-auto">
                                                        <a href="login.php" name="login" id="login">Login Here</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
</body>

</html>