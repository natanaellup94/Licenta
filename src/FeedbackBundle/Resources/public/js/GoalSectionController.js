"use strict";

(function(){
    var GoalController;

    /**
     * Goal controller contructor.
     *
     * @constructor
     */
    GoalController = function () {
        /**
         * Main section for load goals section.
         * @type {*|jQuery|HTMLElement}
         */
        this.mainSection = $('#goals-section');
    };

    /**
     * Url for get my goals page elements.
     * @type {string}
     */
    const LOAD_SECTION_URL = '/goals/show_my_goals'

    /**
     * Init goal controller.
     */
    GoalController.prototype.init = function(){
        this.loadSection();
    };

    /**
     * Load my goals section.
     */
    GoalController.prototype.loadSection = function(){
        var self = this;
        $.ajax({
            url: LOAD_SECTION_URL,
            type: "get",
            success: function (response) {
                self.mainSection.html(response.pageContent);
            }
        });
    };

    /**
     * Init page elements.
     */
    $(document).ready(function(){
        var controller = new GoalController();
        controller.init();
    });

})();