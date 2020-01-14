Scheduler.plugin(function (e) {
    ! function () {
        window.dhtmlXTooltip = e.dhtmlXTooltip = e.tooltip = {}, dhtmlXTooltip.config = {
                className: "dhtmlXTooltip tooltip",
                timeout_to_display: 50,
                timeout_to_hide: 50,
                delta_x: 15,
                delta_y: -20
            }, dhtmlXTooltip.tooltip = document.createElement("div"), dhtmlXTooltip.tooltip.className = dhtmlXTooltip.config.className, e._waiAria.tooltipAttr(dhtmlXTooltip.tooltip), dhtmlXTooltip.show = function (t, a) {
                if (!this._mobile || e.config.touch_tooltip) {
                    var n = dhtmlXTooltip,
                        i = this.tooltip,
                        r = i.style;
                    n.tooltip.className = n.config.className;
                    var o = this.position(t),
                        _ = t.target || t.srcElement;
                    if (!this.isTooltip(_)) {
                        var d = o.x + (n.config.delta_x || 0),
                            s = o.y - (n.config.delta_y || 0);
                        r.visibility = "hidden", r.removeAttribute ? (r.removeAttribute("right"), r.removeAttribute("bottom")) : (r.removeProperty("right"), r.removeProperty("bottom")), r.left = "0", r.top = "0", e.config.rtl && (i.className += " dhtmlXTooltip_rtl"), this.tooltip.innerHTML = a, document.body.appendChild(this.tooltip);
                        var l = this.tooltip.offsetWidth,
                            c = this.tooltip.offsetHeight;
                        document.documentElement.clientWidth - d - l < 0 ? (r.removeAttribute ? r.removeAttribute("left") : r.removeProperty("left"), r.right = document.documentElement.clientWidth - d + 2 * (n.config.delta_x || 0) + "px") : r.left = d < 0 ? o.x + Math.abs(n.config.delta_x || 0) + "px" : d + "px", document.documentElement.clientHeight - s - c < 0 ? (r.removeAttribute ? r.removeAttribute("top") : r.removeProperty("top"),
                            r.bottom = document.documentElement.clientHeight - s - 2 * (n.config.delta_y || 0) + "px") : r.top = s < 0 ? o.y + Math.abs(n.config.delta_y || 0) + "px" : s + "px", e._waiAria.tooltipVisibleAttr(this.tooltip), r.visibility = "visible", this.tooltip.onmouseleave = function (t) {
                            t = t || window.event;
                            for (var a = e.dhtmlXTooltip, n = t.relatedTarget; n != e._obj && n;) n = n.parentNode;
                            n != e._obj && a.delay(a.hide, a, [], a.config.timeout_to_hide)
                        }, e.callEvent("onTooltipDisplayed", [this.tooltip, this.tooltip.event_id])
                    }
                }
            },
            dhtmlXTooltip._clearTimeout = function () {
                this.tooltip._timeout_id && window.clearTimeout(this.tooltip._timeout_id)
            }, dhtmlXTooltip.hide = function () {
                if (this.tooltip.parentNode) {
                    e._waiAria.tooltipHiddenAttr(this.tooltip);
                    var t = this.tooltip.event_id;
                    this.tooltip.event_id = null, this.tooltip.onmouseleave = null, this.tooltip.parentNode.removeChild(this.tooltip), e.callEvent("onAfterTooltip", [t])
                }
                this._clearTimeout()
            }, dhtmlXTooltip.delay = function (e, t, a, n) {
                this._clearTimeout(),
                    this.tooltip._timeout_id = setTimeout(function () {
                        var n = e.apply(t, a);
                        return e = t = a = null, n
                    }, n || this.config.timeout_to_display)
            }, dhtmlXTooltip.isTooltip = function (e) {
                for (var t = !1; e && !t;) t = e.className == this.tooltip.className, e = e.parentNode;
                return t
            }, dhtmlXTooltip.position = function (e) {
                return e = e || window.event, {
                    x: e.clientX,
                    y: e.clientY
                }
            }, e.attachEvent("onMouseMove", function (t, a) {
                var n = window.event || a,
                    i = n.target || n.srcElement,
                    r = dhtmlXTooltip,
                    o = r.isTooltip(i),
                    _ = r.isTooltipTarget && r.isTooltipTarget(i);
                if (t && e.getState().editor_id != t || o || _) {
                    var d;
                    if (t || r.tooltip.event_id) {
                        var s = e.getEvent(t) || e.getEvent(r.tooltip.event_id);
                        if (!s) return;
                        if (r.tooltip.event_id = s.id, !(d = e.templates.tooltip_text(s.start_date, s.end_date, s))) return r.hide()
                    }
                    _ && (d = "");
                    var l;
                    if (e.$env.isIE) {
                        l = {
                            pageX: void 0,
                            pageY: void 0,
                            clientX: void 0,
                            clientY: void 0,
                            target: void 0,
                            srcElement: void 0
                        };
                        for (var c in l) l[c] = n[c]
                    }
                    if (!e.callEvent("onBeforeTooltip", [t]) || !d) return;
                    r.delay(r.show, r, [l || n, d])
                } else r.delay(r.hide, r, [], r.config.timeout_to_hide)
            }), e.attachEvent("onBeforeDrag", function () {
                return dhtmlXTooltip.hide(), !0
            }), e.attachEvent("onEventDeleted", function () {
                return dhtmlXTooltip.hide(), !0
            })
    }()
});
