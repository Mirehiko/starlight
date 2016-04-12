/*   Автокоплит   */
    $(document).ready(function(e){
        $('#searchField').keyup(function(){
            //console.log($(this).val());
            var numChars=$(this).val().length;
            
            if(numChars>=3){
                var queryString=$(this).val();
                $.post(
                    '/scripts/search.php',
                    {
                        queryString: queryString
                    },
                    function(data){
                        if(data!=''){
                            $('#autocomplete').show();
                            $('#autocomplete').css('width',$('#searchField').css('width'));
                            $('#autocomplete').html(data);
                            //$('#autocomplete').append(data);
                        }else{
                            $('#autocomplete').show();
                            $('#autocomplete').css('width',$('#searchField').css('width'));
                            $('#autocomplete').html("<ul class='nav'><li><a href='#'>По вашему запросу не найдено результатов</a></li></ul>");
                        }
                    }
                );
            }else if(numChars<3){
                $('#autocomplete').hide();
            }else if(numChars==0){
                $('#autocomplete').html('');
            }
        });
    });