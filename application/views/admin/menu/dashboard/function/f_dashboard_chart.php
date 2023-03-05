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
    let Rolename = "<?php echo $role->name;?>";
    if (Rolename != "Kasir") {
        get_top_10();
        get_min_top_10();

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

        function get_min_top_10() {
            if ($.fn.DataTable.isDataTable("#tblData1")) {
                $('#tblData1').dataTable().fnClearTable();
            }
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('chartreport/get_data_min10_product');?>",
                success: function(data) {
                    if (data != "") {
                        for (var i = 0; i < data.detail.length; i++) {
                            $("#tblData1").dataTable().fnAddData(
                                [
                                    $("#tblData1").dataTable().fnGetData().length + 1,
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
        $("#tblData1").dataTable({
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
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('chartreport/get_data_chart_customer');?>",
                success: function(data) {
                    $('#lbl-count').html(data.transaksi);
                    $('#lbl-sales').html(Globalize.format(data.total, "c"));
                    var Chartcustomer = new Chart($Chartcustomer, {
                        data: {
                            labels: data.labels,
                            datasets: [{
                                    type: 'line',
                                    data: data.qty.now,
                                    backgroundColor: 'transparent',
                                    borderColor: '#007bff',
                                    pointBorderColor: '#007bff',
                                    pointBackgroundColor: '#007bff',
                                    fill: false,
                                    pointHoverBackgroundColor: '#007bff',
                                    pointHoverBorderColor: '#007bff'
                                },
                                {
                                    type: 'line',
                                    data: data.qty.before,
                                    backgroundColor: 'tansparent',
                                    borderColor: '#ced4da',
                                    pointBorderColor: '#ced4da',
                                    pointBackgroundColor: '#ced4da',
                                    fill: false,
                                    pointHoverBackgroundColor: '#ced4da',
                                    pointHoverBorderColor: '#ced4da'
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
                                        suggestedMax: data.jumlah
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
                            labels: data.labels,
                            datasets: [{
                                    backgroundColor: '#007bff',
                                    borderColor: '#007bff',
                                    data: data.datasets.now
                                },
                                {
                                    backgroundColor: '#ced4da',
                                    borderColor: '#ced4da',
                                    data: data.datasets.before
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
    }
});
</script>