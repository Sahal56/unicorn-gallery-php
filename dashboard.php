<?php
include_once("auth_session.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Gallery </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

    <link rel="stylesheet" href="CSS/gallery.css">


</head>

<body>
    <div class="container">
        <h3><b>UNICORN</b></h3>
        <div class="link">
            <a href='index.html'>
                <input type="button" class="home" value="HOME" name="submit" />
            </a>
            <a href='logout.php'>
                <input type="button" class="home" value="LOGOUT" name="submit" />
            </a>
        </div>
        <form action="upload.php" class="form-image-upload" method="POST" enctype="multipart/form-data">

            <!-- code to show error message -->
            <?php if (!empty($_SESSION['error'])) { ?>
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        <li><?php echo $_SESSION['error']; ?></li>
                    </ul>
                </div>
            <?php unset($_SESSION['error']);
            } ?>

            <!-- code to show success message  -->
            <?php if (!empty($_SESSION['success'])) { ?>
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong><?php echo $_SESSION['success']; ?></strong>
                </div>
            <?php unset($_SESSION['success']);
            } ?>

            <div class="row">
                <div class="col-md-5">
                    <strong>Title:</strong>
                    <input type="text" name="title" class="form-control" placeholder="Title">
                </div>
                <div class="col-md-5">
                    <strong>Image:</strong>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="col-md-2">
                    <br />
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </div>
        </form>


        <div class="row">
            <div class='list-group gallery' style="width:100%;">
                <?php
                require('db.php');
                include_once("auth_session.php");

                $sql = "SELECT * FROM `image_gallery`";
                $images = mysqli_query($con, $sql);


                while ($image = mysqli_fetch_assoc($images)) {

                ?>
                    <div class='col-sm-3' style="float: left;">

                        <a class="thumbnail fancybox" rel="ligthbox" href="uploads/<?php echo $image['image'] ?>">

                            <img alt="" src="uploads/<?php echo $image['image'] ?>" />
                            <div class='text-center'>
                                <small class='text-muted'><?php echo $image['title'] ?></small>
                            </div> <!-- text-center / end -->
                        </a>

                        <!-- form to delete image -->
                        <form action="delete.php" nane="delForm" method="POST">
                            <?php
                            $id = $image['id'];
                            ?>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <button type="submit" title="delete" value="submit" class="close-icon btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                        </form>

                    </div> <!-- col-6 / end -->
                <?php } ?>

            </div> <!-- list-group / end -->
        </div> <!-- row / end -->
    </div> <!-- container / end -->
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none",
        });
    });
</script>