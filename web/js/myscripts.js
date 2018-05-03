$(document).ready(function(){    
    $(".clickable").click(function(){
        document.location = $(this).attr('value');
    });
});

