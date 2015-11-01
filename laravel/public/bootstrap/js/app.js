
// $(".nav a").on("click", function(){
//    $(".nav").find(".active").removeClass("active");
//    $(this).parent().addClass("active");
// });

$(function(){

    $(".dropdown-menu li a").click(function(){

      $(".selectpicker:first-child").text($(this).text());
      $(".selectpicker:first-child").val($(this).text());

   });

});
