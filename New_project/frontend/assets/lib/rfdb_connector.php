<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";


$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($conn, 'utf8');

if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
}

$id = $_POST["id"];




switch ($id) {
        //get category (data also)
    case 1:
        $catid = $_POST["catid"];
        $build_id = $_POST["build_id"];
        // $cat3id = $_POST["cat3id"];
        if ($catid == null && $build_id == null) {
            $sql = "SELECT * FROM category";
            $sqlbuild = "SELECT * FROM building";
            $sqlfdata = "SELECT id,bd_id,code_place,floor,cat_id,owner,name,eng_name,chi_name,detail,eng_detail,chi_detail,LogoImgName FROM agency_item";
            // $dataresult = mysqli_query($conn, $sql);
            // $myArray = array();
            // // $json

            // while ($row = mysqli_fetch_array($dataresult, MYSQLI_ASSOC)) {
            //     $myArray[] = $row;
            // };
            // echo json_encode($myArray);
            // echo "----------";

            // echo getdata($sqlfdata, $conn);

            // mysqli_free_result($dataresult);
            echo getdata($sql, $conn);
            echo "----------";
            echo getdata($sqlfdata, $conn);
            // echo "helloworld";
            echo "----------";
            echo getdata($sqlbuild, $conn);


            mysqli_close($conn);
        } else if ($catid != null && $build_id == null) {
            $sqlfcat = "SELECT bd_id  FROM agency_item WHERE cat_id=$catid";
            $sqlfdata = "SELECT id,bd_id,code_place,floor,cat_id,owner,name,eng_name,chi_name,detail,eng_detail,chi_detail,LogoImgName FROM agency_item WHERE cat_id=$catid";

            $headerfsqlcat = "SELECT * FROM building WHERE id IN ";

            $query = json_decode(getdata($sqlfcat, $conn), true);

            // echo print_r($query);
            $arrtmp = [];
            for ($i = 0; $i < count($query); $i++) {
                array_push($arrtmp, $query[$i]['bd_id']);
            }
            // echo print($arrtmp);
            $extendsql = implode(",", $arrtmp);
            // echo $extendsql[0];
            $headerfsqlcat .= "($extendsql)";

            // echo $headerfsqlcat;

            echo getdata($headerfsqlcat, $conn);


            echo "----------";
            echo getdata($sqlfdata, $conn);


            mysqli_close($conn);
        } else if ($catid == null && $build_id != null) {
            $sql = "SELECT id,bd_id,code_place,floor,cat_id,owner,name,eng_name,chi_name,detail,eng_detail,chi_detail,LogoImgName FROM agency_item WHERE bd_id='$build_id'";
            echo "----------";
            echo getdata($sql, $conn);
        } else if ($catid != '' && $build_id != '') {
            $sql = "SELECT id,bd_id,code_place,floor,cat_id,owner,name,eng_name,chi_name,detail,eng_detail,chi_detail,LogoImgName FROM agency_item WHERE cat_id='$catid' AND bd_id='$build_id'";
            $emptyjson = json_encode(array());
            echo $emptyjson;
            echo "----------";
            echo getdata($sql, $conn);
        }


        break;


        //add/insert
    case 2:


        $addbdin = $_POST["addbdin"];
        $bdid = $_POST["bdid"];
        $floorin = $_POST["floorin"];
        $codein = $_POST["codein"];
        $catid = $_POST["catid"];
        $ownerin = $_POST["ownerin"];
        $namein = $_POST["namein"];
        $detailin = $_POST["detailin"];




        if ($addbdin != '') {


            $checkbdsql = "SELECT * FROM building WHERE name = '$addbdin'";

            $result = json_decode(getdata($checkbdsql, $conn));
            // echo $result;
            // echo gettype($result);

            if (count($result) > 0) {
                echo "already in db";
            } else {
                $insertsql = "INSERT INTO building (name) VALUES ('$addbdin')";
                mysqli_query($conn, $insertsql);
                echo "insert building complete";
            }

            mysqli_close($conn);
        } else if (
            $bdid != '' &&
            $floorin != '' &&
            $codein != '' &&
            $catid != '' &&
            $ownerin != '' &&
            $namein != '' &&
            $detailin != ''
        ) {
            // echo "testpass";

            $filename = "testimg";
            insertdata(
                $bdid,
                $floorin,
                $codein,
                $catid,
                $ownerin,
                $namein,
                $detailin,
                $conn,
                $filename,
                $image
            );
        } else {
            $bdsql = "SELECT * FROM building";
            echo getdata($bdsql, $conn);
        }

        break;

        //delete building
    case 3:
        if (isset($_POST["build_id"])) {
            $bdid = $_POST["build_id"];
            $delsql = "DELETE FROM building WHERE id='$bdid'";
            $getbdname = "SELECT name FROM building WHERE id='$bdid'";
            $selecteddata = getdata($getbdname, $conn);
            mysqli_query($conn, $delsql);
            echo $selecteddata;

            mysqli_close($conn);

            break;
        } else if (isset($_POST["agencid"])) {
            $targetid = $_POST["agencid"];
            $delsql = "DELETE FROM agency_item WHERE id='$targetid'";
            // $getagencname = "SELECT name FROM building WHERE id='$bdid'";
            mysqli_query($conn, $delsql);
            mysqli_close($conn);
            break;
        }

        break;
        // else if(isset)

        ///////deleteonlyimage///////
        case 4:
            $targetid = $_POST["agencid"];
            if (isset($_POST["imgname"])) {
                $imgname = $_POST["imgname"];
                $delsql = "UPDATE agency_item SET LogoImgName = '-' /*, LogoImg = null WHERE id = */";
                mysqli_query($conn, $delsql);
                mysqli_close($conn);
                $imgpath = "../img/logo/" . $imgname;
    
                if (unlink($imgpath)) {
                }
            }
    
            break;
}

function getdata($sql, $connector)
{
    $dataresult = mysqli_query($connector, $sql);
    $dataArray = array();
    if ($dataresult != false) {
        while ($datarow = mysqli_fetch_array($dataresult, MYSQLI_ASSOC)) {
            // $i = 0;
            $dataArray[] = $datarow;
            // array_push($dataArray[$i], $datarow["id"], $datarow["name"]);
            // $i++;
        };
    }

    return json_encode($dataArray);
    mysqli_free_result($dataresult);
    mysqli_close($connector);
}
function insertdata($bd, $floor, $code, $cat, $owner, $name, $detailin, $connector, $imgname, $imgdata)
{
    $sql = "INSERT INTO agency_item (code_place, floor, owner,name,bd_id,cat_id,detail,LogoName,LogoImg)
    VALUES ('$code', '$floor', '$owner','$name','$bd','$cat','$detailin','$imgname','$imgdata')";

    if (mysqli_query($connector, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connector);
        mysqli_close($connector);
    }
}
