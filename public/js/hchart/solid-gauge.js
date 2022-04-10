/*
 Highcharts JS v9.0.1 (2021-02-15)

 Solid angular gauge module

 (c) 2010-2021 Torstein Honsi

 License: www.highcharts.com/license
*/
(function (a) {
    "object" === typeof module && module.exports ? (a["default"] = a, module.exports = a) : "function" === typeof define && define.amd ? define("highcharts/modules/solid-gauge", ["highcharts", "highcharts/highcharts-more"], function (l) {
        a(l);
        a.Highcharts = l;
        return a
    }) : a("undefined" !== typeof Highcharts ? Highcharts : void 0)
})(function (a) {
    function l(a, e, f, c) {
        a.hasOwnProperty(e) || (a[e] = c.apply(null, f))
    }

    a = a ? a._modules : {};
    l(a, "Core/Axis/SolidGaugeAxis.js", [a["Core/Color/Color.js"], a["Core/Utilities.js"]], function (a, e) {
        var f =
            a.parse, c = e.extend, l = e.merge, b;
        (function (a) {
            var b = {
                initDataClasses: function (a) {
                    var c = this.chart, m, p = 0, h = this.options;
                    this.dataClasses = m = [];
                    a.dataClasses.forEach(function (b, d) {
                        b = l(b);
                        m.push(b);
                        b.color || ("category" === h.dataClassColor ? (d = c.options.colors, b.color = d[p++], p === d.length && (p = 0)) : b.color = f(h.minColor).tweenTo(f(h.maxColor), d / (a.dataClasses.length - 1)))
                    })
                }, initStops: function (a) {
                    this.stops = a.stops || [[0, this.options.minColor], [1, this.options.maxColor]];
                    this.stops.forEach(function (a) {
                        a.color = f(a[1])
                    })
                },
                toColor: function (a, c) {
                    var b = this.stops, f = this.dataClasses, h;
                    if (f) for (h = f.length; h--;) {
                        var e = f[h];
                        var d = e.from;
                        b = e.to;
                        if (("undefined" === typeof d || a >= d) && ("undefined" === typeof b || a <= b)) {
                            var k = e.color;
                            c && (c.dataClass = h);
                            break
                        }
                    } else {
                        this.logarithmic && (a = this.val2lin(a));
                        a = 1 - (this.max - a) / (this.max - this.min);
                        for (h = b.length; h-- && !(a > b[h][0]);) ;
                        d = b[h] || b[h + 1];
                        b = b[h + 1] || d;
                        a = 1 - (b[0] - a) / (b[0] - d[0] || 1);
                        k = d.color.tweenTo(b.color, a)
                    }
                    return k
                }
            };
            a.init = function (a) {
                c(a, b)
            }
        })(b || (b = {}));
        return b
    });
    l(a, "Series/SolidGauge/SolidGaugeComposition.js",
        [a["Core/Globals.js"], a["Core/Utilities.js"]], function (a, e) {
            e = e.wrap;
            e(a.Renderer.prototype.symbols, "arc", function (a, c, e, b, l, k) {
                a = a(c, e, b, l, k);
                k.rounded && (b = ((k.r || b) - (k.innerR || 0)) / 2, c = a[0], k = a[2], "M" === c[0] && "L" === k[0] && (c = ["A", b, b, 0, 1, 1, c[1], c[2]], a[2] = ["A", b, b, 0, 1, 1, k[1], k[2]], a[4] = c));
                return a
            })
        });
    l(a, "Series/SolidGauge/SolidGaugeSeries.js", [a["Mixins/LegendSymbol.js"], a["Core/Series/SeriesRegistry.js"], a["Core/Axis/SolidGaugeAxis.js"], a["Core/Utilities.js"]], function (a, e, l, c) {
        var f = this && this.__extends ||
            function () {
                var a = function (b, g) {
                    a = Object.setPrototypeOf || {__proto__: []} instanceof Array && function (a, b) {
                        a.__proto__ = b
                    } || function (a, b) {
                        for (var g in b) b.hasOwnProperty(g) && (a[g] = b[g])
                    };
                    return a(b, g)
                };
                return function (b, g) {
                    function c() {
                        this.constructor = b
                    }

                    a(b, g);
                    b.prototype = null === g ? Object.create(g) : (c.prototype = g.prototype, new c)
                }
            }(), b = e.seriesTypes, n = b.gauge, k = b.pie.prototype, p = c.clamp, u = c.extend, m = c.isNumber,
            w = c.merge, h = c.pick, v = c.pInt, d = {colorByPoint: !0, dataLabels: {y: 0}};
        c = function (a) {
            function b() {
                var b =
                    null !== a && a.apply(this, arguments) || this;
                b.data = void 0;
                b.points = void 0;
                b.options = void 0;
                b.axis = void 0;
                b.yAxis = void 0;
                b.startAngleRad = void 0;
                b.thresholdAngleRad = void 0;
                return b
            }

            f(b, a);
            b.prototype.translate = function () {
                var a = this.yAxis;
                l.init(a);
                !a.dataClasses && a.options.dataClasses && a.initDataClasses(a.options);
                a.initStops(a.options);
                n.prototype.translate.call(this)
            };
            b.prototype.drawPoints = function () {
                var a = this, b = a.yAxis, c = b.center, e = a.options, l = a.chart.renderer, d = e.overshoot,
                    k = m(d) ? d / 180 * Math.PI : 0,
                    f;
                m(e.threshold) && (f = b.startAngleRad + b.translate(e.threshold, null, null, null, !0));
                this.thresholdAngleRad = h(f, b.startAngleRad);
                a.points.forEach(function (d) {
                    if (!d.isNull) {
                        var f = d.graphic, g = b.startAngleRad + b.translate(d.y, null, null, null, !0),
                            m = v(h(d.options.radius, e.radius, 100)) * c[2] / 200,
                            q = v(h(d.options.innerRadius, e.innerRadius, 60)) * c[2] / 200, r = b.toColor(d.y, d),
                            t = Math.min(b.startAngleRad, b.endAngleRad), n = Math.max(b.startAngleRad, b.endAngleRad);
                        "none" === r && (r = d.color || a.color || "none");
                        "none" !== r && (d.color =
                            r);
                        g = p(g, t - k, n + k);
                        !1 === e.wrap && (g = p(g, t, n));
                        t = Math.min(g, a.thresholdAngleRad);
                        g = Math.max(g, a.thresholdAngleRad);
                        g - t > 2 * Math.PI && (g = t + 2 * Math.PI);
                        d.shapeArgs = q = {x: c[0], y: c[1], r: m, innerR: q, start: t, end: g, rounded: e.rounded};
                        d.startR = m;
                        f ? (m = q.d, f.animate(u({fill: r}, q)), m && (q.d = m)) : d.graphic = f = l.arc(q).attr({
                            fill: r,
                            "sweep-flag": 0
                        }).add(a.group);
                        a.chart.styledMode || ("square" !== e.linecap && f.attr({
                            "stroke-linecap": "round",
                            "stroke-linejoin": "round"
                        }), f.attr({
                            stroke: e.borderColor || "none", "stroke-width": e.borderWidth ||
                                0
                        }));
                        f && f.addClass(d.getClassName(), !0)
                    }
                })
            };
            b.prototype.animate = function (a) {
                a || (this.startAngleRad = this.thresholdAngleRad, k.animate.call(this, a))
            };
            b.defaultOptions = w(n.defaultOptions, d);
            return b
        }(n);
        u(c.prototype, {drawLegendSymbol: a.drawRectangle});
        e.registerSeriesType("solidgauge", c);
        "";
        return c
    });
    l(a, "masters/modules/solid-gauge.src.js", [], function () {
    })
});
//# sourceMappingURL=solid-gauge.js.map