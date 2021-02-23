$(document).ready(function () {
  var url = "http://localhost/webconfig/server/rfdb_connector.php";
  var dataset = [];

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
    imagein: "",
  };

  var deletepackage = {
    id: 3,
    build_id: "",
  };

  var jsondata = [];
  $.post(url, package, function (data) {
    jsoncatdata = readrawdata(data, "catjson");
    if (jsoncatdata.length > 0) {
      console.log("pass");
      // $("#catdrop").empty();
      for (var i = 0; i < jsoncatdata.length; i++) {
        $("#catdropinsmodal").append(
          "<option value=" +
            jsoncatdata[i].id +
            ">" +
            jsoncatdata[i].name +
            "</option>"
        );
      }
    }
  });
  $.post(url, insertpackage, function (data, status) {
    console.log(data);
    jsondata = JSON.parse(data);
    console.log(jsondata);
    if (jsondata.length > 0) {
      for (var i = 0; i < jsondata.length; i++) {
        $("#bddropinsmodal").append(
          "<option value=" +
            jsondata[i].id +
            ">" +
            jsondata[i].name +
            "</option>"
        );
      }
    }
  });

  document.getElementById("addbuild").onclick = function () {
    var addbuildin = document.getElementById("addbd").value;
    if (addbuildin != "") {
      insertpackage = {
        id: 2,
        addbdin: addbuildin,
        bdid: "",
        floorin: "",
        codein: "",
        catid: "",
        ownerin: "",
        namein: "",
        detailin: "",
      };
      $.post(url, insertpackage, function (data) {
        alert(data);
      });
      location.reload();
    } else {
      alert("กรุณาใส่ชื่อตึก");
    }
  };

  /////////////////////////////////////////////////////////////
  // for delete
  /////////////////////////////////////////////////////////////

  $("#deletebuilding").on("click", function () {
    buildpickid = document.getElementById("bddropinsmodal").value;
    // alert(buildpickid);
    if (buildpickid != "") {
      if (confirm("ARE YOU SURE") == true) {
        deletepackage = {
          id: 3,
          build_id: buildpickid,
        };
        $.post(url, deletepackage, function (data) {
          var bdname = JSON.parse(data);
          alert(bdname[0].name + " has been deleted.");
          location.reload();
        });
      }
    } else {
      alert("กรุณาเลือกตึกที่ต้องการลบ");
    }

    // alert(buildpickname);
  });

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

  // document.getElementById("catdrop").onchange=function(){
  //   alert()
  // }

  /////////////////////////////////////////////////////////////
  // FUNCTIONS
  /////////////////////////////////////////////////////////////

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
          subdataset.push(tabledata[i].code_place);
          subdataset.push(tabledata[i].owner);
          subdataset.push(tabledata[i].name);
          subdataset.push(tabledata[i].detail);

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
  function checkdqstring(str) {
    if (str.charAt(0) == '"' && str.charAt(str.length - 1) == '"') {
      str = str.substring(1, str.length - 1);
      return str;
    } else return str;
  }
});
