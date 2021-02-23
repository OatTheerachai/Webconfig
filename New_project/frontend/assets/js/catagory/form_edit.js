function  GetURLParameter(sParam){
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam)
        {
            return decodeURIComponent(sParameterName[1]);
        }
    }
}
const id = GetURLParameter('id');

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