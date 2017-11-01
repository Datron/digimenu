$(document).ready(function () {
   $('.tabs').css('display','none');
   $('#all').css('display','block');
    $.ajax({
        method:'POST',
        url: 'cart.php',
        data: {'add':2}
    }).done(function (data) {
        $('#curCart').html(data);
        console.log("ajax done");
    });
   $('.btn-menu').click(function () {
      var id = $(this).text();
      switch(id){
          case 'All':
              $('.tabs').css('display','none');
              $('#all').css('display','block');
              break;
          case 'Burgers':
              $('.tabs').css('display','none');
              $('#Burgers').css('display','block');
              break;
          case 'Dosas':
              $('.tabs').css('display','none');
              $('#Dosas').css('display','block');
              break;
          case 'Beverages':
              $('.tabs').css('display','none');
              $('#Beverages').css('display','block');
              break;
          case 'Sides':
              $('.tabs').css('display','none');
              $('#Sides').css('display','block');
              break;
      }
       document.body.scrollTop = 0; // For Chrome, Safari and Opera
       document.documentElement.scrollTop = 0; // For IE and Firefox
   });
   $('.btn-quantity').on('click', function () {
      var sel = $(this).text().split('_')[0];
      var showQuan = $(this).parent().find("span");
      var id = parseInt($(this).parent().attr('value'));
      var quantity = parseInt(showQuan.text());
      var request = 0;
      if (sel == 'add') {
          quantity++;
          request = 1;
      }
      else if (sel == 'remove' && quantity != 0)
          quantity--;
      showQuan.html('&nbsp; '+quantity);
      $.ajax({
          method:'POST',
          url: 'cart.php',
          data: {'add':request,'id':id,'quantity':quantity}
      }).done(function (data) {
          $('#curCart').html(data);
            console.log("ajax done");
      });
   });
});