<?php
    require_once "../../includes/Connection.php";

    if(isset($_POST['id']) && !empty($_POST['id'])){
        $con = new Connection();
        $feedback = $con->getFeedback($_POST['id']);
        $con->setFeedbackViewed($_POST['id']);
        ?>
        <div class="row">
            <div class="col-sm-6">
                <p><b>Name:</b><span><?php echo $feedback->getName(); ?></span></p>
            </div>
            <div class="col-sm-6">
                <p><b>Time:</b><span><?php echo $feedback->getUploadDate(); ?></span></p>
            </div>
        </div>
        <div class="">
            <p><b>Email:</b><span><?php echo $feedback->getEmail(); ?></span></p>
        </div>
        <div class="">
            <p><b>Subject:</b><?php echo $feedback->getSubject(); ?></p>
        </div>
        <hr width="70%">
        <div class="">
            <span><?php echo $feedback->getMessage(); ?></span>
        </div>
    <?php
    } else {
        ?>
        <div class="row">
            <div class="col-12 text-grey p-5" style="font-size: 40px" align="center">
                Not Valid Message
            </div>
        </div>
        <?php
    }
    ?>