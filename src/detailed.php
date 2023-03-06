<?php
require_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/detailed.css">
</head>

<body>
    <?php
    include_once 'connectju.php';
    if (isset($_GET['id'])) :
        $pid = $_GET['id'];
        $c = new connectju();
        $dblink = $c->connectToMySQL();
        $sql = "SELECT *FROM product WHERE IDp = '$pid'";
        $re = $dblink->query($sql);
        $row = $re->fetch_assoc();
    ?>
        <div class="detailed-container row">
            <div class="col-12 col-md-6 col-sm-4">
                <div class="img">
                    <img src="../image/<?= $row['Image'] ?>" class="card-img-top" alt="" />
                </div>
                <div class="product-dropdown">
                    <div class="heading">
                        <h3>Description</h3>
                    </div>
                    <div class="description">
                        <?= $row['Description'] ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-sm-4">
                <form action="cart.php" method="POST" id="addcart">
                    <div class="col-md-4 pb-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?= $row['Namep'] ?>
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted cardprice">$<?= $row['Pricep'] ?></h6>
                        </div> 
                    </div>
                    <input type="hidden" name="pid" value="<?=$pid?>">
                    <h2>Size: XS, S, M, L, XL, 2XL </h2>
                    <input type="text" name="size" class="prod-size" value="">
                    <div class="button-quantity">
                        <div class="quantity">
                            <span>QUANTITY</span>
                            <input type="number" placeholder="1" value="1" min="1" style="outline: none;" name="count">
                        </div>
                        <input type="submit" class="btnAdd btn btn-primary shop-button" name="btnAdd" value="ADD TO CART" />
                    </div>
                </form>
            <?php
        else :
            ?>
            <?php
        endif;
            ?>
            </div>
        </div>
</body>

</html>