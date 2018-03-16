<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
	header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();


//$DBcon->close();

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
        <style>
            img {
                height: 300px;
                width: 400px;
            }

        </style>
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
                    <a class="navbar-brand" href="">AgriDoc</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li ><a href="home.php">Home</a></li>
                        <li class="active"><a href="agriculture.php">Agriculture</a></li>
                        <li ><a href="fish.php">Fish</a></li>
                        <li ><a href="animal.php">Animal</a></li>
                        <li><a href="../index.html">Main Site</a></li>


                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $userRow['username']; ?></a></li>
                        <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container" style="margin-top:150px;text-align:left;font-family:Verdana, Geneva, sans-serif;font-size:35px;">

            <h2 style="color:#97c950;text-align:center;">Report Data</h2>
            <br>

            <?php
            $query2 = $DBcon->query("SELECT * FROM images WHERE catagory=1");
            while($data=$query2->fetch_array()){
           echo "<h5> " . $data['created'] . "</h5><h3> Username :" . $data['username'] . "</h3><h3>Phone : ".$data['phone']."</h3><h3>Address : ".$data['address']."</h3><h3>Problem:</h3><p>". $data['report'] ."</p><img src=\"../user/view.php?id=".$data['id'] . " \"><br/><a href=\"../user/view.php?id=".$data['id'] ."\" target=\"_blank\">Click to view large Image</a><hr/>"; 
            
            }
            
        ?>

        </div>

        <img src="" alt="">

    </body>

    </html>
