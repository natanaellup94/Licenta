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
                            label: "# of ability",
                            data: data
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
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
