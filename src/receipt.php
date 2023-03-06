<?php
require_once 'header.php';
include_once("connectju.php");
$c = new connectju();
$dblink = $c->connectToPDO();
if (isset($_GET['btnBuy'])) {
    $user_id = $_SESSION['user_id'];
    $sqlSelect1 = "SELECT  SUM(Countp * Pricep) as sum FROM product p, cart c WHERE IDurs =? and c.IDp = p.IDp ";
    $re = $dblink->prepare($sqlSelect1);
    $re->execute(array("$user_id"));
    $row = $re->fetch(PDO::FETCH_BOTH);
    $total = $row['0'];
    $query = "INSERT INTO `receipt`(`IDurs`, Total, `Date`) VALUES (?,?,?)";
    $re = $dblink->prepare($query);
    $re->execute(array("$user_id", $total, date("y.m.d")));

    $sqlSelect1 = "SELECT max(IDre) as max from receipt";
    $re = $dblink->prepare($sqlSelect1);
    $re->execute(array());
    $row = $re->fetch(PDO::FETCH_BOTH);

    $bid = $row[0];
    $sqlSelect1 = "SELECT * FROM cart WHERE IDurs =? ";
    $re = $dblink->prepare($sqlSelect1);
    $re->execute(array("$user_id"));
    $rows = $re->fetchAll(PDO::FETCH_BOTH);
    if ($re->rowCount() > 0) {
        foreach ($rows as $r) {
            $pid = $r['IDp'];
            $query = "INSERT INTO `detailed_receipt`(`IDre`, `IDp`) VALUES(?,?)";
            $re = $dblink->prepare($query);
            $re->execute(array($bid, "$pid"));
            $cart_del = $_GET['del_id'];
            $query_del = "DELETE FROM cart WHERE IDcart=?";
            $stmt_del = $dblink->prepare($query_del);
            $stmt_del->execute(array($cart_del));
        }
        header('location: receipt.php');
    }
}
?>

<style>
    h1.fw-bold {
        text-align: center;
        margin-top: 30px;
    }

    h6.mb-0 {
        justify-content: center;
        text-align: center;
        font-size: 20px;
        margin-top: 20px;
    }

    .line {
        border-bottom: 1px solid #ccc;
        margin-bottom: 12px;
    }
</style>
<?php
$sqlSelect2 = "SELECT * FROM receipt WHERE IDurs=?";
$stmt1 = $dblink->prepare($sqlSelect2);
$stmt1->execute(array($_SESSION['user']['IDurs']));
$rows = $stmt1->fetchAll(PDO::FETCH_BOTH);
$usrName = $_SESSION['user']['Nameurs'] ?? "";
$usrPhone = $_SESSION['user']['Phone'] ?? "";
$usrEmail = $_SESSION['user']['Email'] ?? "";
$usrAddress = $_SESSION['user']['Address'] ?? "";
?>
<h1 class="fw-bold mb-0 text-black">Detail Receipt</h1>
<div class="receipt card-body">
    <?php
    foreach ($rows as $row) {
    ?>
        <div class="">
            <div>
                <h6 class="mb-0" id="">Name Users: <?= $usrName ?></h6>
            </div>
            <div>
                <h6 class="mb-0" id="">Phone Users: <?= $usrPhone ?></h6>
            </div>
            <div>
                <h6 class="mb-0" id="">Email Users: <?= $usrEmail ?></h6>
            </div>
            <div>
                <h6 class="mb-0" id="">Address Users: <?= $usrAddress ?></h6>
            </div>
            <?php
            $sqlSelect3 = "SELECT * FROM `detailed_receipt` as d, product as p WHERE  d.IDp = p.IDp and IDre=?";
            $stmt1 = $dblink->prepare($sqlSelect3);
            $stmt1->execute(array($row['IDre']));
            $re = $stmt1->fetchAll(PDO::FETCH_BOTH);
            foreach ($re as $r) :
            ?>
                <div>
                    <h6 class="mb-0" id="">Name Product: <?= $r['Namep'] ?></h6>
                </div>
        </div>
    <?php

            endforeach;
    ?>
    <div>
        <h6 class="mb-0">Total: <?= $row['Total'] ?></h6>
    </div>
    <div>
        <h6 class="mb-0 line" id="">Date: <?= $row['Date'] ?></h6>
    </div>
<?php
    }

?>
</div>
<h6 class="mb-0"><a href="homepage.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>back to
        shop</a></h6>