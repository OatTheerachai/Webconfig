<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Category</title>

  <!-- stylesheet -->
  <link rel="stylesheet" href="../../assets/vendor/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/vendor/plugins/bootstrap-toggle/bootstrap-toggle.min.css">
  <link rel="stylesheet" href="../../assets/vendor/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="../../assets/vendor/plugins/@sweetalert2/theme-bootstrap-4/bootstrap-4.css">
  <link rel="stylesheet" href="../../assets/vendor/plugins/summernote/summernote-bs4.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">

</head>
<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        <!-- include Sidebar -->
        <div id="sidebar"></div>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h5 class="m-0 text-dark">เพิ่มข้อมูล</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title" style="line-height: 2.1rem;">เพิ่มผู้ดูแล</h3>
                                    <a href="index.html" class="btn btn-warning float-right">กลับ</a>
                                </div>
                                <form id="formData">
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label for="building">อาคาร</label>
                                                <select class="form-control" name="building" id="building" required>
                                                    <option value disabled selected>เลือกอาคาร</option>
                                                </select>
                                                <!-- <input type="text" class="form-control" name="first_name" id="first_name" placeholder="ชื่อจริง" required> -->
                                            </div>

                                            <div class="form-group col-sm-6">
                                                <label for="floor">ชั้น</label>
                                                <select class="form-control" name="floor" id="floor" required>
                                                    <option value disabled selected>เลือกอาคาร</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-sm-6">
                                                <label for="owner">ชื่อผู้เช่า</label>
                                                <input type="text" class="form-control" name="owner" id="owner" placeholder="ชื่อผู้เช่า" required>
                                            </div>
    
                                            <div class="form-group col-sm-6">
                                                <label for="name">ชื่อพื้นที่</label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อพื้นที่" required>
                                            </div>

                                            <div class="form-group col-sm-6">
                                                <label for="Category">ประเภท</label>
                                                <select class="form-control" name="Category" id="Category" required>
                                                    <option value disabled selected>เลือกประเภท</option>
                                                </select>
                                                <!-- <input type="text" class="form-control" name="first_name" id="first_name" placeholder="ชื่อจริง" required> -->
                                            </div>

                                            <div class="form-group col-sm-6">
                                                <label for="name">รหัสสถานที่</label>
                                                <input type="text" class="form-control" name="code_place" id="code_place" placeholder="รหัสสถานที่" required>
                                            </div>

                                            
                                            <div class="form-group col-sm-12">
                                                <label for="name">รายละเอียด</label>
                                                <input type="text" class="form-control" name="detail" id="detail" placeholder="รายละเอียด" required>
                                            </div>

                                            <div class="form-group col-sm-6">
                                                <label for="customFile">รูปโปรไฟล์ 
                                                    <span style="color: red;">
                                                    (สามารถอัพโหลดได้ไม่เกิน 1 รูปภาพ)
                                                    </span>
                                                </label>
                                                    <div class="dropzone" id="mydropzone">
                                                    </div>
                                            </div>
    
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-block" name="submit">บันทึกข้อมูล</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- SCRIPTS -->
<script src="../../assets/vendor/plugins/jquery/jquery.min.js"></script>
<script src="../../assets/vendor/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/vendor/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="../../assets/js/hamburger/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
<!-- Summernote -->
<script src="../../assets/vendor/plugins/summernote/summernote-bs4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>

<script src="../../assets/js/catagory/form_create.js"></script>
<script>
    // $("#sidebar").load("../include/sidebar.html"); 

    $(document).ready(function(){
        $("#sidebar").load("../include/sidebar.html"); 
        // $('#formData').on('submit', function (e) {
        //     // e.preventDefault();
        //     // console.log($('#formData').serialize());
        //     $.post("../../assets/lib/datareturn.php", {
        //         i: 101,
        //         building: $('#building').val(),
        //         floor: $('#floor').val(),
        //         owner: $('#owner').val(),
        //         name: $('#name').val(),
        //         }).done(function(resp) {
        //             if(resp == "Success"){
        //                 Swal.fire({
        //                 text: 'เพิ่มข้อมูลเรียบร้อย',
        //                 icon: 'success',
        //                 confirmButtonText: 'ตกลง',
        //             }).then((result) => {
        //                 location.assign('index.html');
        //             });
        //             }
        //             else {
        //                 swal({
        //                     title: 'ERROR',
        //                     text: 'ไม่สามารถเพิ่มข้อมูลได้',
        //                     confirmButtonText: "OK",
        //                     type: 'error'
        //                 });
        //             }

        //     })
        // });
    });
</script>
</body>
</html>
