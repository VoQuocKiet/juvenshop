<?php
require_once 'header.php';
?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="../css/homepage.css">
</head>
<style>

    p.card-text:last-child {
        font-size: 30px;
        color: black;
        text-align: center;
        margin-bottom: 50px;
    }
    nav.line {
        background-color: black;
    }

</style>

<body>
    <main class="">
        <nav class="">
            <banner class="banner">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../image/banner1.png" class="d-block w-100" alt="..." width="ms-auto" height="600px">
                        </div>
                        <div class="carousel-item">
                            <img src="../image/banner2.jpg" class="d-block w-100" alt="..." width="ms-auto" height="600px">
                        </div>
                        <div class="carousel-item">
                            <img src="../image/banner4.jpg" class="d-block w-100" alt="..." width="ms-auto" height="600px">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </banner>
        </nav>
        <div class="content">
            <h1 class="content1">100% OFFICIAL MERCHANDISE<p class="content2">SHOW YOUR PRIDE, SUPPORT DIRECTLY!</p>
            </h1>
            <h1 class="content1 content-line">CHRISTMAS DELIVERY LAST
                ORDER DATES<p class="content2">WAIT NO MORE! HUNTING SALE ON
                    THE LAST DATES</p>
            </h1>
            <h1 class="content1">EXCLUSIVE PRODUCTS<p class="content2">NEW
                    EXCLUSIVE PRODUCTS EVERY DAY</p>
            </h1>
        </div>
        <nav class="line">
            <hr>
        </nav>
        <nav class="Christmas row">
            <span>
                <h1 class="h1xmas">CHRISTMAS</h1>
            </span>
            <h2 class="h2hot"><a class="hoticon"> <img src="../image/hoticon.png" width="30px" height="30px"></a>HOT NEW</h2>
            <div class="">
                <div class="boxxmas-list">
                    <?php
                    include_once 'connectju.php';
                    $c = new connectju();
                    $dblink = $c->connectToMySQL();
                    $sql = "SELECT *FROM product WHERE IDcat LIKE ('2')";
                    $re = $dblink->query($sql);
                    $row1 = $re->fetch_row();
                    $re->data_seek(0);
                    if ($re->num_rows > 0) :
                        while ($row = $re->fetch_assoc()) :
                    ?>
                            <div class="boxxmas col-12 col-md-6 col-sm-4 row">
                                <div class=" boxchildxmas col-12 col-md-8 col-sm-6">
                                    <img class="img-xmas" src="../image/<?= $row['Image'] ?>">
                                    <a href="detailed.php?id=<?= $row['IDp'] ?>" class="text-decoration-none">
                                        <p class="card-text"><?= $row['Namep'] ?></p>
                                    </a>
                                </div>
                            </div>
                    <?php
                        endwhile;
                    else :
                        echo "Not found";
                    endif;
                    ?>
                </div>
            </div>
        </nav>
        <div class="background col-12 d-xl-block"></div>
</body>

</html>

<?php
require_once 'footer.php';
?>