"use strict";

(function(){
    var RecognitionController;

    /**
     * Recognition controller contructor.
     *
     * @constructor
     */
    RecognitionController = function () {
        /**
         * Main section for load goals section.
         * @type {*|jQuery|HTMLElement}
         */
        this.mainSection = $('#recognitions-section');
    };

    /**
     * Url for get my goals page elements.
     * @type {string}
     */
    const LOAD_SECTION_URL = '/recognition/list';

    /**
     * Init goal controller.
     */
    RecognitionController.prototype.init = function(){
        this.loadSection();
    };

    /**
     * Load my goals section.
     */
    RecognitionController.prototype.loadSection = function(){
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
        var controller = new RecognitionController();
        controller.init();
    });

})();