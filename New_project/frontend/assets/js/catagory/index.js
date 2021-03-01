$(document).ready(function () {
  console.log("hello");
  var table;

  var url = "http://localhost/frontend/assets/lib/rfdb_connector.php";

  var dataset = [];
  /////////////////////////////////////////////////////////////
  // startup
  /////////////////////////////////////////////////////////////

  var package = {
    id: 1,
    catid: "",
    build_id: "",
  };
  var insertpackage = {
    id: 2,
    addbdin: "",
    bdid: "",
    floorin: "",
    codein: "",
    catid: "",
    ownerin: "",
    namein: "",
    detailin: "",
  };

  var deletepackage = {
    id: 3,
    build_id: "",
  };

  var jsondata = [];
  var buildingdb = [];
  var categorydb = [];

  /////////////////////////////////////////////////////////////
  // for 1st load cat
  /////////////////////////////////////////////////////////////

  $.post(url, package, function (data, status) {
    console.log(data);
    buildingdb = readrawdata(data, "buildjson");
    categorydb = readrawdata(data, "catjson");

    jsoncatdata = readrawdata(data, "catjson");
    jsonbuilddata = readrawdata(data, "buildjson");
    console.log(jsoncatdata);
    console.log(jsonbuilddata);
    if (jsoncatdata.length > 0) {
      console.log("pass");
      // $("#catdrop").empty();
      for (var i = 0; i < jsoncatdata.length; i++) {
        $(".catdrop").append(
          "<option value=" +
            jsoncatdata[i].id +
            ">" +
            jsoncatdata[i].name +
            "</option>"
        );
      }

      var dataset = readrawdata(data, "datasettable");
      console.log(dataset);
      table = createdatatable("#mytable", dataset); //////////////////////////////////////////////
    }
    if (jsonbuilddata.length > 0) {
      for (var j = 0; j < jsonbuilddata.length; j++) {
        $(".cat2drop").append(
          "<option class = 'added' name = " +
            jsonbuilddata[j].name +
            " value=" +
            jsonbuilddata[j].id +
            ">" +
            jsonbuilddata[j].name +
            "</option>"
        );
      }
    }
  });

  /////////////////////////////////////////////////////////////
  // for 1st load add
  /////////////////////////////////////////////////////////////

  jsondata = [];
  $.post(url, insertpackage, function (data, status) {
    console.log(data);
    jsondata = JSON.parse(data);
    console.log(jsondata);
    if (jsondata.length > 0) {
      for (var i = 0; i < jsondata.length; i++) {
        $("#bddrop").append(
          "<option value=" +
            jsondata[i].id +
            ">" +
            jsondata[i].name +
            "</option>"
        );
      }
    }
  });

  /////////////////////////////////////////////////////////////
  // for add
  /////////////////////////////////////////////////////////////
  // document.getElementById("addbuild").onclick = function () {
  //   var addbuildin = document.getElementById("addbd").value;
  //   if (addbuildin != "") {
  //     insertpackage = {
  //       id: 2,
  //       addbdin: addbuildin,
  //       bdid: "",
  //       floorin: "",
  //       codein: "",
  //       catid: "",
  //       ownerin: "",
  //       namein: "",
  //     };
  //     $.post(url, insertpackage, function (data) {
  //       alert(data);
  //     });
  //     location.reload();
  //   } else {
  //     alert("กรุณาใส่ชื่อตึก");
  //   }
  // };

  // document.getElementById("addbut").onclick = function () {
  //   var cat = document.getElementById("cat").value;
  //   var buildpick = document.getElementById("bddrop").value;
  //   var floor = document.getElementById("floor").value;
  //   var code = document.getElementById("code").value;
  //   var owner = document.getElementById("owner").value;
  //   var name = document.getElementById("name").value;
  //   var detail = document.getElementById("detail").value;
  //   ///////////////////////////////////
  //   code = checkdqstring(code);
  //   owner = checkdqstring(owner);
  //   name = checkdqstring(name);
  //   detail = checkdqstring(detail);
  //   if (
  //     cat != "" &&
  //     buildpick != "" &&
  //     floor != "" &&
  //     code != "" &&
  //     owner != ""
  //     // name != "" &&
  //     // detail != ""
  //   ) {
  //     if (name == "") {
  //       name = "-";
  //     }
  //     if (detail == "") {
  //       detail = "-";
  //     }
  //     insertpackage = {
  //       id: 2,
  //       addbdin: "",
  //       catid: cat,
  //       bdid: buildpick,
  //       floorin: floor,
  //       codein: code,
  //       ownerin: owner,
  //       namein: name,
  //       detailin: detail,
  //     };

  //     $.post(url, insertpackage, function (data) {
  //       alert(data);
  //     });
  //     // location.reload();
  //   } else {
  //     alert("กรุณากรอกข้อมูลให้ครบทุกช่อง");
  //   }
  // };

  /////////////////////////////////////////////////////////////
  // for category
  /////////////////////////////////////////////////////////////
  document.getElementById("catdrop").onchange = function () {
    var catpick = document.getElementById("catdrop").value;
    console.log(catpick);
    package = {
      id: 1,
      catid: catpick,
      build_id: "",
    };

    dataset = [];

    $.post(url, package, function (data, status) {
      console.log(data);
      var rawdata = [];
      // var jsoncat = [];
      var jsoncat = readrawdata(data, "catjson");
      var jsondata = readrawdata(data, "datasettable");

      console.log(jsondata);

      if (jsoncat.length > 0) {
        console.log("2pass");
        //   $("#cat2drop").empty();
        $("option").remove(".added");
        for (var i = 0; i < jsoncat.length; i++) {
          $("#cat2drop").append(
            "<option class = 'added' value=" +
              jsoncat[i].id +
              ">" +
              jsoncat[i].name +
              "</option>"
          );
        }
      } else {
        $("option").remove(".added");
      }
      table = createdatatable("#mytable", jsondata); ///////////////////////////////////////////////
    });
  };

  document.getElementById("cat2drop").onchange = function () {
    dataset = [];
    var cat1pick = document.getElementById("catdrop").value;
    var cat2pick = document.getElementById("cat2drop").value;
    console.log(cat1pick);
    console.log(cat2pick);

    if (cat1pick == "" && cat2pick != "") {
      console.log("hey there");
      package = {
        id: 1,
        catid: cat1pick,
        build_id: cat2pick,
      };
      $.post(url, package, function (data) {
        dataset = readrawdata(data, "datasettable");
        console.log(dataset);
        table = createdatatable("#mytable", dataset);
      });
    } else {
      package = {
        id: 1,
        catid: cat1pick,
        build_id: cat2pick,
      };
      var jsondata = [];
      $.post(url, package, function (data, status) {
        dataset = readrawdata(data, "datasettable");
        console.log(dataset);
        if (dataset.length > 0) {
          console.log("3pass");
          table = createdatatable("#mytable", dataset);
          //   $("#cat3drop").empty();
          //   for (var i = 0; i < jsondata.length; i++) {
          //     $("#cat3drop").append(
          //       "<option value=" +
          //         jsondata[i].id +
          //         ">" +
          //         jsondata[i].name +
          //         "</option>"
          //     );
          //   }
        } else {
          // createdatatable("#mytable", dataset);
        }
      });
    }
  };

  /////////////////////////////////////////////////////////////
  // for delete
  /////////////////////////////////////////////////////////////

  // document.getElementById("deletebuilding").onclick = function () {
  //   buildpickid = document.getElementById("bddrop").value;
  //   if (buildpickid != "") {
  //     if (confirm("ARE YOU SURE") == true) {
  //       deletepackage = {
  //         id: 3,
  //         build_id: buildpickid,
  //       };
  //       $.post(url, deletepackage, function (data) {
  //         var bdname = JSON.parse(data);
  //         alert(bdname[0].name + " has been deleted.");
  //         location.reload();
  //       });
  //     }
  //   } else {
  //     alert("กรุณาเลือกตึกที่ต้องการลบ");
  //   }

  //   // alert(buildpickname);
  // };

  /////////////////////////////////////////////////////////////
  // for updatemodal
  /////////////////////////////////////////////////////////////

  /////////////////////////////////////////////////////////////
  // FUNCTIONS
  /////////////////////////////////////////////////////////////

  $("#updateModal").on("hide", function () {
    window.location.reload();
  });
  $("textarea").keyup(function () {
    var characterCount = $(this).val().length,
      current = $(".current"),
      maximum = $(".maximum"),
      theCount = $(".the-count");

    current.text(characterCount);
  });

  $("#mytable").on("click", "#updatebtn", function () {
    var data = [];

    data = table.row($(this).parents("tr")).data();

    document.getElementById("agencid").value = data[1];

    document.getElementById("catdropModal").value = data[5];
    document.getElementById("bddropModal").value = data[2];
    document.getElementById("floor").value = data[4];
    document.getElementById("code").value = data[6];
    document.getElementById("owner").value = data[7];
    document.getElementById("name").value = data[8];
    document.getElementById("detail").value = data[9];
    var detaillength = data[9].length;
    document.getElementById("current").textContent = detaillength;

    document.getElementById("imageshow").src =
      "../../assets/img/logo/" + data[10];

    // alert(data[10]);
    // alert(document.getElementById("imageshow").src);
  });

  $("#mytable").on("click", "#deleteagency", function () {
    alert("delete function");
    var data = [];
    data = table.row($(this).parents("tr")).data();
    // alert(data);
    if (confirm("ARE YOU SURE") == true) {
      var deletepackage = {
        id: 3,
        agencid: data[1],
      };
      $.post(url, deletepackage, function (data) {
        // var agencyname = JSON.parse(data);
        alert(" Data has been deleted.");
        location.reload();
      });
    }
  });

  function readrawdata(rawdata, output) {
    var datasplitter = rawdata.split("----------");
    switch (output) {
      case "catjson":
        var catdata = JSON.parse(datasplitter[0]);
        return catdata;
        break;

      case "datasettable":
        var tabledataset = [];
        var subdataset = [];
        var tabledata = JSON.parse(datasplitter[1]);
        for (var i = 0; i < tabledata.length; i++) {
          subdataset.push(i + 1);
          subdataset.push(tabledata[i].id);
          subdataset.push(tabledata[i].bd_id);
          for (var j = 0; j < buildingdb.length; j++) {
            if (buildingdb[j].id == tabledata[i].bd_id) {
              subdataset.push(buildingdb[j].name);
              break;
            }
          }
          subdataset.push(tabledata[i].floor);
          subdataset.push(tabledata[i].cat_id);
          for (var j = 0; j < categorydb.length; j++) {
            if (categorydb[j].id == tabledata[i].cat_id) {
              subdataset.push(categorydb[j].name);
              break;
            }
          }
          subdataset.push(tabledata[i].code_place);
          subdataset.push(tabledata[i].owner);
          subdataset.push(tabledata[i].name);
          subdataset.push(tabledata[i].detail);
          subdataset.push(tabledata[i].LogoImgName);
          // subdataset.push(Array);

          tabledataset.push(subdataset);
          subdataset = [];
        }
        return tabledataset;
        break;

      case "buildjson":
        var builddata = JSON.parse(datasplitter[2]);
        return builddata;
    }
  }
  function createdatatable(htmlid, dataset) {
    var table = $(htmlid).DataTable({
      // scrollY: "600px",
      // scrollCollapse: true,
      paging: true,
      rowReorder: {
        enable: true,
      },
      // dom: "lfrtip",
      dom: '<"top"f>rt<"bottom"lip>',
      data: dataset,
      autoWidth: true,
      columnDefs: [
        {
          targets: [6, 8, 3],
          width: 80,
        },
        {
          targets: [2, 1, 5],
          visible: false,
          searchable: false,
        },

        {
          targets: -1,
          data: null,
          width: 100,
          defaultContent:
            "<div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>" +
            "<div class='btn-group mr-5' role='group' aria-label='First group'>" +
            "<button type='button' id='updatebtn' class='btn btn-info btn-sm' data-toggle='modal' data-target='#updateModal'>edit</button>" +
            "</div>" +
            "<div class='btn-group mr-5' role='group' aria-label='First group'>" +
            "<button type='button' id='deleteagency' class='btn btn-warning btn-sm' data-toggle='modal' data-target=''>delete</button>" +
            "</div>" +
            "</div>",
        },
      ],
      columns: [
        { title: "ลำดับ" },
        { title: "id" },
        { title: "รหัสอาคาร" },
        { title: "อาคาร" },
        { title: "ชั้น" },
        { title: "รหัสประเภท" },
        { title: "ประเภท" },
        { title: "รหัสพื้นที่" },
        { title: "ชื่อผู้เช่า" },
        { title: "ชื่อสถานที่" },
        { title: "รายละเอียด" },
        { title: "ชื่อรูป" },
        { title: "option" },
      ],

      destroy: true,
    });
    // /////////////////////////////////////////////////////////////
    // // for updatepage
    // /////////////////////////////////////////////////////////////

    // $(htmlid + " tbody").on("click", ".updatebtn", function () {
    //   var data = [];
    //   data = table.row($(this).parents("tr")).data();
    //   alert(data);
    //   // table.column(-1).visible(false);

    //   // window.location.href = "http://stackoverflow.com";

    //   // alert("worked!!!");
    // });
    return table;
  }
  function checkdqstring(str) {
    if (str.charAt(0) == '"' && str.charAt(str.length - 1) == '"') {
      str = str.substring(1, str.length - 1);
      return str;
    } else return str;
  }
});
