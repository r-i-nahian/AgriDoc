<?php
if(isset($_POST["submit"])){
    $check = getimagesize($_FILES["image"]["tmp_name"]);
     
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));

        /*
         * Insert image data into database
         */
        
        //DB details
        $dbHost = 'localhost';
        $dbUsername = 'root';
        $dbPassword = 'root';
        $dbName = 'Agridoc';
        
        //Create connection and select DB
        $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
        
        // Check connection
        if($db->connect_error){
            die("Connection failed: " . $db->connect_error);
        }
        /*$link = mysqli_connect("localhost","root","root","testreport");
       $username = mysqli_real_escape_string($link, $_REQUEST['username']);
        $report = mysqli_real_escape_string($link, $_REQUEST['report']);
        $dataTime = date("Y-m-d H:i:s");*/
        
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $catagory = mysqli_real_escape_string($db, $_POST['catagory']);
$report = mysqli_real_escape_string($db, $_POST['report']);
$dataTime = date("Y-m-d H:i:s");
        
        //Insert image content into database
        $insert = $db->query("INSERT into images (username,report,image, created,catagory) VALUES ('$username','$report','$imgContent', '$dataTime','$catagory')");
        if($insert){
            echo "<h1>File uploaded successfully.</h1><br><a href=\"home.php\">  Submit Another Report </a><br><a href=\"../index.html\">  Home </a>";
        }else{
            echo "File upload failed, please try again.";
        } 
    }else{
        echo "Please select an image file to upload.";
    }
}
?>
