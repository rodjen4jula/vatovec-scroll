

(function($) {

    $(document).ready( function(){
        let differenceMain = document.documentElement.scrollHeight - window.innerHeight;

        if ($(this).scrollTop() > 400 ) {
            $('.vatovecScrollToTop').css('opacity', '1').fadeIn(900);
        } else {
            $('.vatovecScrollToTop').fadeOut();
        }

        if ($(this).scrollTop() > 125 && differenceMain - $(this).scrollTop() > 125 ) {
            
            $('.vatovecScrollToBottom').css('opacity', '1').fadeIn(900);
        } else {
            $('.vatovecScrollToBottom').fadeOut();
        }

        $(window).scroll(function(){
            if ($(this).scrollTop() > 400) {
                $('.vatovecScrollToTop').css('opacity', '1').fadeIn(900);
            } else {
                $('.vatovecScrollToTop').fadeOut();
            }
        });
        // alert('aa');
        $(window).scroll(function(){
            // let difference = document.documentElement.scrollHeight - window.innerHeight;
            // let scrollposition = document.documentElement.scrollTop;             
            if ($(this).scrollTop() > 125 && differenceMain - $(this).scrollTop() > 125) { 
                $('.vatovecScrollToBottom').css('opacity', '1').fadeIn(900);
            } else {
                $('.vatovecScrollToBottom').fadeOut();
            }
        });
      
        $('.vatovecScrollToTop').click(function(){
            $('html, body').animate({scrollTop : 0},800);          
            return false;
        });

        $('.vatovecScrollToBottom').click(function(){
            
            $('html, body').animate({scrollTop : $(document).height() },700);
            // $('.vatovecScrollToBottom').css('opacity', '0').fadeOut(11100);
            $('.vatovecScrollToBottom').animate({opacity : 0 },700);
            return false;
        });
          
    } );     
   
})(jQuery);

// window.onscroll = function() {
//     const difference = document.documentElement.scrollHeight - window.innerHeight;
//     const scrollposition = document.documentElement.scrollTop; 
//     if (difference - scrollposition <= 2) {
//         alert("Bottom of Page!"); 
//     }   
// }

