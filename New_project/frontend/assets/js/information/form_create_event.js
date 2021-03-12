
  function registerSummernote(element, max, callbackMax) {
    $(element).summernote({
    toolbar: [
        // ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
    ],
    height: 100,
      callbacks: {
        onKeydown: function(e) {
          var t = e.currentTarget.innerText;
          if (t.length >= max) {
            //delete key
            if (e.keyCode != 8 && !(e.keyCode >= 37 && e.keyCode <= 40) && e.keyCode != 46 && !(e.keyCode == 88 && e.ctrlKey) && !(e.keyCode == 67 && e.ctrlKey)) 
            {
                e.preventDefault();
            }
          }
        },
        onKeyup: function(e) {
          var t = e.currentTarget.innerText;
          if (typeof callbackMax == 'function') {
            callbackMax(max - t.length);
          }
        },
        onPaste: function(e) {
          var t = e.currentTarget.innerText;
          var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
          e.preventDefault();
          var maxPaste = bufferText.length;
          let all = t.length + bufferText.length;
          if(all > max) {
            maxPaste = max - t.length;
          }
          if(maxPaste > 0){
            document.execCommand('insertText', false, bufferText.trim().substring(0, maxPaste));
          }
          if (typeof callbackMax == 'function') {
                callbackMax(max - t.length);
          }
        }   
      }
    });
  }

  registerSummernote('#details', 100, function(max) {
    $('#total-characters').text(max + "/100");
  });

// const charLimit = 100;
// $('#details').summernote({
//     toolbar: [
//         // ['style', ['style']],
//         ['font', ['bold', 'underline', 'clear']],
//         ['color', ['color']],
//         ['para', ['ul', 'ol', 'paragraph']],
//     ],
//     callbacks: {
//         onKeydown: function(e) {
//             let characters = $('#details').summernote('code').replace(/(<([^>]+)>)/ig, "");
//             let totalCharacters = characters.length;
//             console.log(totalCharacters);
//             $("#total-characters").text(totalCharacters + " / " + charLimit);
//             var t = e.currentTarget.innerText;
//             if (t.trim().length >= charLimit) {
//                 if (e.keyCode != 8 && !(e.keyCode >= 37 && e.keyCode <= 40) && e.keyCode != 46 && !(e.keyCode == 88 && e.ctrlKey) && !(e.keyCode == 67 && e.ctrlKey)) 
//                 {
//                     e.preventDefault();
//                 }
//                 e.preventDefault();
//             }
//         },
//         onKeyup: function(e) {
//             var t = e.currentTarget.innerText;
//             $('#details').text(charLimit - t.trim().length);
//         },
//         onPaste: function(e) {
//             let characters = $('#details').summernote('code').replace(/(<([^>]+)>)/ig, "");
//             let totalCharacters = characters.length;
//             $("#total-characters").text(totalCharacters + " / " + charLimit);
//             var t = e.currentTarget.innerText;
//             var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
//             e.preventDefault();
//             var maxPaste = bufferText.length;
//             if (t.length + bufferText.length > charLimit) {
//                 maxPaste = charLimit - t.length;
//             }
//             if (maxPaste > 0) {
//                 document.execCommand('insertText', false, bufferText.substring(0, maxPaste));
//             }
//             $('#details').text(charLimit - t.length);
//         }
//     },
//     height: 100,
// });

$.ajax({
    url: "../../assets/lib/datareturn.php?i=2", 
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
    // thumbnailWidth: 50,
    // thumbnailHeight: 50,
    addRemoveLinks: true,
    maxFilesize: 10, // MB,
    dictRemoveFile: "ลบออก",
    // dictDefaultMessage: "เลือกรูปภาพ",
    dictFileTooBig: "ไม่อนุญาตให้อัพโหลดไฟล์เกิน 2 MB",
    dictMaxFilesExceeded:"สามารถอัพโหลดได้ 1 รูป",
    dictInvalidFileType: "สามารถอัพได้เฉพาะ jpg,jpeg,png เเละ gif",
    acceptedFiles: "image/jpg,image/jpeg,image/png,image/gif",
    init: function() {
        // var prevFile;
        this.on("sending", function(file, xhr, formData){
            let title = $("#title").val();
            let event_type = $("#event_type").val();
            let details = $("#details").val();
            formData.append("title", title);
            formData.append("event_type", event_type);
            formData.append("details", details);
        }),

        // this.on('addedfile', function(file) {
        //     // prevFile = file;
        //     // console.log(prevFile);
        //     if (prevFile == null) {
        //         prevFile = file;
        //     }
        //     else {
        //         this.removeFile(prevFile);
        //         prevFile = null;
        //     }
        // });
        this.on("error", function(file, message) { 
            // alert(message);
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
        if(response.data == "Success"){
            toastr.success('เข้าสู่ระบบเรียบร้อย')
            setTimeout(() => {
              window.location.href = '../information'
            }, 800);
          }
          else {
              toastr.error('ไม่สามารถบันทึกข้อมูลได้');
          }
        // console.log(response.id);
        // id = response.id;
        // $.each(response, function(i, el){
        //     if($.inArray(el, id) === -1) 
        //     {
        //         id.push(el);
        //     }
        // });
        // Videodropzone.processQueue();
    }
});

  //dropzone video
//   var Video_name = new Array;
//   var Videodropzone = new Dropzone('#mydropzone_video', {
//       url: '../../assets/lib/datareturn.php',
//       params: {
//           i:107
//       },
//       paramName: "video",
//       autoProcessQueue: false,
//       maxFiles: 1,
//       parallelUploads: 10,
//       uploadMultiple: true,
//       addRemoveLinks: true,
//       maxFilesize: 10, // MB
//       dictRemoveFile: "ลบออก",
//     //   dictDefaultMessage: "เลือกวิดิโอ",
//       dictFileTooBig: "ไม่อนุญาตให้อัพโหลดไฟล์เกิน 2 MB",
//       dictMaxFilesExceeded:"สามารถอัพโหลดได้ 1 วิดิโอ",
//       dictInvalidFileType: "สามารถอัพโหลดได้เฉพาะ mp4",
//       acceptedFiles: "video/mp4",
//       init: function() {

//         this.on("sending", function(file, xhr, formData){
//             formData.append("id", id);
//         }),

//           this.on("addedfile", function(file) {
//             file.previewElement.querySelector("img").src = '../../assets/img/video.png';
//           });
//           this.on("error", function(file, message) { 
//               alert(message);
//               this.removeFile(file); 
//           });
//       },
//       success: function(file,res) {
//         if(res.data == "Success"){
//             toastr.success('บันทึกข้อมูลเรียบร้อย')
//             setTimeout(() => {
//               window.location.href = '../information'
//             }, 800);
//         }
//         else {
//             toastr.error('ไม่สามารถบันทึกข้อมูลได้');
//         }
//       },
//       removedfile: function(file) {
//           let _ref;
//           return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
//       }
//   });

  $('#formData').on('submit', function (e) {   
    e.preventDefault();
    Picdropzone.processQueue();
  });
