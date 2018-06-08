"use strict";

(function () {

    var HandlerGoalForm;

    HandlerGoalForm  = function(){
        /**
         * Date picker fields.
         * @type {*|jQuery|HTMLElement}
         */
        this.datepickerFields = $('.js-datepicker');

        /**
         * Current form.
         *
         * @type {*|jQuery|HTMLElement}
         */
        this.form = $('.handler-goal-form');

        /**
         * Init page elements.
         */
        this.init();
    };

    /**
     * Init page elements.
     */
    HandlerGoalForm.prototype.init = function() {
        $(this.datepickerFields).each(function(){
            $(this).datepicker()
        });
    };

    $(document).ready(function () {
        new HandlerGoalForm();
    });
})();