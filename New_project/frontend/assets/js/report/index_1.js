$( document ).ready(function() {

    $('#start_date').datepicker({
        format: 'yyyy-mm-dd',
        uiLibrary: 'bootstrap4',
    });
    $('#end_date').datepicker({
        format: 'yyyy-mm-dd',
        uiLibrary: 'bootstrap4',
    });

    // $("#start_date,#end_date").on("change", function(e) {
    //     let start_date = $('#start_date').val();
    //     let end_date = $('#end_date').val();
    //     console.log(start_date);
    //     console.log(end_date);
    // });
var date;
var DropdownCategory = $('#search_cat');
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

var event = $('#dataTable-event').DataTable( {
    processing: true,
    scrollX: true,
    // scrollCollapse: true,
    // autowidth: false,
    // columnDefs: [
    //     { width: 10, targets: 0 },
    //     { width: 10, targets: 1 },
    // ],
    // fixedColumns: true,
    // rowReorder: true,
    // fixedColumns:   {
    //     leftColumns: 1,
    //     rightColumns: 1
    // },
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
            i:10,
        },
        type: 'GET',
    },
    columns: [
        { 
            title: "หัวข้อ",
            className: "align-middle dt-nowrap",
            data: 'title',
        },
        { 
            title: "ประเภท",
            className: "align-middle dt-nowrap",
            data: 'name'
        },
        { 
            title: "จำนวนการเข้าชม",
            className: "align-middle dt-nowrap",
            data: 'Views',
        },
        { 
            title: "รายละเอียด",
            className: "align-middle dt-nowrap",
            data: 'detail'
        },
    ],
    // "columnDefs": [{
    //     //    "searchable": false,
    //     //    "orderable": false,
    //     //    "targets": 0
    //    }],
    "order": [[1, 'asc']],
    "initComplete": function () {
        createDropdowns(this.api(),1,DropdownCategory,"กรุณาเลือกประเภท");
    },
    // responsive: true,
    // responsive: {
    //     details: {
    //         display: $.fn.dataTable.Responsive.display.modal( {
    //             header: function ( row ) {
    //                 var data = row.data();
    //                 return data.title;
    //             }
    //         } ),
    //         renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
    //             tableClass: 'table'
    //         } )
    //     }
    // },
    "language": {
        "lengthMenu": "แสดงข้อมูล _MENU_ แถว",
        "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
        "info": "แสดงหน้า _PAGE_ จาก _PAGES_",
        "infoEmpty": "ไม่พบข้อมูลที่ต้องการ",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "search": 'ค้นหา',
        "processing": "Loading..."
    },
    oLanguage: {
        sProcessing: "loading..."
    },
})
 event.buttons().container().appendTo($('#excel'));

 function getDate_LogView() {
    $("#start_date,#end_date").on("change", function(e) {
        // date = $("#date").val();
        let start_date = $('#start_date').val();
        let end_date = $('#end_date').val();
        if ( $.fn.dataTable.isDataTable( '#dataTable-event' ) ) {
            event.destroy();
            $('#dataTable-event').empty(); 
            DropdownCategory.empty();
        }
        event = $('#dataTable-event').DataTable( {
            processing: true,
            responsive: true,
            scrollX: true,
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
                    i:14,
                    start_date: start_date,
                    end_date: end_date,
                },
                type: 'GET',
            },
            columns: [
                { 
                    title: "หัวข้อ",
                    className: "align-middle",
                    data: 'title'
                },
                { 
                    title: "ประเภท",
                    className: "align-middle",
                    data: 'name'
                },
                { 
                    title: "รายละเอียด",
                    className: "align-middle",
                    data: 'detail'
                },
                { 
                    title: "จำนวนการเข้าชม",
                    className: "align-middle",
                    data: 'Views',
                },
            ],
            "columnDefs": [{
                   "searchable": false,
                   "orderable": false,
                   "targets": 0
            }],
            order: [[1, "asc"]],
            "initComplete": function () {
                createDropdowns(this.api(),1,DropdownCategory,"กรุณาเลือกประเภท");
            },
            // responsive: {
            //     details: {
            //         display: $.fn.dataTable.Responsive.display.modal( {
            //             header: function ( row ) {
            //                 var data = row.data();
            //                 return data.title;
            //             }
            //         } ),
            //         renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
            //             tableClass: 'table'
            //         } )
            //     }
            // },
            "language": {
                    "lengthMenu": "แสดงข้อมูล _MENU_ แถว",
                    "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
                    "info": "แสดงหน้า _PAGE_ จาก _PAGES_",
                    "infoEmpty": "ไม่พบข้อมูลที่ต้องการ",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "search": 'ค้นหา',
                    "processing": "Loading..."
            },
            oLanguage: {
                sProcessing: "loading..."
            },
        })
        event.buttons().container().appendTo($('#excel'));
    })
}
getDate_LogView();



});
