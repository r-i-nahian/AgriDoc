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
            <form class="form-signin" method="post" action="upload.php" enctype='multipart/form-data'>

                <div class="form-group">


                    <input class="form-control" type="text" name="username" placeholder="Your Name">
                    <input class="form-control" type="text" name="report" placeholder="Write your problem"> Select image to upload:
                    <input class="form-control" type="file" name="image" />
                    <input type="submit" class="form-control" name="submit" value="UPLOAD" />
                </div>

            </form>

        </div>

    </body>

    </html>
