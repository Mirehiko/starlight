
		var slideWidth=190;
		//console.log(slideWidth);
		var sliderTimer;
		$(function(){
			$('.slidewrapper').width($('.slidewrapper').children().size()*slideWidth);
		    sliderTimer=setInterval(nextSlide,3000);
		    $('.viewport').hover(function(){
		        clearInterval(sliderTimer);
		    },function(){
		        sliderTimer=setInterval(nextSlide,3000);//при наведении останавливает прокрутку и задает направление смены слайдов(след/пред)
		    });
		    $('#next_slide').click(function(){
		        //clearInterval(sliderTimer);
		        nextSlide();

		        //sliderTimer=setInterval(nextSlide,3000);
		    });
		    $('#prev_slide').click(function(){
		        //clearInterval(sliderTimer);
		        prevSlide();
		        //sliderTimer=setInterval(nextSlide,3000);
		    });
		});

		function nextSlide(){
		    var currentSlide=parseInt($('.slidewrapper').data('current'));
		    currentSlide++;
		    if(currentSlide>=$('.slidewrapper').children().size()-8)
		    {
		        $('.slidewrapper').css('left',-(currentSlide-2)*slideWidth);  
		        $('.slidewrapper').append($('.slidewrapper').children().first().clone()); 
		        $('.slidewrapper').children().first().remove();
		        currentSlide--;                        
		    }
		    $('.slidewrapper').animate({left: -currentSlide*slideWidth},500).data('current',currentSlide);
		}

		function prevSlide(){
		    var currentSlide=parseInt($('.slidewrapper').data('current'));
		    currentSlide--;
		    if(currentSlide<0)
		    {
		        $('.slidewrapper').css('left',-(currentSlide+2)*slideWidth);  
		        $('.slidewrapper').prepend($('.slidewrapper').children().last().clone()); 
		        $('.slidewrapper').children().last().remove();
		        currentSlide++;   
		    }
		    $('.slidewrapper').animate({left: -currentSlide*slideWidth},500).data('current',currentSlide);
		}
