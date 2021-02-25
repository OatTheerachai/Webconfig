$(document).ready(function(){
    var status;
     var ip = $('#dataTable-event').DataTable( {
        processing: true,
        responsive: true,
        ajax: 
        {
            url: '../../assets/lib/datareturn.php?i=6',
            type: 'GET',
        },
        columns: [
            { 
                title: 'ลำดับ',
                className: "align-middle",
                data: 'ip_id'
            },
            { 
                title: "ที่อยู่ IP",
                className: "align-middle",
                data: 'ip_name'
            },
            {
                title: "เปิด/ปิด",
                className: "align-middle",
                data: null,
                render: function ( data, type, row ) {
                    return `<div class="btn-group" role="group">
                    <input class="toggle-event" data-id="${data.ip_id}" type="checkbox" name="status" 
                        ${data.status == "true" ? 'checked': ''} data-toggle="toggle" data-on="เปิด" 
                        data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-style="ios">
                </div>`
                }
            },
            {
                title: "สถานะ",
                className: "align-middle",
                data: null,
                render: function ( data, type, row ) {
                     return data.status == "true"? `<span class="badge badge-success">ออนไลน์</span>`: 
                     `<span class="badge badge-danger">ออฟไลน์</span>`;
                }
            },
            {
                title: "จัดการ",
                className: "align-middle",
                data: null,
                render: function ( data, type, row ) {
                    return `<div class="btn-group" role="group">
                                <button type="button" class="btn btn-info" id="delete" data-id="${data.ip_id}">
                                    <i class="fas fa-power-off"></i> Restart
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
        "order": [[1, 'asc']],
        "initComplete": function () {
            $('.toggle-event').bootstrapToggle();
            $('.toggle-event').change(function(){
                let id = $(this).data('id');
                // console.log(id);
                // console.log(this.checked);
                $.ajax({  
                    type: "POST",  
                    url: "../../assets/lib/datareturn.php",  
                    data: {
                        i: 115,
                        id: id,
                        status: this.checked
                    }
                  }).done(function(resp) {
                    toastr.success('อัพเดทข้อมูลเรียบร้อย')
                    setTimeout(() => {
                        window.location.reload();
                    }, 800)
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
    ip.on('order.dt search.dt', function () {
        ip.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
             cell.innerHTML = i + 1;
         });
     }).draw();

    //  $('.toggle-event').change(function(){
    //      console.log("test");
    //     toastr.success('อัพเดทข้อมูลเสร็จเรียบร้อย')
    // })
})
