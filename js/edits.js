$(document).ready(function () {
   console.log("ready");
   var height = parseInt($(window).height())+300;
   console.log("height "+height);
   $('.col-md-3').attr("height",height.toString());
   //trigger file upload
    $('.form-group #upload').click(function () {
        $('.filesup').click();
    });
    $('.navMenu a').click(function () {
        var section = $(this).attr("href");
        switch (section){
            case "#orders":
                break;
            case "#completed":
                break;
            case "#menu_insert":
                $('.dbHandler').css("display","none");
                $('.inserting').css("display","block");
                break;
            case "#menu_modify":
                $('.dbHandler').css("display","none");
                $('.modifying').css("display","block");
                break;
            case "#staff_insert":
                $('.dbHandler').css("display","none");
                $('.staffInsert').css("display","block");
                break;
            case "#staff_modify":
                $('.dbHandler').css("display","none");
                $('.staffModify').css("display","block");
                break;
        }
    });
    $('.filesup').change(function(){
        console.log(this.files);
        if (this.files && this.files[0])
        {
            photo_set = true;
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#foodim').attr('src', e.target.result);
                $('#foodim').css("display","block");
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
});
$(document).ready(function(){
    //navbar events
    $("#navClose").on("click touchstart", function(){
        var menu = document.getElementById("nav-menu");
        TweenLite.to(menu, 0.5, {width:"0"});
    });
    $("#nav-menu-button").on("click touchstart", function() {
        var menu = document.getElementById("nav-menu");
        TweenLite.to(menu, 0.5, {width:"20%"});
    });

});
