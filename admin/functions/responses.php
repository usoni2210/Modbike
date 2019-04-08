<div id="sucess-alert" class="text-center" style="z-index: 10">
    <?php
        if(isset($_GET['w'])){
            echo "<div class='alert alert-warning'>
                    ".$_GET['w']."
                </div>";
        } else if (isset($_GET['s'])){
            echo "<div class='alert alert-success'>
                    ".$_GET['s']."
                </div>";
        } else if (isset($_GET['d'])){
            echo "<div class='alert alert-danger'>
                    ".$_GET['d']."
                </div>";
        }
    ?>
</div>