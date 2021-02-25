var event = $('#dataTable-event').DataTable( {
    processing: true,
    responsive: true,
    dom: 'Bfrtip',
    buttons: [
        // 'excelHtml5',
        {
            extend: 'excel',
            text: '<i class="far fa-file-excel"></i> Excel',
            className: 'btn btn-warning float-left'
          }
    ],
    ajax: 
    {
        url: '../../assets/lib/datareturn.php?i=3',
        type: 'GET',
    },
    columns: [
        // { 
        //     title: 'ลำดับ',
        //     className: "align-middle",
        //     data: null
        // },
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
        // {
        //     title: "จัดการ",
        //     className: "align-middle ",
        //     data: null,
        //     render: function ( data, type, row ) {
        //         return `<div class="btn-group" role="group">
        //                     <a href="form_edit_event.html?id=${data.id}" type="button" class="btn btn-warning">
        //                         <i class="far fa-edit"></i> แก้ไข
        //                     </a>
        //                     <button type="button" class="btn btn-danger" id="delete" data-id="${data.id}">
        //                         <i class="far fa-trash-alt"></i> ลบ
        //                     </button>
        //                 </div>`
        //     }
        // }
    ],
    "columnDefs": [{
           "searchable": false,
           "orderable": false,
           "targets": 0
       }],
    "order": [[1, 'asc']],
    "initComplete": function () {
            $(document).on('click', '#delete', function(){ 
                let id = $(this).data('id');
                console.log(id);
                Swal.fire({
                    text: "คุณแน่ใจหรือไม่...ที่จะลบรายการนี้?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่! ลบเลย',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("../../assets/lib/datareturn.php", {
                            i: 102,
                            id: id
                        }).done(function() {
                            Swal.fire({
                                text: 'รายการของคุณถูกลบเรียบร้อย',
                                icon: 'success',
                                confirmButtonText: 'ตกลง',
                            }).then((result) => {
                                location.reload();
                            });
                        })
                    }
                })
            })
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

 event.buttons().container().appendTo($('#test'));