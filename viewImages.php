<?php
    session_start();
    require_once "includes/Connection.php";

    $con = new Connection();
    $maxPage = $con->imageMaxPage();

    if(!isset($_GET['page']) || empty($_GET['page']))
        $page = 1;
    else if($_GET['page'] > $maxPage || !ctype_digit($_GET['page']))
        header("location:/error.php");
    else
        $page = $_GET['page'];
?>

<html lang="en">
	<head>
        <title><?php echo WEBSITE_NAME." - Modified Bikes"; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="images/logo.png" type="image/png" sizes="32x32">

        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="assets/bootstrap-social/bootstrap-social.css" rel="stylesheet" type="text/css">
        <link href="assets/fancybox/dist/jquery.fancybox.min.css" rel="stylesheet" type="text/css">
        <link href="assets/main.css" rel="stylesheet" type="text/css">

        <style type="text/css">
            .dropdown-toggle::after{
                display: none; !important;
            }
        </style>
    </head>
	<body class="">
        <?php require_once "includes/header.php"?><br><br>
        <div class="container-fluid p-5" style="min-height: 56.2%">
            <?php
                /** @var Image[] $images */
                $images = $con->getImages($page);
                if($images == null){
                    echo "<div class='col-12 text-center p-5' style='font-size: 3vw;'>No Images Found</div>";
                } else {
                    ?>
                    <div class="row">
                        <?php
                        foreach ($images as $image){
                            ?>
                            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                <a href="images/modifiedBikes/<?php echo $image->getFileName(); ?>" class="fancybox" rel="ligthbox">
                                    <img src="images/modifiedBikes/thumb/<?php echo $image->getFileName(); ?>" class="zoom img-fluid"  alt="Image 1">
                                       <div class="text-block text-right">
                                        <span><?php echo $image->getName(); ?></span><br>
                                        <span><?php echo $image->getEmail(); ?></span>
                                    </div>
                                </a>
                            </div>
                            <?php
                        } ?>
                    </div><br>
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?php if($page == 1 ) {echo "disabled";} ?>">
                                <a class="page-link" href="<?php echo "?page=".($page-1); ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <?php for($i=1; $i<=$maxPage; $i++) { ?>
                                <li class="page-item <?php if($i==$page){echo "active";} ?>">
                                    <a class="page-link" href="<?php echo "?page=$i"; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="page-item <?php if($page == $maxPage ) {echo "disabled";} ?>">
                                <a class="page-link" href="<?php echo "?page=".($page+1); ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav><?php
                }
            ?>
        </div>

        <div class="pt-2 text-center">
            To Upload your image
            <span style="cursor: pointer;" data-toggle="modal" data-target="#uploadImageModal">
                    click here
                </span>
        </div><br>
        <?php require_once "includes/footer.php"?>

        <!-- Upload Modified Bike Image Modal -->
        <div class="modal fade" id="uploadImageModal" role="dialog">
            <div class="modal-dialog" style="top: 10%;">
                <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                        <h3>Upload Your Bike Image</h3>
                        <button type="button" class="close float-right" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
                        <form role="form" method="post" action="uploadImage.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="email"><span class="glyphicon glyphicon-user"></span> Email</label>
                                <input type="text" class="form-control" id="email" size="80" maxlength="80" pattern="\\b[A-Z0-9._%-]+@[A-Z0-9.-]+\\.[A-Z]{2,4}\\b" title="Please Enter the Correct Email" placeholder="Enter email" name="email" required>
                            </div>
                            <div class="form-group">
                                <span class="glyphicon glyphicon-eye-open"></span> File To Upload
                                <input type="file" class="form-control p-1" id="file" name="image" onchange="return fileValidate()" accept="image/png,image/jpeg,image/jpg,/image/gif">
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="private"> Keep My Email ID Private</label>
                            </div>
                            <br>
                            <input type="hidden" name="q" value="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <button type="submit" class="btn bg-black text-white btn-block" name="upload" value="ok"><span class="fas fa-upload"></span> Upload</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <script src="assets/jquery.min.js" type="text/javascript"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/fontawesome/js/fontawesome.min.js" type="text/javascript"></script>
        <script src="assets/fancybox/dist/jquery.fancybox.min.js" type="text/javascript"></script>
        <script src="assets/main.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".fancybox").fancybox({
                    openEffect: "none",
                    closeEffect: "none",
                    width:1200,
                    autoSize:false
                });

                $(".zoom").hover(function(){
                    $(this).addClass('transition');
                }, function(){
                    $(this).removeClass('transition');
                });
            });

            function fileValidate() {
                let fileInput = document.getElementById('file');
                let filePath = fileInput.value;
                let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
                if(!allowedExtensions.exec(filePath)){
                    alert('Please upload file having  extension .jpg / .jpeg / .png / .gif only');
                    fileInput.value="";
                    return false;
                }else
                {
                    //image preview
                    if(fileInput.files && fileInput.files(0)){
                        var reader =new FileReader();
                        reader.onload=function (e) {
                            document.getElementById("imagePreview").innerHTML ='<img src="' +e.target.result+   '"/>';
                        };
                        reader.readAsDataURL(fileInput.files(0));

                    }
                }
            }
        </script>
	</body>
</html>