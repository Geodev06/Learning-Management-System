(function ($) {
  'use strict';
  $(function () {
    if ($("#performanceLine").length) {
      const ctx = document.getElementById('performanceLine');
      var graphGradient = document.getElementById("performanceLine").getContext('2d');
      var graphGradient2 = document.getElementById("performanceLine").getContext('2d');
      var saleGradientBg = graphGradient.createLinearGradient(5, 0, 5, 100);
      saleGradientBg.addColorStop(0, 'rgba(26, 115, 232, 0.18)');
      saleGradientBg.addColorStop(1, 'rgba(26, 115, 232, 0.02)');
      var saleGradientBg2 = graphGradient2.createLinearGradient(100, 0, 50, 150);
      saleGradientBg2.addColorStop(0, 'rgba(0, 208, 255, 0.19)');
      saleGradientBg2.addColorStop(1, 'rgba(0, 208, 255, 0.03)');

      new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["SUN", "sun", "MON", "mon", "TUE", "tue", "WED", "wed", "THU", "thu", "FRI", "fri", "SAT"],
          datasets: [{
            label: 'This week',
            data: [50, 110, 60, 290, 200, 115, 130, 170, 90, 210, 240, 280, 200],
            backgroundColor: saleGradientBg,
            borderColor: [
              '#1F3BB3',
            ],
            borderWidth: 1.5,
            fill: true, // 3: no fill
            pointBorderWidth: 1,
            pointRadius: [4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4],
            pointHoverRadius: [2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2],
            pointBackgroundColor: ['#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3', '#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3', '#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3', '#1F3BB3)'],
            pointBorderColor: ['#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff',],
          }, {
            label: 'Last week',
            data: [30, 150, 190, 250, 120, 150, 130, 20, 30, 15, 40, 95, 180],
            backgroundColor: saleGradientBg2,
            borderColor: [
              '#52CDFF',
            ],
            borderWidth: 1.5,
            fill: true, // 3: no fill
            pointBorderWidth: 1,
            pointRadius: [0, 0, 0, 4, 0],
            pointHoverRadius: [0, 0, 0, 2, 0],
            pointBackgroundColor: ['#52CDFF)', '#52CDFF', '#52CDFF', '#52CDFF', '#52CDFF)', '#52CDFF', '#52CDFF', '#52CDFF', '#52CDFF)', '#52CDFF', '#52CDFF', '#52CDFF', '#52CDFF)'],
            pointBorderColor: ['#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff',],
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          elements: {
            line: {
              tension: 0.4,
            }
          },

          scales: {
            y: {
              border: {
                display: false
              },
              grid: {
                display: true,
                color: "#F0F0F0",
                drawBorder: false,
              },
              ticks: {
                beginAtZero: false,
                autoSkip: true,
                maxTicksLimit: 4,
                color: "#6B778C",
                font: {
                  size: 10,
                }
              }
            },
            x: {
              border: {
                display: false
              },
              grid: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                beginAtZero: false,
                autoSkip: true,
                maxTicksLimit: 7,
                color: "#6B778C",
                font: {
                  size: 10,
                }
              }
            }
          },
          plugins: {
            legend: {
              display: false,
            }
          }
        },
        plugins: [{
          afterDatasetUpdate: function (chart, args, options) {
            const chartId = chart.canvas.id;
            var i;
            const legendId = `${chartId}-legend`;
            const ul = document.createElement('ul');
            for (i = 0; i < chart.data.datasets.length; i++) {
              ul.innerHTML += `
                  <li>
                    <span style="background-color: ${chart.data.datasets[i].borderColor}"></span>
                    ${chart.data.datasets[i].label}
                  </li>
                `;
            }
            return document.getElementById(legendId).appendChild(ul);
          }
        }]
      });
    }

    if ($("#status-summary").length) {
      const statusSummaryChartCanvas = document.getElementById('status-summary');
      new Chart(statusSummaryChartCanvas, {
        type: 'line',
        data: {
          labels: ["SUN", "MON", "TUE", "WED", "THU", "FRI"],
          datasets: [{
            label: '# of Votes',
            data: [50, 68, 70, 10, 12, 80],
            backgroundColor: "#ffcc00",
            borderColor: [
              '#01B6A0',
            ],
            borderWidth: 2,
            fill: false, // 3: no fill
            pointBorderWidth: 0,
            pointRadius: [0, 0, 0, 0, 0, 0],
            pointHoverRadius: [0, 0, 0, 0, 0, 0],
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          elements: {
            line: {
              tension: 0.4,
            }
          },
          scales: {
            y: {
              border: {
                display: false
              },
              display: false,
              grid: {
                display: false,
              },
            },
            x: {
              border: {
                display: false
              },
              display: false,
              grid: {
                display: false,
              }
            }
          },
          plugins: {
            legend: {
              display: false,
            }
          }
        }
      });
    }

    if ($("#marketingOverview").length) {
      const marketingOverviewCanvas = document.getElementById('marketingOverview');
      new Chart(marketingOverviewCanvas, {
        type: 'bar',
        data: {
          labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
          datasets: [{
            label: 'Last week',
            data: [110, 220, 200, 190, 220, 110, 210, 110, 205, 202, 201, 150],
            backgroundColor: "#52CDFF",
            borderColor: [
              '#52CDFF',
            ],
            borderWidth: 0,
            barPercentage: 0.35,
            fill: true, // 3: no fill

          }, {
            label: 'This week',
            data: [215, 290, 210, 250, 290, 230, 290, 210, 280, 220, 190, 300],
            backgroundColor: "#1F3BB3",
            borderColor: [
              '#1F3BB3',
            ],
            borderWidth: 0,
            barPercentage: 0.35,
            fill: true, // 3: no fill
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          elements: {
            line: {
              tension: 0.4,
            }
          },

          scales: {
            y: {
              border: {
                display: false
              },
              grid: {
                display: true,
                drawTicks: false,
                color: "#F0F0F0",
                zeroLineColor: '#F0F0F0',
              },
              ticks: {
                beginAtZero: false,
                autoSkip: true,
                maxTicksLimit: 4,
                color: "#6B778C",
                font: {
                  size: 10,
                }
              }
            },
            x: {
              border: {
                display: false
              },
              stacked: true,
              grid: {
                display: false,
                drawTicks: false,
              },
              ticks: {
                beginAtZero: false,
                autoSkip: true,
                maxTicksLimit: 7,
                color: "#6B778C",
                font: {
                  size: 10,
                }
              }
            }
          },
          plugins: {
            legend: {
              display: false,
            }
          }
        },
        plugins: [{
          afterDatasetUpdate: function (chart, args, options) {
            const chartId = chart.canvas.id;
            var i;
            const legendId = `${chartId}-legend`;
            const ul = document.createElement('ul');
            for (i = 0; i < chart.data.datasets.length; i++) {
              ul.innerHTML += `
                  <li>
                    <span style="background-color: ${chart.data.datasets[i].borderColor}"></span>
                    ${chart.data.datasets[i].label}
                  </li>
                `;
            }
            return document.getElementById(legendId).appendChild(ul);
          }
        }]
      });
    }

    if ($('#totalVisitors').length) {
      var bar = new ProgressBar.Circle(totalVisitors, {
        color: '#fff',
        // This has to be the same size as the maximum width to
        // prevent clipping
        strokeWidth: 15,
        trailWidth: 15,
        easing: 'easeInOut',
        duration: 1400,
        text: {
          autoStyleContainer: false
        },
        from: {
          color: '#52CDFF',
          width: 15
        },
        to: {
          color: '#677ae4',
          width: 15
        },
        // Set default step function for all animate calls
        step: function (state, circle) {
          circle.path.setAttribute('stroke', state.color);
          circle.path.setAttribute('stroke-width', state.width);

          var value = Math.round(circle.value() * 100);
          if (value === 0) {
            circle.setText('');
          } else {
            circle.setText(value);
          }

        }
      });

      bar.text.style.fontSize = '0rem';
      bar.animate(.64); // Number from 0.0 to 1.0
    }

    if ($('#visitperday').length) {
      var bar = new ProgressBar.Circle(visitperday, {
        color: '#fff',
        // This has to be the same size as the maximum width to
        // prevent clipping
        strokeWidth: 15,
        trailWidth: 15,
        easing: 'easeInOut',
        duration: 1400,
        text: {
          autoStyleContainer: false
        },
        from: {
          color: '#34B1AA',
          width: 15
        },
        to: {
          color: '#677ae4',
          width: 15
        },
        // Set default step function for all animate calls
        step: function (state, circle) {
          circle.path.setAttribute('stroke', state.color);
          circle.path.setAttribute('stroke-width', state.width);

          var value = Math.round(circle.value() * 100);
          if (value === 0) {
            circle.setText('');
          } else {
            circle.setText(value);
          }

        }
      });

      bar.text.style.fontSize = '0rem';
      bar.animate(.34); // Number from 0.0 to 1.0
    }

    if ($("#doughnutChart").length) {
      const doughnutChartCanvas = document.getElementById('doughnutChart');
      new Chart(doughnutChartCanvas, {
        type: 'doughnut',
        data: {
          labels: ['Total', 'Net', 'Gross', 'AVG'],
          datasets: [{
            data: [40, 20, 30, 10],
            backgroundColor: [
              "#1F3BB3",
              "#FDD0C7",
              "#52CDFF",
              "#81DADA"
            ],
            borderColor: [
              "#1F3BB3",
              "#FDD0C7",
              "#52CDFF",
              "#81DADA"
            ],
          }]
        },
        options: {
          cutout: 90,
          animationEasing: "easeOutBounce",
          animateRotate: true,
          animateScale: false,
          responsive: true,
          maintainAspectRatio: true,
          showScale: true,
          legend: false,
          plugins: {
            legend: {
              display: false,
            }
          }
        },
        plugins: [{
          afterDatasetUpdate: function (chart, args, options) {
            const chartId = chart.canvas.id;
            var i;
            const legendId = `${chartId}-legend`;
            const ul = document.createElement('ul');
            for (i = 0; i < chart.data.datasets[0].data.length; i++) {
              ul.innerHTML += `
                  <li>
                    <span style="background-color: ${chart.data.datasets[0].backgroundColor[i]}"></span>
                    ${chart.data.labels[i]}
                  </li>
                `;
            }
            return document.getElementById(legendId).appendChild(ul);
          }
        }]
      });
    }

    if ($("#leaveReport").length) {
      const leaveReportCanvas = document.getElementById('leaveReport');
      new Chart(leaveReportCanvas, {
        type: 'bar',
        data: {
          labels: ["Jan", "Feb", "Mar", "Apr", "May"],
          datasets: [{
            label: 'Last week',
            data: [18, 25, 39, 11, 24],
            backgroundColor: "#52CDFF",
            borderColor: [
              '#52CDFF',
            ],
            borderWidth: 0,
            fill: true, // 3: no fill
            barPercentage: 0.5,
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          elements: {
            line: {
              tension: 0.4,
            }
          },
          scales: {
            y: {
              border: {
                display: false
              },
              display: true,
              grid: {
                display: false,
                drawBorder: false,
                color: "rgba(255,255,255,.05)",
                zeroLineColor: "rgba(255,255,255,.05)",
              },
              ticks: {
                beginAtZero: true,
                autoSkip: true,
                maxTicksLimit: 5,
                fontSize: 10,
                color: "#6B778C",
                font: {
                  size: 10,
                }
              }
            },
            x: {
              border: {
                display: false
              },
              display: true,
              grid: {
                display: false,
              },
              ticks: {
                beginAtZero: false,
                autoSkip: true,
                maxTicksLimit: 7,
                fontSize: 10,
                color: "#6B778C",
                font: {
                  size: 10,
                }
              }
            }
          },
          plugins: {
            legend: {
              display: false,
            }
          }
        }
      });
    }


    if ($("#pre_assessment_report").length) {
      const pre_assessment_report = document.getElementById('pre_assessment_report');
      $.get('/get_pre_assessment', function (res) {
        new Chart(pre_assessment_report, {
          type: 'bar',
          data: {
            labels: ["Auditory", "Kinesthetic", "Visual", "Reading and Writing"],
            datasets: [{
              label: 'Score',
              data: [res.auditory_score, res.kinesthetic_score, res.visual_score, res.reading_and_writing_score],
              backgroundColor: ["#060270", '#D05A2E', '#de1708', 'rgb(99, 137, 233)'],
              borderColor: [],
              borderWidth: 0,
              fill: true, // 3: no fill
              barPercentage: 0.5,
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            elements: {
              line: {
                tension: 0.4,
              }
            },
            scales: {
              y: {
                border: {
                  display: false
                },
                display: true,
                grid: {
                  display: false,
                  drawBorder: false,
                  color: "rgba(255,255,255,.05)",
                  zeroLineColor: "rgba(255,255,255,.05)",
                },
                ticks: {
                  beginAtZero: true,
                  autoSkip: true,
                  maxTicksLimit: 5,
                  fontSize: 10,
                  color: "#6B778C",
                  font: {
                    size: 10,
                  }
                }
              },
              x: {
                border: {
                  display: false
                },
                display: true,
                grid: {
                  display: false,
                },
                ticks: {
                  beginAtZero: false,
                  autoSkip: true,
                  maxTicksLimit: 7,
                  fontSize: 10,
                  color: "#6B778C",
                  font: {
                    size: 10,
                  }
                }
              }
            },
            plugins: {
              legend: {
                display: false,
              },
              tooltip: {
                callbacks: {
                  // Custom tooltip to display percentage
                  label: function (tooltipItem) {
                    var value = tooltipItem.raw;
                    var percentage = (value / 100) * 100; // Assuming the score is out of 100
                    return value + '%'; // Adds percentage sign
                  }
                }
              }
            }
          }
        });
      });

    }

    if ($("#activity_stats").length) {
      const activity_stats = document.getElementById('activity_stats');
      $.get('/api/students/stats', function (res) {

        var modalities = res.data.modalities;


        var auditory = parseFloat(modalities.Auditory.averageScore).toFixed(2);
        var visual = parseFloat(modalities.Visual.averageScore).toFixed(2);
        var kinesthetic = parseFloat(modalities.Kinesthetic.averageScore).toFixed(2);
        var reading_and_writing = parseFloat(modalities['Reading & Writing'].averageScore).toFixed(2);
        
        
        
        
        new Chart(activity_stats, {
          type: 'bar',
          data: {
            labels: ["Auditory", "Kinesthetic", "Visual", "Reading and Writing"],
            datasets: [{
              label: 'Score',
              data: [auditory, kinesthetic, visual, reading_and_writing],
              backgroundColor: ["#060270", '#D05A2E', '#de1708', 'rgb(99, 137, 233)'],
              borderColor: [],
              borderWidth: 0,
              fill: true, // 3: no fill
              barPercentage: 0.5,
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            elements: {
              line: {
                tension: 0.4,
              }
            },
            scales: {
              y: {
                border: {
                  display: false
                },
                display: true,
                grid: {
                  display: false,
                  drawBorder: false,
                  color: "rgba(255,255,255,.05)",
                  zeroLineColor: "rgba(255,255,255,.05)",
                },
                ticks: {
                  beginAtZero: true,
                  autoSkip: true,
                  maxTicksLimit: 5,
                  fontSize: 10,
                  color: "#6B778C",
                  font: {
                    size: 10,
                  }
                }
              },
              x: {
                border: {
                  display: false
                },
                display: true,
                grid: {
                  display: false,
                },
                ticks: {
                  beginAtZero: false,
                  autoSkip: true,
                  maxTicksLimit: 7,
                  fontSize: 10,
                  color: "#6B778C",
                  font: {
                    size: 10,
                  }
                }
              }
            },
            plugins: {
              legend: {
                display: false,
              },
              tooltip: {
                callbacks: {
                  // Custom tooltip to display percentage
                  label: function (tooltipItem) {
                    var value = tooltipItem.raw;
                    var percentage = (value / 100) * 100; // Assuming the score is out of 100
                    return value + '%'; // Adds percentage sign
                  }
                }
              }
            }
          }
        });
      });

    }

    function getRandomColor() {
      var letters = '0123456789ABCDEF';
      var color = '#';
      for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      return color;
    }

    if ($("#avg_score_per_modules").length) {
      const avg_score_per_modules = document.getElementById('avg_score_per_modules');
      $.get('/get_avg_score_per_modules', function (res) {

        var labels = [];
        var data = [];
        var colors = [];

        if (res) {
          res.forEach(element => {
            labels.push(element.title)
            data.push(element.avg_score)
            colors.push(getRandomColor())
          });

          new Chart(avg_score_per_modules, {
            type: 'bar',
            data: {
              labels: labels,
              datasets: [{
                label: 'Score',
                data: data,
                backgroundColor: colors,
                borderColor: [],
                borderWidth: 0,
                fill: true, // 3: no fill
                barPercentage: 0.5,
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              elements: {
                line: {
                  tension: 0.4,
                }
              },
              scales: {
                y: {
                  border: {
                    display: false
                  },
                  display: true,
                  grid: {
                    display: false,
                    drawBorder: false,
                    color: "rgba(255,255,255,.05)",
                    zeroLineColor: "rgba(255,255,255,.05)",
                  },
                  ticks: {
                    beginAtZero: true,
                    autoSkip: true,
                    maxTicksLimit: 5,
                    fontSize: 10,
                    color: "#6B778C",
                    font: {
                      size: 10,
                    }
                  }
                },
                x: {
                  border: {
                    display: false
                  },
                  display: true,
                  grid: {
                    display: false,
                  },
                  ticks: {
                    beginAtZero: false,
                    autoSkip: true,
                    maxTicksLimit: 7,
                    fontSize: 10,
                    color: "#6B778C",
                    font: {
                      size: 10,
                    }
                  }
                }
              },
              plugins: {
                legend: {
                  display: false,
                },
                tooltip: {
                  callbacks: {

                  }
                }
              }
            }
          });
        }


      });

    }


    if ($("#avg_score_per_modality").length) {
      const avg_score_per_modality = document.getElementById('avg_score_per_modality');
      $.get('/get_avg_score_per_modality', function (res) {

        console.log(res)
        var dt = res[0]
        var labels = ['Visual','Auditory','Reading & Writing','Kinesthetic'];
        var data = [dt.visual, dt.auditory, dt.reading_writing, dt.kinesthetic]
        var colors = ['dodgerblue'];

        if (res) {
         
          console.log()
          new Chart(avg_score_per_modality, {
            type: 'bar',
            data: {
              labels: labels,
              datasets: [{
                label: 'Score',
                data: data,
                backgroundColor: colors,
                borderColor: [],
                borderWidth: 0,
                fill: true, // 3: no fill
                barPercentage: 0.5,
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              elements: {
                line: {
                  tension: 0.4,
                }
              },
              scales: {
                y: {
                  border: {
                    display: false
                  },
                  display: true,
                  grid: {
                    display: false,
                    drawBorder: false,
                    color: "rgba(255,255,255,.05)",
                    zeroLineColor: "rgba(255,255,255,.05)",
                  },
                  ticks: {
                    beginAtZero: true,
                    autoSkip: true,
                    maxTicksLimit: 5,
                    fontSize: 10,
                    color: "#6B778C",
                    font: {
                      size: 10,
                    }
                  }
                },
                x: {
                  border: {
                    display: false
                  },
                  display: true,
                  grid: {
                    display: false,
                  },
                  ticks: {
                    beginAtZero: false,
                    autoSkip: true,
                    maxTicksLimit: 7,
                    fontSize: 10,
                    color: "#6B778C",
                    font: {
                      size: 10,
                    }
                  }
                }
              },
              plugins: {
                legend: {
                  display: false,
                },
                tooltip: {
                  callbacks: {

                  }
                }
              }
            }
          });
        }


      });

    }


    // if ($.cookie('staradmin2-pro-banner') != "true") {
    //   document.querySelector('#proBanner').classList.add('d-flex');
    //   document.querySelector('.navbar').classList.remove('fixed-top');
    // }
    // else {
    //   document.querySelector('#proBanner').classList.add('d-none');
    //   document.querySelector('.navbar').classList.add('fixed-top');
    // }

    // if ($(".navbar").hasClass("fixed-top")) {
    //   document.querySelector('.page-body-wrapper').classList.remove('pt-0');
    //   document.querySelector('.navbar').classList.remove('pt-5');
    // }
    // else {
    //   document.querySelector('.page-body-wrapper').classList.add('pt-0');
    //   document.querySelector('.navbar').classList.add('pt-5');
    //   document.querySelector('.navbar').classList.add('mt-3');

    // }
    // document.querySelector('#bannerClose').addEventListener('click', function () {
    //   document.querySelector('#proBanner').classList.add('d-none');
    //   document.querySelector('#proBanner').classList.remove('d-flex');
    //   document.querySelector('.navbar').classList.remove('pt-5');
    //   document.querySelector('.navbar').classList.add('fixed-top');
    //   document.querySelector('.page-body-wrapper').classList.add('proBanner-padding-top');
    //   document.querySelector('.navbar').classList.remove('mt-3');
    //   var date = new Date();
    //   date.setTime(date.getTime() + 24 * 60 * 60 * 1000);
    //   $.cookie('staradmin2-pro-banner', "true", { expires: date });
    // });

  });
  // iconify.load('icons.svg').then(function() {
  //   iconify(document.querySelector('.my-cool.icon'));
  // });


  
})(jQuery);