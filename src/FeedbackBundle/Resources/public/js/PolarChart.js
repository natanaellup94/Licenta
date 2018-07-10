(function(){
    var PolarCharController;

    /**
     * Base chart controller.
     *
     * @constructor
     */
    PolarCharController = function(){
        /**
         * Main section for load goals section.
         * @type {*|jQuery|HTMLElement}
         */
        this.mainSection = $('#polar-chart-section');

        /**
         * Init page element.
         */
        this.init();
    };

    /**
     * Url for get my goals page elements.
     * @type {string}
     */
    const LOAD_SECTION_URL = '/session/current-user-score';

    PolarCharController.prototype.init = function(){
        this.loadSection();
    };

    /**
     * Load my goals section.
     */
    PolarCharController.prototype.loadSection = function(){
        var self = this;
        $.ajax({
            url: LOAD_SECTION_URL,
            type: "get",
            success: function (response) {
                var data = []; var labels = [];

                $.each(response, function(key, value){
                    labels.push(key);
                    data.push(value);
                });

                var ctx = document.getElementById('polar-chart-canvas').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'polarArea',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Rating from feedback',
                            data: data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            hoverBackgroundColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        max: 5.0
                    }
                })
            }
        });
    };

    $(document).ready(function(){
        new PolarCharController;
    });
})();
