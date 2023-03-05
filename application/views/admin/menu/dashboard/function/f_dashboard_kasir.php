<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
var selectedId;
var $date = "<?php echo R::isoDateTime(); ?>";
var $User = "<?php echo $user->id;?>";
var $Role = "<?php echo $role->id;?>";

$(function() {
    'use strict'
    Globalize.culture("id-ID");
    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    }
    var mode = 'index';
    var intersect = true;
    var d = new Date();
    var days = ['MINGGU', 'SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT', 'SABTU'];
    var daysNow = null;
    var Chartsc = {
        count: 10,
        total: null,
        totalAfter: [],
        totalBefore: [],
        After: [],
        Befour: [],
        Day: [],
    };
    var $Chartcustomer = $('#Chart-customer');
    var $SalesChart = $('#Sales-chart');

    if ($Role == 1) {
        $('[data-toggle="#Report"]').addClass('menu-open');
    } else {
        $('[data-toggle="#Report"]').addClass('menu-open');
    }
    $('a[href="' + location + '"]').addClass('active');
    get_top_10();

    function get_top_10() {
        if ($.fn.DataTable.isDataTable("#tblData")) {
            $('#tblData').dataTable().fnClearTable();
        }
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('chartreport/get_data_10_product');?>",
            success: function(data) {
                if (data != "") {
                    for (var i = 0; i < data.detail.length; i++) {
                        $("#tblData").dataTable().fnAddData(
                            [
                                $("#tblData").dataTable().fnGetData().length + 1,
                                data.detail[i].nama,
                                data.detail[i].harga,
                                data.detail[i].jumlah,
                            ]
                        );

                    }
                }
            }
        });
    }
    $("#tblData").dataTable({
        "responsive": false,
        "bJQueryUI": false,
        "bPaginate": false,
        "bAutoWidth": false,
        "bLengthChange": false,
        "bFilter": false,
        "bSort": false,
        "bInfo": false,
        "bRetrieve": true,
        "aoColumns": [{
                "sTitle": "#",
                "bSortable": false,
                "sClass": "text-center"
            },
            {
                "sTitle": "Product",
                "sClass": "text-left"
            },
            {
                "sTitle": "Harga",
                "sClass": "text-right",
                "mRender": function(data, type, full) {
                    return Globalize.format(Globalize.parseInt(data), "c");
                }
            },
            {
                "sTitle": "Terjual",
                "sClass": "text-center"
            }

        ]
    });
    // Chart Pelanggan Datang

    get_chart_customer();

    function get_chart_customer() {
        $SalesChart.empty();
        $Chartcustomer.empty();
        d = new Date();
        var x = d.getDay();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "<?php echo site_url('chartreport/get_data_chart_customer');?>",
            success: function(data) {
                let position;
                for (var i = 0; i < days.length; i++) {
                    if (days[x] == days[i]) {
                        position = data.Qty[i];
                    } else {
                        position = 0;
                    }
                    Chartsc.Befour.push(data.QtyBefore[i]);
                }
                Chartsc.After.push(position);
                for (var i = 0; i < data.Date.length; i++) {
                    Chartsc.totalAfter.push(parseInt(data.Date[i].total));
                    Chartsc.total += parseInt(data.Date[i].total);
                }
                if (data.DateBefore) {
                    for (var i = 0; i < data.DateBefore.length; i++) {
                        Chartsc.totalBefore.push(parseInt(data.DateBefore[i].total));
                    }
                }
                $('#lbl-count').html(data.Sum);
                $('#lbl-sales').html(Globalize.format(Chartsc.total, "c"));
                Chartsc.count += parseInt(data.Sum);
                var Chartcustomer = new Chart($Chartcustomer, {
                    data: {
                        labels: days,
                        datasets: [{
                                type: 'line',
                                data: Chartsc.After,
                                backgroundColor: 'transparent',
                                borderColor: '#007bff',
                                pointBorderColor: '#007bff',
                                pointBackgroundColor: '#007bff',
                                fill: false,
                                // pointHoverBackgroundColor: '#007bff',
                                // pointHoverBorderColor: '#007bff'
                            },
                            {
                                type: 'line',
                                data: Chartsc.Befour,
                                backgroundColor: 'tansparent',
                                borderColor: '#ced4da',
                                pointBorderColor: '#ced4da',
                                pointBackgroundColor: '#ced4da',
                                fill: false,
                                // pointHoverBackgroundColor: '#ced4da',
                                // pointHoverBorderColor: '#ced4da'
                            }
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            mode: mode,
                            intersect: intersect
                        },
                        hover: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                // display: false,
                                gridLines: {
                                    display: true,
                                    lineWidth: '4px',
                                    color: 'rgba(0, 0, 0, .2)',
                                    zeroLineColor: 'transparent'
                                },
                                ticks: $.extend({
                                    beginAtZero: true,
                                    suggestedMax: Chartsc.count
                                }, ticksStyle)
                            }],
                            xAxes: [{
                                display: true,
                                gridLines: {
                                    display: false
                                },
                                ticks: ticksStyle
                            }]
                        }
                    }
                });

                var salesChart = new Chart($SalesChart, {
                    type: 'bar',
                    data: {
                        labels: days,
                        datasets: [{
                                backgroundColor: '#007bff',
                                borderColor: '#007bff',
                                data: Chartsc.totalAfter
                            },
                            {
                                backgroundColor: '#ced4da',
                                borderColor: '#ced4da',
                                data: Chartsc.totalBefore
                            }
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            mode: mode,
                            intersect: intersect
                        },
                        hover: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                // display: false,
                                gridLines: {
                                    display: true,
                                    lineWidth: '4px',
                                    color: 'rgba(0, 0, 0, .2)',
                                    zeroLineColor: 'transparent'
                                },
                                ticks: $.extend({
                                    beginAtZero: true,
                                    callback: function(value, index,
                                        values) {
                                        if (value >= 1000) {
                                            value /= 1000
                                            value += 'k'
                                        }
                                        return value
                                    }
                                }, ticksStyle)
                            }],
                            xAxes: [{
                                display: true,
                                gridLines: {
                                    display: false
                                },
                                ticks: ticksStyle
                            }]
                        }
                    }
                });
            }
        });
    }

});
</script>