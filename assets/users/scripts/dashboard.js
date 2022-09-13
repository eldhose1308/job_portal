"use strict";

document.addEventListener("DOMContentLoaded", () => {
    load_contact_us_json();
    load_dashboard_count();
    load_recent_activity();
    load_visitors_traffic();
  });


  function load_contact_us_json() {
    $("#na_datatable").dataTable().fnDestroy();

    var table = $('#na_datatable').DataTable({
      "processing": true,
      "serverSide": false,
      "ajax": {
        "type": "GET",
        "url": $("#contact_messages_form").attr("action")
      },
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "bFilter": false,
      "bInfo": false,
      "bPaginate": false,
    });
  }



  function load_dashboard_count() {
    let dashboard_counts_url = $("#dashboard_counts_form").attr("action");

    var count_xhr = $.get(dashboard_counts_url);

    count_xhr.done(function(data) {
      var out = jQuery.parseJSON(data);
      out = out.data;

      $("#enquiries_count").html(out.enquiries);
      $("#news_count").html(out.news);
      $("#donations_count").html("₹" + out.donations);
      $("#traffic_count").html(out.traffic);
    });

  }


  function load_recent_activity() {
    let recent_activity_url = $("#recent_activity_form").attr("action");
    var activity_xhr = $.get(recent_activity_url);

    activity_xhr.done(function(data) {
      var out = jQuery.parseJSON(data);
      out = out.data;

      var activities = '';


      out = out.activity;
      out.map(function(element) {

        activities += `<li class="event-list">
              <div class="event-timeline-dot">
                <i class="material-icons md-play_circle_outline font-xxl"></i>
              </div>
              <div class="media">
                <div class="me-3">
                  <h6><span>${element.created_time}</span> <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i></h6>
                </div>
                <div class="media-body">
                  <div>${element.activity}</div>
                </div>
              </div>
            </li>`;


      });


      $('.activity_block').html(activities);
    });

  }


  function load_visitors_traffic() {
    let visitors_traffic_url = $("#visitors_traffic_form").attr("action");
    var traffic_xhr = $.get(visitors_traffic_url);

    traffic_xhr.done(function(data) {
      var out = jQuery.parseJSON(data);
      out = out.data.traffic;

      setTrafficChart(out);
    });
  }



  function setTrafficChart(out) {

    var data_array_x = [];
    var data_array_y = [];
    $.each(out, function(index, value) {
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
