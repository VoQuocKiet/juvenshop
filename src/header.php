<?php
session_start();
ob_start();
include_once 'connectju.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>
<style>
    .dropdown:hover .dropdown-menu {
        display: block;
    }

    a.nav-link {
        color: black;
        font-size: 20px;
    }

    a.nav.nav-link.active {
        color: black;
    }

    a.navbar-brand {
        color: black;
    }
</style>

<body>
    <nav class="navbar navbar-expand-md navbar-white bg-close-white">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand col-sm-2 col-form-div">
                <img src="../image/juventusicon.png" alt="" width="40" height="36">JUVENTUS STORE
            </a>
            <div class="d-flex">
                <form class="input-group input-group-sm" action="search.php">
                    <span class="input-group-text" id="inputGroup-sizing-sm"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Search.." id="search" name="search">
                </form>
            </div>
            <div class="navbar-nav col-sm-6 col-form-div" id="navbarMain">
                <div class="menu navbar-nav">
                    <a href="homepage.php" class="nav nav-link active">Home</a>
                    <a href="product.php" class="nav-link">Product</a>
                </div>
                <div class="navbar-nav ms-auto">
                    <?php
                    if (isset($_SESSION['user_name'])) :
                    ?>
                        <a href="receipt.php" class="nav-link">View New Order</a>
                        <a href="cart.php" class="nav-link"><i class="bi bi-cart"></i></a>
                        <a href="#" class="nav-item nav-link">Welcome,<?= $_SESSION['user_name'] ?></a>
                        <a href="logout.php" class="nav-item nav-link">Logout</a>
                    <?php
                    else :
                    ?>
                        <a href="#" class="nav-item nav-link" onclick="document.location='login.php'">Login</a>
                        <a href="#" class="nav-item nav-link" onclick="document.location='register.php'">Register</a>
                    <?php
                    endif;
                    ?>
                </div>

            </div>
        </div>
    </nav>
</body>

</html>