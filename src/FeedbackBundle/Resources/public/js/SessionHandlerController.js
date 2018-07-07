"use strict";

(function(){

    var SessionHandlerController;

    SessionHandlerController = function(){

        this.form = $('form');

        this.init();
    };

    SessionHandlerController.prototype.init = function(){
        $(this.form).on('submit', function(e) {
            e.preventDefault();

            $('.selected').each(function(){
                console.log($(this).data('value'));
                console.log($(this).data('ability'));
            });
        });
    };

    $(document).ready(function(){
       new SessionHandlerController();
    });
})();
