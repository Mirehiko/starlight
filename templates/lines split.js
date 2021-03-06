        (function($){
         $.fn.truncate = function(options) {
            
            var defaults = {
                length: 100,
                minTrail: 20,
                moreText: "читать полностью",
                lessText: "спрятать",
                ellipsisText: "..."
            };
          
            var options = $.extend(defaults, options);
            
            return this.each(function() {
                // элемент DOM текущей итерации  
                obj = $(this);
                // извлекаем содержимое элемента в виде HTML разметки  
                var body = obj.html();
           
                if(body.length > options.length + options.minTrail) {
                    // возвращаем позицию, после числа (options.length), с которой начинается совпадение 
                    // в нашем случае это пробел 
                    var splitLocation = body.indexOf(' ', options.length);
                    // если совпадение найденно то
                    if(splitLocation != -1) {
                    // прячем текст подсказки
             
                        var splitLocation = body.indexOf(' ', options.length);
                        var str1 = body.substring(0, splitLocation);
                        var str2 = body.substring(splitLocation, body.length - 1);
                        obj.html(str1 + '<span class="truncate_ellipsis">' + options.ellipsisText + 
                            '</span>' + '<span  class="truncate_more">' + str2 + '</span>');
                        obj.find('.truncate_more').css("display", "none");
                 
                        // вставляем ссылку "читать полностью" в конец сцществующего содержимого
                         obj.append(
                          '<div class="clearboth">' +
                           '<a href="#" class="truncate_more_link">' +  options.moreText + '</a>' + 
                          '</div>'
                         );

                        //устанавливаем событие onclick для ссылки "читать полностью"/"спрятать"
                        var moreLink = $('.truncate_more_link', obj);
                        var moreContent = $('.truncate_more', obj);
                        //дополнительный текст за текстом, например "..."    
                        var ellipsis = $('.truncate_ellipsis', obj);
                        moreLink.click(function() {
                            if(moreLink.text() == options.moreText) {
                                moreContent.show('normal');
                                moreLink.text(options.lessText);
                                ellipsis.css("display", "none");
                            } else {
                                moreContent.hide('normal');
                                moreLink.text(options.moreText);
                                ellipsis.css("display", "inline");
                            }
                          return false;
                        });
                    }
                } // end if
            });
         };
        })(jQuery);

        $(document).ready(function(){
        $('.film_c').truncate( {
            length: 90,
            minTrail: 10,
            moreText: '',
            lessText: '',
            ellipsisText: ""
        });
        });