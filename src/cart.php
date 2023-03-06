<?php
include_once 'header.php';
include_once 'connectju.php';
$c = new connectju();
$dblink = $c->connectToPDO();
if (isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];
    $user_id = $_SESSION['user_id'];


    if (isset($_POST['btnAdd'])) {
        $p_id = $_POST['pid'];
        $sqlSelect1 = "SELECT IDp FROM cart WHERE IDurs =? AND IDp=?";
        $re = $dblink->prepare($sqlSelect1);
        $size   = $_POST['size'];
        $count   = $_POST['count'];
        $re->execute(array("$user_id", "$p_id"));

        if ($re->rowCount() == 0) {
            $query = "INSERT INTO `cart`(`IDurs`, `IDp`, `Size`, `Countp`) VALUES (?,?,'$size',$count)";
            $stmt = $dblink->prepare($query);
            $stmt->execute(array($user_id, "$p_id"));
            header("Location: cart.php");
        } else {
            $query = "UPDATE cart SET Countp = Countp + ? where IDurs=? and IDp=?";
            $stmt = $dblink->prepare($query);
            $stmt->execute(array($count, $user_id, "$p_id"));
            header("Location: cart.php");
        }
    } elseif (isset($_POST['btn_update'])) {
        $size = $_POST['size'];
        $count   = $_POST['count'];
        $p_id = $_POST['pid'];
        $query = "UPDATE cart SET Countp = ?, Size = ? where IDurs=? and IDp=? limit 1";
        $stmt = $dblink->prepare($query);
        $stmt->execute(array($count, $size, $user_id, "$p_id"));
    } 
     else if (isset($_GET['cart_id'])) {
        $cart_del = $_GET['cart_id'];
        $query = "DELETE FROM cart WHERE IDcart=?";
        $stmt = $dblink->prepare($query);
        $stmt->execute(array($cart_del));
    }
    $sqlSelect = "SELECT * FROM cart c, product p where c.IDp = p.IDp and c.IDurs =?";
    $stmt1 = $dblink->prepare($sqlSelect);
    $stmt1->execute(array($user_id));
    $rows = $stmt1->fetchAll(PDO::FETCH_BOTH);
} else {
    header("Location: login.php");
}

?>
<div class="container">
    <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
    <h6 class="mb-0 text-muted"><?= $stmt1->rowCount() ?> item(s)</h6>
    <table class="table">
        <tr>
            <th>Productname</th>
            <th>Size</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
            <th>Action</th>
        </tr>
        <?php
        foreach ($rows as $row) {
        ?>
            <form method="POST" action="">
                <tr>
                    <td><?= $row['Namep'] ?></td>
                    <td><input id="" name="size" value="<?= $row['Size'] ?>" type="text" class="form-control form-control-sm" /></td>
                    <td><input id="" min="0" name="count" value="<?= $row['Countp'] ?>" type="number" class="form-control form-control-sm" /></td>
                    <td>
                        <h6 class="mb-0" id="" name="total" value="<?= $row['Countp'] * $row['Pricep'] ?>"><?= $row['Countp'] * $row['Pricep'] ?> </h6>
                    </td>
                    <input type="hidden" name="pid" value="<?= $row['IDp'] ?>">
                    <td><a href="cart.php?cart_id=<?= $row['IDcart'] ?>" class="text-muted text-decoration-non">X</a> </td>
                    <td><button type="submit" name="btn_update" class="text-muted text-decoration-non">UPDATE</button></td>
                </tr>
            </form>
        <?php
        }
        ?>
    </table>
    <hr class="pt-5">
    <?php
    $sqlSelect1 = "SELECT * FROM cart WHERE IDurs =?";
    $re = $dblink->prepare($sqlSelect1);
    $re->execute(array("$user_id"));
    if ($re->rowCount() > 0) {
    ?>
        <form action="receipt.php?" medthod="GET" id="addreceipt">
            <input class="buy" type="submit" class=" btnAdd btn btn-primary shop-button" name="btnBuy" value="BUY">
        </form>
    <?php
    }
    ?>
    <h6 class="mb-0"><a href="homepage.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>back to shop</a></h6>
</div>