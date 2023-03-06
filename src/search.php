<?php
require_once 'header.php';
?>

<style>
        img.card-img-top{
            width: 80%;
        }
        div.card-search{
            margin-top: 50px;
            padding-left: 50px;
        }
        h2.h2{
            padding-left: 50px;
        }

    </style>
<h2 class="h2 mt-5">Result for: <?=$_GET['search'] ??'' ?></h2>
<div class="row">
    <?php
    include_once 'connectju.php';
    $c = new connectju();
    $dblink = $c->connectToPDO();
    $Name = $_GET['search'] ??'';
    $sql = "SELECT *FROM product WHERE Namep LIKE ?";
    $re = $dblink->prepare($sql);
    $re->bindParam(":Namep", $Name, PDO::PARAM_STR);
    $re->execute(array("%$Name%"));
    $rows = $re->fetchAll(PDO::FETCH_BOTH);
    foreach ($rows as $r) :
    ?>
        <div class="col-12 col-md-4 pb-3">
            <div class="card-search">
                <div class="img-search"><img src="../image/<?= $r['Image']?>" class="card-img-top" alt="Product1>"/></div>
                <div class="card-body">
                    <a href="detailed.php?id=<?=$r['IDp']?>" class="text-decoration-none">
                        <h5 class="card-title">
                            <?= $r['Namep'] ?>
                        </h5>
                    </a>
                    <h6 class="card-subtitle mb-2 text-muted">$<?= $r['Pricep']?></h6>
                </div>
            </div>
        </div>
    <?php
    endforeach;
    ?>
</div>