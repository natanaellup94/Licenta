(function(){
    var BaseChartController;

    /**
     * Base chart controller.
     *
     * @constructor
     */
    BaseChartController = function(){
        /**
         * Main section for load goals section.
         * @type {*|jQuery|HTMLElement}
         */
        this.mainSection = $('#base-chart-section');

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

    BaseChartController.prototype.init = function(){
        this.loadSection();
    };

    /**
     * Load my goals section.
     */
    BaseChartController.prototype.loadSection = function(){
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

                var ctx = document.getElementById('base-chart-canvas').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
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
                            borderColor: [
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
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    max: 5.0
                                }
                            }]
                        }
                    }
                })
            }
        });
    };

    $(document).ready(function(){
       new BaseChartController;
    });
})();
