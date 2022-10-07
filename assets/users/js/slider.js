// Requires jQuery

// Initialize slider:
$(document).ready(function () {
    $(".noUi-handle").on("click", function () {
        $(this).width(50);
    });
    var rangeSlider_1 = document.getElementById("slider-range-1");
    var rangeSlider_2 = document.getElementById("slider-range-2");
    var rangeSlider_3 = document.getElementById("slider-range-3");
    var rangeSlider_4 = document.getElementById("slider-range-4");

    var rangeSlider1 = $("#slider-range-1");
    var rangeSlider2 = $("#slider-range-2");
    var rangeSlider3 = $("#slider-range-3");
    var rangeSlider4 = $("#slider-range-4");

    if (rangeSlider1.length > 0) {
        var moneyFormat = wNumb({
            decimals: 0,
            thousand: ",",
            prefix: ""
        });
        noUiSlider.create(rangeSlider_1, {
            start: 0,
            animate: false,
            tooltips: true,
            step: 1,
            range: {
                min: 0,
                max: 1000
            },
            format: moneyFormat
        });

        // Set visual min and max values and also update value hidden form inputs
        rangeSlider_1.noUiSlider.on("update", function (values, handle) {
            $(".min-value-money").val(values[0]);
        });
    }  
    
    if (rangeSlider3.length > 0) {
        var moneyFormat = wNumb({
            decimals: 0,
            thousand: ",",
            prefix: ""
        });
        noUiSlider.create(rangeSlider_3, {
            start: 0,
            animate: false,
            tooltips: true,
            step: 1,
            range: {
                min: 0,
                max: 1000
            },
            format: moneyFormat
        });

        // Set visual min and max values and also update value hidden form inputs
        rangeSlider_3.noUiSlider.on("update", function (values, handle) {
            $(".min-value-money").val(values[0]);
        });
    }  
    
    if (rangeSlider2.length > 0) {
        var moneyFormat = wNumb({
            decimals: 0,
            thousand: ",",
            prefix: ""
        });
        noUiSlider.create(rangeSlider_2, {
            start: 0,
            animate: false,
            tooltips: true,
            step: 1,
            range: {
                min: 0,
                max: 20
            },
            format: moneyFormat
        });

        // Set visual min and max values and also update value hidden form inputs
        rangeSlider_2.noUiSlider.on("update", function (values, handle) {
            $(".min-value-experience").val(values[0]);
        });
    }

    if (rangeSlider4.length > 0) {
        var moneyFormat = wNumb({
            decimals: 0,
            thousand: ",",
            prefix: ""
        });
        noUiSlider.create(rangeSlider_4, {
            start: 0,
            animate: false,
            tooltips: true,
            step: 1,
            range: {
                min: 0,
                max: 20
            },
            format: moneyFormat
        });

        // Set visual min and max values and also update value hidden form inputs
        rangeSlider_4.noUiSlider.on("update", function (values, handle) {
            $(".min-value-experience").val(values[0]);
        });
    }

});
