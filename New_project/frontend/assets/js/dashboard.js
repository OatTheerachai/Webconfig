$(function () {
    'use strict'
  
    var ticksStyle = {
      fontColor: '#495057',
      fontStyle: 'bold'
    }
  
    var mode      = 'index'
    var intersect = true
  
    $.ajax({  
      type: "GET",  
      url: "../../assets/lib/datareturn.php?i=13"
    }).done(function(resp) {
      var $EventChart = $('#view-event-chart');
      var EventChart  = new Chart($EventChart, {
        type   : 'bar',
        data   : {
          labels  : resp.name,
          datasets: [
            {
              backgroundColor: '#007bff',
              borderColor    : '#007bff',
              data           : resp.view
            }
          ]
        },
        options: {
          maintainAspectRatio: false,
          tooltips           : {
            mode     : mode,
            intersect: intersect
          },
          hover              : {
            mode     : mode,
            intersect: intersect
          },
          legend             : {
            display: false
          },
          scales             : {
            yAxes: [{
              // display: false,
              gridLines: {
                display      : true,
                lineWidth    : '4px',
                color        : 'rgba(0, 0, 0, .2)',
                zeroLineColor: 'transparent'
              },
              ticks    : $.extend({
                beginAtZero: true,
    
                // Include a ฿ in the ticks
                callback: function (value, index, values) {
                  return value
                }
              }, ticksStyle)
            }],
            xAxes: [{
              display  : true,
              gridLines: {
                display: false
              },
              ticks    : ticksStyle
            }]
          }
        }
      })
    })

    $.ajax({  
      type: "GET",  
      url: "../../assets/lib/datareturn.php?i=12"
    }).done(function(resp) {
      var $ViewChart = $('#view-agency-chart');
      var ViewChart  = new Chart($ViewChart, {
        type   : 'bar',
        data   : {
          labels  : resp.name,
          datasets: [
            {
              backgroundColor: '#007bff',
              borderColor    : '#007bff',
              data           : resp.view
            }
          ]
        },
        options: {
          maintainAspectRatio: false,
          tooltips           : {
            mode     : mode,
            intersect: intersect
          },
          hover              : {
            mode     : mode,
            intersect: intersect
          },
          legend             : {
            display: false
          },
          scales             : {
            yAxes: [{
              // display: false,
              gridLines: {
                display      : true,
                lineWidth    : '4px',
                color        : 'rgba(0, 0, 0, .2)',
                zeroLineColor: 'transparent'
              },
              ticks    : $.extend({
                beginAtZero: true,
    
                // Include a ฿ in the ticks
                callback: function (value, index, values) {
                  return value
                }
              }, ticksStyle)
            }],
            xAxes: [{
              display  : true,
              gridLines: {
                display: false
              },
              ticks    : ticksStyle
            }]
          }
        }
      })
    })

  })
  