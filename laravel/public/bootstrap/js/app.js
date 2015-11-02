
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

//This function is for register form.
//when a user selects from the drop down the hidden input value will change
 $(function() 
{
    $('.dropdown-menu li').click(function()
    {
        $('#myType').val($(this).attr('value'));
    });
});
