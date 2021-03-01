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
if (isset($_POST['updatesub'])) {
    $folder = '../../../img/logo/';
    $filename = $_FILES['updateimage']['name'];
    $filetmp = $_FILES['updateimage']['tmp_name'];
    // $checksize = getimagesize($filetmp);
    // $oldimgname = $_POST["imageshow"];
    $agencid = $_POST["agencid"];
    $bdid = $_POST["bdin"];
    $floorin = $_POST["floorin"];
    $codein = $_POST["codein"];
    $catid = $_POST["catin"];
    $ownerin = $_POST["ownerin"];
    $namein = $_POST["namein"];
    $detailin = $_POST["detailin"];
    if ($filename != null) {
        if ($_FILES['updateimage']["size"] < 20000000) {



            $image = addslashes(file_get_contents($_FILES['updateimage']['tmp_name']));

            move_uploaded_file($filetmp, $folder . $filename);


            // updatedata($agencid, $bdid, $floorin, $codein, $catid, $ownerin, $namein, $detailin, $filename,  $conn);
            updatedata($agencid, $bdid, $codein, $detailin, $floorin, $ownerin, $namein, $catid, $filename, $image, $conn);
        }
    } else {
        updatedata($agencid, $bdid, $codein, $detailin, $floorin, $ownerin, $namein, $catid, '-', null, $conn);
        // if($oldimgname!=null){

        // }
        // $sql = "UPDATE agency_item SET code_place='$code', floor='$floor', owner='$owner', name='$name', bd_id='$bd', cat_id='$cat', detail='$detailin', LogoImgName='$imgname' WHERE id=$id";
    }
}




// function updatedata($id, $bd, $floor, $code, $cat, $owner, $name, $detailin, $imgname,  $connector)
function updatedata($id, $bd, $code, $detailin, $floor, $owner, $name, $cat, $imgname,  $imgdata, $connector)
{
    // if()
    // echo 'you are in';
    // $sql = "INSERT INTO agency_item (code_place, floor, owner,name,bd_id,cat_id,detail,LogoImgName,LogoImg)
    // VALUES ('$code', '$floor', '$owner','$name','$bd','$cat','$detailin','$imgname','$imgdata')";

    // $sql = "UPDATE agency_item SET code_place='$code', floor='$floor', owner='$owner',name='$name',bd_id=$bd,cat_id=$cat,detail=$detailin,LogoName=$imgname, WHERE id=$id";
    $sql = "UPDATE agency_item SET code_place='$code', floor='$floor', owner='$owner', name='$name', bd_id='$bd', cat_id='$cat', detail='$detailin', LogoImgName='$imgname', LogoImg='$imgdata' WHERE id=$id";
    if (mysqli_query($connector, $sql)) {
        // echo "Record updated successfully";
        $url = "http://localhost/frontend/pages/catagory/index.html";
        // echo '<script language="javascript">';
        // echo 'alert("Record updated successfully")';
        // echo '</script>';

        echo "<script>window.location.href='$url'</script>";
        // echo "<script>window.close();</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connector);
    }
    mysqli_close($connector);
}
