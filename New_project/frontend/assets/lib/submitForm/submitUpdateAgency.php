<?php
include "../../../config/connect.php";

if (isset($_POST['updatesub'])) {


    $folder = '../../img/logo/';
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
    $engnamein = $_POST["engnameupd"];
    $chinamein = $_POST["chinameupd"];
    $detailin = $_POST["th_upddetail"];
    $engdetailin = $_POST["eng_upddetail"];
    $chidetailin = $_POST["chi_upddetail"];
    if ($filename != null) {
        if ($_FILES['updateimage']["size"] < 20000000) {



            $image = addslashes(file_get_contents($_FILES['updateimage']['tmp_name']));

            move_uploaded_file($filetmp, $folder . $filename);


            // updatedata($agencid, $bdid, $floorin, $codein, $catid, $ownerin, $namein, $detailin, $filename,  $conn);
            updatedata($urlheader, $agencid, $bdid, $codein, $detailin, $engdetailin, $chidetailin, $floorin, $ownerin, $namein, $engnamein, $chinamein, $catid, $filename, $conn);
        }
    } else {
        updatedata($urlheader, $agencid, $bdid, $codein, $detailin, $engdetailin, $chidetailin, $floorin, $ownerin, $namein, $engnamein, $chinamein, $catid, '-', $conn);
        // if($oldimgname!=null){

        // }
        // $sql = "UPDATE agency_item SET code_place='$code', floor='$floor', owner='$owner', name='$name', bd_id='$bd', cat_id='$cat', detail='$detailin', LogoImgName='$imgname' WHERE id=$id";
    }
}




// function updatedata($id, $bd, $floor, $code, $cat, $owner, $name, $detailin, $imgname,  $connector)
function updatedata($urlheader, $id, $bd, $code, $detailin, $engdetailin, $chidetailin, $floor, $owner, $name, $engname, $chiname, $cat, $imgname,  /*$imgdata,*/ $connector)
{

    $sql = "UPDATE agency_item SET code_place='$code', floor='$floor', owner='$owner', name='$name', chi_name='$chiname' , eng_name='$engname', bd_id='$bd', cat_id='$cat', detail='$detailin',eng_detail='$engdetailin',chi_detail='$chidetailin', LogoImgName='$imgname'/*, LogoImg=*/ WHERE id=$id";

    if ($imgname == '-' || $imgname == null /*$imgdata == null*/) {
        $sql = "UPDATE agency_item SET code_place='$code', floor='$floor', owner='$owner', name='$name', chi_name='$chiname' , eng_name='$engname', bd_id='$bd', cat_id='$cat', detail='$detailin',eng_detail='$engdetailin',chi_detail='$chidetailin' WHERE id=$id";
    }
    // echo 'you are in';
    // $sql = "INSERT INTO agency_item (code_place, floor, owner,name,bd_id,cat_id,detail,LogoImgName,LogoImg)
    // VALUES ('$code', '$floor', '$owner','$name','$bd','$cat','$detailin','$imgname','$imgdata')";

    // $sql = "UPDATE agency_item SET code_place='$code', floor='$floor', owner='$owner',name='$name',bd_id=$bd,cat_id=$cat,detail=$detailin,LogoName=$imgname, WHERE id=$id";
    if (mysqli_query($connector, $sql)) {
        // echo "Record updated successfully";
        $url = $urlheader . "pages/catagory/index.php";
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