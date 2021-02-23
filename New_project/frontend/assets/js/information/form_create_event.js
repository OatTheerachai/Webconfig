
$.ajax({
    url: "../../assets/lib/datareturn.php?i=8", 
    success: function(result){
        // console.log(result.data);
        for(let i =0; i < result.length; i++){
            $('#event_type').append($('<option>', { 
                value: result[i].id,
                text : result[i].name,
            }));
        }
    }});

//dropzone pic
// var file_name = new Array;
// var id = new Array;
var id;
Dropzone.autoDiscover = false;
var Picdropzone = new Dropzone('#mydropzone', {
    url: '../../assets/lib/datareturn.php',
    params: {
        i:106
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
        var prevFile;
        this.on("sending", function(file, xhr, formData){
            let title = $("#title").val();
            let event_type = $("#event_type").val();
            let details = $("#details").val();
            formData.append("title", title);
            formData.append("event_type", event_type);
            formData.append("details", details);
        }),

        // this.on('addedfile', function() {
        //     if (typeof prevFile !== "undefined") {
        //         this.removeFile(prevFile);
        //     }
        // });
        // this.on('success', function(file, responseText) {
        //     prevFile = file;
        // });
        this.on("error", function(file, message) { 
            alert(message);
            this.removeFile(file); 
        });
    },
    removedfile: function(file) {
        // const index = file_name.indexOf(file.name);
        // console.log(index);
        // if (index >= 0) {
        //     file_name.splice(index, 1);
        // }
        let _ref;
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
    },
    success: function(file, response) {
        console.log(response.id);
        id = response.id;
        // $.each(response, function(i, el){
        //     if($.inArray(el, id) === -1) 
        //     {
        //         id.push(el);
        //     }
        // });
        Videodropzone.processQueue();
    }
});

  //dropzone video
//   var Video_name = new Array;
  var Videodropzone = new Dropzone('#mydropzone_video', {
      url: '../../assets/lib/datareturn.php',
      params: {
          i:107
      },
      paramName: "video",
      autoProcessQueue: false,
      maxFiles: 1,
      parallelUploads: 10,
      uploadMultiple: true,
      addRemoveLinks: true,
      maxFilesize: 10, // MB
      dictRemoveFile: "ลบออก",
      dictDefaultMessage: "เลือกวิดิโอ",
      dictFileTooBig: "ไม่อนุญาตให้อัพโหลดไฟล์เกิน 2 MB",
      dictMaxFilesExceeded:"สามารถอัพโหลดได้ 1 วิดิโอ",
      dictInvalidFileType: "สามารถอัพโหลดได้เฉพาะ mp4",
      acceptedFiles: "video/mp4",
      init: function() {

        this.on("sending", function(file, xhr, formData){
            formData.append("id", id);
        }),

          this.on("addedfile", function(file) {
            file.previewElement.querySelector("img").src = '../../assets/img/video.png';
          });
          this.on("error", function(file, message) { 
              alert(message);
              this.removeFile(file); 
          });
      },
      success: function(file,res) {
        //   console.log(res);
      },
      removedfile: function(file) {
          let _ref;
          return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
      }
  });

  $('#submit').click(function(){     
    Picdropzone.processQueue();
  });
