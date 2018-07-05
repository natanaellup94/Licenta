"use strict";

(function(){
    var SessionController;

    /**
     * Goal controller contructor.
     *
     * @constructor
     */
    SessionController = function () {
        /**
         * Main section for load goals section.
         * @type {*|jQuery|HTMLElement}
         */
        this.mainSection = $('#sessions-section');
    };

    /**
     * Url for get my goals page elements.
     * @type {string}
     */
    const LOAD_SECTION_URL = '/session/show_my_session_section';

    /**
     * Init goal controller.
     */
    SessionController.prototype.init = function(){
        this.loadSection();
    };

    /**
     * Load my goals section.
     */
    SessionController.prototype.loadSection = function(){
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
        var controller = new SessionController();
        controller.init();
    });

})();