$(document).ready(function () {

    $.preloadImages = function (images) {
        for (var i = 0; i < images.length; i++) {
            var $image = $("<img />").attr("src", images[i]);
        }
    };
    function reflowChart() {
        var lineWrapperHeight = 0;

        $(".line-wrapper").each(function () {
            lineWrapperHeight += (parseInt($(this).outerHeight()) + parseInt($(this).css('margin-bottom')));
        });

        var containerHeight = (parseInt($(window).height()) -
            parseInt($("header").outerHeight()) -
            lineWrapperHeight -
            parseInt($(".legend-wrapper").outerHeight()) -
            parseInt($("footer").outerHeight())) + 10 + 'px';

        $("#container").css('height', containerHeight);

        setTimeout(function () {
            $("#container").highcharts().reflow();
        }, 50);
    }

    $(window).resize(reflowChart);


    $("body").on("change", "select#map-precision", function () {
        showMap($(this).val());
    });

    showMap();

    function showMap(precision) {

        $.getJSON("/ajax/map/" + (precision || "regions") + "/", function (data) {

            var isSingle = $('#container').hasClass("single");

            var $legend = $("div.legend-wrapper");
            $("span.legend-units", $legend).html(data.units);
            $("span.min-value", $legend).html(data.axis.min_formatted);
            $("span.max-value", $legend).html(data.axis.max_formatted);


            (function (H) {
                H.wrap(H.ColorAxis.prototype, 'toColor', function (proceed, value, point) {
                    if(point.options.is_null)
                        return '#D0D0D0'; // My color
                    else
                        return proceed.apply(this, Array.prototype.slice.call(arguments, 1)); // Normal coloring
                });
            }(Highcharts));

            $('#container').highcharts('Map', {

                chart: {
                    backgroundColor: 'rgba(255, 255, 255, 0.1)',

                    events: {
                        init: function (event) {
                            var lineWrapperHeight = 0;

                            $(".line-wrapper").each(function () {
                                lineWrapperHeight += (parseInt($(this).outerHeight()) + parseInt($(this).css('margin-bottom')));
                            });

                            var containerHeight = (parseInt($(window).height()) -
                                parseInt($("header").outerHeight()) -
                                lineWrapperHeight -
                                parseInt($(".legend-wrapper").outerHeight()) -
                                parseInt($("footer").outerHeight())) + 10;
                            this.chartHeight = containerHeight;
                            var box = d3.select(this.renderer.box);
                            box.attr("height", containerHeight);
                            box.attr("viewBox", "0 0 " + box.attr("width") + " " + containerHeight);
                            $("#container").css('height', containerHeight + 'px');
                            $(this.renderTo.firstChild).css('height', containerHeight + 'px');
                        },
                        beforeRender: function (event) {
                            /*this.renderer.defs.element.innerHTML=
                             '<filter id="drop-shadow" height="130%">'+
                             '<feGaussianBlur in="SourceAlpha" stdDeviation="2" result="blur"></feGaussianBlur>'+
                             '<feOffset in="blur" dx="1" dy="1" result="offsetBlur"></feOffset>'+
                             '<feComponentTransfer><feFuncA type="linear" slope="0.4"></feFuncA></feComponentTransfer>'+
                             '<feMerge><feMergeNode></feMergeNode><feMergeNode in="SourceGraphic"></feMergeNode></feMerge>'+
                             '</filter>';
                             */
                            var defs = d3.select("#container svg defs");
                            var filter = defs.append("filter")
                                .attr("id", "drop-shadow")
                                .attr("height", "130%");
                            filter.append("feGaussianBlur")
                                .attr("in", "SourceAlpha")
                                .attr("stdDeviation", 2)
                                .attr("result", "blur");
                            filter.append("feOffset")
                                .attr("in", "blur")
                                .attr("dx", 1)
                                .attr("dy", 1)
                                .attr("result", "offsetBlur");
                            filter.append("feComponentTransfer")
                                .append("feFuncA").attr("type", "linear").attr("slope", 0.4);

                            var feMerge = filter.append("feMerge");
                            feMerge.append("feMergeNode");
                            feMerge.append("feMergeNode")
                                .attr("in", "SourceGraphic");

                            var filter = defs.append("filter")
                                .attr("id", "item-shadow")
                                .attr("height", "130%");


                            filter.append("feOffset")
                                .attr("in", "SourceGraphic")
                                .attr("dx", 1)
                                .attr("dy", 0)
                                .attr("result", "offsetSource");
                            filter.append("feOffset")
                                .attr("in", "SourceAlpha")
                                .attr("dx", 1)
                                .attr("dy", 0)
                                .attr("result", "offsetBlur");
                            filter.append("feGaussianBlur")
                                .attr("in", "offsetBlur")
                                .attr("stdDeviation", 2)
                                .attr("result", "blur");
                            filter.append("feColorMatrix")
                                .attr("type", "matrix")
                                .attr("values", "-0.95703125 0 0 0 0.95703125 -0.95703125 0 0 0 0.95703125 -0.95703125 0 0 0 0.95703125 0 0 0 1 0")
                                .attr("in", "blur")
                                .attr("result", "colo");

                            var feMerge = filter.append("feMerge");
                            feMerge.append("feMergeNode")
                                .attr("in", "colo");
                            feMerge.append("feMergeNode")
                                .attr("in", "colo");
                            feMerge.append("feMergeNode")
                                .attr("in", "colo");
                            feMerge.append("feMergeNode")
                                .attr("in", "offsetSource");

                        },
                        load: function (event) {
                            this.series[0].group.attr("filter", "url(#drop-shadow)");
                            this.series[1].group.attr("filter", "url(#drop-shadow)");
                            var rect = $("clipPath rect", this.renderer.defs.element);
                            rect.attr('height', parseInt(rect.attr('height')) + 20);
                        },
                        redraw: function (event) {
                            //
                        }
                    }
                },

                tooltip: {
                    hideDelay: 0,
                    shared: false,
                    animation: false,
                    followPointer: true,
                    backgroundColor: null,
                    borderWidth: 0,
                    shadow: false,
                    useHTML: true,
                    padding: 0,

                    positioner: function (labelWidth, labelHeight, point) {

                        var chart = this.chart,
                            dx = 30,
                            dy = 50,
                            tooltipX = point.plotX + chart.plotLeft + dx,
                            tooltipY = point.plotY + chart.plotTop - dy,
                            labelPaddingY = 20;
                        tooltipMarkerSide = 'left';
                        tooltipMarkerOtherSide = 'right';


                        if ((tooltipX + labelWidth) > chart.plotWidth) {
                            tooltipX = chart.plotWidth - labelWidth;
                        }
                        if ((tooltipX - dx) < point.plotX) {
                            tooltipX = point.plotX - labelWidth - dx;
                            $(".tooltip-left").removeClass("tooltip-" + tooltipMarkerSide).addClass("tooltip-" + tooltipMarkerOtherSide);
                            tooltipMarkerOtherSide = 'left';
                            tooltipMarkerSide = 'right';
                        }
                        if ((tooltipY + labelHeight) + labelPaddingY > chart.chartHeight) {
                            tooltipY = chart.chartHeight - labelHeight - labelPaddingY;
                        } else if (tooltipY < labelPaddingY) {
                            tooltipY = labelPaddingY;
                        }

                        tooltipMarkerY = Math.min(Math.max(point.plotY - tooltipY - 10, 3), labelHeight - dy - 0 /* padding */);
                        $(".tooltip-" + tooltipMarkerSide + " .marker").css("bottom", 0);
                        $(".tooltip-" + tooltipMarkerSide + " .marker").css("top", tooltipMarkerY + "px");

                        return {
                            x: tooltipX,
                            y: tooltipY
                        };
                    },

                    formatter: function () {

                        return '<div class="tooltip-left">' +
                            '<div class="marker"></div>' +
                            '<div class="tooltip-header">' +
                            ((this.point.options.key.length) === 5 ? '<img src="/img/heraldry/' + this.point.options.key + '.png" style="width:auto;height:55px;">' : '') +
                            '<h3>' + this.point.options.name + '</h3>' +
                            '</div>' +
                            ((this.series.data.length > 1)
                                ?
                            '<div class="tooltip-section"><span class="rate">' + (this.point.options.is_null ? '&mdash;' : this.point.options.counter + ' место') + '</span><br><span class="descr">в рейтинге регионов' +
                            (isSingle ? '<br />федерального&nbsp;округа' : ' РФ')
                            + '</span></div>'
                                :
                                '') +
                            '<div class="tooltip-section"><span class="rate">' + (this.point.options.is_null ? '&mdash;' : this.point.options.export_formatted + ' ' + data.units) + '</span><br><span class="descr">за ' + data.periods + '</span></div>' +
                            '</div>';
                    }

                },

                title: {
                    text: null
                },

                subtitle: {
                    text: null
                },

                credits: {
                    enabled: false
                },

                mapNavigation: {
                    enabled: false,
                    buttonOptions: {
                        verticalAlign: 'bottom'
                    }
                },

                colorAxis: {
                    min: data.axis.lnMin,
                    max: data.axis.lnMax,
                    minColor: '#a4c8e4',
                    maxColor: '#002e5e',
                    /*                    stops: [
                     [0, 'grey'],
                     [data.axis.lnMin / data.axis.lnMax - 1e-12, '#a4c8e4'],
                     [1, '#002e5e']
                     ],*/

                    /**
                     tickInterval: data.axis.lnMax / 5 ,
                     **/
                    tickPositions: [data.axis.lnMin, data.axis.lnMax],
                    tickWidth: 0,

                    marker: false,

                    showInLegend: true,
                    labels: {
                        enabled: true,
                        formatter: function () {
                            if (this.value <= data.axis.lnMin) {
                                return this.value;
                            } else if (this.value >= data.axis.lnMax) {
                                return this.value;
                            } else {
                                return null;
                            }
                        }
                    },
                    showFirstLabel: true,
                    showLastLabel: true
                },

                legend: {
                    enabled: false,
                    align: 'left',
                    verticalAlign: 'top',
                    layout: 'horizontal',
                    floating: false,
                    width: 400,
                    symbolWidth: 390,
                    x: 152,
                    y: -15

                },


                series: [{
                    data: data.data,
                    mapData: Highcharts.maps['countries/ru/custom/' + data.precision],
                    joinBy: 'hc-key',
                    name: 'Federal Customs Service of Russia',
                    borderColor: '#ffffff',
                    borderWidth: 1,
                    cursor: 'pointer',
                    animation: false,
                    zIndex: 100,
                    shadow: false,
                    enableMouseTracking: true,
                    allAreas: false,

                    states: {
                        hover: {
                            borderColor: '#ffffff',
                            color: '#002D5C',    //{},
                            enabled: true
                        }
                    },

                    tooltip: {
                        formatter: function () {
                            /**
                             **/
                        },
                        valueSuffix: ''
                    },

                    point: {

                        events: {
                            click: function () {
                                console.log(this);
                                $.getJSON('/ajax/session/set/regions/' + this.options.key + '/', function (data) {
                                    if (data.status == 'OK') {
                                        location.reload();
                                    }
                                });
                            },
                            mouseOver: function (event) {
                                d3.select(this.graphic.element).attr("filter", "url(#item-shadow)");
                                if (this.graphic.element.parentNode.lastChild != this.graphic.element) {
                                    this.graphic.toFront();
                                    this.setState('hover');
                                }
                            },
                            mouseOut: function (event) {
                                d3.select(this.graphic.element).attr("filter", null);
                            }
                        }
                    },

                    dataLabels: {
                        enabled: false
                    }
                }

                /**
                 *
                 */
                    ,
                    {
                        data: data.data.filter(function (x) {
                            return x.hasOwnProperty('hc-key') && ($.inArray(x['hc-key'], ["ru-ms", "ru-sp", "ru-sc"]) > -1);
                        }),
                        mapData: Highcharts.maps['countries/ru/custom/' + data.precision],
                        joinBy: 'hc-key',
                        name: 'Federal Customs Service of Russia',
                        borderColor: '#ffffff',
                        borderWidth: 1,
                        cursor: 'pointer',
                        animation: false,
                        zIndex: 1001,
                        shadow: false,
                        enableMouseTracking: true,
                        allAreas: false,

                        states: {
                            hover: {
                                borderColor: '#ffffff',
                                color: '#002D5C',    //{},
                                enabled: true
                            }
                        },

                        tooltip: {
                            formatter: function () {
                                /**
                                 **/
                            },
                            valueSuffix: ''
                        },

                        point: {

                            events: {
                                click: function () {
                                    console.log(this);
                                    $.getJSON('/ajax/session/set/regions/' + this.options.key + '/', function (data) {
                                        if (data.status == 'OK') {
                                            location.reload();
                                        }
                                    });
                                },
                                mouseOver: function (event) {
                                    d3.select(this.graphic.element).attr("filter", "url(#item-shadow)");
                                    if (this.graphic.element.parentNode.lastChild != this.graphic.element) {
                                        this.graphic.toFront();
                                        this.setState('hover');
                                    }
                                },
                                mouseOut: function (event) {
                                    d3.select(this.graphic.element).attr("filter", null);
                                }
                            }
                        },

                        dataLabels: {
                            enabled: false
                        }
                    }
                /**
                 *
                 */

                ]
            });


            var images = [];
            $(data.data).each(function (x) {
                if ($(this).attr('key').length === 5) {
                    images.push('/img/heraldry/' + $(this).attr('key') + '.png');
                }
            });
            $.preloadImages(images);

        });


    }


});
