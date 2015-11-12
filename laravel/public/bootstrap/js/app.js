
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

//for datetime picker
$(function () {
        $('#datetimepicker6').datetimepicker();
        $('#datetimepicker7').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
    });



$(document).bind("contextmenu", function (event) {
    
    // Avoid the real one
    event.preventDefault();
    
    // Show contextmenu
    $(".custom-menu").finish().toggle(100).
    
    // In the right position (the mouse)
    css({
        top: event.pageY + "px",
        left: event.pageX + "px"
    });
});

$(document).bind("mousedown", function (e) {
    
    // If the clicked element is not the menu
    if (!$(e.target).parents(".custom-menu").length > 0) {
        $(".custom-menu").hide(100);
        
        // Hide it
    }
});

