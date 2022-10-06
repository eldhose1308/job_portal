"use strict";

document.addEventListener("DOMContentLoaded", () => {
  load_dashboard_count();
  // load_visitors_traffic();
});





function load_dashboard_count() {
  let dashboard_counts_url = $("#dashboard_counts_form").attr("action");

  var count_xhr = $.get(dashboard_counts_url);

  count_xhr.done(function (data) {
    var out = jQuery.parseJSON(data);
    out = out.data;

    $(".total_applications").html(out.total_applications);
    $(".shortlisted_applications").html(out.shortlisted_applications);
    $(".rejected_applications").html(out.rejected_applications);

  });

}



function load_visitors_traffic() {
  let visitors_traffic_url = $("#visitors_traffic_form").attr("action");
  var traffic_xhr = $.get(visitors_traffic_url);

  traffic_xhr.done(function (data) {
    var out = jQuery.parseJSON(data);
    out = out.data.traffic;

    setTrafficChart(out);
  });
}



function setTrafficChart(out) {

  var data_array_x = [];
  var data_array_y = [];
  $.each(out, function (index, value) {
    data_array_y[index] = Number(value.visit_count);
    data_array_x[index] = value.visited_date;
  });


  new Chart("trafficChart", {
    type: "bar",
    data: {
      labels: data_array_x,
      datasets: [{
        backgroundColor: "#3bb77e",
        data: data_array_y
      }]
    }
  });


}
