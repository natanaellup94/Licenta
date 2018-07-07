"use strict";

(function(){

    var SessionHandlerController;

    SessionHandlerController = function(){

        this.form = $('form');

        this.init();
    };

    SessionHandlerController.prototype.init = function(){

        $('.em').on('click', function(){
            var questionId = $(this).data('question-id');

            $("[data-question-id="+questionId+"]").each(function(){
                $(this).removeClass('selected');
            });

            $(this).addClass('selected');
        });

        $('.btn-danger').on('click', function(e) {
            e.preventDefault();

            var results = new Array();
            $('.selected').each(function(){
                if(isNaN(results[$(this).data('ability')])){
                    results[$(this).data('ability')] = 0;
                }
                results[$(this).data('ability')] += $(this).data('value');
            });

            for(var i = 1; i <=6; i++){
                var noQuestions = $("[data-ability-question = "+i+"]").length;
                var abilityMean = !isNaN(results[i] / noQuestions) ? results[i] / noQuestions : 0;
                $("[data-ability-field ="+i+"]").val(abilityMean);
            }

            $('form').submit();
        });
    };

    $(document).ready(function(){
       new SessionHandlerController();
    });
})();
