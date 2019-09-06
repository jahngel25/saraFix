

    $(document).ready(function () {
        $('a[href="#navbar-more-show"], .navbar-more-overlay').on('click', function (event) {
            event.preventDefault();
            $('#boby').toggleClass('navbar-more-show');
            if ($('#boby').hasClass('navbar-more-show')) {
                $('a[href="#navbar-more-show"]').closest('li').addClass('active');
            } else {
                $('a[href="#navbar-more-show"]').closest('li').removeClass('active');
            }
            return false;
        });
    });

   function detallesProducts() {
               $('#modalPreguntas').modal({ show: true });
           }
           

    $(document).ready(function(){
        $('#help').tooltip({title: "Que es todaru", placement: "bottom"}); 
    });
  
   