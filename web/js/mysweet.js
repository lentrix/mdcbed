$(document).ready(function(){
    $(".delete-button").click(function(){
        var targetUrl = $(this).data('url');
        swal({
            title: "Delete?",
            text: $(this).data('message'),
            icon: 'warning',
            buttons: {
                delete : true,
                cancel : "Cancel"
            },
        }).then(value=>{
            if(value) {
                $.ajax({
                    url : targetUrl,
                    type:'POST'
                });
            }else {
                swal("Cancelled",'','info');
            }
        });
    });
});