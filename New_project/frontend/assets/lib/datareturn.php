<?php
    header('Content-Type: application/json');
    include("queryFactory.php");


    if(isset($_GET["i"])){
        switch($_GET["i"]){
            case 1:
                echo selectDataSQL("SELECT * FROM users WHERE id=1");
            break;
            case 2:
                echo selectDataSQL("SELECT * FROM event_type");
            break;
            case 3:
                echo '{"data":'.selectDataSQL("SELECT event.*,event_type.name FROM event
                    INNER JOIN event_type ON event.et_id=event_type.id WHERE show_status = 1")."}";
            break;
            case 4:
                echo selectDataSQL("SELECT * FROM form_config");
            break;
            case 5:
                $response = [
                    'status' => true,
                    'data' => [
                        'labels' => ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'], 
                        'data' => [125, 147,136, 142, 118, 180, 140, 176, 190, 220, 190, 220]
                    ],
                    'message' => 'OK'
                ];
                echo json_encode($response);
            break;
            case 6:
                echo '{"data":'.selectDataSQL("SELECT * FROM ip_address")."}";
            break;
            case 7:
                echo '{"data":'.selectDataSQL("SELECT agency_item.floor,agency_item.code_place,agency_item.owner,agency_item.name,agency_item.detail,building.name as bd_name,category.name as cat_name FROM agency_item 
                JOIN building ON building.id = agency_item.bd_id JOIN category ON category.id = agency_item.cat_id")."}";
            break;
            case 8:
                echo selectDataSQL("SELECT * FROM building");
            break;
            case 9:
                echo selectDataSQL("SELECT * FROM category");
            break;
        }
    }
    else if(isset($_POST["i"])){
        switch($_POST["i"]){
            case 103:
                $id = $_POST['id'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $pass = sha1(md5($pass));
                echo queryData("UPDATE users SET email = '$email',firstname ='$firstname', lastname = '$lastname', password='$pass' WHERE id='$id'");
            break;
            case 104:
                $email = $_POST['email'];
                $pass = $_POST['password'];
                echo checkUserPass($email,$pass);
            break;
            case 105:
                $email = $_POST['email'];
                $pass = $_POST['password'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $pass = sha1(md5($pass));
                echo queryDataLastID("INSERT INTO users (firstname,lastname,email,password) VALUE ('$firstname','$lastname','$email','$pass')");
                // echo checkData1field($email);
            break;
            case 106:
                $title = $_POST['title'];
                $event_type = $_POST['event_type'];
                $details = $_POST['details'];
                $id = queryDataLastID("INSERT INTO event (title,detail,et_id,show_status) VALUE ('$title','$details','$event_type',1)");
                echo $id;
                $last_id = json_decode($id,true);
                $data_pic = json_decode(upload_pic(),true);
                foreach($data_pic as $key=>$value) {
                    $e_id = $last_id['id'];
                    $nmae = $value['name'];
                    $gen_name = $value['gen_name'];
                    queryData("INSERT INTO picture (p_name,gen_p_name,e_id) VALUE ('$nmae','$gen_name',$e_id)");
                }
            break;
            case 107:
                $id = $_POST['id'];
                $data_video = json_decode(upload_video(),true);
                foreach($data_video as $key=>$value) {
                    $nmae = $value['name'];
                    $gen_name = $value['gen_name'];
                    queryData("INSERT INTO video (v_name,gen_v_name,e_id) VALUE ('$nmae','$gen_name','$id')");
                }
            break;
            case 108:
                $text = $_POST['text'];
                $f_size = $_POST['f_size'];
                $f_speed = $_POST['f_speed'];
                echo queryData("UPDATE form_config SET text='$text',f_size='$f_size',f_speed='$f_speed' WHERE id=1");
            break;
            case 109:
                $id = $_POST['id'];
                echo selectDataSQL("SELECT * FROM event WHERE id = $id");
            break;
            case 110:
                $id = $_POST['e_id'];
                // echo $id;
                // echo selectDataSQL("SELECT * FROM picture WHERE e_id = $id");
                $data = json_decode(selectDataSQL("SELECT * FROM picture WHERE e_id = $id"),true);
                foreach($data as $key=>$value){
                    $data[$key]['path'] = '../../picture/'.$value['gen_p_name'];
                    $data[$key]['size'] = filesize('../../picture/'.$value['gen_p_name']);;
                }
                echo json_encode($data);
            break;
            case 111:
                $id = $_POST['e_id'];
                $data = json_decode(selectDataSQL("SELECT * FROM video WHERE e_id = $id"),true);
                foreach($data as $key=>$value){
                    $data[$key]['path'] = '../../video/'.$value['gen_v_name'];
                    $data[$key]['size'] = filesize('../../video/'.$value['gen_v_name']);;
                }
                echo json_encode($data);
            break;
            case 112:
                $id = $_POST['id'];
                $title = $_POST['title'];
                $event_type = $_POST['event_type'];
                $detail = $_POST['details'];
                echo queryData("UPDATE event SET title ='$title', detail = '$detail', et_id='$event_type' WHERE id='$id'");
            break;
            case 113:
                $p_id = $_POST['p_id'];
                $data_pic = json_decode(upload_pic(),true);
                foreach($data_pic as $key=>$value) {
                    $nmae = $value['name'];
                    $gen_name = $value['gen_name'];
                    queryData("UPDATE picture SET p_name ='$nmae', gen_p_name = '$gen_name' WHERE p_id='$p_id'");
                }
                break;
            case 114:
                $v_id = $_POST['v_id'];
                $data_pic = json_decode(upload_video(),true);
                foreach($data_pic as $key=>$value) {
                    $nmae = $value['name'];
                    $gen_name = $value['gen_name'];
                    queryData("UPDATE video SET v_name ='$nmae', gen_v_name = '$gen_name' WHERE v_id='$v_id'");
                }
                break;
        }
    }


    
?>