"use strict";

(function(){

    var ShowMyRecognitionsPageController;

    ShowMyRecognitionsPageController = function () {
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

    const REMOVE_RECOGNITION_URM = '/recognition/remove';

    /**
     * Init page elements.
     */
    ShowMyRecognitionsPageController.prototype.init = function(){
        var self = this;

        /** add on click event for trash icon (show remove pop-up and init it)*/
        $('.fa-trash').on('click', function(){
            var recognitionId = $(this).data('recognition-id');
            self.openRemoveDialog(recognitionId);
        });

        /** add on click event for remove button */
        $(this.removeButton).on('click', function () {
            var recognitionId = $(this).data('recognition-id');
            self.removeRecognition(recognitionId, $('#recognition'+recognitionId));
        });
    };

    /**
     * Init remove modal and init it.
     *
     * @param recognitionId
     */
    ShowMyRecognitionsPageController.prototype.openRemoveDialog = function (recognitionId){
        $(this.removeButton).data('recognition-id', recognitionId);
        $(this.removeModal).modal('show');
    };

    /**
     * Remove recognition function.
     *
     * @param recognitionId
     * @param recognitionWrapper
     */
    ShowMyRecognitionsPageController.prototype.removeRecognition = function(recognitionId, recognitionWrapper) {
        var self = this;

        $.ajax({
            data: {recognition_id: recognitionId},
            type: 'GET',
            url: REMOVE_RECOGNITION_URM,
            success: function(response){
                if(response.success){
                    $(recognitionWrapper).remove();
                    $(self.removeModal).modal('hide');
                }
            }
        });
    };

    $(document).ready(function () {
        new ShowMyRecognitionsPageController();
    })

})();