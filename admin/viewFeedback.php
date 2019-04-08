<?php
    require_once "../includes/config.php";
    include "../includes/Connection.php";
    session_start();
?>
<html lang="en">
	<head>
		<title><?php echo WEBSITE_NAME." - Admin Dashboard"; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="../images/logo.png" type="image/png" sizes="32x32">

        <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="../assets/bootstrap-social/bootstrap-social.css" rel="stylesheet" type="text/css">
        <link href="../assets/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="../assets/animate/animate.min.css" rel="stylesheet" type="text/css">
        <link href="assets/main.css" rel="stylesheet" type="text/css">

        <style type="text/css">
            .dropdown-toggle::after{
                display: none; !important;
            }
        </style>
    </head>
	<body>
        <?php include "includes/leftbar.php"; ?>

        <div id="right-panel" class="right-panel">
            <?php include "includes/header.php"; ?>
            <div class="container-fluid">
                <?php
                    $conn = new Connection();
                    /** @var Feedback[] $feedbacks */
                    $feedbacks = $conn->getFeedbackList();
                    if($feedbacks == null){
                        ?>
                        <div class="col-12 text-grey p-5" style="font-size: 40px" align="center">
                            No Feedbacks
                        </div>
                        <?php
                    } else {
                    $i=1;
                    ?>
                <div align="center"><i class="fas fa-comments fa-4x"></i></div><br>
                <table frame="box" class="table table-responsive-sm">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th scope="col">S.NO.</th>
                            <th scope="col">NAME</th>
                            <th scope="col">SUBJECT</th>
                            <th scope="col">DATE</th>
                            <th scope="col" colspan="2">OPERATIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($feedbacks as $feedback) {
                            ?>
                            <tr class="text-center<?php if(!$feedback->isViewed){echo ' bg-white';} ?>">
                                <td scope="col" class="text-center"><?php echo $feedback->isViewed?$i++:"<b>".$i++."</b>"; ?></td>
                                <td><?php echo $feedback->isViewed?$feedback->getName():"<b>".$feedback->getName()."</b>"; ?></td>
                                <td><?php echo $feedback->isViewed?$feedback->getSubject():"<b>".$feedback->getSubject()."</b>"; ?></td>
                                <td><?php echo $feedback->isViewed?$feedback->getUploadDate():"<b>".$feedback->getUploadDate()."</b>"; ?></td>
                                <td align="center">
                                    <a href="" onclick="viewMessage(<?php echo $feedback->getId(); ?>)" data-toggle="modal" data-target="#viewFeedbackModal" class="pr-3" title="Open Feedback" ><i class="fas fa-folder"></i></a>
                                    <a class="pl-3" href="functions/deleteFeedback.php?<?php echo "q=".$_SERVER['PHP_SELF']."&id=".$feedback->getId(); ?>" title="Delete Feedback"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="viewFeedbackModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title w-100 text-center"><b>Message</b></h4>
                        <button type="button" class="close" data-dismiss="modal" onclick="window.location.reload()">&times;</button>
                    </div>
                    <div class="container-fluid">
                        <div class="modal-body" id="msgContent">
                        </div>
                    </div>
                </div>
            </div>
        </div>

		<script src="../assets/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/popper/popper.min.js" type="text/javascript"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/fontawesome/js/fontawesome.min.js" type="text/javascript"></script>
        <script src="assets/main.js" type="text/javascript"></script>
        <script type="text/javascript">
            function viewMessage(fid){
                $('#msgContent').load("functions/viewMessage.php", {
                    id: fid
                });
            }
        </script>
	</body>
</html>

