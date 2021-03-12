<?php 
    include_once('../../authen.php'); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Config</title>

    <!-- stylesheet -->
    <link
      rel="stylesheet"
      href="../../assets/vendor/plugins/fontawesome-free/css/all.min.css"
    />
    <link rel="stylesheet" href="../../assets/css/adminlte.min.css" />
    <link rel="stylesheet" href="../../assets/css/style.css" />
    <link
      rel="stylesheet"
      href="../../assets/vendor/plugins/bootstrap-toggle/bootstrap-toggle.min.css"
    />
    <link
      rel="stylesheet"
      href="../../assets/vendor/plugins/toastr/toastr.min.css"
    />
    <link
      rel="stylesheet"
      href="../../assets/vendor/plugins/@sweetalert2/theme-bootstrap-4/bootstrap-4.css"
    />

    <!-- Datatables -->
    <link
      rel="stylesheet"
      href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.datatables.net/searchpanes/1.2.1/css/searchPanes.dataTables.min.css"
    />

    <link
      rel="stylesheet"
      href="../../assets/vendor/bootstrap-table/bootstrap-table.css"
    />

    <link
      href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css"
      rel="stylesheet"
    />

    <style>
      table,
      th,
      td {
        border: 1px solid black;
        width: 100px;
      }
    </style>
  </head>
  <body class="hold-transition sidebar-mini">
    <!-- <div class="wrapper"> -->
      <!-- Header Content -->
      <div class="wrapper">
      <?php include_once('../include/sidebar.php') ?>
        <!-- include Sidebar -->
        <!-- <div id="sidebar"></div/> -->
        <div class="content-wrapper">
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-12">
                  <!-- <h5 class="m-0 text-dark">Category</h5> -->
                </div>
              </div>
            </div>
          </div>
          <!-- Main content -->
          <div class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title" style="line-height: 2.1rem">
                        Category
                      </h3>
                      <!-- <a
                        href="form_create.html"
                        class="btn btn-primary float-right"
                        >เพิ่มข้อมูล</a
                      > -->
                      <a
                        type="button"
                        id="insertbtn"
                        data-toggle="modal"
                        data-target="#insertModal"
                        class="btn btn-primary float-right"
                        >เพิ่มข้อมูล</a
                      >
                    </div>

                    <div class="card-body">
                      <!-- <h1>Category Page</h1> -->
                      <!-- <br /><br /> -->

                      <!-- <form name="form1" id="form1" action="/action_page.php"> -->
                      Category:
                      <select
                        name="subject"
                        id="catdrop"
                        class="catdrop form-control"
                      >
                        <option value="" selected="selected">
                          Please select cat
                        </option>
                      </select>
                      <!-- <input
                              class="button button1"
                              onclick="document.location='http://localhost/webconfig/insertAgencyPage.html'"
                              value="Go to InsertPage"
                            /> -->

                      <br /><br />
                      Building:
                      <select
                        name="topic"
                        id="cat2drop"
                        class="cat2drop form-control"
                      >
                        <option value="" selected="selected">
                          Please select building
                        </option>
                      </select>
                      <br />

                      <!-- <button
                          type="button"
                          id="updatebtn"
                          class="button button1"
                          data-toggle="modal"
                          data-target="#insertModal"
                        >
                          insert
                        </button> -->

                      <table
                        id="mytable"
                        class="table table-hover table-bordered table-striped"
                        style="width: 100%"
                      ></table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- updatedata modal -->
        <div class="modal fade" id="updateModal" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Edit data</h4>
                <button type="button" class="close" data-dismiss="modal">
                  &times;
                </button>
              </div>
              <form
                action="../../assets/lib/submitForm/submitUpdateAgency.php"
                method="post"
                enctype="multipart/form-data"
              >
                <div class="modal-body">
                  <label for="agencid">ID:</label>
                  <input
                    name="agencid"
                    id="agencid"
                    value=""
                    class="form-control"
                    readonly
                  />

                  <!-- <input
                  class="deletebuilding"
                  type="button"
                  value="deletebuilding"
                /> -->
                  <br /><br />

                  <!-- <label for="addbd">เพิ่มอาคาร(ใส่เฉพาะเวลาต้องการเพิ่มเท่านั้น):</label
        ><br />
        <input type="text" id="addbd" value="" />
        <input id="addbuild" type="button" value="addbuilding" /><br /><br /> -->

                  <!-- <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-10">
                        <div class="card-header">
                            <h3 class="card-title" style="line-height: 2.1rem">Profile</h3>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div> -->
                  <div class="card-body">
                    <div class="form-row">
                      <div class="form-group col-sm-6">
                        <label for="catdropModal">ประเภทธุรกิจ:</label>
                        <select
                          name="catin"
                          class="catdrop form-control"
                          id="catdropModal"
                        >
                          <!-- <option value="" selected="selected">Select cat</option> -->
                        </select>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="bddropModal">อาคาร:</label>
                        <select
                          name="bdin"
                          class="cat2drop form-control"
                          id="bddropModal"
                        >
                          <!-- <option value="" selected="selected">Select building</option> -->
                        </select>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="floor">ชั้น:</label><br />
                        <input
                          name="floorin"
                          class="form-control"
                          type="number"
                          id="floor"
                          value=""
                        />
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="code">รหัสพื้นที่:</label><br />
                        <input
                          name="codein"
                          class="form-control"
                          type="text"
                          id="code"
                          value=""
                        />
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="owner">ชื่อผู้เช่า:</label><br />
                        <input
                          name="ownerin"
                          class="form-control"
                          type="text"
                          id="owner"
                          value=""
                        />
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="name">ชื่อสถานที่:</label><br />
                        <input
                          name="namein"
                          class="form-control"
                          type="text"
                          id="name"
                          value=""
                        />
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="engupname">ชื่อสถานที่(english):</label
                        ><br />
                        <input
                          class="form-control"
                          name="engnameupd"
                          type="text"
                          id="engupname"
                          value="-"
                        />
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="chiupname">ชื่อสถานที่(chinese):</label
                        ><br />
                        <input
                          class="form-control"
                          name="chinameupd"
                          type="text"
                          id="chiupname"
                          value="-"
                        />
                      </div>
                    </div>
                  </div>

                  <label for="detailupd">รายละเอียด:</label><br />
                  <textarea
                    maxlength="200"
                    class="form-control thdetail"
                    name="th_upddetail"
                    type="text"
                    id="thupdatedetail"
                    value=""
                  ></textarea>
                  <div class="the-count-th" id="the-count">
                    <span id="thupdatecurrent" class="thcurrent">0</span>
                    <span class="thmaximum">/ 200</span>
                  </div>
                  <br />

                  <label for="eng_detail">รายละเอียด(eng)</label><br />
                  <textarea
                    maxlength="200"
                    class="form-control engdetail"
                    name="eng_upddetail"
                    type="text"
                    id="engupdatedetail"
                    value="-"
                  ></textarea>
                  <div class="the-count-th" id="the-count">
                    <span id="engupdatecurrent" class="engcurrent">0</span>
                    <span class="enmaximum">/ 200</span>
                  </div>
                  <br />

                  <label for="chi_detail">รายละเอียด(chinese)</label>
                  <textarea
                    name="chi_upddetail"
                    id="chiupdatedetail"
                    maxlength="200"
                    class="form-control chidetail"
                    type="text"
                    value="-"
                  ></textarea>
                  <div class="the-count-chi" id="the-count">
                    <span id="chiupdatecurrent" class="chicurrent">0</span>
                    <span class="chimaximum">/ 200</span>
                  </div>
                  <br /><br />
                  <div>
                    <h5>your agency's logo image</h5>
                    <!-- <p>ใส่ได้เพียงรูปเดียว</p>
                  <p>png only</p>
                  <p>ไม่เกิน20mb</p> -->
                    <input
                      class="btn btn-danger"
                      id="deletelogoimage"
                      type="button"
                      value="deleteimage"
                    />
                  </div>

                  <img
                    id="imageshow"
                    src="../../assets/img/logo/default.png"
                    width="200"
                    height="200"
                  />
                  <label for="updateimage"> change logo's image: </label>
                  <input
                    type="file"
                    accept="image/png, .jpg"
                    name="updateimage"
                    id="updateimage"
                  />
                  <br /><br />
                  <!-- <input type="submit" name="updatesub" value="update" /> -->
                </div>
                <div class="modal-footer">
                  <!-- <button
                  type="button"
                  class="btn btn-default"
                  data-dismiss="modal"
                >
                  Close
                </button> -->
                  <input
                    type="submit"
                    class="btn btn-primary btn-block"
                    name="updatesub"
                    value="update"
                  />
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- insertdata modal -->
        <div class="modal fade" id="insertModal" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Insertdata</h4>
                <button type="button" class="close" data-dismiss="modal">
                  &times;
                </button>
              </div>
              <form
                action="../../assets/lib/submitForm/submitInsertAgency.php"
                method="post"
                enctype="multipart/form-data"
              >
                <div class="modal-body">
                  <!-- <form
                  target="_blank"
                  action="../../assets/lib/submitForm/submitInsertAgency.php"
                  method="post"
                  enctype="multipart/form-data"
                > -->

                  <!-- <h1>test add data and logo logic</h1> -->
                  <div class="card-body">
                    <div class="form-row">
                      <div class="form-group col-sm-6">
                        <label for="catdropinsmodal"> ประเภทธุรกิจ: </label>
                        <select
                          class="form-control"
                          name="catins"
                          id="catdropinsmodal"
                          required
                        >
                          <option value="" selected="selected">
                            Select cat
                          </option>
                        </select>
                      </div>

                      <div class="form-group col-sm-6">
                        <label for="bddropinsmodal">อาคาร:</label>
                        <select
                          class="form-control"
                          name="bdins"
                          id="bddropinsmodal"
                          required
                        >
                          <option value="" selected="selected">
                            Select building
                          </option>
                        </select>
                        <br />
                        <input
                          class="deletebuilding btn btn-danger"
                          id="deletebuilding"
                          type="button"
                          value="deletebuilding"
                        />
                      </div>

                      <div class="form-group col-sm-6">
                        <label for="addbd"
                          >เพิ่มอาคาร(ใส่เฉพาะเวลาต้องการเพิ่มเท่านั้น):</label
                        ><br />
                        <input
                          class="form-control"
                          type="text"
                          id="addbd"
                          value=""
                        />
                        <br />
                        <input
                          class="btn btn-success"
                          id="addbuild"
                          type="button"
                          value="addbuilding"
                        />
                      </div>
                      <div class="form-group col-sm-6"></div>
                      <div class="form-group col-sm-6">
                        <label for="floor">ชั้น:</label><br />
                        <input
                          class="form-control"
                          name="floorins"
                          type="number"
                          id="floor"
                          value=""
                        />
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="code">รหัสพื้นที่:</label><br />
                        <input
                          class="form-control"
                          name="codeins"
                          type="text"
                          id="code"
                          value="-"
                        />
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="owner">ชื่อผู้เช่า:</label><br />
                        <input
                          class="form-control"
                          name="ownerins"
                          type="text"
                          id="owner"
                          value="-"
                        />
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="name">ชื่อสถานที่:</label><br />
                        <input
                          class="form-control"
                          name="nameins"
                          type="text"
                          id="name"
                          value=""
                          required
                        />
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="engname">ชื่อสถานที่(english):</label><br />
                        <input
                          class="form-control"
                          name="engnameins"
                          type="text"
                          id="engname"
                          value="-"
                        />
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="chiname">ชื่อสถานที่(chinese):</label><br />
                        <input
                          class="form-control"
                          name="chinameins"
                          type="text"
                          id="chiname"
                          value="-"
                        />
                      </div>
                    </div>
                  </div>

                  <!-- <select
                    class="form-control"
                    name="bdins"
                    id="bddropinsmodal"
                    required
                  >
                    <option value="" selected="selected">
                      Select building
                    </option>
                  </select> -->
                  <!-- <br />
                  <input
                    class="deletebuilding"
                    id="deletebuilding"
                    type="button"
                    value="deletebuilding"
                  />
                  <br /><br /> -->

                  <!-- <label for="addbd"
                    >เพิ่มอาคาร(ใส่เฉพาะเวลาต้องการเพิ่มเท่านั้น):</label
                  ><br />
                  <input type="text" id="addbd" value="" />
                  <input
                    id="addbuild"
                    type="button"
                    value="addbuilding"
                  /><br /><br /> -->

                  <!-- <label for="floor">ชั้น:</label><br />
                  <input
                    class="form-control"
                    name="floorins"
                    type="number"
                    id="floor"
                    value=""
                  /><br /><br /> -->
                  <!-- <label for="code">รหัสพื้นที่:</label><br />
                  <input
                    class="form-control"
                    name="codeins"
                    type="text"
                    id="code"
                    value="-"
                  /><br /><br /> -->
                  <!-- <label for="owner">ชื่อผู้เช่า:</label><br />
                  <input
                    class="form-control"
                    name="ownerins"
                    type="text"
                    id="owner"
                    value="-"
                  /><br /><br /> -->
                  <!-- <label for="name">ชื่อสถานที่:</label><br />
                  <input
                    class="form-control"
                    name="nameins"
                    type="text"
                    id="name"
                    value=""
                    required
                  /><br /><br /> -->
                  <label for="thinsdetail">รายละเอียด:</label><br />
                  <textarea
                    maxlength="200"
                    class="form-control thdetail"
                    name="detailins"
                    type="text"
                    id="thinsdetail"
                    value="-"
                  ></textarea>
                  <div class="the-count-th" id="the-count">
                    <span id="thinsertcurrent" class="thcurrent">0</span>
                    <span class="thmaximum">/ 200</span>
                  </div>
                  <br />

                  <label for="eng_detail">รายละเอียด(eng)</label><br />
                  <textarea
                    maxlength="200"
                    class="form-control engdetail"
                    name="eng_insdetail"
                    type="text"
                    id=""
                    value="-"
                  ></textarea>
                  <div class="the-count-th" id="the-count">
                    <span id="enginsertcurrent" class="engcurrent">0</span>
                    <span class="enmaximum">/ 200</span>
                  </div>
                  <br />

                  <label for="chi_detail">รายละเอียด(chinese)</label>
                  <textarea
                    name="chi_insdetail"
                    id=""
                    maxlength="200"
                    class="form-control chidetail"
                    type="text"
                    value="-"
                  ></textarea>
                  <div class="the-count-chi" id="the-count">
                    <span id="chiinsertcurrent" class="chicurrent">0</span>
                    <span class="chimaximum">/ 200</span>
                  </div>

                  <!-- <input id="addbt" type="button" value="add" /> -->

                  <h5>your agency's image</h5>

                  <input
                    type="file"
                    accept="image/png, .jpg"
                    name="uploadfile"
                    id="uploadimage"
                  />
                  <br /><br />
                  <!-- <input type="submit" name="uploadfilesub" value="add" /> -->
                </div>
                <div class="modal-footer">
                  <!-- <button
                  type="button"
                  class="btn btn-default"
                  data-dismiss="modal"
                >
                  Close
                </button> -->
                  <input
                    type="submit"
                    class="btn btn-primary btn-block"
                    name="uploadfilesub"
                    value="add"
                  />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <th
        class="align-middle sorting"
        tabindex="0"
        aria-controls="dataTable"
        rowspan="1"
        colspan="1"
        style="width: 102.6px"
        aria-label="ลำดับ: activate to sort column ascending"
      >
        ลำดับ
      </th>
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

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="../../assets/vendor/plugins/toastr/toastr.min.js"></script>

    <script src="../../assets/vendor/bootstrap-table/bootstrap-table.min.js"></script>
    <script src="../../assets/vendor/bootstrap-table/extensions/mobile/bootstrap-table-mobile.js"></script>
    <script src="../../assets/vendor/bootstrap-table/bootstrap-table-th-TH.js"></script>
    <script src="../../assets/vendor/bootstrap-table/extensions/export/bootstrap-table-export.js"></script>
    <script src="../../assets/vendor/bootstrap-table/extensions/export/export.js"></script>

    <!-- <script src="../../assets/vendor/plugins/bootstrap-toggle/bootstrap-toggle.min.js"></script> -->

    <!-- Create Me SCRIPTS -->
    <script src="../../assets/js/catagory/index.js" charset="UTF-8"></script>
    <script
      src="../../assets/js/catagory/insertAgencyJS.js"
      charset="UTF-8"
    ></script>

    <script>
      $(document).ready(function () {
        $("#sidebar").load("../include/sidebar.php");
      });
    </script>
  </body>
</html>
