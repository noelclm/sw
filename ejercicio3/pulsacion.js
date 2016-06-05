$(document).ready(function(){

    $("body").on("click",function(event) {

        var r = $("#radio").val();
        var x = event.pageX - (r/2);
        var y = event.pageY - (r/2);
        
        $("#d").css('width', (r)+'px');
        $("#d").css('height', (r)+'px');
        $("#d").css('border-radius', (r)+'px');
        $("#d").css('top', (y)+'px');
        $("#d").css('left', (x)+'px');
        
        $('#d').show().delay(500).fadeOut('medium');

    });
    
});
