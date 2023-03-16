"use strict";
(function ($) {
    "use strict";
    var period = $('#days').val();
    $('#days').on('change', () => {
        period = $('#days').val();
        loadData();
    })

    var base_url = $("#base_url").val();
    var site_url = $("#site_url").val();
    var dashboard_static_url = $("#dashboard_static").val();
    var isPerformanceChartLoaded = false;
    var performanceChart = false;

    loadStaticData();
    load_performance(7);


    function number_format(number) {
        var num = new Intl.NumberFormat({maximumSignificantDigits: 3}).format(number);
        return num;
    }

})(jQuery);
