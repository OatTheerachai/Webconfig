$(document).ready(function(){

     var event = $('#dataTable-event').DataTable( {
        processing: true,
        // responsive: true,
        // scrollCollapse: true,
        // autoWidth: false,
        // scrollY:        "300px",
        scrollX: true,
        ajax: 
        {
            url: '../../assets/lib/datareturn.php?i=3',
            type: 'GET',
        },
        // columnDefs: [ {
            // targets: 3,
            // render: function ( data, type, row ) {
            //     return data.substr( 0, 50 );
            // }
        // } ],
        // fixedColumns:   true,
        // fixedColumns: {
        //     leftColumns: 1,
        //     // rightColumns: 1
        // },
        columns: [
            { 
                title: 'ลำดับ',
                className: "align-middle",
                data: null,
            },
            { 
                title: "หัวข้อ",
                className: "align-middle",
                data: 'title',
            },
            { 
                title: "ประเภท",
                className: "align-middle",
                data: 'name',
            },
            { 
                title: "รายละเอียด",
                className: "align-middle",
                data: 'detail',
                // render: function ( data, type, row ) {
                //     return type === 'display' && data.detail.length > 60 ? 
                //     data.detail.substr( 0, 10 ) +'.....' 
                //     : data.detail;
                // }
            },
            {
                title: "จัดการ",
                className: "align-middle ",
                data: null,
                render: function ( data, type, row ) {
                    return `<div class="btn-group" role="group">
                                <a href="form_edit_event.php?id=${data.id}" type="button" class="btn btn-warning">
                                    <i class="far fa-edit"></i> แก้ไข
                                </a>
                                <button type="button" class="btn btn-danger" id="delete" data-id="${data.id}">
                                    <i class="far fa-trash-alt"></i> ลบ
                                </button>
                            </div>`
                }
            }
        ],
        "columnDefs": [{
               "searchable": false,
               "orderable": false,
               "targets": 0
           }],
        // ordering: false,
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
                "search": 'ค้นหา'
            }
    })
    event.on('order.dt search.dt', function () {
         event.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
             cell.innerHTML = i + 1;
         });
     }).draw();

     function setDefult() {
        $.ajax({
            url: "../../assets/lib/datareturn.php?i=4", 
            success: function(result){
                $("#title").val(result[0].text); 
                $("#front-size").val(result[0].f_size); 
                $("#front-speed").val(result[0].f_speed); 
            }
        });
     }

     function sendValue(value_1,value2,value3) {
        $.post("../../assets/lib/datareturn.php", {
            i: 108,
            text: value_1,
            f_size:value2,
            f_speed:value3,
            success: function(data,result) {
                console.log(result);
            }
        });
     }


     setDefult();

     $("#front-size,#front-speed,#title").on("keyup change", function(e) {
         let text = $("#title").val();
         let f_size = $("#front-size").val();
         let f_speed = $("#front-speed").val();

        clearTimeout($("#front-size,#front-speed,#title").data('timer'));
        $("#front-size,#front-speed,#title").data('timer', setTimeout(function(){
            sendValue(text,f_size,f_speed);
        }, 3000));
         
    })

})