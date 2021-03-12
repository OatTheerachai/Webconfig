<?php 
    include_once('../../authen.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Report</title>

  <!-- stylesheet -->
  <link rel="stylesheet" href="../../assets/vendor/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
  <link rel="stylesheet" href="../../assets/css/report/report.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/vendor/plugins/bootstrap-toggle/bootstrap-toggle.min.css">
  <link rel="stylesheet" href="../../assets/vendor/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="../../assets/vendor/plugins/@sweetalert2/theme-bootstrap-4/bootstrap-4.css">

  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  
  
  <!-- <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" /> -->
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">

    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css"> -->

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    

    <!-- Header Content -->
    <div class="wrapper">
        <!-- include Sidebar -->
        <?php include_once('../include/sidebar.php') ?>
        <!-- <div id="sidebar"></div> -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h5 class="m-0 text-dark">Report Event</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content  One-->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- <div class="card-header"> -->
                                    <!-- <h3 class="card-title" style="line-height: 2.1rem">Report Event</h3> -->
                                    <!-- <h3></h3>
                                </div> -->
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-sm-5">
                                            <input class="form-control" type="text" placeholder="วันที่" id="start_date" autocomplete="off"/>
                                        </div>

                                        <div class="form-group d-flex align-items-center">
                                            <span>ถึง</span>
                                        </div>

                                        <div class="form-group col-sm-5">
                                            <input class="form-control" type="text" placeholder="วันที่" id="end_date" autocomplete="off"/>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content Two-->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <!-- <h3 class="card-title" style="line-height: 2.1rem">Report Event</h3> -->
                                    <!-- <input class="col-2 form-control float-left" type="date" id="date"> -->
                                    <div id="excel" class="float-right"></div>
                                    <div id="search_cat" class="float-left"></div>
                                </div>
                                <div class="card-body">
                                    <table  id="dataTable-event" 
                                            class="display table table-hover table-bordered table-striped row-border order-column" 
                                            width="100%">
                                    </table>
                                </div>
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

<!-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script> -->
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>


<!-- OPTIONAL SCRIPTS -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>


<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>

<script src="../../assets/js/report/index_1.js"></script>

<!-- <script src="../../assets/vendor/plugins/bootstrap-toggle/bootstrap-toggle.min.js"></script> -->
<script src="../../assets/vendor/plugins/toastr/toastr.min.js"></script>



<!-- <script> 
      $(document).ready(function(){
        $("#sidebar").load("../include/sidebar.html"); 
    })
</script>  -->

</body>
</html>