<?php
    session_start();
    require_once "includes/Connection.php";
    require_once "includes/class/Shop.php";
?>
<div class="row">
    <?php
        if(isset($_POST['location']) && !empty($_POST['location'])) {
            $conn = new Connection();

            /** @var Shop[] $list */
            $list = $conn->getShopList($_POST['location']);
            if($list != null) {
                foreach ($list as $shop) { ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 mt-2 mb-2">
                        <div class="info-card">
                            <img class="w-100" src="images/shop/<?php echo $shop->getImage(); ?>" alt="image"/>
                            <div class="info-card-details animate">
                                <div class="info-card-header">
                                    <h1><?php echo $shop->getName(); ?></h1>
                                </div>
                                <div class="info-card-detail">
                                    <table align="center" cellpadding="8px">
                                        <tr>
                                            <th>Owner</th>
                                            <td><?php echo $shop->getOwner(); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Contact No</th>
                                            <td><?php echo $shop->getPhone(); ?></td>
                                        </tr>
                                        <tr>
                                            <th valign="top">Address</th>
                                            <td>
                                                <?php echo $shop->getAddrFline().",<br>".
                                                    $shop->getAddrSline().",<br/>".
                                                    $shop->getCity().", ".$shop->getState().",<br/>".
                                                    "Pin : ".$shop->getPinCode(); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            }else {
            ?>
                <div class="col-12 text-white p-5" style="font-size: 40px" align="center">
                    No Shop Found Near You
                </div>
            <?php
            }
        }
    ?>
</div>