<?php
    session_start();
    header('Content-Type: application/json');

    function checkUserPass($email,$pass){
        include("../../config/connect.php");
        $pass = sha1(md5($pass));
        $result = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users where email='$email' and password='$pass'"));
        if($result > 0){
            $_SESSION['email'] = $email;
            mysqli_query($conn,"UPDATE users set last_login=NOW() where email='$email'");
            mysqli_close($conn);
            return true; 
        }
        else{
            return '{"data":"Failed"}';
        }
    }

    function checkData1field($values){
        include("../../config/connect.php");
        $result = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE email='$values'"));
        if($result > 0){
            return FALSE; 
        }
        else
            return TRUE;
    }

    function selectDataSQL($command){
        include("../../config/connect.php");
        $sql = $command;
        $query = mysqli_query($conn,$sql);
        if (!$query) {
                printf("Error: %s\n", $conn->error);
                exit();
        }
        $resultArray = array();
        while($result = mysqli_fetch_array($query,MYSQLI_ASSOC))
        {
            array_push($resultArray,$result);
        }
        mysqli_close($conn);
        return json_encode($resultArray);
    } 

    function queryData($values){
        include("../../config/connect.php");
        if($conn->query("$values;")){
            return '{"data":"Success"}';
        }else{
            return '{"data":"Failed"}';
        }
    }

    function queryDataLastID($values){
        include("../../config/connect.php");
        if($conn->query("$values;")){
            $last_id = $conn->insert_id;
            return '{"id":'.json_encode($last_id).'}';
        }else{
            return '{"data":"Failed"}';
        }
    }

    function upload_pic() {
        $count = count($_FILES['file']['name']);
        $uniqid = uniqid(rand(), true);
        $postfix = date('Y-m-d') . '_' . $uniqid . '_';

        $log_name = array();
        $pic = array();
        for($i = 0; $i< $count; $i++){
            $name = $_FILES['file']['name'][$i];
            $file_name = $postfix.$_FILES['file']['name'][$i];
            $target_dir = "../../picture/";
            $target_file = $target_dir . $file_name;
            if($_FILES['file']['size'][$i] != 0){
                move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_file);
                $log_name[$i]['name'] = $name;
                $log_name[$i]['gen_name'] = $file_name;
            }
        }
        return json_encode($log_name);
    }

    function upload_video() {
        $count = count($_FILES['video']['name']);
        $uniqid = uniqid(rand(), true);
        $postfix = date('Y-m-d') . '_' . $uniqid . '_';

        $log_name = array();

        for($i = 0; $i< $count; $i++){
            $name = $_FILES['video']['name'][$i];
            $file_name = $postfix.$_FILES['video']['name'][$i];
            $target_dir = "../../video/";
            $target_file = $target_dir . $file_name;
            if($_FILES['video']['size'][$i] != 0){
                move_uploaded_file($_FILES['video']['tmp_name'][$i], $target_file);
                $log_name[$i]['name'] = $name;
                $log_name[$i]['gen_name'] = $file_name;
            }
        }
        return json_encode($log_name);
    }

?>