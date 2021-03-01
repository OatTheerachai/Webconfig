var information = $('#dataTable-event').DataTable( {
    processing: true,
    responsive: true,
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'excel',
            text: '<i class="far fa-file-excel"></i> Excel',
            className: 'btn btn-warning float-left'
          }
    ],
    ajax: 
    {
        url: '../../assets/lib/datareturn.php',
        data: {
            i:11,
            // date: 2020/2020/2020
        },
        type: 'GET',
    },
    columns: [
        { 
            title: "อาคาร",
            className: "align-middle",
            data: 'bd_name',
        },
        { 
            title: "ชั้น",
            className: "align-middle",
            data: 'floor',
        },
        { 
            title: "ประเภท",
            className: "align-middle",
            data: 'cat_name',

        },
        { 
            title: "รหัสพื้นที่",
            className: "align-middle",
            data: 'code_place',
        },
        { 
            title: "ชื่อผู้เช่า",
            className: "align-middle",
            data: 'owner',
        },
        { 
            title: "ชื่อสถานที่",
            className: "align-middle",
            data: 'name',
        },
        { 
            title: "รายละเอียด",
            className: "align-middle",
            data: 'detail'
        },
        { 
            title: "จำนวนการเข้าชม",
            className: "align-middle",
            data: 'Views'
        },
    ],
    "columnDefs": [{
           "searchable": false,
           "orderable": false,
           "targets": 0
       }],
    "order": [[1, 'asc']],
    "initComplete": function () {

        },
    responsive: {
        details: {
            display: $.fn.dataTable.Responsive.display.modal( {
                header: function ( row ) {
                    var data = row.data();
                    return data.title;
                }
            } ),
            renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                tableClass: 'table'
            } )
        }
    },
    "language": {
            "lengthMenu": "แสดงข้อมูล _MENU_ แถว",
            "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
            "info": "แสดงหน้า _PAGE_ จาก _PAGES_",
            "infoEmpty": "ไม่พบข้อมูลที่ต้องการ",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": 'ค้นหา'
        }
})
// event.on('order.dt search.dt', function () {
//      event.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
//          cell.innerHTML = i + 1;
//      });
//  }).draw();
 information.buttons().container().appendTo($('#test'));

 console.log($('#date').val());
  $("#date").on("change", function(e) {
    var date = $("#date").val();
    console.log(date);
})