<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
	header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$DBcon->close();

?>
    <?php
    include("config.php");
 
    if(isset($_POST['but_upload'])){
        
        $username = $userRow['username'];
        $email = $userRow['email'];
        $name = $_FILES['file']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
            
            // Convert to base64 
            $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

            // Insert record
            $query = "insert into images(name,image,username,email) values('".$name."','".$image."','".$username."','".$email."')";
           
            mysqli_query($con,$query) or die(mysqli_error($con));
            
            // Upload file
            move_uploaded_file($_FILES['file']['tmp_name'],'upload/'.$name);

        }
    
    }
?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Welcome -
                <?php echo $userRow['username']; ?>
            </title>

            <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
            <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">

            <link rel="stylesheet" href="style.css" type="text/css" />
        </head>

        <body>

            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
                        <a class="navbar-brand" href="#">Agri Doc</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; Welcome &nbsp; <?php echo $userRow['username']; ?></a></li>
                            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </nav>

            <div class="container" style="margin-top:150px;font-family:Verdana, Geneva, sans-serif;font-size:15px;">
                <h1 style="color:red;text-align:center;">Report a problem</h1>

                <br>
                <br>
                <form class="form-signin" method="post" action="" enctype='multipart/form-data'>

                    <div class="form-group">
                        <input class="form-control" type='file' name='file' />
                        <input type='submit' class="form-control" value='Upload Image' name='but_upload'>
                    </div>

                </form>

            </div>

        </body>

        </html>
