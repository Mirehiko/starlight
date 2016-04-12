/*Menu*/
$(document).ready(function(e){
    $("#accordion > li > a").click(function(){

        if(false == $(this).next().is(':visible')) {
            $('#accordion ul').slideUp(280);
        }
        $(this).next().slideToggle(280);
    });

    $('#accordion ul:eq(10)').show();
});

