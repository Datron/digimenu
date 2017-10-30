$(document).ready(function () {
   console.log("ready");
   var height = parseInt($(window).height())+300;
   console.log("height "+height);
   $('.col-md-3').attr("height",height.toString());
   //trigger file upload
    $('#upload').click(function () {
        $('.filesup').click();
    });
});