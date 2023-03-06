<?php
require_once 'header.php';
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
    <link rel="stylesheet" href="../css/product.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="product-container row">
        <nav class="cate col-12 col-md-6 col-sm-4">
            <div class="head">Categories</div>
            <div class="cate-list">
                <a href="?IDcat">All Product</a>
                <?php
                include_once 'connectju.php';
                $c = new connectju();
                $dblink = $c->connectToMySQL();
                $sql = "SELECT *FROM type";
                $re = $dblink->query($sql);
                $re->data_seek(0);
                while ($row = $re->fetch_assoc()) {
                    $href = "?IDcat=$row[IDcat]";
                    echo "<a href='$href'>$row[Namecat]</a>";
                }
                ?>
            </div>
        </nav>
        <nav class="all col-12 col-md-6 col-sm-4">
            <div class="boxall-list row">
            <?php
                include_once 'connectju.php';
                $c = new connectju();
                $dblink = $c->connectToMySQL();
                $idcat = $_GET['IDcat'] ?? '';
                $sql = "SELECT *FROM product WHERE IDcat LIKE ('".$idcat."')";
                $re = $dblink->query($sql);
                $re->data_seek(0);
                if ($re->num_rows > 0) :
                    while ($row = $re->fetch_assoc()) :
                ?>
                        <div class="allproduct col-12 col-md-6 col-sm-4">
                            <div class=" boxchildall card">
                                <img src="../image/<?= $row['Image'] ?>">
                                <a href="detailed.php?id=<?= $row['IDp'] ?>" class="text-decoration-none">
                                    <p class="card-text"><?= $row['Namep'] ?></p>
                                </a>
                                <a class="price">$<?= $row['Pricep'] ?></a>
                            </div>
                        </div>
                <?php
                    endwhile;
                else :
                    include_once 'connectju.php';
                    $c = new connectju();
                    $dblink = $c->connectToMySQL();
                    $sql = "SELECT *FROM product";
                    $re = $dblink->query($sql);
                    $re->data_seek(0);
                    if ($re->num_rows > 0) :
                        while ($row = $re->fetch_assoc()) :
                    ?>
                            <div class="allproduct col-12 col-md-6 col-sm-4">
                                <div class=" boxchildall card">
                                    <img src="../image/<?= $row['Image'] ?>">
                                    <a href="detailed.php?id=<?= $row['IDp'] ?>" class="text-decoration-none">
                                        <p class="card-text"><?= $row['Namep'] ?></p>
                                    </a>
                                    <a class="price">$<?= $row['Pricep']?></a>
                                </div>
                            </div>
                    <?php
                        endwhile;
                endif;
            endif;
                ?>
            </div>
        </nav>

    </div>

</body>

</html>