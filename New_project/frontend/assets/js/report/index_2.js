$( document ).ready(function() {

function createDropdowns(api,colNumber,SelectPosition,setText,Tableposition) {
  api.columns([colNumber]).every( function () {
    let column = this;
    let select = $('<select class="form-control"><option value="">'+ setText +'</option></select>')
        .appendTo( $(column.header()))
        .on( 'change', function () {
          let val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
            );
            column.search( val ? '^'+val+'$' : '', true, false ).draw();
        } );

    column.data().unique().sort().each( function ( d, j ) {
        select.append( '<option value="'+d+'">'+d+'</option>' )
    } );
    SelectPosition.append(select);
} );
}
var date;
var DropdownBuilding = $('#search_bd');
var DropdownCategory = $('#search_cat');
var information = $("#dataTable-event").DataTable({
  processing: true,
  responsive: true,
  dom: "Bfrtip",
  buttons: [
    {
      extend: "excel",
      text: '<i class="far fa-file-excel"></i> Excel',
      className: "btn btn-warning float-left",
    },
  ],
  ajax: {
    url: "../../assets/lib/datareturn.php",
    data: {
      i: 11,
    },
    type: "GET",
  },
  columns: [
    {
      title: "ลำดับ",
      className: "align-middle",
      data: 'id',
    },
    {
      title: "อาคาร",
      className: "align-middle",
      data: "bd_name",
    },
    {
      title: "ชั้น",
      className: "align-middle",
      data: "floor",
    },
    {
      title: "ประเภท",
      className: "align-middle",
      data: "cat_name",
    },
    {
      title: "รหัสพื้นที่",
      className: "align-middle",
      data: "code_place",
    },
    {
      title: "ชื่อผู้เช่า",
      className: "align-middle",
      data: "owner",
    },
    {
      title: "ชื่อสถานที่",
      className: "align-middle",
      data: "name",
    },
    {
      title: "รายละเอียด",
      className: "align-middle",
      data: "detail",
    },
    {
      title: "จำนวนการเข้าชม",
      className: "align-middle",
      data: "Views",
    },
  ],
  columnDefs: [
    {
      searchable: false,
      orderable: false,
      targets: 0,
    },
  ],
  order: [[0, "asc"]],
  initComplete: function () {
    createDropdowns(this.api(),1,DropdownBuilding,"กรุณาเลือกอาคาร");
    createDropdowns(this.api(),3,DropdownCategory,"กรุณาเลือกประเภท");
  },
  responsive: {
    details: {
      display: $.fn.dataTable.Responsive.display.modal({
        header: function (row) {
          var data = row.data();
          return data.title;
        },
      }),
      renderer: $.fn.dataTable.Responsive.renderer.tableAll({
        tableClass: "table",
      }),
    },
  },
  language: {
    lengthMenu: "แสดงข้อมูล _MENU_ แถว",
    zeroRecords: "ไม่พบข้อมูลที่ต้องการ",
    info: "แสดงหน้า _PAGE_ จาก _PAGES_",
    infoEmpty: "ไม่พบข้อมูลที่ต้องการ",
    infoFiltered: "(filtered from _MAX_ total records)",
    search: "ค้นหา",
  },
});
information.buttons().container().appendTo($("#excel"));

function getDate_LogView() {
  $("#date").on("change", function(e) {
      date = $("#date").val();
      // console.log(date);
      if ( $.fn.dataTable.isDataTable( '#dataTable-event' ) ) {
          information.destroy();
          $('#dataTable-event').empty();
          DropdownBuilding.empty();
          DropdownCategory.empty();
      }
      information = $("#dataTable-event").DataTable({
        processing: true,
        responsive: true,
        dom: "Bfrtip",
        buttons: [
          {
            extend: "excel",
            text: '<i class="far fa-file-excel"></i> Excel',
            className: "btn btn-warning float-left",
          },
        ],
        ajax: {
          url: "../../assets/lib/datareturn.php",
          data: {
            i: 15,
            date: date
          },
          type: "GET",
        },
        columns: [
          {
            title: "ลำดับ",
            className: "align-middle",
            data: "id",
          },
          {
            title: "อาคาร",
            className: "align-middle",
            data: "bd_name",
          },
          {
            title: "ชั้น",
            className: "align-middle",
            data: "floor",
          },
          {
            title: "ประเภท",
            className: "align-middle",
            data: "cat_name",
          },
          {
            title: "รหัสพื้นที่",
            className: "align-middle",
            data: "code_place",
          },
          {
            title: "ชื่อผู้เช่า",
            className: "align-middle",
            data: "owner",
          },
          {
            title: "ชื่อสถานที่",
            className: "align-middle",
            data: "name",
          },
          {
            title: "รายละเอียด",
            className: "align-middle",
            data: "detail",
          },
          {
            title: "จำนวนการเข้าชม",
            className: "align-middle",
            data: "Views",
          },
        ],
        columnDefs: [
          {
            searchable: false,
            orderable: false,
            targets: 0,
          },
        ],
        order: [[1, "asc"]],
        initComplete: function () {
          createDropdowns(this.api(),1,DropdownBuilding,"กรุณาเลือกอาคาร");
          createDropdowns(this.api(),3,DropdownCategory,"กรุณาเลือกประเภท");
        },
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal({
              header: function (row) {
                var data = row.data();
                return data.title;
              },
            }),
            renderer: $.fn.dataTable.Responsive.renderer.tableAll({
              tableClass: "table",
            }),
          },
        },
        language: {
          lengthMenu: "แสดงข้อมูล _MENU_ แถว",
          zeroRecords: "ไม่พบข้อมูลที่ต้องการ",
          info: "แสดงหน้า _PAGE_ จาก _PAGES_",
          infoEmpty: "ไม่พบข้อมูลที่ต้องการ",
          infoFiltered: "(filtered from _MAX_ total records)",
          search: "ค้นหา",
        },
      });
      information.buttons().container().appendTo($('#excel'));
  })
}
getDate_LogView();

});
