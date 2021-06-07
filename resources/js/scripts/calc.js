/*!
 * jQuery Form Plugin
 * version: 3.51.0-2014.06.20
 * Requires jQuery v1.5 or later
 * Copyright (c) 2014 M. Alsupme
 * Examples and documentation at: http://malsup.com/jquery/form/
 * Project repository: https://github.com/malsup/form
 * Dual licensed under the MIT and GPL licenses.
 * https://github.com/malsup/form#copyright-and-license
 */
!function (e) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], e) : e("undefined" != typeof jQuery ? jQuery : window.Zepto)
}(function (e) {
    "use strict";

    function t(t) {
        var r = t.data;
        t.isDefaultPrevented() || (t.preventDefault(), e(t.target).ajaxSubmit(r))
    }

    function r(t) {
        var r = t.target, a = e(r);
        if (!a.is("[type=submit],[type=image]")) {
            var n = a.closest("[type=submit]");
            if (0 === n.length) return;
            r = n[0]
        }
        var i = this;
        if (i.clk = r, "image" == r.type) if (void 0 !== t.offsetX) i.clk_x = t.offsetX, i.clk_y = t.offsetY; else if ("function" == typeof e.fn.offset) {
            var o = a.offset();
            i.clk_x = t.pageX - o.left, i.clk_y = t.pageY - o.top
        } else i.clk_x = t.pageX - r.offsetLeft, i.clk_y = t.pageY - r.offsetTop;
        setTimeout(function () {
            i.clk = i.clk_x = i.clk_y = null
        }, 100)
    }

    function a() {
        if (e.fn.ajaxSubmit.debug) {
            var t = "[jquery.form] " + Array.prototype.join.call(arguments, "");
            window.console && window.console.log ? window.console.log(t) : window.opera && window.opera.postError && window.opera.postError(t)
        }
    }

    var n = {};
    n.fileapi = void 0 !== e("<input type='file'/>").get(0).files, n.formdata = void 0 !== window.FormData;
    var i = !!e.fn.prop;
    e.fn.attr2 = function () {
        if (!i) return this.attr.apply(this, arguments);
        var e = this.prop.apply(this, arguments);
        return e && e.jquery || "string" == typeof e ? e : this.attr.apply(this, arguments)
    }, e.fn.ajaxSubmit = function (t) {
        function r(r) {
            var a, n, i = e.param(r, t.traditional).split("&"), o = i.length, s = [];
            for (a = 0; o > a; a++) i[a] = i[a].replace(/\+/g, " "), n = i[a].split("="), s.push([decodeURIComponent(n[0]), decodeURIComponent(n[1])]);
            return s
        }

        function o(a) {
            for (var n = new FormData, i = 0; i < a.length; i++) n.append(a[i].name, a[i].value);
            if (t.extraData) {
                var o = r(t.extraData);
                for (i = 0; i < o.length; i++) o[i] && n.append(o[i][0], o[i][1])
            }
            t.data = null;
            var s = e.extend(!0, {}, e.ajaxSettings, t, {
                contentType: !1,
                processData: !1,
                cache: !1,
                type: u || "POST"
            });
            t.uploadProgress && (s.xhr = function () {
                var r = e.ajaxSettings.xhr();
                return r.upload && r.upload.addEventListener("progress", function (e) {
                    var r = 0, a = e.loaded || e.position, n = e.total;
                    e.lengthComputable && (r = Math.ceil(a / n * 100)), t.uploadProgress(e, a, n, r)
                }, !1), r
            }), s.data = null;
            var c = s.beforeSend;
            return s.beforeSend = function (e, r) {
                r.data = t.formData ? t.formData : n, c && c.call(this, e, r)
            }, e.ajax(s)
        }

        function s(r) {
            function n(e) {
                var t = null;
                try {
                    e.contentWindow && (t = e.contentWindow.document)
                } catch (r) {
                    a("cannot get iframe.contentWindow document: " + r)
                }
                if (t) return t;
                try {
                    t = e.contentDocument ? e.contentDocument : e.document
                } catch (r) {
                    a("cannot get iframe.contentDocument: " + r), t = e.document
                }
                return t
            }

            function o() {
                function t() {
                    try {
                        var e = n(g).readyState;
                        a("state = " + e), e && "uninitialized" == e.toLowerCase() && setTimeout(t, 50)
                    } catch (r) {
                        a("Server abort: ", r, " (", r.name, ")"), s(k), j && clearTimeout(j), j = void 0
                    }
                }

                var r = f.attr2("target"), i = f.attr2("action"), o = "multipart/form-data",
                    c = f.attr("enctype") || f.attr("encoding") || o;
                w.setAttribute("target", p), (!u || /post/i.test(u)) && w.setAttribute("method", "POST"), i != m.url && w.setAttribute("action", m.url), m.skipEncodingOverride || u && !/post/i.test(u) || f.attr({
                    encoding: "multipart/form-data",
                    enctype: "multipart/form-data"
                }), m.timeout && (j = setTimeout(function () {
                    T = !0, s(D)
                }, m.timeout));
                var l = [];
                try {
                    if (m.extraData) for (var d in m.extraData) m.extraData.hasOwnProperty(d) && l.push(e.isPlainObject(m.extraData[d]) && m.extraData[d].hasOwnProperty("name") && m.extraData[d].hasOwnProperty("value") ? e('<input type="hidden" name="' + m.extraData[d].name + '">').val(m.extraData[d].value).appendTo(w)[0] : e('<input type="hidden" name="' + d + '">').val(m.extraData[d]).appendTo(w)[0]);
                    m.iframeTarget || v.appendTo("body"), g.attachEvent ? g.attachEvent("onload", s) : g.addEventListener("load", s, !1), setTimeout(t, 15);
                    try {
                        w.submit()
                    } catch (h) {
                        var x = document.createElement("form").submit;
                        x.apply(w)
                    }
                } finally {
                    w.setAttribute("action", i), w.setAttribute("enctype", c), r ? w.setAttribute("target", r) : f.removeAttr("target"), e(l).remove()
                }
            }

            function s(t) {
                if (!x.aborted && !F) {
                    if (M = n(g), M || (a("cannot access response document"), t = k), t === D && x) return x.abort("timeout"), void S.reject(x, "timeout");
                    if (t == k && x) return x.abort("server abort"), void S.reject(x, "error", "server abort");
                    if (M && M.location.href != m.iframeSrc || T) {
                        g.detachEvent ? g.detachEvent("onload", s) : g.removeEventListener("load", s, !1);
                        var r, i = "success";
                        try {
                            if (T) throw"timeout";
                            var o = "xml" == m.dataType || M.XMLDocument || e.isXMLDoc(M);
                            if (a("isXml=" + o), !o && window.opera && (null === M.body || !M.body.innerHTML) && --O) return a("requeing onLoad callback, DOM not available"), void setTimeout(s, 250);
                            var u = M.body ? M.body : M.documentElement;
                            x.responseText = u ? u.innerHTML : null, x.responseXML = M.XMLDocument ? M.XMLDocument : M, o && (m.dataType = "xml"), x.getResponseHeader = function (e) {
                                var t = {"content-type": m.dataType};
                                return t[e.toLowerCase()]
                            }, u && (x.status = Number(u.getAttribute("status")) || x.status, x.statusText = u.getAttribute("statusText") || x.statusText);
                            var c = (m.dataType || "").toLowerCase(), l = /(json|script|text)/.test(c);
                            if (l || m.textarea) {
                                var f = M.getElementsByTagName("textarea")[0];
                                if (f) x.responseText = f.value, x.status = Number(f.getAttribute("status")) || x.status, x.statusText = f.getAttribute("statusText") || x.statusText; else if (l) {
                                    var p = M.getElementsByTagName("pre")[0], h = M.getElementsByTagName("body")[0];
                                    p ? x.responseText = p.textContent ? p.textContent : p.innerText : h && (x.responseText = h.textContent ? h.textContent : h.innerText)
                                }
                            } else "xml" == c && !x.responseXML && x.responseText && (x.responseXML = X(x.responseText));
                            try {
                                E = _(x, c, m)
                            } catch (y) {
                                i = "parsererror", x.error = r = y || i
                            }
                        } catch (y) {
                            a("error caught: ", y), i = "error", x.error = r = y || i
                        }
                        x.aborted && (a("upload aborted"), i = null), x.status && (i = x.status >= 200 && x.status < 300 || 304 === x.status ? "success" : "error"), "success" === i ? (m.success && m.success.call(m.context, E, "success", x), S.resolve(x.responseText, "success", x), d && e.event.trigger("ajaxSuccess", [x, m])) : i && (void 0 === r && (r = x.statusText), m.error && m.error.call(m.context, x, i, r), S.reject(x, "error", r), d && e.event.trigger("ajaxError", [x, m, r])), d && e.event.trigger("ajaxComplete", [x, m]), d && !--e.active && e.event.trigger("ajaxStop"), m.complete && m.complete.call(m.context, x, i), F = !0, m.timeout && clearTimeout(j), setTimeout(function () {
                            m.iframeTarget ? v.attr("src", m.iframeSrc) : v.remove(), x.responseXML = null
                        }, 100)
                    }
                }
            }

            var c, l, m, d, p, v, g, x, y, b, T, j, w = f[0], S = e.Deferred();
            if (S.abort = function (e) {
                x.abort(e)
            }, r) for (l = 0; l < h.length; l++) c = e(h[l]), i ? c.prop("disabled", !1) : c.removeAttr("disabled");
            if (m = e.extend(!0, {}, e.ajaxSettings, t), m.context = m.context || m, p = "jqFormIO" + (new Date).getTime(), m.iframeTarget ? (v = e(m.iframeTarget), b = v.attr2("name"), b ? p = b : v.attr2("name", p)) : (v = e('<iframe name="' + p + '" src="' + m.iframeSrc + '" />'), v.css({
                position: "absolute",
                top: "-1000px",
                left: "-1000px"
            })), g = v[0], x = {
                aborted: 0,
                responseText: null,
                responseXML: null,
                status: 0,
                statusText: "n/a",
                getAllResponseHeaders: function () {
                },
                getResponseHeader: function () {
                },
                setRequestHeader: function () {
                },
                abort: function (t) {
                    var r = "timeout" === t ? "timeout" : "aborted";
                    a("aborting upload... " + r), this.aborted = 1;
                    try {
                        g.contentWindow.document.execCommand && g.contentWindow.document.execCommand("Stop")
                    } catch (n) {
                    }
                    v.attr("src", m.iframeSrc), x.error = r, m.error && m.error.call(m.context, x, r, t), d && e.event.trigger("ajaxError", [x, m, r]), m.complete && m.complete.call(m.context, x, r)
                }
            }, d = m.global, d && 0 === e.active++ && e.event.trigger("ajaxStart"), d && e.event.trigger("ajaxSend", [x, m]), m.beforeSend && m.beforeSend.call(m.context, x, m) === !1) return m.global && e.active--, S.reject(), S;
            if (x.aborted) return S.reject(), S;
            y = w.clk, y && (b = y.name, b && !y.disabled && (m.extraData = m.extraData || {}, m.extraData[b] = y.value, "image" == y.type && (m.extraData[b + ".x"] = w.clk_x, m.extraData[b + ".y"] = w.clk_y)));
            var D = 1, k = 2, A = e("meta[name=csrf-token]").attr("content"),
                L = e("meta[name=csrf-param]").attr("content");
            L && A && (m.extraData = m.extraData || {}, m.extraData[L] = A), m.forceSync ? o() : setTimeout(o, 10);
            var E, M, F, O = 50, X = e.parseXML || function (e, t) {
                return window.ActiveXObject ? (t = new ActiveXObject("Microsoft.XMLDOM"), t.async = "false", t.loadXML(e)) : t = (new DOMParser).parseFromString(e, "text/xml"), t && t.documentElement && "parsererror" != t.documentElement.nodeName ? t : null
            }, C = e.parseJSON || function (e) {
                return window.eval("(" + e + ")")
            }, _ = function (t, r, a) {
                var n = t.getResponseHeader("content-type") || "", i = "xml" === r || !r && n.indexOf("xml") >= 0,
                    o = i ? t.responseXML : t.responseText;
                return i && "parsererror" === o.documentElement.nodeName && e.error && e.error("parsererror"), a && a.dataFilter && (o = a.dataFilter(o, r)), "string" == typeof o && ("json" === r || !r && n.indexOf("json") >= 0 ? o = C(o) : ("script" === r || !r && n.indexOf("javascript") >= 0) && e.globalEval(o)), o
            };
            return S
        }

        if (!this.length) return a("ajaxSubmit: skipping submit process - no element selected"), this;
        var u, c, l, f = this;
        "function" == typeof t ? t = {success: t} : void 0 === t && (t = {}), u = t.type || this.attr2("method"), c = t.url || this.attr2("action"), l = "string" == typeof c ? e.trim(c) : "", l = l || window.location.href || "", l && (l = (l.match(/^([^#]+)/) || [])[1]), t = e.extend(!0, {
            url: l,
            success: e.ajaxSettings.success,
            type: u || e.ajaxSettings.type,
            iframeSrc: /^https/i.test(window.location.href || "") ? "javascript:false" : "about:blank"
        }, t);
        var m = {};
        if (this.trigger("form-pre-serialize", [this, t, m]), m.veto) return a("ajaxSubmit: submit vetoed via form-pre-serialize trigger"), this;
        if (t.beforeSerialize && t.beforeSerialize(this, t) === !1) return a("ajaxSubmit: submit aborted via beforeSerialize callback"), this;
        var d = t.traditional;
        void 0 === d && (d = e.ajaxSettings.traditional);
        var p, h = [], v = this.formToArray(t.semantic, h);
        if (t.data && (t.extraData = t.data, p = e.param(t.data, d)), t.beforeSubmit && t.beforeSubmit(v, this, t) === !1) return a("ajaxSubmit: submit aborted via beforeSubmit callback"), this;
        if (this.trigger("form-submit-validate", [v, this, t, m]), m.veto) return a("ajaxSubmit: submit vetoed via form-submit-validate trigger"), this;
        var g = e.param(v, d);
        p && (g = g ? g + "&" + p : p), "GET" == t.type.toUpperCase() ? (t.url += (t.url.indexOf("?") >= 0 ? "&" : "?") + g, t.data = null) : t.data = g;
        var x = [];
        if (t.resetForm && x.push(function () {
            f.resetForm()
        }), t.clearForm && x.push(function () {
            f.clearForm(t.includeHidden)
        }), !t.dataType && t.target) {
            var y = t.success || function () {
            };
            x.push(function (r) {
                var a = t.replaceTarget ? "replaceWith" : "html";
                e(t.target)[a](r).each(y, arguments)
            })
        } else t.success && x.push(t.success);
        if (t.success = function (e, r, a) {
            for (var n = t.context || this, i = 0, o = x.length; o > i; i++) x[i].apply(n, [e, r, a || f, f])
        }, t.error) {
            var b = t.error;
            t.error = function (e, r, a) {
                var n = t.context || this;
                b.apply(n, [e, r, a, f])
            }
        }
        if (t.complete) {
            var T = t.complete;
            t.complete = function (e, r) {
                var a = t.context || this;
                T.apply(a, [e, r, f])
            }
        }
        var j = e("input[type=file]:enabled", this).filter(function () {
                return "" !== e(this).val()
            }), w = j.length > 0, S = "multipart/form-data", D = f.attr("enctype") == S || f.attr("encoding") == S,
            k = n.fileapi && n.formdata;
        a("fileAPI :" + k);
        var A, L = (w || D) && !k;
        t.iframe !== !1 && (t.iframe || L) ? t.closeKeepAlive ? e.get(t.closeKeepAlive, function () {
            A = s(v)
        }) : A = s(v) : A = (w || D) && k ? o(v) : e.ajax(t), f.removeData("jqxhr").data("jqxhr", A);
        for (var E = 0; E < h.length; E++) h[E] = null;
        return this.trigger("form-submit-notify", [this, t]), this
    }, e.fn.ajaxForm = function (n) {
        if (n = n || {}, n.delegation = n.delegation && e.isFunction(e.fn.on), !n.delegation && 0 === this.length) {
            var i = {s: this.selector, c: this.context};
            return !e.isReady && i.s ? (a("DOM not ready, queuing ajaxForm"), e(function () {
                e(i.s, i.c).ajaxForm(n)
            }), this) : (a("terminating; zero elements found by selector" + (e.isReady ? "" : " (DOM not ready)")), this)
        }
        return n.delegation ? (e(document).off("submit.form-plugin", this.selector, t).off("click.form-plugin", this.selector, r).on("submit.form-plugin", this.selector, n, t).on("click.form-plugin", this.selector, n, r), this) : this.ajaxFormUnbind().bind("submit.form-plugin", n, t).bind("click.form-plugin", n, r)
    }, e.fn.ajaxFormUnbind = function () {
        return this.unbind("submit.form-plugin click.form-plugin")
    }, e.fn.formToArray = function (t, r) {
        var a = [];
        if (0 === this.length) return a;
        var i, o = this[0], s = this.attr("id"), u = t ? o.getElementsByTagName("*") : o.elements;
        if (u && !/MSIE [678]/.test(navigator.userAgent) && (u = e(u).get()), s && (i = e(':input[form="' + s + '"]').get(), i.length && (u = (u || []).concat(i))), !u || !u.length) return a;
        var c, l, f, m, d, p, h;
        for (c = 0, p = u.length; p > c; c++) if (d = u[c], f = d.name, f && !d.disabled) if (t && o.clk && "image" == d.type) o.clk == d && (a.push({
            name: f,
            value: e(d).val(),
            type: d.type
        }), a.push({name: f + ".x", value: o.clk_x}, {
            name: f + ".y",
            value: o.clk_y
        })); else if (m = e.fieldValue(d, !0), m && m.constructor == Array) for (r && r.push(d), l = 0, h = m.length; h > l; l++) a.push({
            name: f,
            value: m[l]
        }); else if (n.fileapi && "file" == d.type) {
            r && r.push(d);
            var v = d.files;
            if (v.length) for (l = 0; l < v.length; l++) a.push({
                name: f,
                value: v[l],
                type: d.type
            }); else a.push({name: f, value: "", type: d.type})
        } else null !== m && "undefined" != typeof m && (r && r.push(d), a.push({
            name: f,
            value: m,
            type: d.type,
            required: d.required
        }));
        if (!t && o.clk) {
            var g = e(o.clk), x = g[0];
            f = x.name, f && !x.disabled && "image" == x.type && (a.push({
                name: f,
                value: g.val()
            }), a.push({name: f + ".x", value: o.clk_x}, {name: f + ".y", value: o.clk_y}))
        }
        return a
    }, e.fn.formSerialize = function (t) {
        return e.param(this.formToArray(t))
    }, e.fn.fieldSerialize = function (t) {
        var r = [];
        return this.each(function () {
            var a = this.name;
            if (a) {
                var n = e.fieldValue(this, t);
                if (n && n.constructor == Array) for (var i = 0, o = n.length; o > i; i++) r.push({
                    name: a,
                    value: n[i]
                }); else null !== n && "undefined" != typeof n && r.push({name: this.name, value: n})
            }
        }), e.param(r)
    }, e.fn.fieldValue = function (t) {
        for (var r = [], a = 0, n = this.length; n > a; a++) {
            var i = this[a], o = e.fieldValue(i, t);
            null === o || "undefined" == typeof o || o.constructor == Array && !o.length || (o.constructor == Array ? e.merge(r, o) : r.push(o))
        }
        return r
    }, e.fieldValue = function (t, r) {
        var a = t.name, n = t.type, i = t.tagName.toLowerCase();
        if (void 0 === r && (r = !0), r && (!a || t.disabled || "reset" == n || "button" == n || ("checkbox" == n || "radio" == n) && !t.checked || ("submit" == n || "image" == n) && t.form && t.form.clk != t || "select" == i && -1 == t.selectedIndex)) return null;
        if ("select" == i) {
            var o = t.selectedIndex;
            if (0 > o) return null;
            for (var s = [], u = t.options, c = "select-one" == n, l = c ? o + 1 : u.length, f = c ? o : 0; l > f; f++) {
                var m = u[f];
                if (m.selected) {
                    var d = m.value;
                    if (d || (d = m.attributes && m.attributes.value && !m.attributes.value.specified ? m.text : m.value), c) return d;
                    s.push(d)
                }
            }
            return s
        }
        return e(t).val()
    }, e.fn.clearForm = function (t) {
        return this.each(function () {
            e("input,select,textarea", this).clearFields(t)
        })
    }, e.fn.clearFields = e.fn.clearInputs = function (t) {
        var r = /^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i;
        return this.each(function () {
            var a = this.type, n = this.tagName.toLowerCase();
            r.test(a) || "textarea" == n ? this.value = "" : "checkbox" == a || "radio" == a ? this.checked = !1 : "select" == n ? this.selectedIndex = -1 : "file" == a ? /MSIE/.test(navigator.userAgent) ? e(this).replaceWith(e(this).clone(!0)) : e(this).val("") : t && (t === !0 && /hidden/.test(a) || "string" == typeof t && e(this).is(t)) && (this.value = "")
        })
    }, e.fn.resetForm = function () {
        return this.each(function () {
            ("function" == typeof this.reset || "object" == typeof this.reset && !this.reset.nodeType) && this.reset()
        })
    }, e.fn.enable = function (e) {
        return void 0 === e && (e = !0), this.each(function () {
            this.disabled = !e
        })
    }, e.fn.selected = function (t) {
        return void 0 === t && (t = !0), this.each(function () {
            var r = this.type;
            if ("checkbox" == r || "radio" == r) this.checked = t; else if ("option" == this.tagName.toLowerCase()) {
                var a = e(this).parent("select");
                t && a[0] && "select-one" == a[0].type && a.find("option").selected(!1), this.selected = t
            }
        })
    }, e.fn.ajaxSubmit.debug = !1
});


!function (e, t) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = t() : "function" == typeof define && define.amd ? define(t) : e.moment = t()
}(this, function () {
    "use strict";
    var e, t;

    function n() {
        return e.apply(null, arguments)
    }

    function s(e) {
        return e instanceof Array || "[object Array]" === Object.prototype.toString.call(e)
    }

    function i(e) {
        return null != e && "[object Object]" === Object.prototype.toString.call(e)
    }

    function r(e) {
        return void 0 === e
    }

    function a(e) {
        return "number" == typeof e || "[object Number]" === Object.prototype.toString.call(e)
    }

    function o(e) {
        return e instanceof Date || "[object Date]" === Object.prototype.toString.call(e)
    }

    function u(e, t) {
        var n, s = [];
        for (n = 0; n < e.length; ++n) s.push(t(e[n], n));
        return s
    }

    function l(e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }

    function d(e, t) {
        for (var n in t) l(t, n) && (e[n] = t[n]);
        return l(t, "toString") && (e.toString = t.toString), l(t, "valueOf") && (e.valueOf = t.valueOf), e
    }

    function h(e, t, n, s) {
        return Ot(e, t, n, s, !0).utc()
    }

    function c(e) {
        return null == e._pf && (e._pf = {
            empty: !1,
            unusedTokens: [],
            unusedInput: [],
            overflow: -2,
            charsLeftOver: 0,
            nullInput: !1,
            invalidMonth: null,
            invalidFormat: !1,
            userInvalidated: !1,
            iso: !1,
            parsedDateParts: [],
            meridiem: null,
            rfc2822: !1,
            weekdayMismatch: !1
        }), e._pf
    }

    function f(e) {
        if (null == e._isValid) {
            var n = c(e), s = t.call(n.parsedDateParts, function (e) {
                    return null != e
                }),
                i = !isNaN(e._d.getTime()) && n.overflow < 0 && !n.empty && !n.invalidMonth && !n.invalidWeekday && !n.weekdayMismatch && !n.nullInput && !n.invalidFormat && !n.userInvalidated && (!n.meridiem || n.meridiem && s);
            if (e._strict && (i = i && 0 === n.charsLeftOver && 0 === n.unusedTokens.length && void 0 === n.bigHour), null != Object.isFrozen && Object.isFrozen(e)) return i;
            e._isValid = i
        }
        return e._isValid
    }

    function m(e) {
        var t = h(NaN);
        return null != e ? d(c(t), e) : c(t).userInvalidated = !0, t
    }

    t = Array.prototype.some ? Array.prototype.some : function (e) {
        for (var t = Object(this), n = t.length >>> 0, s = 0; s < n; s++) if (s in t && e.call(this, t[s], s, t)) return !0;
        return !1
    };
    var _ = n.momentProperties = [];

    function y(e, t) {
        var n, s, i;
        if (r(t._isAMomentObject) || (e._isAMomentObject = t._isAMomentObject), r(t._i) || (e._i = t._i), r(t._f) || (e._f = t._f), r(t._l) || (e._l = t._l), r(t._strict) || (e._strict = t._strict), r(t._tzm) || (e._tzm = t._tzm), r(t._isUTC) || (e._isUTC = t._isUTC), r(t._offset) || (e._offset = t._offset), r(t._pf) || (e._pf = c(t)), r(t._locale) || (e._locale = t._locale), _.length > 0) for (n = 0; n < _.length; n++) r(i = t[s = _[n]]) || (e[s] = i);
        return e
    }

    var g = !1;

    function p(e) {
        y(this, e), this._d = new Date(null != e._d ? e._d.getTime() : NaN), this.isValid() || (this._d = new Date(NaN)), !1 === g && (g = !0, n.updateOffset(this), g = !1)
    }

    function v(e) {
        return e instanceof p || null != e && null != e._isAMomentObject
    }

    function w(e) {
        return e < 0 ? Math.ceil(e) || 0 : Math.floor(e)
    }

    function M(e) {
        var t = +e, n = 0;
        return 0 !== t && isFinite(t) && (n = w(t)), n
    }

    function S(e, t, n) {
        var s, i = Math.min(e.length, t.length), r = Math.abs(e.length - t.length), a = 0;
        for (s = 0; s < i; s++) (n && e[s] !== t[s] || !n && M(e[s]) !== M(t[s])) && a++;
        return a + r
    }

    function D(e) {
        !1 === n.suppressDeprecationWarnings && "undefined" != typeof console && console.warn && console.warn("Deprecation warning: " + e)
    }

    function k(e, t) {
        var s = !0;
        return d(function () {
            if (null != n.deprecationHandler && n.deprecationHandler(null, e), s) {
                for (var i, r = [], a = 0; a < arguments.length; a++) {
                    if (i = "", "object" == typeof arguments[a]) {
                        for (var o in i += "\n[" + a + "] ", arguments[0]) i += o + ": " + arguments[0][o] + ", ";
                        i = i.slice(0, -2)
                    } else i = arguments[a];
                    r.push(i)
                }
                D(e + "\nArguments: " + Array.prototype.slice.call(r).join("") + "\n" + (new Error).stack), s = !1
            }
            return t.apply(this, arguments)
        }, t)
    }

    var Y, O = {};

    function T(e, t) {
        null != n.deprecationHandler && n.deprecationHandler(e, t), O[e] || (D(t), O[e] = !0)
    }

    function x(e) {
        return e instanceof Function || "[object Function]" === Object.prototype.toString.call(e)
    }

    function b(e, t) {
        var n, s = d({}, e);
        for (n in t) l(t, n) && (i(e[n]) && i(t[n]) ? (s[n] = {}, d(s[n], e[n]), d(s[n], t[n])) : null != t[n] ? s[n] = t[n] : delete s[n]);
        for (n in e) l(e, n) && !l(t, n) && i(e[n]) && (s[n] = d({}, s[n]));
        return s
    }

    function P(e) {
        null != e && this.set(e)
    }

    n.suppressDeprecationWarnings = !1, n.deprecationHandler = null, Y = Object.keys ? Object.keys : function (e) {
        var t, n = [];
        for (t in e) l(e, t) && n.push(t);
        return n
    };
    var W = {};

    function H(e, t) {
        var n = e.toLowerCase();
        W[n] = W[n + "s"] = W[t] = e
    }

    function R(e) {
        return "string" == typeof e ? W[e] || W[e.toLowerCase()] : void 0
    }

    function C(e) {
        var t, n, s = {};
        for (n in e) l(e, n) && (t = R(n)) && (s[t] = e[n]);
        return s
    }

    var F = {};

    function L(e, t) {
        F[e] = t
    }

    function U(e, t, n) {
        var s = "" + Math.abs(e), i = t - s.length;
        return (e >= 0 ? n ? "+" : "" : "-") + Math.pow(10, Math.max(0, i)).toString().substr(1) + s
    }

    var N = /(\[[^\[]*\])|(\\)?([Hh]mm(ss)?|Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|Qo?|YYYYYY|YYYYY|YYYY|YY|gg(ggg?)?|GG(GGG?)?|e|E|a|A|hh?|HH?|kk?|mm?|ss?|S{1,9}|x|X|zz?|ZZ?|.)/g,
        G = /(\[[^\[]*\])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g, V = {}, E = {};

    function I(e, t, n, s) {
        var i = s;
        "string" == typeof s && (i = function () {
            return this[s]()
        }), e && (E[e] = i), t && (E[t[0]] = function () {
            return U(i.apply(this, arguments), t[1], t[2])
        }), n && (E[n] = function () {
            return this.localeData().ordinal(i.apply(this, arguments), e)
        })
    }

    function A(e, t) {
        return e.isValid() ? (t = j(t, e.localeData()), V[t] = V[t] || function (e) {
            var t, n, s, i = e.match(N);
            for (t = 0, n = i.length; t < n; t++) E[i[t]] ? i[t] = E[i[t]] : i[t] = (s = i[t]).match(/\[[\s\S]/) ? s.replace(/^\[|\]$/g, "") : s.replace(/\\/g, "");
            return function (t) {
                var s, r = "";
                for (s = 0; s < n; s++) r += x(i[s]) ? i[s].call(t, e) : i[s];
                return r
            }
        }(t), V[t](e)) : e.localeData().invalidDate()
    }

    function j(e, t) {
        var n = 5;

        function s(e) {
            return t.longDateFormat(e) || e
        }

        for (G.lastIndex = 0; n >= 0 && G.test(e);) e = e.replace(G, s), G.lastIndex = 0, n -= 1;
        return e
    }

    var Z = /\d/, z = /\d\d/, $ = /\d{3}/, q = /\d{4}/, J = /[+-]?\d{6}/, B = /\d\d?/, Q = /\d\d\d\d?/,
        X = /\d\d\d\d\d\d?/, K = /\d{1,3}/, ee = /\d{1,4}/, te = /[+-]?\d{1,6}/, ne = /\d+/, se = /[+-]?\d+/,
        ie = /Z|[+-]\d\d:?\d\d/gi, re = /Z|[+-]\d\d(?::?\d\d)?/gi,
        ae = /[0-9]{0,256}['a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFF07\uFF10-\uFFEF]{1,256}|[\u0600-\u06FF\/]{1,256}(\s*?[\u0600-\u06FF]{1,256}){1,2}/i,
        oe = {};

    function ue(e, t, n) {
        oe[e] = x(t) ? t : function (e, s) {
            return e && n ? n : t
        }
    }

    function le(e, t) {
        return l(oe, e) ? oe[e](t._strict, t._locale) : new RegExp(de(e.replace("\\", "").replace(/\\(\[)|\\(\])|\[([^\]\[]*)\]|\\(.)/g, function (e, t, n, s, i) {
            return t || n || s || i
        })))
    }

    function de(e) {
        return e.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&")
    }

    var he = {};

    function ce(e, t) {
        var n, s = t;
        for ("string" == typeof e && (e = [e]), a(t) && (s = function (e, n) {
            n[t] = M(e)
        }), n = 0; n < e.length; n++) he[e[n]] = s
    }

    function fe(e, t) {
        ce(e, function (e, n, s, i) {
            s._w = s._w || {}, t(e, s._w, s, i)
        })
    }

    var me = 0, _e = 1, ye = 2, ge = 3, pe = 4, ve = 5, we = 6, Me = 7, Se = 8;

    function De(e) {
        return ke(e) ? 366 : 365
    }

    function ke(e) {
        return e % 4 == 0 && e % 100 != 0 || e % 400 == 0
    }

    I("Y", 0, 0, function () {
        var e = this.year();
        return e <= 9999 ? "" + e : "+" + e
    }), I(0, ["YY", 2], 0, function () {
        return this.year() % 100
    }), I(0, ["YYYY", 4], 0, "year"), I(0, ["YYYYY", 5], 0, "year"), I(0, ["YYYYYY", 6, !0], 0, "year"), H("year", "y"), L("year", 1), ue("Y", se), ue("YY", B, z), ue("YYYY", ee, q), ue("YYYYY", te, J), ue("YYYYYY", te, J), ce(["YYYYY", "YYYYYY"], me), ce("YYYY", function (e, t) {
        t[me] = 2 === e.length ? n.parseTwoDigitYear(e) : M(e)
    }), ce("YY", function (e, t) {
        t[me] = n.parseTwoDigitYear(e)
    }), ce("Y", function (e, t) {
        t[me] = parseInt(e, 10)
    }), n.parseTwoDigitYear = function (e) {
        return M(e) + (M(e) > 68 ? 1900 : 2e3)
    };
    var Ye, Oe = Te("FullYear", !0);

    function Te(e, t) {
        return function (s) {
            return null != s ? (be(this, e, s), n.updateOffset(this, t), this) : xe(this, e)
        }
    }

    function xe(e, t) {
        return e.isValid() ? e._d["get" + (e._isUTC ? "UTC" : "") + t]() : NaN
    }

    function be(e, t, n) {
        e.isValid() && !isNaN(n) && ("FullYear" === t && ke(e.year()) && 1 === e.month() && 29 === e.date() ? e._d["set" + (e._isUTC ? "UTC" : "") + t](n, e.month(), Pe(n, e.month())) : e._d["set" + (e._isUTC ? "UTC" : "") + t](n))
    }

    function Pe(e, t) {
        if (isNaN(e) || isNaN(t)) return NaN;
        var n, s = (t % (n = 12) + n) % n;
        return e += (t - s) / 12, 1 === s ? ke(e) ? 29 : 28 : 31 - s % 7 % 2
    }

    Ye = Array.prototype.indexOf ? Array.prototype.indexOf : function (e) {
        var t;
        for (t = 0; t < this.length; ++t) if (this[t] === e) return t;
        return -1
    }, I("M", ["MM", 2], "Mo", function () {
        return this.month() + 1
    }), I("MMM", 0, 0, function (e) {
        return this.localeData().monthsShort(this, e)
    }), I("MMMM", 0, 0, function (e) {
        return this.localeData().months(this, e)
    }), H("month", "M"), L("month", 8), ue("M", B), ue("MM", B, z), ue("MMM", function (e, t) {
        return t.monthsShortRegex(e)
    }), ue("MMMM", function (e, t) {
        return t.monthsRegex(e)
    }), ce(["M", "MM"], function (e, t) {
        t[_e] = M(e) - 1
    }), ce(["MMM", "MMMM"], function (e, t, n, s) {
        var i = n._locale.monthsParse(e, s, n._strict);
        null != i ? t[_e] = i : c(n).invalidMonth = e
    });
    var We = /D[oD]?(\[[^\[\]]*\]|\s)+MMMM?/,
        He = "January_February_March_April_May_June_July_August_September_October_November_December".split("_");
    var Re = "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_");

    function Ce(e, t) {
        var n;
        if (!e.isValid()) return e;
        if ("string" == typeof t) if (/^\d+$/.test(t)) t = M(t); else if (!a(t = e.localeData().monthsParse(t))) return e;
        return n = Math.min(e.date(), Pe(e.year(), t)), e._d["set" + (e._isUTC ? "UTC" : "") + "Month"](t, n), e
    }

    function Fe(e) {
        return null != e ? (Ce(this, e), n.updateOffset(this, !0), this) : xe(this, "Month")
    }

    var Le = ae;
    var Ue = ae;

    function Ne() {
        function e(e, t) {
            return t.length - e.length
        }

        var t, n, s = [], i = [], r = [];
        for (t = 0; t < 12; t++) n = h([2e3, t]), s.push(this.monthsShort(n, "")), i.push(this.months(n, "")), r.push(this.months(n, "")), r.push(this.monthsShort(n, ""));
        for (s.sort(e), i.sort(e), r.sort(e), t = 0; t < 12; t++) s[t] = de(s[t]), i[t] = de(i[t]);
        for (t = 0; t < 24; t++) r[t] = de(r[t]);
        this._monthsRegex = new RegExp("^(" + r.join("|") + ")", "i"), this._monthsShortRegex = this._monthsRegex, this._monthsStrictRegex = new RegExp("^(" + i.join("|") + ")", "i"), this._monthsShortStrictRegex = new RegExp("^(" + s.join("|") + ")", "i")
    }

    function Ge(e) {
        var t = new Date(Date.UTC.apply(null, arguments));
        return e < 100 && e >= 0 && isFinite(t.getUTCFullYear()) && t.setUTCFullYear(e), t
    }

    function Ve(e, t, n) {
        var s = 7 + t - n;
        return -((7 + Ge(e, 0, s).getUTCDay() - t) % 7) + s - 1
    }

    function Ee(e, t, n, s, i) {
        var r, a, o = 1 + 7 * (t - 1) + (7 + n - s) % 7 + Ve(e, s, i);
        return o <= 0 ? a = De(r = e - 1) + o : o > De(e) ? (r = e + 1, a = o - De(e)) : (r = e, a = o), {
            year: r,
            dayOfYear: a
        }
    }

    function Ie(e, t, n) {
        var s, i, r = Ve(e.year(), t, n), a = Math.floor((e.dayOfYear() - r - 1) / 7) + 1;
        return a < 1 ? s = a + Ae(i = e.year() - 1, t, n) : a > Ae(e.year(), t, n) ? (s = a - Ae(e.year(), t, n), i = e.year() + 1) : (i = e.year(), s = a), {
            week: s,
            year: i
        }
    }

    function Ae(e, t, n) {
        var s = Ve(e, t, n), i = Ve(e + 1, t, n);
        return (De(e) - s + i) / 7
    }

    I("w", ["ww", 2], "wo", "week"), I("W", ["WW", 2], "Wo", "isoWeek"), H("week", "w"), H("isoWeek", "W"), L("week", 5), L("isoWeek", 5), ue("w", B), ue("ww", B, z), ue("W", B), ue("WW", B, z), fe(["w", "ww", "W", "WW"], function (e, t, n, s) {
        t[s.substr(0, 1)] = M(e)
    });
    I("d", 0, "do", "day"), I("dd", 0, 0, function (e) {
        return this.localeData().weekdaysMin(this, e)
    }), I("ddd", 0, 0, function (e) {
        return this.localeData().weekdaysShort(this, e)
    }), I("dddd", 0, 0, function (e) {
        return this.localeData().weekdays(this, e)
    }), I("e", 0, 0, "weekday"), I("E", 0, 0, "isoWeekday"), H("day", "d"), H("weekday", "e"), H("isoWeekday", "E"), L("day", 11), L("weekday", 11), L("isoWeekday", 11), ue("d", B), ue("e", B), ue("E", B), ue("dd", function (e, t) {
        return t.weekdaysMinRegex(e)
    }), ue("ddd", function (e, t) {
        return t.weekdaysShortRegex(e)
    }), ue("dddd", function (e, t) {
        return t.weekdaysRegex(e)
    }), fe(["dd", "ddd", "dddd"], function (e, t, n, s) {
        var i = n._locale.weekdaysParse(e, s, n._strict);
        null != i ? t.d = i : c(n).invalidWeekday = e
    }), fe(["d", "e", "E"], function (e, t, n, s) {
        t[s] = M(e)
    });
    var je = "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_");
    var Ze = "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_");
    var ze = "Su_Mo_Tu_We_Th_Fr_Sa".split("_");
    var $e = ae;
    var qe = ae;
    var Je = ae;

    function Be() {
        function e(e, t) {
            return t.length - e.length
        }

        var t, n, s, i, r, a = [], o = [], u = [], l = [];
        for (t = 0; t < 7; t++) n = h([2e3, 1]).day(t), s = this.weekdaysMin(n, ""), i = this.weekdaysShort(n, ""), r = this.weekdays(n, ""), a.push(s), o.push(i), u.push(r), l.push(s), l.push(i), l.push(r);
        for (a.sort(e), o.sort(e), u.sort(e), l.sort(e), t = 0; t < 7; t++) o[t] = de(o[t]), u[t] = de(u[t]), l[t] = de(l[t]);
        this._weekdaysRegex = new RegExp("^(" + l.join("|") + ")", "i"), this._weekdaysShortRegex = this._weekdaysRegex, this._weekdaysMinRegex = this._weekdaysRegex, this._weekdaysStrictRegex = new RegExp("^(" + u.join("|") + ")", "i"), this._weekdaysShortStrictRegex = new RegExp("^(" + o.join("|") + ")", "i"), this._weekdaysMinStrictRegex = new RegExp("^(" + a.join("|") + ")", "i")
    }

    function Qe() {
        return this.hours() % 12 || 12
    }

    function Xe(e, t) {
        I(e, 0, 0, function () {
            return this.localeData().meridiem(this.hours(), this.minutes(), t)
        })
    }

    function Ke(e, t) {
        return t._meridiemParse
    }

    I("H", ["HH", 2], 0, "hour"), I("h", ["hh", 2], 0, Qe), I("k", ["kk", 2], 0, function () {
        return this.hours() || 24
    }), I("hmm", 0, 0, function () {
        return "" + Qe.apply(this) + U(this.minutes(), 2)
    }), I("hmmss", 0, 0, function () {
        return "" + Qe.apply(this) + U(this.minutes(), 2) + U(this.seconds(), 2)
    }), I("Hmm", 0, 0, function () {
        return "" + this.hours() + U(this.minutes(), 2)
    }), I("Hmmss", 0, 0, function () {
        return "" + this.hours() + U(this.minutes(), 2) + U(this.seconds(), 2)
    }), Xe("a", !0), Xe("A", !1), H("hour", "h"), L("hour", 13), ue("a", Ke), ue("A", Ke), ue("H", B), ue("h", B), ue("k", B), ue("HH", B, z), ue("hh", B, z), ue("kk", B, z), ue("hmm", Q), ue("hmmss", X), ue("Hmm", Q), ue("Hmmss", X), ce(["H", "HH"], ge), ce(["k", "kk"], function (e, t, n) {
        var s = M(e);
        t[ge] = 24 === s ? 0 : s
    }), ce(["a", "A"], function (e, t, n) {
        n._isPm = n._locale.isPM(e), n._meridiem = e
    }), ce(["h", "hh"], function (e, t, n) {
        t[ge] = M(e), c(n).bigHour = !0
    }), ce("hmm", function (e, t, n) {
        var s = e.length - 2;
        t[ge] = M(e.substr(0, s)), t[pe] = M(e.substr(s)), c(n).bigHour = !0
    }), ce("hmmss", function (e, t, n) {
        var s = e.length - 4, i = e.length - 2;
        t[ge] = M(e.substr(0, s)), t[pe] = M(e.substr(s, 2)), t[ve] = M(e.substr(i)), c(n).bigHour = !0
    }), ce("Hmm", function (e, t, n) {
        var s = e.length - 2;
        t[ge] = M(e.substr(0, s)), t[pe] = M(e.substr(s))
    }), ce("Hmmss", function (e, t, n) {
        var s = e.length - 4, i = e.length - 2;
        t[ge] = M(e.substr(0, s)), t[pe] = M(e.substr(s, 2)), t[ve] = M(e.substr(i))
    });
    var et, tt = Te("Hours", !0), nt = {
        calendar: {
            sameDay: "[Today at] LT",
            nextDay: "[Tomorrow at] LT",
            nextWeek: "dddd [at] LT",
            lastDay: "[Yesterday at] LT",
            lastWeek: "[Last] dddd [at] LT",
            sameElse: "L"
        },
        longDateFormat: {
            LTS: "h:mm:ss A",
            LT: "h:mm A",
            L: "MM/DD/YYYY",
            LL: "MMMM D, YYYY",
            LLL: "MMMM D, YYYY h:mm A",
            LLLL: "dddd, MMMM D, YYYY h:mm A"
        },
        invalidDate: "Invalid date",
        ordinal: "%d",
        dayOfMonthOrdinalParse: /\d{1,2}/,
        relativeTime: {
            future: "in %s",
            past: "%s ago",
            s: "a few seconds",
            ss: "%d seconds",
            m: "a minute",
            mm: "%d minutes",
            h: "an hour",
            hh: "%d hours",
            d: "a day",
            dd: "%d days",
            M: "a month",
            MM: "%d months",
            y: "a year",
            yy: "%d years"
        },
        months: He,
        monthsShort: Re,
        week: {dow: 0, doy: 6},
        weekdays: je,
        weekdaysMin: ze,
        weekdaysShort: Ze,
        meridiemParse: /[ap]\.?m?\.?/i
    }, st = {}, it = {};

    function rt(e) {
        return e ? e.toLowerCase().replace("_", "-") : e
    }

    // function at(e) {
    //     var t = null;
    //     if (!st[e] && "undefined" != typeof module && module && module.exports) try {
    //         t = et._abbr, require("./locale/" + e), ot(t)
    //     } catch (e) {
    //     }
    //     return st[e]
    // }

    function ot(e, t) {
        var n;
        return e && ((n = r(t) ? lt(e) : ut(e, t)) ? et = n : "undefined" != typeof console && console.warn && console.warn("Locale " + e + " not found. Did you forget to load it?")), et._abbr
    }

    function ut(e, t) {
        if (null !== t) {
            var n, s = nt;
            if (t.abbr = e, null != st[e]) T("defineLocaleOverride", "use moment.updateLocale(localeName, config) to change an existing locale. moment.defineLocale(localeName, config) should only be used for creating a new locale See http://momentjs.com/guides/#/warnings/define-locale/ for more info."), s = st[e]._config; else if (null != t.parentLocale) if (null != st[t.parentLocale]) s = st[t.parentLocale]._config; else {
                if (null == (n = at(t.parentLocale))) return it[t.parentLocale] || (it[t.parentLocale] = []), it[t.parentLocale].push({
                    name: e,
                    config: t
                }), null;
                s = n._config
            }
            return st[e] = new P(b(s, t)), it[e] && it[e].forEach(function (e) {
                ut(e.name, e.config)
            }), ot(e), st[e]
        }
        return delete st[e], null
    }

    function lt(e) {
        var t;
        if (e && e._locale && e._locale._abbr && (e = e._locale._abbr), !e) return et;
        if (!s(e)) {
            if (t = at(e)) return t;
            e = [e]
        }
        return function (e) {
            for (var t, n, s, i, r = 0; r < e.length;) {
                for (t = (i = rt(e[r]).split("-")).length, n = (n = rt(e[r + 1])) ? n.split("-") : null; t > 0;) {
                    if (s = at(i.slice(0, t).join("-"))) return s;
                    if (n && n.length >= t && S(i, n, !0) >= t - 1) break;
                    t--
                }
                r++
            }
            return et
        }(e)
    }

    function dt(e) {
        var t, n = e._a;
        return n && -2 === c(e).overflow && (t = n[_e] < 0 || n[_e] > 11 ? _e : n[ye] < 1 || n[ye] > Pe(n[me], n[_e]) ? ye : n[ge] < 0 || n[ge] > 24 || 24 === n[ge] && (0 !== n[pe] || 0 !== n[ve] || 0 !== n[we]) ? ge : n[pe] < 0 || n[pe] > 59 ? pe : n[ve] < 0 || n[ve] > 59 ? ve : n[we] < 0 || n[we] > 999 ? we : -1, c(e)._overflowDayOfYear && (t < me || t > ye) && (t = ye), c(e)._overflowWeeks && -1 === t && (t = Me), c(e)._overflowWeekday && -1 === t && (t = Se), c(e).overflow = t), e
    }

    function ht(e, t, n) {
        return null != e ? e : null != t ? t : n
    }

    function ct(e) {
        var t, s, i, r, a, o = [];
        if (!e._d) {
            var u, l;
            for (u = e, l = new Date(n.now()), i = u._useUTC ? [l.getUTCFullYear(), l.getUTCMonth(), l.getUTCDate()] : [l.getFullYear(), l.getMonth(), l.getDate()], e._w && null == e._a[ye] && null == e._a[_e] && function (e) {
                var t, n, s, i, r, a, o, u;
                if (null != (t = e._w).GG || null != t.W || null != t.E) r = 1, a = 4, n = ht(t.GG, e._a[me], Ie(Tt(), 1, 4).year), s = ht(t.W, 1), ((i = ht(t.E, 1)) < 1 || i > 7) && (u = !0); else {
                    r = e._locale._week.dow, a = e._locale._week.doy;
                    var l = Ie(Tt(), r, a);
                    n = ht(t.gg, e._a[me], l.year), s = ht(t.w, l.week), null != t.d ? ((i = t.d) < 0 || i > 6) && (u = !0) : null != t.e ? (i = t.e + r, (t.e < 0 || t.e > 6) && (u = !0)) : i = r
                }
                s < 1 || s > Ae(n, r, a) ? c(e)._overflowWeeks = !0 : null != u ? c(e)._overflowWeekday = !0 : (o = Ee(n, s, i, r, a), e._a[me] = o.year, e._dayOfYear = o.dayOfYear)
            }(e), null != e._dayOfYear && (a = ht(e._a[me], i[me]), (e._dayOfYear > De(a) || 0 === e._dayOfYear) && (c(e)._overflowDayOfYear = !0), s = Ge(a, 0, e._dayOfYear), e._a[_e] = s.getUTCMonth(), e._a[ye] = s.getUTCDate()), t = 0; t < 3 && null == e._a[t]; ++t) e._a[t] = o[t] = i[t];
            for (; t < 7; t++) e._a[t] = o[t] = null == e._a[t] ? 2 === t ? 1 : 0 : e._a[t];
            24 === e._a[ge] && 0 === e._a[pe] && 0 === e._a[ve] && 0 === e._a[we] && (e._nextDay = !0, e._a[ge] = 0), e._d = (e._useUTC ? Ge : function (e, t, n, s, i, r, a) {
                var o = new Date(e, t, n, s, i, r, a);
                return e < 100 && e >= 0 && isFinite(o.getFullYear()) && o.setFullYear(e), o
            }).apply(null, o), r = e._useUTC ? e._d.getUTCDay() : e._d.getDay(), null != e._tzm && e._d.setUTCMinutes(e._d.getUTCMinutes() - e._tzm), e._nextDay && (e._a[ge] = 24), e._w && void 0 !== e._w.d && e._w.d !== r && (c(e).weekdayMismatch = !0)
        }
    }

    var ft = /^\s*((?:[+-]\d{6}|\d{4})-(?:\d\d-\d\d|W\d\d-\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?::\d\d(?::\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/,
        mt = /^\s*((?:[+-]\d{6}|\d{4})(?:\d\d\d\d|W\d\d\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?:\d\d(?:\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/,
        _t = /Z|[+-]\d\d(?::?\d\d)?/,
        yt = [["YYYYYY-MM-DD", /[+-]\d{6}-\d\d-\d\d/], ["YYYY-MM-DD", /\d{4}-\d\d-\d\d/], ["GGGG-[W]WW-E", /\d{4}-W\d\d-\d/], ["GGGG-[W]WW", /\d{4}-W\d\d/, !1], ["YYYY-DDD", /\d{4}-\d{3}/], ["YYYY-MM", /\d{4}-\d\d/, !1], ["YYYYYYMMDD", /[+-]\d{10}/], ["YYYYMMDD", /\d{8}/], ["GGGG[W]WWE", /\d{4}W\d{3}/], ["GGGG[W]WW", /\d{4}W\d{2}/, !1], ["YYYYDDD", /\d{7}/]],
        gt = [["HH:mm:ss.SSSS", /\d\d:\d\d:\d\d\.\d+/], ["HH:mm:ss,SSSS", /\d\d:\d\d:\d\d,\d+/], ["HH:mm:ss", /\d\d:\d\d:\d\d/], ["HH:mm", /\d\d:\d\d/], ["HHmmss.SSSS", /\d\d\d\d\d\d\.\d+/], ["HHmmss,SSSS", /\d\d\d\d\d\d,\d+/], ["HHmmss", /\d\d\d\d\d\d/], ["HHmm", /\d\d\d\d/], ["HH", /\d\d/]],
        pt = /^\/?Date\((\-?\d+)/i;

    function vt(e) {
        var t, n, s, i, r, a, o = e._i, u = ft.exec(o) || mt.exec(o);
        if (u) {
            for (c(e).iso = !0, t = 0, n = yt.length; t < n; t++) if (yt[t][1].exec(u[1])) {
                i = yt[t][0], s = !1 !== yt[t][2];
                break
            }
            if (null == i) return void (e._isValid = !1);
            if (u[3]) {
                for (t = 0, n = gt.length; t < n; t++) if (gt[t][1].exec(u[3])) {
                    r = (u[2] || " ") + gt[t][0];
                    break
                }
                if (null == r) return void (e._isValid = !1)
            }
            if (!s && null != r) return void (e._isValid = !1);
            if (u[4]) {
                if (!_t.exec(u[4])) return void (e._isValid = !1);
                a = "Z"
            }
            e._f = i + (r || "") + (a || ""), kt(e)
        } else e._isValid = !1
    }

    var wt = /^(?:(Mon|Tue|Wed|Thu|Fri|Sat|Sun),?\s)?(\d{1,2})\s(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s(\d{2,4})\s(\d\d):(\d\d)(?::(\d\d))?\s(?:(UT|GMT|[ECMP][SD]T)|([Zz])|([+-]\d{4}))$/;

    function Mt(e, t, n, s, i, r) {
        var a = [function (e) {
            var t = parseInt(e, 10);
            {
                if (t <= 49) return 2e3 + t;
                if (t <= 999) return 1900 + t
            }
            return t
        }(e), Re.indexOf(t), parseInt(n, 10), parseInt(s, 10), parseInt(i, 10)];
        return r && a.push(parseInt(r, 10)), a
    }

    var St = {UT: 0, GMT: 0, EDT: -240, EST: -300, CDT: -300, CST: -360, MDT: -360, MST: -420, PDT: -420, PST: -480};

    function Dt(e) {
        var t, n, s, i = wt.exec(e._i.replace(/\([^)]*\)|[\n\t]/g, " ").replace(/(\s\s+)/g, " ").trim());
        if (i) {
            var r = Mt(i[4], i[3], i[2], i[5], i[6], i[7]);
            if (t = i[1], n = r, s = e, t && Ze.indexOf(t) !== new Date(n[0], n[1], n[2]).getDay() && (c(s).weekdayMismatch = !0, s._isValid = !1, 1)) return;
            e._a = r, e._tzm = function (e, t, n) {
                if (e) return St[e];
                if (t) return 0;
                var s = parseInt(n, 10), i = s % 100;
                return (s - i) / 100 * 60 + i
            }(i[8], i[9], i[10]), e._d = Ge.apply(null, e._a), e._d.setUTCMinutes(e._d.getUTCMinutes() - e._tzm), c(e).rfc2822 = !0
        } else e._isValid = !1
    }

    function kt(e) {
        if (e._f !== n.ISO_8601) if (e._f !== n.RFC_2822) {
            e._a = [], c(e).empty = !0;
            var t, s, i, r, a, o, u, d, h = "" + e._i, f = h.length, m = 0;
            for (i = j(e._f, e._locale).match(N) || [], t = 0; t < i.length; t++) r = i[t], (s = (h.match(le(r, e)) || [])[0]) && ((a = h.substr(0, h.indexOf(s))).length > 0 && c(e).unusedInput.push(a), h = h.slice(h.indexOf(s) + s.length), m += s.length), E[r] ? (s ? c(e).empty = !1 : c(e).unusedTokens.push(r), o = r, d = e, null != (u = s) && l(he, o) && he[o](u, d._a, d, o)) : e._strict && !s && c(e).unusedTokens.push(r);
            c(e).charsLeftOver = f - m, h.length > 0 && c(e).unusedInput.push(h), e._a[ge] <= 12 && !0 === c(e).bigHour && e._a[ge] > 0 && (c(e).bigHour = void 0), c(e).parsedDateParts = e._a.slice(0), c(e).meridiem = e._meridiem, e._a[ge] = function (e, t, n) {
                var s;
                if (null == n) return t;
                return null != e.meridiemHour ? e.meridiemHour(t, n) : null != e.isPM ? ((s = e.isPM(n)) && t < 12 && (t += 12), s || 12 !== t || (t = 0), t) : t
            }(e._locale, e._a[ge], e._meridiem), ct(e), dt(e)
        } else Dt(e); else vt(e)
    }

    function Yt(e) {
        var t, l, h, _, g = e._i, w = e._f;
        return e._locale = e._locale || lt(e._l), null === g || void 0 === w && "" === g ? m({nullInput: !0}) : ("string" == typeof g && (e._i = g = e._locale.preparse(g)), v(g) ? new p(dt(g)) : (o(g) ? e._d = g : s(w) ? function (e) {
            var t, n, s, i, r;
            if (0 === e._f.length) return c(e).invalidFormat = !0, void (e._d = new Date(NaN));
            for (i = 0; i < e._f.length; i++) r = 0, t = y({}, e), null != e._useUTC && (t._useUTC = e._useUTC), t._f = e._f[i], kt(t), f(t) && (r += c(t).charsLeftOver, r += 10 * c(t).unusedTokens.length, c(t).score = r, (null == s || r < s) && (s = r, n = t));
            d(e, n || t)
        }(e) : w ? kt(e) : r(l = (t = e)._i) ? t._d = new Date(n.now()) : o(l) ? t._d = new Date(l.valueOf()) : "string" == typeof l ? (h = t, null === (_ = pt.exec(h._i)) ? (vt(h), !1 === h._isValid && (delete h._isValid, Dt(h), !1 === h._isValid && (delete h._isValid, n.createFromInputFallback(h)))) : h._d = new Date(+_[1])) : s(l) ? (t._a = u(l.slice(0), function (e) {
            return parseInt(e, 10)
        }), ct(t)) : i(l) ? function (e) {
            if (!e._d) {
                var t = C(e._i);
                e._a = u([t.year, t.month, t.day || t.date, t.hour, t.minute, t.second, t.millisecond], function (e) {
                    return e && parseInt(e, 10)
                }), ct(e)
            }
        }(t) : a(l) ? t._d = new Date(l) : n.createFromInputFallback(t), f(e) || (e._d = null), e))
    }

    function Ot(e, t, n, r, a) {
        var o, u = {};
        return !0 !== n && !1 !== n || (r = n, n = void 0), (i(e) && function (e) {
            if (Object.getOwnPropertyNames) return 0 === Object.getOwnPropertyNames(e).length;
            var t;
            for (t in e) if (e.hasOwnProperty(t)) return !1;
            return !0
        }(e) || s(e) && 0 === e.length) && (e = void 0), u._isAMomentObject = !0, u._useUTC = u._isUTC = a, u._l = n, u._i = e, u._f = t, u._strict = r, (o = new p(dt(Yt(u))))._nextDay && (o.add(1, "d"), o._nextDay = void 0), o
    }

    function Tt(e, t, n, s) {
        return Ot(e, t, n, s, !1)
    }

    n.createFromInputFallback = k("value provided is not in a recognized RFC2822 or ISO format. moment construction falls back to js Date(), which is not reliable across all browsers and versions. Non RFC2822/ISO date formats are discouraged and will be removed in an upcoming major release. Please refer to http://momentjs.com/guides/#/warnings/js-date/ for more info.", function (e) {
        e._d = new Date(e._i + (e._useUTC ? " UTC" : ""))
    }), n.ISO_8601 = function () {
    }, n.RFC_2822 = function () {
    };
    var xt = k("moment().min is deprecated, use moment.max instead. http://momentjs.com/guides/#/warnings/min-max/", function () {
            var e = Tt.apply(null, arguments);
            return this.isValid() && e.isValid() ? e < this ? this : e : m()
        }),
        bt = k("moment().max is deprecated, use moment.min instead. http://momentjs.com/guides/#/warnings/min-max/", function () {
            var e = Tt.apply(null, arguments);
            return this.isValid() && e.isValid() ? e > this ? this : e : m()
        });

    function Pt(e, t) {
        var n, i;
        if (1 === t.length && s(t[0]) && (t = t[0]), !t.length) return Tt();
        for (n = t[0], i = 1; i < t.length; ++i) t[i].isValid() && !t[i][e](n) || (n = t[i]);
        return n
    }

    var Wt = ["year", "quarter", "month", "week", "day", "hour", "minute", "second", "millisecond"];

    function Ht(e) {
        var t = C(e), n = t.year || 0, s = t.quarter || 0, i = t.month || 0, r = t.week || 0, a = t.day || 0,
            o = t.hour || 0, u = t.minute || 0, l = t.second || 0, d = t.millisecond || 0;
        this._isValid = function (e) {
            for (var t in e) if (-1 === Ye.call(Wt, t) || null != e[t] && isNaN(e[t])) return !1;
            for (var n = !1, s = 0; s < Wt.length; ++s) if (e[Wt[s]]) {
                if (n) return !1;
                parseFloat(e[Wt[s]]) !== M(e[Wt[s]]) && (n = !0)
            }
            return !0
        }(t), this._milliseconds = +d + 1e3 * l + 6e4 * u + 1e3 * o * 60 * 60, this._days = +a + 7 * r, this._months = +i + 3 * s + 12 * n, this._data = {}, this._locale = lt(), this._bubble()
    }

    function Rt(e) {
        return e instanceof Ht
    }

    function Ct(e) {
        return e < 0 ? -1 * Math.round(-1 * e) : Math.round(e)
    }

    function Ft(e, t) {
        I(e, 0, 0, function () {
            var e = this.utcOffset(), n = "+";
            return e < 0 && (e = -e, n = "-"), n + U(~~(e / 60), 2) + t + U(~~e % 60, 2)
        })
    }

    Ft("Z", ":"), Ft("ZZ", ""), ue("Z", re), ue("ZZ", re), ce(["Z", "ZZ"], function (e, t, n) {
        n._useUTC = !0, n._tzm = Ut(re, e)
    });
    var Lt = /([\+\-]|\d\d)/gi;

    function Ut(e, t) {
        var n = (t || "").match(e);
        if (null === n) return null;
        var s = ((n[n.length - 1] || []) + "").match(Lt) || ["-", 0, 0], i = 60 * s[1] + M(s[2]);
        return 0 === i ? 0 : "+" === s[0] ? i : -i
    }

    function Nt(e, t) {
        var s, i;
        return t._isUTC ? (s = t.clone(), i = (v(e) || o(e) ? e.valueOf() : Tt(e).valueOf()) - s.valueOf(), s._d.setTime(s._d.valueOf() + i), n.updateOffset(s, !1), s) : Tt(e).local()
    }

    function Gt(e) {
        return 15 * -Math.round(e._d.getTimezoneOffset() / 15)
    }

    function Vt() {
        return !!this.isValid() && (this._isUTC && 0 === this._offset)
    }

    n.updateOffset = function () {
    };
    var Et = /^(\-|\+)?(?:(\d*)[. ])?(\d+)\:(\d+)(?:\:(\d+)(\.\d*)?)?$/,
        It = /^(-|\+)?P(?:([-+]?[0-9,.]*)Y)?(?:([-+]?[0-9,.]*)M)?(?:([-+]?[0-9,.]*)W)?(?:([-+]?[0-9,.]*)D)?(?:T(?:([-+]?[0-9,.]*)H)?(?:([-+]?[0-9,.]*)M)?(?:([-+]?[0-9,.]*)S)?)?$/;

    function At(e, t) {
        var n, s, i, r = e, o = null;
        return Rt(e) ? r = {
            ms: e._milliseconds,
            d: e._days,
            M: e._months
        } : a(e) ? (r = {}, t ? r[t] = e : r.milliseconds = e) : (o = Et.exec(e)) ? (n = "-" === o[1] ? -1 : 1, r = {
            y: 0,
            d: M(o[ye]) * n,
            h: M(o[ge]) * n,
            m: M(o[pe]) * n,
            s: M(o[ve]) * n,
            ms: M(Ct(1e3 * o[we])) * n
        }) : (o = It.exec(e)) ? (n = "-" === o[1] ? -1 : (o[1], 1), r = {
            y: jt(o[2], n),
            M: jt(o[3], n),
            w: jt(o[4], n),
            d: jt(o[5], n),
            h: jt(o[6], n),
            m: jt(o[7], n),
            s: jt(o[8], n)
        }) : null == r ? r = {} : "object" == typeof r && ("from" in r || "to" in r) && (i = function (e, t) {
            var n;
            if (!e.isValid() || !t.isValid()) return {milliseconds: 0, months: 0};
            t = Nt(t, e), e.isBefore(t) ? n = Zt(e, t) : ((n = Zt(t, e)).milliseconds = -n.milliseconds, n.months = -n.months);
            return n
        }(Tt(r.from), Tt(r.to)), (r = {}).ms = i.milliseconds, r.M = i.months), s = new Ht(r), Rt(e) && l(e, "_locale") && (s._locale = e._locale), s
    }

    function jt(e, t) {
        var n = e && parseFloat(e.replace(",", "."));
        return (isNaN(n) ? 0 : n) * t
    }

    function Zt(e, t) {
        var n = {milliseconds: 0, months: 0};
        return n.months = t.month() - e.month() + 12 * (t.year() - e.year()), e.clone().add(n.months, "M").isAfter(t) && --n.months, n.milliseconds = +t - +e.clone().add(n.months, "M"), n
    }

    function zt(e, t) {
        return function (n, s) {
            var i;
            return null === s || isNaN(+s) || (T(t, "moment()." + t + "(period, number) is deprecated. Please use moment()." + t + "(number, period). See http://momentjs.com/guides/#/warnings/add-inverted-param/ for more info."), i = n, n = s, s = i), $t(this, At(n = "string" == typeof n ? +n : n, s), e), this
        }
    }

    function $t(e, t, s, i) {
        var r = t._milliseconds, a = Ct(t._days), o = Ct(t._months);
        e.isValid() && (i = null == i || i, o && Ce(e, xe(e, "Month") + o * s), a && be(e, "Date", xe(e, "Date") + a * s), r && e._d.setTime(e._d.valueOf() + r * s), i && n.updateOffset(e, a || o))
    }

    At.fn = Ht.prototype, At.invalid = function () {
        return At(NaN)
    };
    var qt = zt(1, "add"), Jt = zt(-1, "subtract");

    function Bt(e, t) {
        var n = 12 * (t.year() - e.year()) + (t.month() - e.month()), s = e.clone().add(n, "months");
        return -(n + (t - s < 0 ? (t - s) / (s - e.clone().add(n - 1, "months")) : (t - s) / (e.clone().add(n + 1, "months") - s))) || 0
    }

    function Qt(e) {
        var t;
        return void 0 === e ? this._locale._abbr : (null != (t = lt(e)) && (this._locale = t), this)
    }

    n.defaultFormat = "YYYY-MM-DDTHH:mm:ssZ", n.defaultFormatUtc = "YYYY-MM-DDTHH:mm:ss[Z]";
    var Xt = k("moment().lang() is deprecated. Instead, use moment().localeData() to get the language configuration. Use moment().locale() to change languages.", function (e) {
        return void 0 === e ? this.localeData() : this.locale(e)
    });

    function Kt() {
        return this._locale
    }

    function en(e, t) {
        I(0, [e, e.length], 0, t)
    }

    function tn(e, t, n, s, i) {
        var r;
        return null == e ? Ie(this, s, i).year : (t > (r = Ae(e, s, i)) && (t = r), function (e, t, n, s, i) {
            var r = Ee(e, t, n, s, i), a = Ge(r.year, 0, r.dayOfYear);
            return this.year(a.getUTCFullYear()), this.month(a.getUTCMonth()), this.date(a.getUTCDate()), this
        }.call(this, e, t, n, s, i))
    }

    I(0, ["gg", 2], 0, function () {
        return this.weekYear() % 100
    }), I(0, ["GG", 2], 0, function () {
        return this.isoWeekYear() % 100
    }), en("gggg", "weekYear"), en("ggggg", "weekYear"), en("GGGG", "isoWeekYear"), en("GGGGG", "isoWeekYear"), H("weekYear", "gg"), H("isoWeekYear", "GG"), L("weekYear", 1), L("isoWeekYear", 1), ue("G", se), ue("g", se), ue("GG", B, z), ue("gg", B, z), ue("GGGG", ee, q), ue("gggg", ee, q), ue("GGGGG", te, J), ue("ggggg", te, J), fe(["gggg", "ggggg", "GGGG", "GGGGG"], function (e, t, n, s) {
        t[s.substr(0, 2)] = M(e)
    }), fe(["gg", "GG"], function (e, t, s, i) {
        t[i] = n.parseTwoDigitYear(e)
    }), I("Q", 0, "Qo", "quarter"), H("quarter", "Q"), L("quarter", 7), ue("Q", Z), ce("Q", function (e, t) {
        t[_e] = 3 * (M(e) - 1)
    }), I("D", ["DD", 2], "Do", "date"), H("date", "D"), L("date", 9), ue("D", B), ue("DD", B, z), ue("Do", function (e, t) {
        return e ? t._dayOfMonthOrdinalParse || t._ordinalParse : t._dayOfMonthOrdinalParseLenient
    }), ce(["D", "DD"], ye), ce("Do", function (e, t) {
        t[ye] = M(e.match(B)[0])
    });
    var nn = Te("Date", !0);
    I("DDD", ["DDDD", 3], "DDDo", "dayOfYear"), H("dayOfYear", "DDD"), L("dayOfYear", 4), ue("DDD", K), ue("DDDD", $), ce(["DDD", "DDDD"], function (e, t, n) {
        n._dayOfYear = M(e)
    }), I("m", ["mm", 2], 0, "minute"), H("minute", "m"), L("minute", 14), ue("m", B), ue("mm", B, z), ce(["m", "mm"], pe);
    var sn = Te("Minutes", !1);
    I("s", ["ss", 2], 0, "second"), H("second", "s"), L("second", 15), ue("s", B), ue("ss", B, z), ce(["s", "ss"], ve);
    var rn, an = Te("Seconds", !1);
    for (I("S", 0, 0, function () {
        return ~~(this.millisecond() / 100)
    }), I(0, ["SS", 2], 0, function () {
        return ~~(this.millisecond() / 10)
    }), I(0, ["SSS", 3], 0, "millisecond"), I(0, ["SSSS", 4], 0, function () {
        return 10 * this.millisecond()
    }), I(0, ["SSSSS", 5], 0, function () {
        return 100 * this.millisecond()
    }), I(0, ["SSSSSS", 6], 0, function () {
        return 1e3 * this.millisecond()
    }), I(0, ["SSSSSSS", 7], 0, function () {
        return 1e4 * this.millisecond()
    }), I(0, ["SSSSSSSS", 8], 0, function () {
        return 1e5 * this.millisecond()
    }), I(0, ["SSSSSSSSS", 9], 0, function () {
        return 1e6 * this.millisecond()
    }), H("millisecond", "ms"), L("millisecond", 16), ue("S", K, Z), ue("SS", K, z), ue("SSS", K, $), rn = "SSSS"; rn.length <= 9; rn += "S") ue(rn, ne);

    function on(e, t) {
        t[we] = M(1e3 * ("0." + e))
    }

    for (rn = "S"; rn.length <= 9; rn += "S") ce(rn, on);
    var un = Te("Milliseconds", !1);
    I("z", 0, 0, "zoneAbbr"), I("zz", 0, 0, "zoneName");
    var ln = p.prototype;

    function dn(e) {
        return e
    }

    ln.add = qt, ln.calendar = function (e, t) {
        var s = e || Tt(), i = Nt(s, this).startOf("day"), r = n.calendarFormat(this, i) || "sameElse",
            a = t && (x(t[r]) ? t[r].call(this, s) : t[r]);
        return this.format(a || this.localeData().calendar(r, this, Tt(s)))
    }, ln.clone = function () {
        return new p(this)
    }, ln.diff = function (e, t, n) {
        var s, i, r;
        if (!this.isValid()) return NaN;
        if (!(s = Nt(e, this)).isValid()) return NaN;
        switch (i = 6e4 * (s.utcOffset() - this.utcOffset()), t = R(t)) {
            case"year":
                r = Bt(this, s) / 12;
                break;
            case"month":
                r = Bt(this, s);
                break;
            case"quarter":
                r = Bt(this, s) / 3;
                break;
            case"second":
                r = (this - s) / 1e3;
                break;
            case"minute":
                r = (this - s) / 6e4;
                break;
            case"hour":
                r = (this - s) / 36e5;
                break;
            case"day":
                r = (this - s - i) / 864e5;
                break;
            case"week":
                r = (this - s - i) / 6048e5;
                break;
            default:
                r = this - s
        }
        return n ? r : w(r)
    }, ln.endOf = function (e) {
        return void 0 === (e = R(e)) || "millisecond" === e ? this : ("date" === e && (e = "day"), this.startOf(e).add(1, "isoWeek" === e ? "week" : e).subtract(1, "ms"))
    }, ln.format = function (e) {
        e || (e = this.isUtc() ? n.defaultFormatUtc : n.defaultFormat);
        var t = A(this, e);
        return this.localeData().postformat(t)
    }, ln.from = function (e, t) {
        return this.isValid() && (v(e) && e.isValid() || Tt(e).isValid()) ? At({
            to: this,
            from: e
        }).locale(this.locale()).humanize(!t) : this.localeData().invalidDate()
    }, ln.fromNow = function (e) {
        return this.from(Tt(), e)
    }, ln.to = function (e, t) {
        return this.isValid() && (v(e) && e.isValid() || Tt(e).isValid()) ? At({
            from: this,
            to: e
        }).locale(this.locale()).humanize(!t) : this.localeData().invalidDate()
    }, ln.toNow = function (e) {
        return this.to(Tt(), e)
    }, ln.get = function (e) {
        return x(this[e = R(e)]) ? this[e]() : this
    }, ln.invalidAt = function () {
        return c(this).overflow
    }, ln.isAfter = function (e, t) {
        var n = v(e) ? e : Tt(e);
        return !(!this.isValid() || !n.isValid()) && ("millisecond" === (t = R(r(t) ? "millisecond" : t)) ? this.valueOf() > n.valueOf() : n.valueOf() < this.clone().startOf(t).valueOf())
    }, ln.isBefore = function (e, t) {
        var n = v(e) ? e : Tt(e);
        return !(!this.isValid() || !n.isValid()) && ("millisecond" === (t = R(r(t) ? "millisecond" : t)) ? this.valueOf() < n.valueOf() : this.clone().endOf(t).valueOf() < n.valueOf())
    }, ln.isBetween = function (e, t, n, s) {
        return ("(" === (s = s || "()")[0] ? this.isAfter(e, n) : !this.isBefore(e, n)) && (")" === s[1] ? this.isBefore(t, n) : !this.isAfter(t, n))
    }, ln.isSame = function (e, t) {
        var n, s = v(e) ? e : Tt(e);
        return !(!this.isValid() || !s.isValid()) && ("millisecond" === (t = R(t || "millisecond")) ? this.valueOf() === s.valueOf() : (n = s.valueOf(), this.clone().startOf(t).valueOf() <= n && n <= this.clone().endOf(t).valueOf()))
    }, ln.isSameOrAfter = function (e, t) {
        return this.isSame(e, t) || this.isAfter(e, t)
    }, ln.isSameOrBefore = function (e, t) {
        return this.isSame(e, t) || this.isBefore(e, t)
    }, ln.isValid = function () {
        return f(this)
    }, ln.lang = Xt, ln.locale = Qt, ln.localeData = Kt, ln.max = bt, ln.min = xt, ln.parsingFlags = function () {
        return d({}, c(this))
    }, ln.set = function (e, t) {
        if ("object" == typeof e) for (var n = function (e) {
            var t = [];
            for (var n in e) t.push({unit: n, priority: F[n]});
            return t.sort(function (e, t) {
                return e.priority - t.priority
            }), t
        }(e = C(e)), s = 0; s < n.length; s++) this[n[s].unit](e[n[s].unit]); else if (x(this[e = R(e)])) return this[e](t);
        return this
    }, ln.startOf = function (e) {
        switch (e = R(e)) {
            case"year":
                this.month(0);
            case"quarter":
            case"month":
                this.date(1);
            case"week":
            case"isoWeek":
            case"day":
            case"date":
                this.hours(0);
            case"hour":
                this.minutes(0);
            case"minute":
                this.seconds(0);
            case"second":
                this.milliseconds(0)
        }
        return "week" === e && this.weekday(0), "isoWeek" === e && this.isoWeekday(1), "quarter" === e && this.month(3 * Math.floor(this.month() / 3)), this
    }, ln.subtract = Jt, ln.toArray = function () {
        var e = this;
        return [e.year(), e.month(), e.date(), e.hour(), e.minute(), e.second(), e.millisecond()]
    }, ln.toObject = function () {
        var e = this;
        return {
            years: e.year(),
            months: e.month(),
            date: e.date(),
            hours: e.hours(),
            minutes: e.minutes(),
            seconds: e.seconds(),
            milliseconds: e.milliseconds()
        }
    }, ln.toDate = function () {
        return new Date(this.valueOf())
    }, ln.toISOString = function (e) {
        if (!this.isValid()) return null;
        var t = !0 !== e, n = t ? this.clone().utc() : this;
        return n.year() < 0 || n.year() > 9999 ? A(n, t ? "YYYYYY-MM-DD[T]HH:mm:ss.SSS[Z]" : "YYYYYY-MM-DD[T]HH:mm:ss.SSSZ") : x(Date.prototype.toISOString) ? t ? this.toDate().toISOString() : new Date(this.valueOf() + 60 * this.utcOffset() * 1e3).toISOString().replace("Z", A(n, "Z")) : A(n, t ? "YYYY-MM-DD[T]HH:mm:ss.SSS[Z]" : "YYYY-MM-DD[T]HH:mm:ss.SSSZ")
    }, ln.inspect = function () {
        if (!this.isValid()) return "moment.invalid(/* " + this._i + " */)";
        var e = "moment", t = "";
        this.isLocal() || (e = 0 === this.utcOffset() ? "moment.utc" : "moment.parseZone", t = "Z");
        var n = "[" + e + '("]', s = 0 <= this.year() && this.year() <= 9999 ? "YYYY" : "YYYYYY", i = t + '[")]';
        return this.format(n + s + "-MM-DD[T]HH:mm:ss.SSS" + i)
    }, ln.toJSON = function () {
        return this.isValid() ? this.toISOString() : null
    }, ln.toString = function () {
        return this.clone().locale("en").format("ddd MMM DD YYYY HH:mm:ss [GMT]ZZ")
    }, ln.unix = function () {
        return Math.floor(this.valueOf() / 1e3)
    }, ln.valueOf = function () {
        return this._d.valueOf() - 6e4 * (this._offset || 0)
    }, ln.creationData = function () {
        return {input: this._i, format: this._f, locale: this._locale, isUTC: this._isUTC, strict: this._strict}
    }, ln.year = Oe, ln.isLeapYear = function () {
        return ke(this.year())
    }, ln.weekYear = function (e) {
        return tn.call(this, e, this.week(), this.weekday(), this.localeData()._week.dow, this.localeData()._week.doy)
    }, ln.isoWeekYear = function (e) {
        return tn.call(this, e, this.isoWeek(), this.isoWeekday(), 1, 4)
    }, ln.quarter = ln.quarters = function (e) {
        return null == e ? Math.ceil((this.month() + 1) / 3) : this.month(3 * (e - 1) + this.month() % 3)
    }, ln.month = Fe, ln.daysInMonth = function () {
        return Pe(this.year(), this.month())
    }, ln.week = ln.weeks = function (e) {
        var t = this.localeData().week(this);
        return null == e ? t : this.add(7 * (e - t), "d")
    }, ln.isoWeek = ln.isoWeeks = function (e) {
        var t = Ie(this, 1, 4).week;
        return null == e ? t : this.add(7 * (e - t), "d")
    }, ln.weeksInYear = function () {
        var e = this.localeData()._week;
        return Ae(this.year(), e.dow, e.doy)
    }, ln.isoWeeksInYear = function () {
        return Ae(this.year(), 1, 4)
    }, ln.date = nn, ln.day = ln.days = function (e) {
        if (!this.isValid()) return null != e ? this : NaN;
        var t, n, s = this._isUTC ? this._d.getUTCDay() : this._d.getDay();
        return null != e ? (t = e, n = this.localeData(), e = "string" != typeof t ? t : isNaN(t) ? "number" == typeof (t = n.weekdaysParse(t)) ? t : null : parseInt(t, 10), this.add(e - s, "d")) : s
    }, ln.weekday = function (e) {
        if (!this.isValid()) return null != e ? this : NaN;
        var t = (this.day() + 7 - this.localeData()._week.dow) % 7;
        return null == e ? t : this.add(e - t, "d")
    }, ln.isoWeekday = function (e) {
        if (!this.isValid()) return null != e ? this : NaN;
        if (null != e) {
            var t = (n = e, s = this.localeData(), "string" == typeof n ? s.weekdaysParse(n) % 7 || 7 : isNaN(n) ? null : n);
            return this.day(this.day() % 7 ? t : t - 7)
        }
        return this.day() || 7;
        var n, s
    }, ln.dayOfYear = function (e) {
        var t = Math.round((this.clone().startOf("day") - this.clone().startOf("year")) / 864e5) + 1;
        return null == e ? t : this.add(e - t, "d")
    }, ln.hour = ln.hours = tt, ln.minute = ln.minutes = sn, ln.second = ln.seconds = an, ln.millisecond = ln.milliseconds = un, ln.utcOffset = function (e, t, s) {
        var i, r = this._offset || 0;
        if (!this.isValid()) return null != e ? this : NaN;
        if (null != e) {
            if ("string" == typeof e) {
                if (null === (e = Ut(re, e))) return this
            } else Math.abs(e) < 16 && !s && (e *= 60);
            return !this._isUTC && t && (i = Gt(this)), this._offset = e, this._isUTC = !0, null != i && this.add(i, "m"), r !== e && (!t || this._changeInProgress ? $t(this, At(e - r, "m"), 1, !1) : this._changeInProgress || (this._changeInProgress = !0, n.updateOffset(this, !0), this._changeInProgress = null)), this
        }
        return this._isUTC ? r : Gt(this)
    }, ln.utc = function (e) {
        return this.utcOffset(0, e)
    }, ln.local = function (e) {
        return this._isUTC && (this.utcOffset(0, e), this._isUTC = !1, e && this.subtract(Gt(this), "m")), this
    }, ln.parseZone = function () {
        if (null != this._tzm) this.utcOffset(this._tzm, !1, !0); else if ("string" == typeof this._i) {
            var e = Ut(ie, this._i);
            null != e ? this.utcOffset(e) : this.utcOffset(0, !0)
        }
        return this
    }, ln.hasAlignedHourOffset = function (e) {
        return !!this.isValid() && (e = e ? Tt(e).utcOffset() : 0, (this.utcOffset() - e) % 60 == 0)
    }, ln.isDST = function () {
        return this.utcOffset() > this.clone().month(0).utcOffset() || this.utcOffset() > this.clone().month(5).utcOffset()
    }, ln.isLocal = function () {
        return !!this.isValid() && !this._isUTC
    }, ln.isUtcOffset = function () {
        return !!this.isValid() && this._isUTC
    }, ln.isUtc = Vt, ln.isUTC = Vt, ln.zoneAbbr = function () {
        return this._isUTC ? "UTC" : ""
    }, ln.zoneName = function () {
        return this._isUTC ? "Coordinated Universal Time" : ""
    }, ln.dates = k("dates accessor is deprecated. Use date instead.", nn), ln.months = k("months accessor is deprecated. Use month instead", Fe), ln.years = k("years accessor is deprecated. Use year instead", Oe), ln.zone = k("moment().zone is deprecated, use moment().utcOffset instead. http://momentjs.com/guides/#/warnings/zone/", function (e, t) {
        return null != e ? ("string" != typeof e && (e = -e), this.utcOffset(e, t), this) : -this.utcOffset()
    }), ln.isDSTShifted = k("isDSTShifted is deprecated. See http://momentjs.com/guides/#/warnings/dst-shifted/ for more information", function () {
        if (!r(this._isDSTShifted)) return this._isDSTShifted;
        var e = {};
        if (y(e, this), (e = Yt(e))._a) {
            var t = e._isUTC ? h(e._a) : Tt(e._a);
            this._isDSTShifted = this.isValid() && S(e._a, t.toArray()) > 0
        } else this._isDSTShifted = !1;
        return this._isDSTShifted
    });
    var hn = P.prototype;

    function cn(e, t, n, s) {
        var i = lt(), r = h().set(s, t);
        return i[n](r, e)
    }

    function fn(e, t, n) {
        if (a(e) && (t = e, e = void 0), e = e || "", null != t) return cn(e, t, n, "month");
        var s, i = [];
        for (s = 0; s < 12; s++) i[s] = cn(e, s, n, "month");
        return i
    }

    function mn(e, t, n, s) {
        "boolean" == typeof e ? (a(t) && (n = t, t = void 0), t = t || "") : (n = t = e, e = !1, a(t) && (n = t, t = void 0), t = t || "");
        var i, r = lt(), o = e ? r._week.dow : 0;
        if (null != n) return cn(t, (n + o) % 7, s, "day");
        var u = [];
        for (i = 0; i < 7; i++) u[i] = cn(t, (i + o) % 7, s, "day");
        return u
    }

    hn.calendar = function (e, t, n) {
        var s = this._calendar[e] || this._calendar.sameElse;
        return x(s) ? s.call(t, n) : s
    }, hn.longDateFormat = function (e) {
        var t = this._longDateFormat[e], n = this._longDateFormat[e.toUpperCase()];
        return t || !n ? t : (this._longDateFormat[e] = n.replace(/MMMM|MM|DD|dddd/g, function (e) {
            return e.slice(1)
        }), this._longDateFormat[e])
    }, hn.invalidDate = function () {
        return this._invalidDate
    }, hn.ordinal = function (e) {
        return this._ordinal.replace("%d", e)
    }, hn.preparse = dn, hn.postformat = dn, hn.relativeTime = function (e, t, n, s) {
        var i = this._relativeTime[n];
        return x(i) ? i(e, t, n, s) : i.replace(/%d/i, e)
    }, hn.pastFuture = function (e, t) {
        var n = this._relativeTime[e > 0 ? "future" : "past"];
        return x(n) ? n(t) : n.replace(/%s/i, t)
    }, hn.set = function (e) {
        var t, n;
        for (n in e) x(t = e[n]) ? this[n] = t : this["_" + n] = t;
        this._config = e, this._dayOfMonthOrdinalParseLenient = new RegExp((this._dayOfMonthOrdinalParse.source || this._ordinalParse.source) + "|" + /\d{1,2}/.source)
    }, hn.months = function (e, t) {
        return e ? s(this._months) ? this._months[e.month()] : this._months[(this._months.isFormat || We).test(t) ? "format" : "standalone"][e.month()] : s(this._months) ? this._months : this._months.standalone
    }, hn.monthsShort = function (e, t) {
        return e ? s(this._monthsShort) ? this._monthsShort[e.month()] : this._monthsShort[We.test(t) ? "format" : "standalone"][e.month()] : s(this._monthsShort) ? this._monthsShort : this._monthsShort.standalone
    }, hn.monthsParse = function (e, t, n) {
        var s, i, r;
        if (this._monthsParseExact) return function (e, t, n) {
            var s, i, r, a = e.toLocaleLowerCase();
            if (!this._monthsParse) for (this._monthsParse = [], this._longMonthsParse = [], this._shortMonthsParse = [], s = 0; s < 12; ++s) r = h([2e3, s]), this._shortMonthsParse[s] = this.monthsShort(r, "").toLocaleLowerCase(), this._longMonthsParse[s] = this.months(r, "").toLocaleLowerCase();
            return n ? "MMM" === t ? -1 !== (i = Ye.call(this._shortMonthsParse, a)) ? i : null : -1 !== (i = Ye.call(this._longMonthsParse, a)) ? i : null : "MMM" === t ? -1 !== (i = Ye.call(this._shortMonthsParse, a)) ? i : -1 !== (i = Ye.call(this._longMonthsParse, a)) ? i : null : -1 !== (i = Ye.call(this._longMonthsParse, a)) ? i : -1 !== (i = Ye.call(this._shortMonthsParse, a)) ? i : null
        }.call(this, e, t, n);
        for (this._monthsParse || (this._monthsParse = [], this._longMonthsParse = [], this._shortMonthsParse = []), s = 0; s < 12; s++) {
            if (i = h([2e3, s]), n && !this._longMonthsParse[s] && (this._longMonthsParse[s] = new RegExp("^" + this.months(i, "").replace(".", "") + "$", "i"), this._shortMonthsParse[s] = new RegExp("^" + this.monthsShort(i, "").replace(".", "") + "$", "i")), n || this._monthsParse[s] || (r = "^" + this.months(i, "") + "|^" + this.monthsShort(i, ""), this._monthsParse[s] = new RegExp(r.replace(".", ""), "i")), n && "MMMM" === t && this._longMonthsParse[s].test(e)) return s;
            if (n && "MMM" === t && this._shortMonthsParse[s].test(e)) return s;
            if (!n && this._monthsParse[s].test(e)) return s
        }
    }, hn.monthsRegex = function (e) {
        return this._monthsParseExact ? (l(this, "_monthsRegex") || Ne.call(this), e ? this._monthsStrictRegex : this._monthsRegex) : (l(this, "_monthsRegex") || (this._monthsRegex = Ue), this._monthsStrictRegex && e ? this._monthsStrictRegex : this._monthsRegex)
    }, hn.monthsShortRegex = function (e) {
        return this._monthsParseExact ? (l(this, "_monthsRegex") || Ne.call(this), e ? this._monthsShortStrictRegex : this._monthsShortRegex) : (l(this, "_monthsShortRegex") || (this._monthsShortRegex = Le), this._monthsShortStrictRegex && e ? this._monthsShortStrictRegex : this._monthsShortRegex)
    }, hn.week = function (e) {
        return Ie(e, this._week.dow, this._week.doy).week
    }, hn.firstDayOfYear = function () {
        return this._week.doy
    }, hn.firstDayOfWeek = function () {
        return this._week.dow
    }, hn.weekdays = function (e, t) {
        return e ? s(this._weekdays) ? this._weekdays[e.day()] : this._weekdays[this._weekdays.isFormat.test(t) ? "format" : "standalone"][e.day()] : s(this._weekdays) ? this._weekdays : this._weekdays.standalone
    }, hn.weekdaysMin = function (e) {
        return e ? this._weekdaysMin[e.day()] : this._weekdaysMin
    }, hn.weekdaysShort = function (e) {
        return e ? this._weekdaysShort[e.day()] : this._weekdaysShort
    }, hn.weekdaysParse = function (e, t, n) {
        var s, i, r;
        if (this._weekdaysParseExact) return function (e, t, n) {
            var s, i, r, a = e.toLocaleLowerCase();
            if (!this._weekdaysParse) for (this._weekdaysParse = [], this._shortWeekdaysParse = [], this._minWeekdaysParse = [], s = 0; s < 7; ++s) r = h([2e3, 1]).day(s), this._minWeekdaysParse[s] = this.weekdaysMin(r, "").toLocaleLowerCase(), this._shortWeekdaysParse[s] = this.weekdaysShort(r, "").toLocaleLowerCase(), this._weekdaysParse[s] = this.weekdays(r, "").toLocaleLowerCase();
            return n ? "dddd" === t ? -1 !== (i = Ye.call(this._weekdaysParse, a)) ? i : null : "ddd" === t ? -1 !== (i = Ye.call(this._shortWeekdaysParse, a)) ? i : null : -1 !== (i = Ye.call(this._minWeekdaysParse, a)) ? i : null : "dddd" === t ? -1 !== (i = Ye.call(this._weekdaysParse, a)) ? i : -1 !== (i = Ye.call(this._shortWeekdaysParse, a)) ? i : -1 !== (i = Ye.call(this._minWeekdaysParse, a)) ? i : null : "ddd" === t ? -1 !== (i = Ye.call(this._shortWeekdaysParse, a)) ? i : -1 !== (i = Ye.call(this._weekdaysParse, a)) ? i : -1 !== (i = Ye.call(this._minWeekdaysParse, a)) ? i : null : -1 !== (i = Ye.call(this._minWeekdaysParse, a)) ? i : -1 !== (i = Ye.call(this._weekdaysParse, a)) ? i : -1 !== (i = Ye.call(this._shortWeekdaysParse, a)) ? i : null
        }.call(this, e, t, n);
        for (this._weekdaysParse || (this._weekdaysParse = [], this._minWeekdaysParse = [], this._shortWeekdaysParse = [], this._fullWeekdaysParse = []), s = 0; s < 7; s++) {
            if (i = h([2e3, 1]).day(s), n && !this._fullWeekdaysParse[s] && (this._fullWeekdaysParse[s] = new RegExp("^" + this.weekdays(i, "").replace(".", ".?") + "$", "i"), this._shortWeekdaysParse[s] = new RegExp("^" + this.weekdaysShort(i, "").replace(".", ".?") + "$", "i"), this._minWeekdaysParse[s] = new RegExp("^" + this.weekdaysMin(i, "").replace(".", ".?") + "$", "i")), this._weekdaysParse[s] || (r = "^" + this.weekdays(i, "") + "|^" + this.weekdaysShort(i, "") + "|^" + this.weekdaysMin(i, ""), this._weekdaysParse[s] = new RegExp(r.replace(".", ""), "i")), n && "dddd" === t && this._fullWeekdaysParse[s].test(e)) return s;
            if (n && "ddd" === t && this._shortWeekdaysParse[s].test(e)) return s;
            if (n && "dd" === t && this._minWeekdaysParse[s].test(e)) return s;
            if (!n && this._weekdaysParse[s].test(e)) return s
        }
    }, hn.weekdaysRegex = function (e) {
        return this._weekdaysParseExact ? (l(this, "_weekdaysRegex") || Be.call(this), e ? this._weekdaysStrictRegex : this._weekdaysRegex) : (l(this, "_weekdaysRegex") || (this._weekdaysRegex = $e), this._weekdaysStrictRegex && e ? this._weekdaysStrictRegex : this._weekdaysRegex)
    }, hn.weekdaysShortRegex = function (e) {
        return this._weekdaysParseExact ? (l(this, "_weekdaysRegex") || Be.call(this), e ? this._weekdaysShortStrictRegex : this._weekdaysShortRegex) : (l(this, "_weekdaysShortRegex") || (this._weekdaysShortRegex = qe), this._weekdaysShortStrictRegex && e ? this._weekdaysShortStrictRegex : this._weekdaysShortRegex)
    }, hn.weekdaysMinRegex = function (e) {
        return this._weekdaysParseExact ? (l(this, "_weekdaysRegex") || Be.call(this), e ? this._weekdaysMinStrictRegex : this._weekdaysMinRegex) : (l(this, "_weekdaysMinRegex") || (this._weekdaysMinRegex = Je), this._weekdaysMinStrictRegex && e ? this._weekdaysMinStrictRegex : this._weekdaysMinRegex)
    }, hn.isPM = function (e) {
        return "p" === (e + "").toLowerCase().charAt(0)
    }, hn.meridiem = function (e, t, n) {
        return e > 11 ? n ? "pm" : "PM" : n ? "am" : "AM"
    }, ot("en", {
        dayOfMonthOrdinalParse: /\d{1,2}(th|st|nd|rd)/, ordinal: function (e) {
            var t = e % 10;
            return e + (1 === M(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th")
        }
    }), n.lang = k("moment.lang is deprecated. Use moment.locale instead.", ot), n.langData = k("moment.langData is deprecated. Use moment.localeData instead.", lt);
    var _n = Math.abs;

    function yn(e, t, n, s) {
        var i = At(t, n);
        return e._milliseconds += s * i._milliseconds, e._days += s * i._days, e._months += s * i._months, e._bubble()
    }

    function gn(e) {
        return e < 0 ? Math.floor(e) : Math.ceil(e)
    }

    function pn(e) {
        return 4800 * e / 146097
    }

    function vn(e) {
        return 146097 * e / 4800
    }

    function wn(e) {
        return function () {
            return this.as(e)
        }
    }

    var Mn = wn("ms"), Sn = wn("s"), Dn = wn("m"), kn = wn("h"), Yn = wn("d"), On = wn("w"), Tn = wn("M"), xn = wn("y");

    function bn(e) {
        return function () {
            return this.isValid() ? this._data[e] : NaN
        }
    }

    var Pn = bn("milliseconds"), Wn = bn("seconds"), Hn = bn("minutes"), Rn = bn("hours"), Cn = bn("days"),
        Fn = bn("months"), Ln = bn("years");
    var Un = Math.round, Nn = {ss: 44, s: 45, m: 45, h: 22, d: 26, M: 11};
    var Gn = Math.abs;

    function Vn(e) {
        return (e > 0) - (e < 0) || +e
    }

    function En() {
        if (!this.isValid()) return this.localeData().invalidDate();
        var e, t, n = Gn(this._milliseconds) / 1e3, s = Gn(this._days), i = Gn(this._months);
        t = w((e = w(n / 60)) / 60), n %= 60, e %= 60;
        var r = w(i / 12), a = i %= 12, o = s, u = t, l = e, d = n ? n.toFixed(3).replace(/\.?0+$/, "") : "",
            h = this.asSeconds();
        if (!h) return "P0D";
        var c = h < 0 ? "-" : "", f = Vn(this._months) !== Vn(h) ? "-" : "", m = Vn(this._days) !== Vn(h) ? "-" : "",
            _ = Vn(this._milliseconds) !== Vn(h) ? "-" : "";
        return c + "P" + (r ? f + r + "Y" : "") + (a ? f + a + "M" : "") + (o ? m + o + "D" : "") + (u || l || d ? "T" : "") + (u ? _ + u + "H" : "") + (l ? _ + l + "M" : "") + (d ? _ + d + "S" : "")
    }

    var In = Ht.prototype;
    return In.isValid = function () {
        return this._isValid
    }, In.abs = function () {
        var e = this._data;
        return this._milliseconds = _n(this._milliseconds), this._days = _n(this._days), this._months = _n(this._months), e.milliseconds = _n(e.milliseconds), e.seconds = _n(e.seconds), e.minutes = _n(e.minutes), e.hours = _n(e.hours), e.months = _n(e.months), e.years = _n(e.years), this
    }, In.add = function (e, t) {
        return yn(this, e, t, 1)
    }, In.subtract = function (e, t) {
        return yn(this, e, t, -1)
    }, In.as = function (e) {
        if (!this.isValid()) return NaN;
        var t, n, s = this._milliseconds;
        if ("month" === (e = R(e)) || "year" === e) return t = this._days + s / 864e5, n = this._months + pn(t), "month" === e ? n : n / 12;
        switch (t = this._days + Math.round(vn(this._months)), e) {
            case"week":
                return t / 7 + s / 6048e5;
            case"day":
                return t + s / 864e5;
            case"hour":
                return 24 * t + s / 36e5;
            case"minute":
                return 1440 * t + s / 6e4;
            case"second":
                return 86400 * t + s / 1e3;
            case"millisecond":
                return Math.floor(864e5 * t) + s;
            default:
                throw new Error("Unknown unit " + e)
        }
    }, In.asMilliseconds = Mn, In.asSeconds = Sn, In.asMinutes = Dn, In.asHours = kn, In.asDays = Yn, In.asWeeks = On, In.asMonths = Tn, In.asYears = xn, In.valueOf = function () {
        return this.isValid() ? this._milliseconds + 864e5 * this._days + this._months % 12 * 2592e6 + 31536e6 * M(this._months / 12) : NaN
    }, In._bubble = function () {
        var e, t, n, s, i, r = this._milliseconds, a = this._days, o = this._months, u = this._data;
        return r >= 0 && a >= 0 && o >= 0 || r <= 0 && a <= 0 && o <= 0 || (r += 864e5 * gn(vn(o) + a), a = 0, o = 0), u.milliseconds = r % 1e3, e = w(r / 1e3), u.seconds = e % 60, t = w(e / 60), u.minutes = t % 60, n = w(t / 60), u.hours = n % 24, o += i = w(pn(a += w(n / 24))), a -= gn(vn(i)), s = w(o / 12), o %= 12, u.days = a, u.months = o, u.years = s, this
    }, In.clone = function () {
        return At(this)
    }, In.get = function (e) {
        return e = R(e), this.isValid() ? this[e + "s"]() : NaN
    }, In.milliseconds = Pn, In.seconds = Wn, In.minutes = Hn, In.hours = Rn, In.days = Cn, In.weeks = function () {
        return w(this.days() / 7)
    }, In.months = Fn, In.years = Ln, In.humanize = function (e) {
        if (!this.isValid()) return this.localeData().invalidDate();
        var t, n, s, i, r, a, o, u, l, d, h, c = this.localeData(),
            f = (n = !e, s = c, i = At(t = this).abs(), r = Un(i.as("s")), a = Un(i.as("m")), o = Un(i.as("h")), u = Un(i.as("d")), l = Un(i.as("M")), d = Un(i.as("y")), (h = r <= Nn.ss && ["s", r] || r < Nn.s && ["ss", r] || a <= 1 && ["m"] || a < Nn.m && ["mm", a] || o <= 1 && ["h"] || o < Nn.h && ["hh", o] || u <= 1 && ["d"] || u < Nn.d && ["dd", u] || l <= 1 && ["M"] || l < Nn.M && ["MM", l] || d <= 1 && ["y"] || ["yy", d])[2] = n, h[3] = +t > 0, h[4] = s, function (e, t, n, s, i) {
                return i.relativeTime(t || 1, !!n, e, s)
            }.apply(null, h));
        return e && (f = c.pastFuture(+this, f)), c.postformat(f)
    }, In.toISOString = En, In.toString = En, In.toJSON = En, In.locale = Qt, In.localeData = Kt, In.toIsoString = k("toIsoString() is deprecated. Please use toISOString() instead (notice the capitals)", En), In.lang = Xt, I("X", 0, 0, "unix"), I("x", 0, 0, "valueOf"), ue("x", se), ue("X", /[+-]?\d+(\.\d{1,3})?/), ce("X", function (e, t, n) {
        n._d = new Date(1e3 * parseFloat(e, 10))
    }), ce("x", function (e, t, n) {
        n._d = new Date(M(e))
    }), n.version = "2.21.0", e = Tt, n.fn = ln, n.min = function () {
        return Pt("isBefore", [].slice.call(arguments, 0))
    }, n.max = function () {
        return Pt("isAfter", [].slice.call(arguments, 0))
    }, n.now = function () {
        return Date.now ? Date.now() : +new Date
    }, n.utc = h, n.unix = function (e) {
        return Tt(1e3 * e)
    }, n.months = function (e, t) {
        return fn(e, t, "months")
    }, n.isDate = o, n.locale = ot, n.invalid = m, n.duration = At, n.isMoment = v, n.weekdays = function (e, t, n) {
        return mn(e, t, n, "weekdays")
    }, n.parseZone = function () {
        return Tt.apply(null, arguments).parseZone()
    }, n.localeData = lt, n.isDuration = Rt, n.monthsShort = function (e, t) {
        return fn(e, t, "monthsShort")
    }, n.weekdaysMin = function (e, t, n) {
        return mn(e, t, n, "weekdaysMin")
    }, n.defineLocale = ut, n.updateLocale = function (e, t) {
        if (null != t) {
            var n, s, i = nt;
            null != (s = at(e)) && (i = s._config), (n = new P(t = b(i, t))).parentLocale = st[e], st[e] = n, ot(e)
        } else null != st[e] && (null != st[e].parentLocale ? st[e] = st[e].parentLocale : null != st[e] && delete st[e]);
        return st[e]
    }, n.locales = function () {
        return Y(st)
    }, n.weekdaysShort = function (e, t, n) {
        return mn(e, t, n, "weekdaysShort")
    }, n.normalizeUnits = R, n.relativeTimeRounding = function (e) {
        return void 0 === e ? Un : "function" == typeof e && (Un = e, !0)
    }, n.relativeTimeThreshold = function (e, t) {
        return void 0 !== Nn[e] && (void 0 === t ? Nn[e] : (Nn[e] = t, "s" === e && (Nn.ss = t - 1), !0))
    }, n.calendarFormat = function (e, t) {
        var n = e.diff(t, "days", !0);
        return n < -6 ? "sameElse" : n < -1 ? "lastWeek" : n < 0 ? "lastDay" : n < 1 ? "sameDay" : n < 2 ? "nextDay" : n < 7 ? "nextWeek" : "sameElse"
    }, n.prototype = ln, n.HTML5_FMT = {
        DATETIME_LOCAL: "YYYY-MM-DDTHH:mm",
        DATETIME_LOCAL_SECONDS: "YYYY-MM-DDTHH:mm:ss",
        DATETIME_LOCAL_MS: "YYYY-MM-DDTHH:mm:ss.SSS",
        DATE: "YYYY-MM-DD",
        TIME: "HH:mm",
        TIME_SECONDS: "HH:mm:ss",
        TIME_MS: "HH:mm:ss.SSS",
        WEEK: "YYYY-[W]WW",
        MONTH: "YYYY-MM"
    }, n
});


function setk1num(val) {
    if (val < 6) {
        $("#k1-num-6").val('');
        $("#calc-param-k1-num").val(val);
    } else {
        $("#calc-param-k1-num").val($("#k1-num-6").val());

        $("[name='k1-numr']").prop("checked", false);
    }


}


function initk1num() {
    if ($("#calc-param-k1-num").val() == '') {
        return;
    }

    if ($("#calc-param-k1-num").val() > 5) {

        $("#k1-num-6").val($("#calc-param-k1-num").val());
    } else {
        $("#k1-num" + $("#calc-param-k1-num").val()).prop('checked', true);
    }


}

(function (a) {
    var b, c = function () {
    };
    c.checkForm = function () {
        1 != b.length && a.error("Ошибка иницилизации формы")
    }, c.formstylerRefresh = function (b) {
        b && b.length || (b = a("input, select")), b.trigger("refresh")
    }, c.loadingCounter = 0, c.loading = function (b) {
        var c = a("#calc-ajax-result-blk"),
            d = a("#calc-ajax-noresult-blk");
        b ? (this.loadingCounter += 1, c.addClass("insurance-result-loading"), d.addClass("insurance-result-loading")) : (this.loadingCounter -= 1, this.loadingCounter <= 0 && (this.loadingCounter = 0, c.removeClass("insurance-result-loading"), d.removeClass("insurance-result-loading")))
    }, window.googleNotified = !1, c.ajaxResult = function (d) {
        var e = this,
            f = 200,
            g = a(".calc-ajax-result-blk"),
            h = a(".calc-ajax-noresult-blk"),
            i = a(".additional-insurance");
        e.loading(!0), a.ajax({
            type: "POST",
            url: b.attr("action"),
            data: b.serialize(),
            success: function (a) {

                if ((a.errorResult) != null) {
                    $("#errorResult").html(a.errorResult);
                    $('#ForerrorResult').show();
                    //alert(a.errorResult);


                } /* БЛОК С ОШИБКОЙ */
                else {
                    $("#forerror").html("");
                    $('#ForerrorResult').hide();
                }

                a && (g.find(".insurance-price").html(a.resultSumText), "0" != a.resultSum ? (g.slideDown(f), h.slideUp(f), i.slideDown(f), window.googleNotified || (sendRawAnalyticsEvent("calculate", "calculate"), window.googleNotified = !0)) : (g.slideUp(f), h.slideDown(f)), c.updatePresentList(a.resultSum), (link = a.url) && history.pushState(null, null, link))
                $("#calc-ajax-result-blk").removeClass("insurance-result-loading");
                if (a.resultSum != "0") {
                    /*
                        if ($("input[data-phone-field=1]").val() == '' && $("input[data-email-field=1]").val() == '') {
                            dataLayer.push({
                                'event': 'calc'
                            });


                        } else {
                            dataLayer.push({
                                'event': 'calc-lead'
                            });
                        }
*/
                    //alert(a.subtex+'sss');


                }


                if (a.komfortp != 0) {
                    $("#ogpop").html(a.ogpop_tex);
                    $("#komfortp").html(a.komfortp_tex);
                    if (g.find(".insurance-price").html().indexOf("Итого") == -1) {
                        //  g.find(".insurance-price").prepend("Итого: ");
                    }
                } else {
                    $("#ogpop").html('');
                    $("#komfortp").html('');
                }

                if (a.resultSum > 0) {
                    $('.megapolis-insurance').show();
                } else {
                    $('.megapolis-insurance').hide();
                }

                if (a.komfortp < 10000) {
                    $('#add-megapolis-block').hide();
                    $('#megahint').show();

                } else {
                    $('#add-megapolis-block').show();

                    $('#megahint').hide();
                }


                if (a.megap != 0 && a.resultSum > 0) {
                    $("#ogpop").html(a.ogpop_tex);
                    $("#megap").html(a.megap_tex);

                } else {
                    $("#megap").html('');
                }


                if (a.amorp != 0 && a.resultSum > 0) {
                    $("#ogpop").html(a.ogpop_tex);
                    $("#amorp").html(a.amorp_tex);

                } else {
                    $("#amorp").html('');
                }


                /*  if (a.subtex.length) {
                        $("#ogpop").html(a.subtex);

                        if (g.find(".insurance-price").html().indexOf("Итого") == -1) {
                            g.find(".insurance-price").prepend("Итого: ");
                        }
                    }*/


            },
            complete: function () {
                e.loading(!1)
            },
            abortOnRetry: !0
        })
    }, c.ruEnding = function (a, b, c, d) {
        var e = a % 10,
            f = 1 != Math.floor(a % 100 / 10);
        return 1 == e && f ? b : e >= 2 && 4 >= e && f || null === d ? c : d
    }, c.updatePresentList = function (b) {
        var d = 0,
            e = 300,
            f = function (a) {
                a.hide(e);
                var b = a.find("input");
                b.prop("checked") && (a.removeClass("active"), b.prop("checked", !1), c.formstylerRefresh(b))
            };
        a(".gift-checkbox label").each(function (c, g) {
            var h = a(g),
                i = !0;
            parseInt(h.data("min-sum")) > b && (f(h), i = !1);
            var j = a("#cityCode");
            if (i === !0 && j.length) {
                var k = j.val(),
                    l = h.data("city-codes");
                if (l) {
                    var m = new RegExp("(?:^|,)" + k + "(?:,|$)", "gim");
                    l.match(m) || (f(h), i = !1)
                } else f(h), i = !1
            }
            i === !0 && (h.show(e), d++)
        });
        var g = "";
        d && (g = "Для вашего полиса " + c.ruEnding(d, "доступен", "доступно", "доступно") + " " + d + "&nbsp;" + c.ruEnding(d, "подарок", "подарка", "подарков") + "."), a("#gift-count").html(g)
    }, c.initDefault = function () {
        //ogpo
        var b = this;

        a(".insurance-form-paymentb").on("click", function () {


            var c = a(this),
                d = c.closest("form"),
                e = d.serializeArray();
            return e.push({
                name: c.prop("name"),
                value: c.prop("value")
            }), b.loading(!0), a.ajax({
                type: "POST",
                url: d.attr("action"),
                data: e,
                success: function (b) {
                    a("#calc-modal .modal-content").html(b), $('#calc-modal').iziModal('open');
                },
                complete: function () {
                    b.loading(!1)
                },
                abortOnRetry: !0
            }), !1
        }), a(document).ready(function () {
            a(document).on("click", "#calc-modal button", function () {
                var b = a(this);
                if (b.data("ajax-off")) return !0;
                var c = b.closest("form"),
                    d = c.serializeArray();
                return d.push({
                    name: b.prop("name"),
                    value: b.prop("value")
                }), b.addClass("loading").prop("disabled", !0), a.ajax({
                    type: "POST",
                    url: c.attr("action"),
                    data: d,
                    success: function (a) {
                        a.redirect ? window.location.href = a.redirect : b.closest(".modal-content").html(a)
                    },
                    complete: function () {
                        b.removeClass("loading").prop("disabled", !1)
                    },
                    abortOnRetry: !0
                }), !1
            })
        }), a("#calc-modal").on("click", function (b) {
            b.target == a("#calc-modal").get(0) && a("#calc-modal .modal-hide").trigger("click")
        }), a("#calc-modal .modal-hide").on("click", function (b) {
            b.preventDefault(), a("#calc-modal, #calc-modal .modal-dialog").removeClass("active")
        }), a(".gift-checkbox input[type=radio]").on("change", function () {
            a(".gift-item").removeClass("active"), a(this).closest(".gift-item").addClass("active")
        }), a("#order-presentLater").on("change", function () {
            var b = a(this);
            b.prop("checked") ? (a(".gift-checkbox").hide(), a(".gift-checkbox-disabled").show()) : (a(".gift-checkbox").show(), a(".gift-checkbox-disabled").hide())
        }), a(document).ready(function () {
            a("#cityCode").change(function () {

                $("#sendreq").click();
                var d = a(this);
                if (d.data("ajax-off")) return !0;
                var e = d.closest("form"),
                    f = e.serialize();
                b.loading(!0), a.ajax({
                    type: "POST",
                    url: e.attr("action"),
                    data: f,
                    success: function (a) {
                        c.updatePresentList(a.resultSum)
                    },
                    complete: function () {
                        b.loading(!1)
                    },
                    abortOnRetry: !0
                })
            })
        }), a(document).ready(function () {
            var c = 300,
                d = a("#popup-calls");
            setTimeout(function () {
                d.show(c)
            }, 6e4), a("#hide-popup-calls").click(function () {
                return d.hide(c), !1
            }), a("#link-popup-calls").click(function () {
                var c = a(this);
                if (c.data("ajax-off")) return !0;
                a("#hide-popup-calls").click();
                var d = a("#product-form"),
                    e = d.serializeArray();
                return e.push({
                    name: "order[currentStepCode]",
                    value: "step2-0"
                }), b.loading(!0), a.ajax({
                    type: "POST",
                    url: d.attr("action"),
                    data: e,
                    success: function (b) {
                        b.redirect ? window.location.href = b.redirect : (a("#calc-modal .modal-content").html(b), a("#calc-modal, #calc-modal .modal-dialog").addClass("active"))
                    },
                    complete: function () {
                        b.loading(!1)
                    },
                    abortOnRetry: !0
                }), !1
            })
        }), a(document).ready(function () {
            if ("function" == typeof a.fn.mask && a("input[data-iin-field=1]").mask("999999999999"), "function" == typeof sendRawAnalyticsEvent) {
                var b = {};
                a("input[data-phone-field=1],input[data-email-field=1]").on("change", function (c) {
                    var d = a("input[data-phone-field=1]"),
                        e = a("input[data-email-field=1]"),
                        f = [];
                    d.length && d.val() && f.push(d.val()), e.length && e.val() && f.push(e.val());
                    var g = f.join("_");
                    g && void 0 == b[g] && (b[g] = 1, sendRawAnalyticsEvent("Calculate", "Fill", g))
                })
            }
        });
        var d;
        a.ajaxPrefilter(function (a, b, c) {
            a.abortOnRetry && (d && 4 != d.readyState && d.abort(), d = c)
        })


    }, a.fn.calcForm = function () {
        return b = this, c
    }, a.fn.smartKeyUp = function (b) {
        var c = null,
            d = 500;
        a(this).on("keyup", function () {
            c && clearTimeout(c);
            var a = this;
            c = setTimeout(function () {
                b.apply(a)
            }, d)
        }), a(this).on("change", function () {
            c && clearTimeout(c), b.apply(this)
        })
    }
}(jQuery),
    function (a) {
        var b, c = function () {
        };
        c.citySelectList = {}, c.oblCitySelect = function (a) {
            var b = a.prop("id").match(/calc-param-k1-region-n(\d+)/);
            b && (c.citySelectList[a.prop("id")] = a.val())
        }, c.kostanaiCity = function () {
            var d, e, f = !1;
            for (d in c.citySelectList)
                if (e = c.citySelectList[d], e.match(/kostanai-obl/g)) {
                    f = !0;
                    break
                }
            var g = a("#add-gpo-block");
            g.length && (f ? (g.hide(), g.find("input,select").prop("disabled", !0)) : (g.show(), g.find("input,select").prop("disabled", !1)))
        }, c.oblCity = function (a) {
            a.is("select") && (c.oblCitySelect(a), c.kostanaiCity())
        }, c.additionalOptions = function (a) {
            if (a.is("input[type=checkbox]")) {

                var b = a.parents(".checkbox-enhanced").find(".checkbox__description, .additional-options");//find(".additional-options");

                a.prop("checked") ? b.removeClass("calc-js-hide1") : b.addClass("calc-js-hide1");
                a.change(function () {
                        // alert(2);

                        var b = $(this).parents(".checkbox-enhanced").find(".checkbox__description, .additional-options");
                        $(this).prop("checked") ? b.removeClass("calc-js-hide") : b.addClass("calc-js-hide");

                    }
                );
            }
        }, c.calc = function (d) {
            var e = a(this);
            c.oblCity(e), c.additionalOptions(e), d !== !0 && b.calcForm().ajaxResult()
        }, c.hilitefieds = function (b, c) {


            $('input[name="order[email]"]').keyup(function () {
                if (validateEmail($(this).val())) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }

            });


            if (validateEmail($('input[name="order[email]"]').val())) {
                $('input[name="order[email]"]').closest('fieldset').addClass('has-success');
            } else {
                $('input[name="order[email]"]').closest('fieldset').removeClass('has-success');


            }


            $('.tel-masked').each(function () {

                if ($(this).val().length == 10) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }
            });
            $('.tel-masked').keyup(function () {

                if ($(this).val().length == 10) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }
            });

        }, c.initDefault = function () {


            e = $('.additional-insurance').find("input");
            c.additionalOptions(e);
            $("#sendreq").on("click", c.calc);
            a(".k1-region-params").each(function (b, d) {
                c.oblCitySelect(a(d))
            }),
                c.kostanaiCity(), /*b.find("select").on("change", c.calc), b.find("input").smartKeyUp(c.calc), c.calc(!0),*/ b.find(".insurance-form-add").on("click", function (event) {

                var b = a(this),
                    d = b.parents(".insurance-form-row").find(".row");


                if (d.hasClass("vehiclerow")) {
                    vechcount = 0;
                }


                if (d.hasClass("driverrow")) {
                    drivercount = 0;
                }

                return d.each(function (b, c) {
                    var d = a(c);


                    if (d.hasClass("vehiclerow")) {
                        vechcount++;

                        //addvehicle
                        if ($('.vehiclerow').length == vechcount) {
                            $("#addvehicle").hide();
                        }

                    }


                    if (d.hasClass("driverrow")) {
                        drivercount++;


                        if ($('.driverrow').length == drivercount) {
                            $("#adddriver").hide();
                        }

                    }


                    return d.hasClass("calc-js-hide") ? (d.removeClass("calc-js-hide"), !1) : void 0
                })/*, c.calc(), !1*/


            }), b.find(".insurance-form-del").on("click", function () {
                var d = a(this).parents(".row"),
                    e = d.find("select,input");


                if (d.hasClass("vehiclerow")) {
                    $("#addvehicle").show();
                }

                if (d.hasClass("driverrow")) {
                    $("#adddriver").show();
                }

                return e.each(function (b, d) {
                    var e = a(d);

                    e.is("input[type=checkbox]") ? e.prop("checked", !1) : e.is("input[type=radio]") ? (e.val()) : e.is("input") ? e.val(null) : e.is("select") ? (e.val(e.find("option[value=v0-empty]").length ? "v0-empty" : null), "undefined" != c.citySelectList[e.prop("id")] && (c.citySelectList[e.prop("id")] = "v0-empty", c.kostanaiCity())


                    ) : e.val(null);

                    if (e.is("select")) {
                        txt = e.find("option:selected").text();

                        e.prevAll('.field-select:first').html('<span>' + txt + '</span>');


                        e.parent('div').parent('.field-set').removeClass('has-success');
                    }

                    if (e.is("input[type=text]")) {

                        e.parent('.field-set').removeClass('has-success');
                        e.siblings('p').text(e.siblings('p').data("hint-text"));


                    }
//alert(e);

                    if (e.is("input[type=radio]") && e.val() == 'v0-empty') {
                        e.prop("checked", true);
                    } else {
                        if (e.is("input[type=radio]")) {
                            e.prop("checked", false);
                        }


                    }


                }), d.addClass("calc-js-hide") /*, c.calc(), !1*/
            })
            var ec = a(this);
            c.hilitefieds(ec, !0);

        }, a.fn.calcFormOgpo = function () {
            b = this, this.calcForm().checkForm(), this.calcForm().initDefault(), c.initDefault()
        }
    }(jQuery),
    function (a) {
        var b, c = function () {
        };
        c.checkP1P2 = function (b) {
            var c = a("#calc-param-p1-pkdt").is(":checked"),
                d = a("#calc-param-p2-ds").is(":checked"),
                e = a("#calc-param-k1-sum-pkdt").closest(".col-33");
            c ? e.removeClass("calc-js-hide") : e.addClass("calc-js-hide");
            var f = a("#calc-param-k1-sum-ds").closest(".col-33");
            d ? f.removeClass("calc-js-hide") : f.addClass("calc-js-hide");
            var g = a("#params-info-blk,#params-sum-blk");
            c || d ? g.show() : g.hide()
        }, c.setNewParam = function (a) {
            var b = a.prop("id");
            ("calc-param-p1-pkdt" == b || "calc-param-p2-ds" == b) && c.checkP1P2(a)
        }, c.calc = function (d) {
            var e = a(this);
            c.setNewParam(e), d !== !0 && b.calcForm().ajaxResult()
        }, c.initDefault = function () {

            $("#sendreq").on("click", c.calc);

            c.checkP1P2();
            $("#calc-param-p2-ds").change(function () {
                c.checkP1P2();
            });
            $("#calc-param-p1-pkdt").change(function () {
                c.checkP1P2();
            });
            /*, b.find("select").on("change", c.calc), b.find("input").smartKeyUp(c.calc), c.calc(!0)*/
        }, c.hilitefieds = function (b, c) {


            $('input[name="order[email]"]').keyup(function () {
                if (validateEmail($(this).val())) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }

            });


            if (validateEmail($('input[name="order[email]"]').val())) {
                $('input[name="order[email]"]').closest('fieldset').addClass('has-success');
            } else {
                $('input[name="order[email]"]').closest('fieldset').removeClass('has-success');


            }


            $('.tel-masked').each(function () {

                if ($(this).val().length == 10) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }
            });
            $('.tel-masked').keyup(function () {

                if ($(this).val().length == 10) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }
            });

        }, a.fn.calcFormMegapolis = function () {

            var ec = a(this);
            c.hilitefieds(ec, !0);
            b = this, this.calcForm().checkForm(), this.calcForm().initDefault(), c.initDefault()
        }
    }(jQuery),
    function (a) {
        var b, c = function () {
        };
        c.calc = function (c) {
            a(this);
            c !== !0 && b.calcForm().ajaxResult()
        }, c.initDefault = function () {

            $("#sendreq").on("click", c.calc);
            /*b.find("select").on("change", c.calc), b.find("input").smartKeyUp(c.calc), c.calc(!0)*/
        }, c.hilitefieds = function (b, c) {


            $('input[name="order[email]"]').keyup(function () {
                if (validateEmail($(this).val())) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }

            });


            if (validateEmail($('input[name="order[email]"]').val())) {
                $('input[name="order[email]"]').closest('fieldset').addClass('has-success');
            } else {
                $('input[name="order[email]"]').closest('fieldset').removeClass('has-success');


            }


            $('.tel-masked').each(function () {

                if ($(this).val().length == 10) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }
            });
            $('.tel-masked').keyup(function () {

                if ($(this).val().length == 10) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }
            });

        }, a.fn.calcFormTumar = function () {
            var ec = a(this);
            c.hilitefieds(ec, !0);
            b = this, this.calcForm().checkForm(), this.calcForm().initDefault(), c.initDefault()
        }
    }(jQuery),
    function (a) {
        var b, c = function () {
        };
        c.paymentNum = function () {
            var c = a("#p1-person-typev1-individual").is(':checked'),
                d = a("#calc-param-k14-payment-num"),
                e = d.val();
            //alert(c);
            if (c) {
                $("#k14-payment-numv2-2, #k14-payment-numv3-3,  #k14-payment-numv4-4").prop("disabled", false);
                $("#k14-payment-numv2-2, #k14-payment-numv3-3,  #k14-payment-numv4-4").prop("checked", false);


            } else {
                $("#k14-payment-numv1-1").prop("checked", true);
                $("#k14-payment-numv2-2, #k14-payment-numv3-3,  #k14-payment-numv4-4").prop("disabled", true);
            }

            //!c || "v2-2" != e && "v3-3" != e && "v4-4" != e || d.val("v1-1"), d.find("option[value=v2-2]").prop("disabled", c), d.find("option[value=v3-3]").prop("disabled", c), d.find("option[value=v4-4]").prop("disabled", c), b.calcForm().formstylerRefresh(d)
        }, c.franchiseWithoutDocUdp = function () {
            var c = a("#k10-without-doc-udpv1-under-150").is(':checked');
            if (c) {
                $("#k9-franchisev1-0").prop("checked", true);
                $("#k9-franchisev2-1,#k9-franchisev3-2, #k9-franchisev4-3, #k9-franchisev5-4, #k9-franchisev6-5").prop("disabled", true);
                $("#k9-franchisev2-1,#k9-franchisev3-2, #k9-franchisev4-3, #k9-franchisev5-4, #k9-franchisev6-5").prop("checked", false);

            } else {
                $("#k9-franchisev2-1,#k9-franchisev3-2, #k9-franchisev4-3, #k9-franchisev5-4, #k9-franchisev6-5").prop("disabled", false);

            }
            /*
            var c = a("#calc-param-k9-franchise"),
                d = a("#calc-param-k10-without-doc-udp"),
                e = d.find("option[value=v1-under-150]"),
                f = c.val();
            "v0-empty" == f || "v1-0" == f ? e.prop({
                disabled: !1
            }) : ("v1-under-150" == d.val() && d.val("v0-empty"), e.prop({
                disabled: !0
            })), "v1-under-150" == d.val() ? c.val("v1-0").prop({
                disabled: !0
            }) : c.prop({
                disabled: !1
            }),*/ //b.calcForm().formstylerRefresh(c), b.calcForm().formstylerRefresh(d)
        }, c.docSpecStoWithoutWear = function () {
            var c = a("#calc-param-k12-without-wear"),
                d = a("#calc-param-k13-doc-spec-sto"),
                e = a("#calc-param-p3-year-full");
            (new Date).getFullYear() - e.val() < 7 ? (d.prop({
                disabled: !1
            }), c.prop({
                disabled: !1
            })) : (d.prop({
                checked: !1,
                disabled: "disabled"
            }), c.prop({
                checked: !1,
                disabled: "disabled"
            })), c.prop("disabled") || (c.prop("checked") ? d.prop({
                disabled: !1
            }) : d.prop({
                checked: !1,
                disabled: "disabled"
            })), b.calcForm().formstylerRefresh(c), b.calcForm().formstylerRefresh(d)
        }, c.calc = function (d) {
            var e = a(this),
                f = e.prop("id");
            "calc-param-p1-person-type" == f ? c.paymentNum() : "calc-param-k9-franchise" == f || "calc-param-k10-without-doc-udp" == f ? c.franchiseWithoutDocUdp(e) : ("calc-param-k12-without-wear" == f || "calc-param-k13-doc-spec-sto" == f || "calc-param-p3-year-full" == f) && c.docSpecStoWithoutWear(e), d !== !0 && b.calcForm().ajaxResult()
        }, c.hilitefieds = function (b, c) {


            $('input[name="order[email]"]').keyup(function () {
                if (validateEmail($(this).val())) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }

            });


            if (validateEmail($('input[name="order[email]"]').val())) {
                $('input[name="order[email]"]').closest('fieldset').addClass('has-success');
            } else {
                $('input[name="order[email]"]').closest('fieldset').removeClass('has-success');


            }


            $('.tel-masked').each(function () {

                if ($(this).val().length == 10) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }
            });
            $('.tel-masked').keyup(function () {

                if ($(this).val().length == 10) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }
            });

            if (intval($("#calc-param-p0-sum").val()) > 0) {
                $("#calc-param-p0-sum").closest('fieldset').addClass('has-success');
            } else {
                $("#calc-param-p0-sum").closest('fieldset').removeClass('has-success');
            }

            if (intval($("#calc-param-p3-year-full").val()) > 1980) {
                $("#calc-param-p3-year-full").closest('fieldset').addClass('has-success');
            } else {
                $("#calc-param-p3-year-full").closest('fieldset').removeClass('has-success');
            }

            $("#calc-param-p0-sum").keyup(function () {

                if (intval($("#calc-param-p0-sum").val()) > 0) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }
            });


            $("#calc-param-p3-year-full").keyup(function () {

                if (intval($("#calc-param-p3-year-full").val()) > 1980) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }
            });


            // alert('kas');
        }, c.initDefault = function () {
            var ec = a(this);
            c.hilitefieds(ec, !0);
            c.paymentNum(), c.franchiseWithoutDocUdp(), c.docSpecStoWithoutWear();
            /* Вызов функций при разных условиях */
            $("#sendreq").on("click", c.calc);

            $("#p1-person-typev1-individual, #p1-person-typev2-legal").change(function () {
                c.paymentNum()
            });
            $("#k10-without-doc-udpv1-under-150, #k10-without-doc-udpv2-under-500, #k10-without-doc-udpv3-full, #k10-without-doc-udpv4-no").change(function () {//#calc-param-k9-franchise
                c.franchiseWithoutDocUdp();
            });
            $("#calc-param-p3-year-full").keyup(function () {
                c.docSpecStoWithoutWear();
            });
            $("#calc-param-k12-without-wear").change(function () {
                c.docSpecStoWithoutWear();
            });


            /* $("#sendreq").click(function(){c.calc, c.paymentNum, c.franchiseWithoutDocUdp, c.docSpecStoWithoutWear});*/
            /*c.paymentNum(), c.franchiseWithoutDocUdp(), c.docSpecStoWithoutWear(), b.find("select").on("change", c.calc), b.find("input").smartKeyUp(c.calc), c.calc(!0)*/

        }, a.fn.calcFormKasko = function () {
            b = this, this.calcForm().checkForm(), this.calcForm().initDefault(), c.initDefault()
        }
    }(jQuery),
    function (a) {
        var b, c = function () {
        };
        c.calc = function (c) {
            a(this);
            c !== !0 && b.calcForm().ajaxResult()
        }, c.hilitefieds = function (b, c) {


            $('input[name="order[email]"]').keyup(function () {
                if (validateEmail($(this).val())) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }

            });


            if (validateEmail($('input[name="order[email]"]').val())) {
                $('input[name="order[email]"]').closest('fieldset').addClass('has-success');
            } else {
                $('input[name="order[email]"]').closest('fieldset').removeClass('has-success');


            }


            $('.tel-masked').each(function () {

                if ($(this).val().length == 10) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }
            });
            $('.tel-masked').keyup(function () {

                if ($(this).val().length == 10) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }
            });

        }, c.initDefault = function () {
            var ec = a(this);
            c.hilitefieds(ec, !0);
            $("#sendreq").on("click", c.calc);
            /*b.find("input").smartKeyUp(c.calc), c.calc(!0) закрыто*/
        }, a.fn.calcFormNs = function () {
            b = this, this.calcForm().checkForm(), this.calcForm().initDefault(), c.initDefault()
        }
    }(jQuery),
    function (a) {


        var b, c = function () {
        };
        c.pCount = function (b, c) {


            chefran()


            if (c === !0 || "p-countv1-single" == b.prop("id") || "p-countv2-multiple" == b.prop("id")) {


                var d = a("#calc-param-p-count"),
                    e = a("#calc-param-base-date-from").parent("div"),
                    f = a("#calc-param-base-days").parent("div"),
                    g = $("#p-countv1-single").prop('checked');
                h = $("#p-countv2-multiple").prop('checked');


                e.hide(), f.hide(), $("#rangelab").hide();
                if (g) {
                    e.show();
                    $("#rangelab").show();
                }
                if (h) {
                    f.show();
                }

            }
        }, c.baseTerritory = function (c, d) {  //alert(d); alert(c);
            if (d === !0 || (c.prop("id") && c.prop("id").match(/^calc-param-base-territory-v/))) {

                var e = a("#calc-param-base-territory-v1-schengen"),
                    f = a("#calc-param-base-territory-v2-us-ca-jp-au-nz"),
                    g = (a("#calc-param-base-territory-v3-other"), a("#calc-param-base-sum")),
                    h = $("#base-sumv1-10-000").prop("disabled", !1),
                    i = $("#base-sumv2-20-000").prop("disabled", !1),
                    j = $("#base-sumv3-30-000").prop("disabled", !1);
                //e.on('change',function(){
                /*
                		if ($("#calc-param-base-territory-v1-schengen").is(':checked'))
                {$("#blk-k4-franchise100").hide();

                $("#calc-param-k4-franchise50-styler").parent( "label" ).hide();
                $("#calc-param-k4-franchise50").prop("checked", false);
                //$("#calc-param-k4-franchise50-styler").removeClass("cheked");
                //b.calcForm().formstylerRefresh(g);
                //c.franchise();


                }
                else {

                if($("#calc-param-k3-purpose").val()=='v2-sport' || chage()){
                	$("#calc-param-k4-franchise50").prop("checked", false);
                $("#calc-param-k4-franchise50-styler").parent( "label" ).hide();
                	$("[name='order[calcData][k4-franchise100]']").val('v1-no');
                	$("#blk-k4-franchise100").show();



                }
                else {
                $("#calc-param-k4-franchise50-styler").parent( "label" ).show();
                	$("#blk-k4-franchise100").hide();

                }
                //b.calcForm().formstylerRefresh(g);
                //c.franchise();

                }

                //});
                */
                chefran()
                e.is(":checked") && (h.prop("disabled", !1), h.prop("disabled", !0), i.prop("disabled", !0), h.prop("checked", !1), i.prop("checked", !1)), f.is(":checked") && (h.prop("disabled", !0), i.prop("disabled", !0), j.prop("disabled", !0));
                var k = g.find("option:selected");
                /*
                if($("#calc-param-k3-purpose").val()=='v2-sport' || $("#calc-param-k2-age-n1")=='v5-71-80'){
                $("#calc-param-k4-franchise50-styler").parent( "label" ).hide();}*/

                k.length && k.prop("disabled") && g.val("v0-empty");
            }
        }, c.franchise = function () {

            /*for(var b=a("#calc-param-k4-franchise50-styler").parent("label"),c=a("#blk-k4-franchise100"),d=a("#calc-param-k3-purpose").val(),e=!1,f=10;f>0;f--){
            var g=a("#calc-param-k2-age-n"+f);if(g.length&&"v5-71-80"==g.val()){e=!0;break}}d&&"v2-sport"==d||e?(c.show(),b.hide()):(b.show(),c.hide())

            if ($("#calc-param-base-territory-v1-schengen").is(':checked')){b.hide();
            c.hide();
            }*/
            chefran()
        }, c.purposeValue = function (b, d) {
            if (d === !0 || "calc-param-k3-purpose" == b.prop("id")) {
                var e = a("#calc-param-k3-purpose"),
                    f = a("#calc-param-k3-sport-type-styler").parent("div"),
                    // g = a("#calc-param-k3-job-type-styler").parent("div"),
                    g = $("#k3-job-type-wraper");
                h = e.val();

                /*
                if ($("#calc-param-k3-purpose").val()=="v2-sport"){f.show()}
                else {f.hide();}
                if ($("#calc-param-base-territory-v1-schengen").is(':checked')){b.hide();
                c.hide();
                }*/
                /*"v2-sport"==h?f.show():f.hide(),*/
                "v3-job" == h ? g.show() : g.hide(), c.franchise()
            }
        }, c.age = function (b, d) {
            if (d === !0 || (b.prop("id") && b.prop("id").match(/^k2-age-n/))) {
                for (var e, f = !1, g = 10; g > 0; g--) {
                    nex = g + 1;
                    //var h = a("#calc-param-k2-age-n" + g);
                    var h = a('input[name="order[calcData][k2-age-n' + g + ']"]');
                    //   alert(g);
                    if (h.length) {

                        h.each(function () {
                            if ($(this).prop('checked')) {
                                i = $(this).val();
                            }

                        })
                        //	alert(i);
                        /*   var i = h.val(),
                        	alert(i+"dsd");*/
                        j = $("#calc-param-k2-age-n" + g + "-wraper");
                        /*j=h.closest("div")*/

                        "v0-empty" != i ? f = !0 : e = j, f ? j.show() : j.hide();

                    }
                    chefran()
                    /*
                    		if ($("#calc-param-base-territory-v1-schengen").is(':checked'))
                    {$("#blk-k4-franchise100").hide();
                    		$("[name='order[calcData][k4-franchise100]']").val('v1-no');
                    $("#calc-param-k4-franchise50-styler").parent( "label" ).hide();
                    $("#calc-param-k4-franchise50").prop("checked", false);
                    //$("#calc-param-k4-franchise50-styler").removeClass("cheked");
                    //b.calcForm().formstylerRefresh(g);
                    //c.franchise();


                    }
                    else {

                    if($("#calc-param-k3-purpose").val()=='v2-sport' || chage()){
                    	$("#calc-param-k4-franchise50").prop("checked", false);
                    $("#calc-param-k4-franchise50-styler").parent( "label" ).hide();
                    	$("#blk-k4-franchise100").show();



                    }
                    else {
                    $("#calc-param-k4-franchise50-styler").parent( "label" ).show();
                    	$("#blk-k4-franchise100").hide();

                    }
                    //b.calcForm().formstylerRefresh(g);
                    //c.franchise();

                    }*/

                }
                e && e.show(), c.franchise()
            }


        }, c.enableGpo = function (b, c) {

            if (c === !0 || (b.prop("id") && "calc-param-k6-enable-gpo" == b.prop("id"))) {
                var d = $("#fork7-gpo").parent("div");

                a("#calc-param-k6-enable-gpo").is(":checked") ? d.show() : d.hide()
            }
        }, c.hilitefieds = function (b, c) {


            var formats = ['YYYY-MM-DD'];


            $("#calc-param-base-date-from, #calc-param-base-date-to").keyup(function () {


                if (moment($("#calc-param-base-date-to").val(), formats).isValid() && moment($("#calc-param-base-date-from").val(), formats).isValid()) {
                    $(this).closest('fieldset').addClass('has-success');


                } else {
                    $(this).closest('fieldset').removeClass('has-success');


                }


            });

            $("#calc-param-base-date-from, #calc-param-base-date-to").change(function () {


                if (moment($("#calc-param-base-date-to").val(), formats).isValid() && moment($("#calc-param-base-date-from").val(), formats).isValid()) {
                    $(this).closest('fieldset').addClass('has-success');


                } else {
                    $(this).closest('fieldset').removeClass('has-success');


                }


            });

            if (moment($("#calc-param-base-date-to").val(), formats).isValid() && moment($("#calc-param-base-date-from").val(), formats).isValid()) {
                $("#calc-param-base-date-from").closest('fieldset').addClass('has-success');


            } else {
                $("#calc-param-base-date-from").closest('fieldset').removeClass('has-success');


            }


            $('input[name="order[email]"]').keyup(function () {
                if (validateEmail($(this).val())) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }

            });


            if (validateEmail($('input[name="order[email]"]').val())) {
                $('input[name="order[email]"]').closest('fieldset').addClass('has-success');
            } else {
                $('input[name="order[email]"]').closest('fieldset').removeClass('has-success');


            }


            $('.tel-masked').each(function () {

                if ($(this).val().length == 10) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }
            });
            if (c === !0 || (b.prop("type") && "tel" == b.prop("type"))) {


                if (b.val().length == 10 && (b.prop("type") && "tel" == b.prop("type"))) {
                    b.closest('fieldset').addClass('has-success');

                } else {

                    if (b.prop("type") && "tel" == b.prop("type")) {
                        b.closest('fieldset').removeClass('has-success');
                    }

                }
            }

            if (c === !0 || (b.prop("id") && "calc-param-base-days" == b.prop("id"))) {


                if ($("#p-countv2-multiple").is(":checked") && intval($("#calc-param-base-days").val()) > 0) {

                    $("#calc-param-base-days").closest('fieldset').addClass('has-success');

                } else {
                    $("#calc-param-base-days").closest('fieldset').removeClass('has-success');


                }


            }


        }, c.calc = function (ev, d) {
            /*$(".insurance-form-row-border").append('123');
            $(".insurance-form-row-border").append('321');
            return;*/
            aj = 'false'
            if (ev === undefined || ev.target === undefined) {

            } else if (ev.target.id == "sendreq") {
                aj = 'true';
            }
            var ec = a(this);
            c.pCount(ec, d), c.baseTerritory(ec, d), c.purposeValue(ec, d), c.age(ec, d), c.enableGpo(ec, d), c.hilitefieds(ec, !0);
            if (aj == 'false') {
                return;
            }
            /* if (!chvzrform()) {
                return;
            }*/
            d !== !0 && b.calcForm().ajaxResult()
        }, c.initDefault = function () {

            initvzr();
            // alert('====')
            /*,
                 c	var b = a(this)
         c.enableGpo(b);.additionalOptions(b); */

            $("#sendreq").on("click", c.calc);

            b.find("select").on("change", c.calc), b.find("input").smartKeyUp(c.calc), c.calc("!0")
        }, a.fn.calcFormVzr = function () {

            b = this, this.calcForm().checkForm(), this.calcForm().initDefault(), c.initDefault(), c.calc()
        }
    }(jQuery),
    function (a) {
        var b, c = function () {
        };
        c.calc = function (c) {
            a(this);
            c !== !0 && b.calcForm().ajaxResult()
        }  , c.hilitefieds = function (b, c) {


            $('input[name="order[email]"]').keyup(function () {
                if (validateEmail($(this).val())) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }

            });


            if (validateEmail($('input[name="order[email]"]').val())) {
                $('input[name="order[email]"]').closest('fieldset').addClass('has-success');
            } else {
                $('input[name="order[email]"]').closest('fieldset').removeClass('has-success');


            }


            $('.tel-masked').each(function () {

                if ($(this).val().length == 10) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }
            });
            $('.tel-masked').keyup(function () {

                if ($(this).val().length == 10) {
                    $(this).closest('fieldset').addClass('has-success');
                } else {
                    $(this).closest('fieldset').removeClass('has-success');
                }
            });

        }, c.initDefault = function () {

            var ec = a(this);

            $("#sendreq").on("click", c.calc);
            c.hilitefieds(ec, !0);
            /*b.find("select").on("change", c.calc), b.find("input").smartKeyUp(c.calc), c.calc(!0)*/


            emfamily = 0
            $('input[name="order[calcData][k1-family]"]').each(function () {

                    if ($(this).is(":checked")) {
                        emfamily = 1;
                    }
                }
            );


            if (emfamily == 0) {
                $("#k1-familyv0-empty").prop("checked", true);
            }


            emstom = 0
            $('input[name="order[calcData][k3-stomatology]"]').each(function () {

                    if ($(this).is(":checked")) {
                        emstom = 1;
                    }
                }
            );


            if (emstom == 0) {
                $("#k3-stomatologyv0-empty").prop("checked", true);
            }


        }, a.fn.calcFormSosCreative = function () {
            b = this, this.calcForm().checkForm(), this.calcForm().initDefault(), c.initDefault();
        }
    }(jQuery), sendRawAnalyticsEvent = function (a, b, c, d) {
    if (window.ga) {
        var e = {
            hitType: "event",
            eventCategory: a,
            eventAction: b
        };
        c && (e.eventLabel = c), d && (e.hitCallback = d), window.ga.getAll()[0].send(e)
    }
}, $(function () {
    var a = function (a, b, c, d) {
        if (ga) {
            if (a.data("analytics-waiting")) return a.data("analytics-waiting", !1), !0;
            var e = !1,
                f = 1500,
                g = function () {
                    e || (e = !0, a.is("a") ? window.location.href = a.attr("href") : a.trigger("click"))
                };
            return a.data("analytics-waiting", !0), setTimeout(g, f), sendRawAnalyticsEvent(b, c, d, g), !1
        }
        return !0
    };
    $("[data-behavior~=analytics]").on("click", function () {
        return a($(this), "buttons_behavior", $(this).data("analytics-action"))
    }), $(".bxslider .fotorama__insure-button button").on("click", function () {
        return a($(this), "buttons_behavior", "calculate_from_main", $(this).closest("form").attr("action"))
    })
}))


function chefran() {

    if (!$("#calc-param-base-territory-v1-schengen").length) {
        return;
    }

    if ($("#calc-param-base-territory-v1-schengen").is(':checked')) {
        //	alert('ch');

        $("#blk-k4-franchise100").hide();
        $("[name='order[calcData][k4-franchise100]']").val('v1-yes');
        $("#blk-k4-franchise50").hide();

        $("#calc-param-k4-franchise50").prop("checked", false);
        $("#calc-param-k4-franchise50-styler").removeClass("checked");
        $("#calc-param-k4-franchise50").val('v2-no');
        $("[name='order[calcData][k4-franchise50]']").val('v2-no');
        //$("#calc-param-k4-franchise50-styler").removeClass("cheked");
        //b.calcForm().formstylerRefresh(g);
        //c.franchise();


    } else {
        if ($("#calc-param-k4-franchise50").is(':checked')) {
            $("#calc-param-k4-franchise50").val('v1-yes');
            $("[name='order[calcData][k4-franchise50]']").val('v1-yes');
            $("[name='order[calcData][k4-franchise100]']").val('v1-yes');
        } else {
            $("#calc-param-k4-franchise50").val('v2-no');
            $("[name='order[calcData][k4-franchise50]']").val('v2-no');
            $("#calc-param-k4-franchise50-styler").removeClass("checked");
            $("[name='order[calcData][k4-franchise100]']").val('v1-yes');

        }

        if ($("#calc-param-k3-purpose").val() == 'v2-sport' || chage()) {
            $("#calc-param-k4-franchise50").prop("checked", false);
            $("#calc-param-k4-franchise50-styler").removeClass("checked");
            $("#calc-param-k4-franchise50").val('v2-no');
            $("[name='order[calcData][k4-franchise50]']").val('v2-no');
            $("#blk-k4-franchise50").hide();

            //$("#calc-param-k4-franchise50-styler").parent( "label" ).hide();
            $("#blk-k4-franchise100").show();
            $("[name='order[calcData][k4-franchise100]']").val('v1-yes');


        } else {

            //здесь нужно подумать )
            $("#blk-k4-franchise50").show();
            //$("#calc-param-k4-franchise50-styler").parent( "label" ).show();
            $("#blk-k4-franchise100").hide();
            $("[name='order[calcData][k4-franchise100]']").val('v1-yes');

        }
        //b.calcForm().formstylerRefresh(g);
        //c.franchise();

    }
    if ($("#calc-param-k3-purpose").val() == "v3-job") {
        $("#k3-job-type-wraper").show();
    }
}


$(document).ready(function () {


    $("#product-form").submit(function (event) {

        event.preventDefault();
    });
    chefran();
    initvzr();

    $('select').change(function () {
        if ($(this).find("option:selected").text() != '—') {
            $(this).parent('div').parent('.field-set').addClass('has-success');
        } else {
            $(this).parent('div').parent('.field-set').removeClass('has-success');
        }
    });

    $('select').each(function () {
        if ($(this).find("option:selected").text() != '—') {
            $(this).parent('div').parent('.field-set').addClass('has-success');
        }
    });

});


function chage() {

    if (!$("#calc-param-k2-age-n1").length) {
        return;
    }
    for (var i = 0; i < 9; i++) {
        if ($("#calc-param-k2-age-n" + i).length && $("#calc-param-k2-age-n" + i).val() == 'v5-71-80') {

            return true;
        }

    }
    return false;

}


/*function chvzrform() {
    $(".product__form__error").remove();

    errors = '';

    //

    if ($("#calc-param-p-count").val() == 'v0-empty') {
        errors = errors + getlang('Вы не указали тип поездки||Сіз сапар түрін көрсетпедіңіз||You must specify trip type') + '<br>';
    }
    range = dateDiffInDays(new Date($("#calc-param-base-date-from").val()), new Date($("#calc-param-base-date-to").val()));
    if ($("#calc-param-p-count").val() == 'v1-single' && (range < 0 || range > 366)) {
        errors = errors + getlang('Вы неверно указали количество дней (максимальный срок страхования — 366 дней)||||You must specify number of days (366 days maximum)') + '<br>';
    }
    if ($("#calc-param-p-count").val() == 'v2-multiple' && (intval($("#calc-param-base-days").val()) < 1 || intval($("#calc-param-base-days").val()) > 366)) {
        errors = errors + getlang('Вы неверно указали количество дней (максимальный срок страхования — 366 дней)||||You must specify number of days (366 days maximum)') + '<br>';
    }
    if ($("#calc-param-k3-purpose").val() == 'v0-empty') {
        errors = errors + getlang('Вы не указали цель поездки') + '<br>';
    }
    if ($("#calc-param-k3-purpose").val() == 'v2-sport' && $("#calc-param-k3-sport-type").val() == 'v0-empty') {

        {
            errors = errors + getlang('Вы не указали вид спорта||Сіз спорт түрін көрсетпедіңіз||sport is not specified') + '<br>';
        }
    }

    if ($("#calc-param-k3-purpose").val() == 'v2-job' && $("#calc-param-k3-job-type").val() == 'v0-empty') {

        {
            errors = errors + getlang("Вы не указали категорию работника||Сіз қызметкер категориясын көрсетпедіңіз||Worker's group is not specifie") + '<br>';
        }
    }

    if (!$("#calc-param-base-territory-v1-schengen").is(':checked') && !$("#calc-param-base-territory-v2-us-ca-jp-au-nz").is(':checked') && !$("#calc-param-base-territory-v3-other").is(':checked')) {
        errors = errors + getlang('Вы не указали территорию страхования||Сіз сақтандыру аумағын көрсетпедіңіз||Territorial limit is not specified') + '<br>';
    }

    if ($("#calc-param-base-sum").val() == 'v0-empty') {
        errors = errors + 'Вы не указали сумму страхования<br>';
    }

    if ($("#calc-param-k2-age-n1").val() == 'v0-empty') {
        errors = errors + getlang('Вы не указали возраст||Сіз жасыңызды көрсетпедіңіз||Age  is not specified') + '<br>';
    }


    if ($("#calc-param-k6-enable-gpo").is(':checked') && $("#calc-param-k7-gpo").val() == 'v0-empty') {
        errors = errors + getlang('Вы не указали страховую сумму добровольного страхование ГПО перед третьими лицами||||') + '<br>';
    }
    if (errors != '') {
        $("#product-form").prepend('<div class="product__form__error">' + errors + '</div>');
        $("#popup-calls").show();
        return false;
    }
    return true;

} */


function validateEmail(Email) {
    var pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

    return $.trim(Email).match(pattern) ? true : false;
}

function intval(mixed_var, base) { // Get the integer value of a variable
    //
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)

    var tmp;

    if (typeof (mixed_var) == 'string') {
        tmp = parseInt(mixed_var);
        if (isNaN(tmp)) {
            return 0;
        } else {
            return tmp.toString(base || 10);
        }
    } else if (typeof (mixed_var) == 'number') {
        return Math.floor(mixed_var);
    } else {
        return 0;
    }
}


var _MS_PER_DAY = 1000 * 60 * 60 * 24;

// a and b are javascript Date objects
function dateDiffInDays(a, b) {
    // Discard the time and time-zone information.
    var utc1 = Date.UTC(a.getFullYear(), a.getMonth(), a.getDate());
    var utc2 = Date.UTC(b.getFullYear(), b.getMonth(), b.getDate());

    return intval(Math.floor((utc2 - utc1) / _MS_PER_DAY));
}


function initvzr() {

    if (!$("#calc-param-k2-age-n1").length) {
        // return;
    }

    var e = $("#calc-param-base-territory-v1-schengen"),
        f = $("#calc-param-base-territory-v2-us-ca-jp-au-nz"),
        g = ($("#calc-param-base-territory-v3-other"), $("#calc-param-base-sum")),
        h = $("#base-sumv1-10-000").prop("disabled", !1),
        i = $("#base-sumv2-20-000").prop("disabled", !1),
        j = $("#base-sumv3-30-000").prop("disabled", !1);

    e.is(":checked") && (h.prop("disabled", !1), h.prop("disabled", !0), i.prop("disabled", !0), h.prop("checked", !1), i.prop("checked", !1)), f.is(":checked") && (h.prop("disabled", !0), i.prop("disabled", !0), j.prop("disabled", !0));
    var k = g.find("option:selected");
    /*
                if($("#calc-param-k3-purpose").val()=='v2-sport' || $("#calc-param-k2-age-n1")=='v5-71-80'){
                $("#calc-param-k4-franchise50-styler").parent( "label" ).hide();}*/

    k.length && k.prop("disabled") && g.val("v0-empty");


    if ($("#calc-param-k6-enable-gpo").is(':checked')) {
        $("#fork7-gpo").parent("div").show();


    } else {
        $("#fork7-gpo").parent("div").hide()
    }

    for (var i = 0; i < 9; i++) {
        g = i + 1;
        var h = $('input[name="order[calcData][k2-age-n' + i + ']"]');
        //  alert(g);
        if (h.length) {

            h.each(function () {
                if ($(this).prop('checked')) {
                    v = $(this).val();
                }

            })

            /*   var i = h.val(),
                        	alert(i+"dsd");*/
            j = $("#calc-param-k2-age-n" + g + "-wraper");
            /*j=h.closest("div")*/

            if (v != "v0-empty") {
                j.show();
            } else {
                j.hide();
            }


        }
    }


    $("#calc-param-base-date-from").parent("div").hide();
    $("#calc-param-base-days").parent("div").hide();
    $("#rangelab").hide();
    if ($("#p-countv1-single").prop('checked')) {
        $("#rangelab").show();
        $("#calc-param-base-date-from").parent("div").show();
        $("#calc-param-base-days").parent("div").hide();

    } else {

        if ($("#p-countv2-multiple").prop('checked')) {
            $("#calc-param-base-date-from").parent("div").hide();
            $("#calc-param-base-days").parent("div").show();
            $("#rangelab").hide();
        }

    }

}

function getlang(string) {

    rezar = string.split("||");

    var pathArray = window.location.host.toString().split('.');
    rezindex = 0;
    switch (pathArray[0]) {
        case 'dev':
        case 'www':
        case 'kommesk': // if (x === 'value1')
            rezindex = 0;
            break;


        case 'kaz':
            rezindex = 1;
            break;

        case 'eng':
            rezindex = 2;
            break;
        default:
            rezindex = 0;
            break;
    }

    if (typeof rezar[rezindex] !== "undefined" && rezar[rezindex] != '') {
        return rezar[rezindex];
    } else return rezar[0];

}

function ShowOrHide_(id) {
    var b = $("#" + id);
    var a = $("#image-" + id);
    if (b.hasClass('text_spoilern')) {
        b.removeClass('text_spoilern').addClass('text_spoilernsh');
        a.attr('src', dle_root + "templates/" + dle_skin + "/dleimages/spoiler-minus.gif");
    } else {

        b.removeClass('text_spoilernsh').addClass('text_spoilern');
        a.attr('src', dle_root + "templates/" + dle_skin + "/dleimages/spoiler-plus.gif");
    }

}





