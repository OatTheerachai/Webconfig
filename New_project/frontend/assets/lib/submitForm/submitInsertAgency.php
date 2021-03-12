<?php
include "../../../config/connect.php";

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
    $engnamein = $_POST["engnameins"];
    $chinamein = $_POST["chinameins"];
    $detailin = $_POST["detailins"];
    $engdetailin = $_POST["eng_insdetail"];
    $chidetailin = $_POST["chi_insdetail"];


    $folder = '../../img/logo/';

    $filename = $_FILES['uploadfile']['name'];
    $filetmpname = $_FILES['uploadfile']['tmp_name'];
    if ($filename != null) {
        /////////////for contain img to db/////////////
        // $image = addslashes(file_get_contents($_FILES['uploadfile']['tmp_name']));
        /////////////for move img to folder/////////////
        move_uploaded_file($filetmpname, $folder . $filename);
        // $sql = "INSERT INTO uploadedImage (name,image) VALUES ('$filename','{$imagedata}')";

        insertdata($urlheader, $bdid, $floorin, $codein, $catid, $ownerin, $namein, $engnamein, $chinamein, $detailin, $engdetailin, $chidetailin, $filename, /*$image,*/ $conn);
        // $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
    } else {
        insertdata($urlheader, $bdid, $floorin, $codein, $catid, $ownerin, $namein, $engnamein, $chinamein, $detailin, $engdetailin, $chidetailin, "-", /*null,*/ $conn);
    }
}


function insertdata($urlheader, $bd, $floor, $code, $cat, $owner, $name, $engname, $chiname, $detailin, $engdetailin, $chidetailin, $imgname, /*$imgdata,*/ $connector)
{


    $sql = "INSERT INTO agency_item (code_place, floor, owner,name,eng_name,chi_name,bd_id,cat_id,detail,eng_detail,chi_detail,LogoImgName/*,LogoImg*/)
    VALUES ('$code', '$floor', '$owner','$name','$engname','$chiname','$bd','$cat','$detailin','$engdetailin','$chidetailin','$imgname')";

    if ($floor == null) {
        $sql = "INSERT INTO agency_item (code_place, floor, owner,name,eng_name,chi_name,bd_id,cat_id,detail,eng_detail,chi_detail,LogoImgName/*,LogoImg*/)
    VALUES ('$code', NULL , '$owner','$name','$engname','$chiname','$bd','$cat','$detailin','$engdetailin','$chidetailin','$imgname')";
    }


    if (mysqli_query($connector, $sql)) {
        $url = $urlheader . "pages/catagory/index.php";
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
