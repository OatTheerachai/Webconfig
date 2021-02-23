Dropzone.autoDiscover = false;
$(document).ready(function(){
    function getdata() {
        $.ajax({
            url: "../../assets/lib/datareturn.php?i=8", 
            success: function(result){
                // console.log(result.data);
                for(let i =0; i < result.length; i++){
                    $('#building').append($('<option>', { 
                        value: result[i].id,
                        text : result[i].name,
                    }));
                }
            }});
    }
    function getdataCategory() {
        $.ajax({
            url: "../../assets/lib/datareturn.php?i=9", 
            success: function(result){
                for(let i =0; i < result.length; i++){
                    $('#Category').append($('<option>', { 
                        value: result[i].id,
                        text : result[i].name,
                    }));
                }
            }});
    }
    getdataCategory();
    getdata();

    // Dropzone.autoDiscover = false;
    var Picdropzone = new Dropzone('#mydropzone', {
        url: '../../assets/lib/datareturn.php',
        params: {
            i:115
        },
        paramName: "file",
        autoProcessQueue: false,
        parallelUploads: 10,
        uploadMultiple: true,
        maxFiles: 1,
        addRemoveLinks: true,
        maxFilesize: 10, // MB,
        dictRemoveFile: "ลบออก",
        dictDefaultMessage: "เลือกรูปภาพ",
        dictFileTooBig: "ไม่อนุญาตให้อัพโหลดไฟล์เกิน 2 MB",
        dictMaxFilesExceeded:"สามารถอัพโหลดได้ 1 รูป",
        dictInvalidFileType: "สามารถอัพได้เฉพาะ jpg,jpeg,png เเละ gif",
        acceptedFiles: "image/jpg,image/jpeg,image/png,image/gif",
        init: function() {
            // this.on("sending", function(file, xhr, formData){
            //     let title = $("#title").val();
            //     let event_type = $("#event_type").val();
            //     let details = $("#details").val();
            //     formData.append("title", title);
            //     formData.append("event_type", event_type);
            //     formData.append("details", details);
            // }),
    
            this.on("error", function(file, message) { 
                // alert(message);
                this.removeFile(file); 
            });
        },
        removedfile: function(file) {
            let _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        success: function(file, response) {
            console.log(response);
        }
    });

    $('#submit').click(function(){     
        // Picdropzone.processQueue();
      });

});