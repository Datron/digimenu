function orders(){
    $.ajax({
        method:'POST',
        url: 'edit_menu.php',
        data: {'load':1}
    }).done(function (data) {
        $('.orders').html(data);
    });
}
function compords() {
    $.ajax({
        method:'POST',
        url: 'edit_menu.php',
        data: {'comp_ord':1}
    }).done(function (data) {
        $('.complete-order').html(data);
    });
}
$(document).ready(function () {
    //navbar events
    $("#navClose").on("click touchstart", function(){
        var menu = document.getElementById("nav-menu");
        TweenLite.to(menu, 0.5, {width:"0"});
    });
    $("#nav-menu-button").on("click touchstart", function() {
        var menu = document.getElementById("nav-menu");
        TweenLite.to(menu, 0.5, {width:"20%"});
    });
    console.log("ready");
    $('.dbHandler').css("display","none");
    $('.orders').css("display","block");
    orders();
    compords();
    setInterval(orders, 5000);
   //trigger file upload
    $('.form-group #upload').click(function () {
        $('.filesup').click();
    });
    $('.orders').on('click', '.btn-done', function () {
        var ord = $(this).val();
        $.ajax({
            method: 'POST',
            url: 'edit_menu.php',
            data: {'ordcomp':ord}
        }).done(function () {
            console.log(ord+" done");
            $(this).removeClass('btn-done');
            $(this).addClass('btn-success');
        });
    });
    $('.navMenu a').click(function () {
        var section = $(this).attr("href");
        switch (section){
            case "#orders":
                $('.dbHandler').css("display","none");
                $('.orders').css("display","block");
                break;
            case "#completed":
                $('.dbHandler').css("display","none");
                $('.complete-order').css("display","block");
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

