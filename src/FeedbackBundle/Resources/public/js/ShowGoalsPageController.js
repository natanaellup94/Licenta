"use strict";

(function(){

    var ShowGoalPageController;

    ShowGoalPageController = function () {
        /**
         * Remove modal element.
         *
         * @type {*|jQuery|HTMLElement}
         */
        this.removeModal = $('#remove-modal');

        /**
         * Remove button element.
         *
         * @type {*|jQuery|HTMLElement}
         */
        this.removeButton = $('#remove-button');

        /**
         * Init page elements.
         */
        this.init();
    };

    const REMOVE_GOAL_URL = '/goals/remove';

    /**
     * Init page elements.
     */
    ShowGoalPageController.prototype.init = function(){
        var self = this;

        /** add on click event for trash icon (show remove pop-up and init it)*/
        $('.fa-trash').on('click', function(){
            var goalId = $(this).data('goal-id');
            self.openRemoveDialog(goalId);
        });

        /** add on click event for remove button */
        $(this.removeButton).on('click', function () {
            var goalId = $(this).data('goal-id');
            self.removeGoal(goalId, $('#goal-element'+goalId));
        });
    };

    /**
     * Init remove modal and init it.
     *
     * @param goalId
     */
    ShowGoalPageController.prototype.openRemoveDialog = function (goalId){
        $(this.removeButton).data('goal-id', goalId);
        $(this.removeModal).modal('show');
    };

    /**
     * Remove goal function.
     *
     * @param goalId
     * @param goalWrapper
     */
    ShowGoalPageController.prototype.removeGoal = function(goalId, goalWrapper) {
        var self = this;

        $.ajax({
            data: {goal_id: goalId},
            type: 'GET',
            url: REMOVE_GOAL_URL,
            success: function(response){
                if(response.success){
                    $(goalWrapper).remove();
                    $(self.removeModal).modal('hide');
                }
            }
        });
    };

    $(document).ready(function () {
        new ShowGoalPageController();
    })

})();