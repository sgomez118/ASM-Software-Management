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

function getTimeRemaining(endtime) {
    var t = Date.parse(endtime) - Date.now();
    var seconds = Math.floor((t / 1000) % 60);
    var minutes = Math.floor((t / 1000 / 60) % 60);
    var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    return {
        'total': t,
        'days': days,
        'hours': hours,
        'minutes': minutes,
        'seconds': seconds
    };
}

function initializeClock(id, endtime) {
    var clock = document.getElementById(id);
    var daysSpan = clock.querySelector('.days');
    var hoursSpan = clock.querySelector('.hours');
    var minutesSpan = clock.querySelector('.minutes');
    var secondsSpan = clock.querySelector('.seconds');

    function updateClock() {
        var t = getTimeRemaining(endtime);

        daysSpan.innerHTML = t.days;
        hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
        minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
        secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

        if (t.total <= 0) {
            clearInterval(timeinterval);
        }
    }

    updateClock();
    var timeinterval = setInterval(updateClock, 1000);
}

$(document).ready(function(e) {
    $(document).on('contextmenu',function(e){
        alert("Right click is disable on this website!");
        return false;
    });
});

$(document).ready(function(e) {
    $(document).on('copy cut', function(e) {
        return false;
    });
});

//Search
$(document).ready(function() {
  $(".search").keyup(function () {
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });
    
  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' item');

  if(jobCount == '0') {$('.no-result').show();}
    else {$('.no-result').hide();}
          });
});

//Custom Menu
// $(document).bind("contextmenu", function (event) {
    
//     // Avoid the real one
//     event.preventDefault();
    
//     // Show contextmenu
//     $(".custom-menu").finish().toggle(100).
    
//     // In the right position (the mouse)
//     css({
//         top: event.pageY + "px",
//         left: event.pageX + "px"
//     });
// });

// $(document).bind("mousedown", function (e) {
    
//     // If the clicked element is not the menu
//     if (!$(e.target).parents(".custom-menu").length > 0) {
//         $(".custom-menu").hide(100);
        
//         // Hide it
//     }
// });



//Try save answer question





