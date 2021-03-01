<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "WebConfig";


$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($conn, 'utf8');

if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
}

if (isset($_POST['uploadfilesub'])) {
    // $checksize = getimagesize()
    $bdid = $_POST["bdins"];
    $floorin = $_POST["floorins"];
    if ($floorin == "") {
        $floorin = null;
    }
    $codein = $_POST["codeins"];
    $catid = $_POST["catins"];
    $ownerin = $_POST["ownerins"];
    $namein = $_POST["nameins"];
    $detailin = $_POST["detailins"];

    $folder = 'server/image/';

    $filename = $_FILES['uploadfile']['name'];
    $filetmpname = $_FILES['uploadfile']['tmp_name'];
    if ($filename != null) {
        /////////////for contain img to db/////////////
        $image = addslashes(file_get_contents($_FILES['uploadfile']['tmp_name']));
        /////////////for move img to folder/////////////
        move_uploaded_file($filetmpname, $folder . $filename);
        // $sql = "INSERT INTO uploadedImage (name,image) VALUES ('$filename','{$imagedata}')";

        insertdata($bdid, $floorin, $codein, $catid, $ownerin, $namein, $detailin, $filename, $image, $conn);
        // $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
    } else {
        insertdata($bdid, $floorin, $codein, $catid, $ownerin, $namein, $detailin, "-", null, $conn);
    }
}


function insertdata($bd, $floor, $code, $cat, $owner, $name, $detailin, $imgname, $imgdata, $connector)
{
    $sql = "INSERT INTO agency_item (code_place, floor, owner,name,bd_id,cat_id,detail,LogoImgName,LogoImg)
    VALUES ('$code', '$floor', '$owner','$name','$bd','$cat','$detailin','$imgname','$imgdata')";

    if ($floor == null) {
        $sql = "INSERT INTO agency_item (code_place, floor, owner,name,bd_id,cat_id,detail,LogoImgName,LogoImg)
    VALUES ('$code', NULL , '$owner','$name','$bd','$cat','$detailin','$imgname','$imgdata')";
    }


    if (mysqli_query($connector, $sql)) {
        $url = "http://localhost/frontend/pages/catagory/index.html";
        // echo '<script language="javascript">';
        // echo 'alert("New record created successfully")';
        // echo '</script>';

        echo "<script>window.location.href='$url'</script>";
        // echo "<script>window.close();</script>";
        mysqli_close($connector);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connector);
        mysqli_close($connector);
    }
}
