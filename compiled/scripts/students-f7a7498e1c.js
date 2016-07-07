function InfoBox(e) {
    e = e || {}, google.maps.OverlayView.apply(this, arguments), this.content_ = e.content || "", this.disableAutoPan_ = e.disableAutoPan || !1, this.maxWidth_ = e.maxWidth || 0, this.pixelOffset_ = e.pixelOffset || new google.maps.Size(0, 0), this.position_ = e.position || new google.maps.LatLng(0, 0), this.zIndex_ = e.zIndex || null, this.boxClass_ = e.boxClass || "infoBox", this.boxStyle_ = e.boxStyle || {}, this.closeBoxMargin_ = e.closeBoxMargin || "2px", this.closeBoxURL_ = e.closeBoxURL || "http://www.google.com/intl/en_us/mapfiles/close.gif", "" === e.closeBoxURL && (this.closeBoxURL_ = ""), this.infoBoxClearance_ = e.infoBoxClearance || new google.maps.Size(1, 1), "undefined" == typeof e.visible && ("undefined" == typeof e.isHidden ? e.visible = !0 : e.visible = !e.isHidden), this.isHidden_ = !e.visible, this.alignBottom_ = e.alignBottom || !1, this.pane_ = e.pane || "floatPane", this.enableEventPropagation_ = e.enableEventPropagation || !1, this.div_ = null, this.closeListener_ = null, this.moveListener_ = null, this.contextListener_ = null, this.eventListeners_ = null, this.fixedWidthSet_ = null
}
function MarkerClusterer(e, t, i) {
    this.extend(MarkerClusterer, google.maps.OverlayView), this.map_ = e, this.markers_ = [], this.clusters_ = [], this.sizes = [53, 56, 66, 78, 90], this.styles_ = [], this.ready_ = !1;
    var r = i || {};
    this.gridSize_ = r.gridSize || 60, this.minClusterSize_ = r.minimumClusterSize || 2, this.maxZoom_ = r.maxZoom || null, this.styles_ = r.styles || [], this.imagePath_ = r.imagePath || this.MARKER_CLUSTER_IMAGE_PATH_, this.imageExtension_ = r.imageExtension || this.MARKER_CLUSTER_IMAGE_EXTENSION_, this.zoomOnClick_ = !0, void 0 != r.zoomOnClick && (this.zoomOnClick_ = r.zoomOnClick), this.averageCenter_ = !1, void 0 != r.averageCenter && (this.averageCenter_ = r.averageCenter), this.setupStyles_(), this.setMap(e), this.prevZoom_ = this.map_.getZoom();
    var o = this;
    google.maps.event.addListener(this.map_, "zoom_changed", function () {
        var e = o.map_.getZoom();
        o.prevZoom_ != e && (o.prevZoom_ = e, o.resetViewport())
    }), google.maps.event.addListener(this.map_, "idle", function () {
        o.redraw()
    }), t && t.length && this.addMarkers(t, !1)
}
function Cluster(e) {
    this.markerClusterer_ = e, this.map_ = e.getMap(), this.gridSize_ = e.getGridSize(), this.minClusterSize_ = e.getMinClusterSize(), this.averageCenter_ = e.isAverageCenter(), this.center_ = null, this.markers_ = [], this.bounds_ = null, this.clusterIcon_ = new ClusterIcon(this, e.getStyles(), e.getGridSize())
}
function ClusterIcon(e, t, i) {
    e.getMarkerClusterer().extend(ClusterIcon, google.maps.OverlayView), this.styles_ = t, this.padding_ = i || 0, this.cluster_ = e, this.center_ = null, this.map_ = e.getMap(), this.div_ = null, this.sums_ = null, this.visible_ = !1, this.setMap(this.map_)
}
function debounce(e, t, i) {
    var r;
    return function () {
        var o = this, s = arguments;
        clearTimeout(r), r = setTimeout(function () {
            r = null, i || e.apply(o, s)
        }, t), i && !r && e.apply(o, s)
    }
}
function checkTransparent() {
    var e = !0, t = !1;
    $(document).ready(function () {
        $('nav[role="navigation"]').hasClass("navbar-transparent") && (t = !0)
    }), $(document).scroll(function () {
        t && $(window).width() > 992 && ($(this).scrollTop() > 280 ? e && (e = !1, $('nav[role="navigation"]').removeClass("navbar-transparent"), $('nav[role="navigation"]').addClass("navbar-white"), $(".brand-img").attr("src", "images/logo.svg")) : e || (e = !0, $('nav[role="navigation"]').removeClass("navbar-white"), $('nav[role="navigation"]').addClass("navbar-transparent"), $(".brand-img").attr("src", "images/logo-w.svg")))
    })
}
function initialize() {
    var e, t = [{
        featureType: "administrative",
        elementType: "labels.text.fill",
        stylers: [{color: "#444444"}]
    }, {
        featureType: "administrative.locality",
        elementType: "labels.text",
        stylers: [{visibility: "on"}]
    }, {
        featureType: "administrative.neighborhood",
        elementType: "labels.text",
        stylers: [{visibility: "off"}]
    }, {
        featureType: "landscape",
        elementType: "all",
        stylers: [{color: "#e1e1e1"}, {saturation: "0"}]
    }, {
        featureType: "poi",
        elementType: "geometry.fill",
        stylers: [{color: "#d1d1d1"}]
    }, {
        featureType: "poi.attraction",
        elementType: "geometry.fill",
        stylers: [{visibility: "off"}, {color: "#d1d1d1"}]
    }, {
        featureType: "poi.attraction",
        elementType: "labels.text",
        stylers: [{visibility: "on"}]
    }, {
        featureType: "poi.business",
        elementType: "geometry.fill",
        stylers: [{saturation: "-3"}, {lightness: "-4"}, {gamma: "4.82"}, {weight: "1.39"}, {visibility: "off"}]
    }, {
        featureType: "poi.business",
        elementType: "labels.text",
        stylers: [{visibility: "off"}]
    }, {
        featureType: "poi.business",
        elementType: "labels.icon",
        stylers: [{visibility: "off"}]
    }, {
        featureType: "poi.government",
        elementType: "geometry.fill",
        stylers: [{color: "#d1d1d1"}, {visibility: "off"}]
    }, {
        featureType: "poi.medical",
        elementType: "geometry.fill",
        stylers: [{visibility: "off"}, {color: "#d1d1d1"}]
    }, {
        featureType: "poi.park",
        elementType: "geometry.fill",
        stylers: [{visibility: "on"}, {color: "#ebebeb"}]
    }, {
        featureType: "poi.park",
        elementType: "labels",
        stylers: [{visibility: "on"}]
    }, {
        featureType: "poi.place_of_worship",
        elementType: "geometry.fill",
        stylers: [{visibility: "on"}, {color: "#d1d1d1"}]
    }, {
        featureType: "poi.school",
        elementType: "geometry.fill",
        stylers: [{color: "#d1d1d1"}, {visibility: "off"}]
    }, {
        featureType: "poi.sports_complex",
        elementType: "geometry.fill",
        stylers: [{visibility: "on"}, {color: "#d1d1d1"}]
    }, {featureType: "road", elementType: "all", stylers: [{saturation: -100}, {lightness: 45}]}, {
        featureType: "road",
        elementType: "labels.text.fill",
        stylers: [{color: "#333333"}]
    }, {
        featureType: "road.highway",
        elementType: "geometry.fill",
        stylers: [{color: "#ffffff"}, {visibility: "on"}]
    }, {
        featureType: "road.highway",
        elementType: "geometry.stroke",
        stylers: [{visibility: "off"}]
    }, {
        featureType: "road.highway",
        elementType: "labels",
        stylers: [{visibility: "off"}]
    }, {
        featureType: "road.arterial",
        elementType: "labels.icon",
        stylers: [{visibility: "off"}]
    }, {
        featureType: "road.local",
        elementType: "geometry.fill",
        stylers: [{saturation: "6"}, {hue: "#ff0000"}, {visibility: "on"}]
    }, {featureType: "transit", elementType: "all", stylers: [{visibility: "off"}]}, {
        featureType: "transit",
        elementType: "labels",
        stylers: [{visibility: "on"}]
    }, {featureType: "transit", elementType: "labels.text.fill", stylers: [{color: "#333333"}]}, {
        featureType: "water",
        elementType: "all",
        stylers: [{color: "#00667d"}, {visibility: "on"}]
    }, {featureType: "water", elementType: "geometry.fill", stylers: [{color: "#cecece"}]}, {
        featureType: "water",
        elementType: "labels.text.fill",
        stylers: [{color: "#ffffff"}]
    }, {featureType: "water", elementType: "labels.text.stroke", stylers: [{visibility: "off"}]}], i = {
        zoom: 11,
        center: new google.maps.LatLng(40.585389, -8.543274),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: !1,
        panControl: !0,
        panControlOptions: {position: google.maps.ControlPosition.TOP_RIGHT},
        zoomControl: !0,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
            position: google.maps.ControlPosition.TOP_RIGHT
        },
        scaleControl: !0,
        streetViewControl: !1,
        styles: t
    }, r = new google.maps.LatLngBounds;
    mapObject = new google.maps.Map(document.getElementById("map_students"), i);
    for (var o in markersData)markersData[o].forEach(function (t) {
        e = new google.maps.Marker({
            position: new google.maps.LatLng(t.location_latitude, t.location_longitude),
            map: mapObject,
            icon: "../images/marcador/marcador.png"
        }), r.extend(e.position), "undefined" == typeof markers[o] && (markers[o] = []), markers[o].push(e), google.maps.event.addListener(e, "click", function () {
            closeInfoBox(), getInfoBox(t).open(mapObject, this), mapObject.panTo(new google.maps.LatLng(t.location_latitude, t.location_longitude))
        })
    });
    mapObject.fitBounds(r);
    var s = [{textColor: "white", url: "../images/marcador/m1.png", height: 45, width: 44}, {
        textColor: "white",
        url: "../images/marcador/m2.png",
        height: 52,
        width: 51
    }], a = {gridSize: 50, maxZoom: 15, styles: s};
    new MarkerClusterer(mapObject, markers[o], a)
}
function closeInfoBox() {
    $("div.infoBox").remove()
}
function getInfoBox(e) {
    return new InfoBox({
        content: '<div class="marker_info none" id="marker_info"><div class="info" id="info"><img src="' + e.map_image_url + '" class="logotype" alt=""/><h2>' + e.name + "<span></span></h2><span><h4>Função</h4>" + e.funcao + "</span><span><h4>Empresa</h4>" + e.description_point + "</span><span><h4>Conclusão</h4>" + e.description_pointA + '</span><span class="arrow"></span></div></div>',
        disableAutoPan: !0,
        maxWidth: 0,
        pixelOffset: new google.maps.Size(35, -234),
        closeBoxMargin: "50px 200px",
        closeBoxURL: "",
        isHidden: !1,
        pane: "floatPane",
        enableEventPropagation: !0
    })
}
function showRegisterForm2() {
    $("#strengthBar").css("width", "0%"), $(".registerBox-2").fadeIn("fast"), $(".social").fadeOut("fast"), $(".division").fadeOut("fast"), $(".loginBox").fadeOut("fast", function () {
        $(".registerBox").fadeOut("fast"), resetForm2(), $(".login-footer").fadeOut("fast", function () {
            $(".register-footer").fadeIn("fast")
        }), $(".modal-title").html("Registar")
    }), $(".error").removeClass("alert alert-danger").html("")
}
function showRegisterForm() {
    $(".registerBox-2").fadeOut("fast"), $(".social").fadeIn("fast"), $(".division").fadeIn("fast"), $(".loginBox").fadeOut("fast", function () {
        $(".registerBox").fadeIn("fast"), resetForm1(), $(".login-footer").fadeOut("fast", function () {
            $(".register-footer").fadeIn("fast")
        }), $(".modal-title").html("Registar")
    }), $(".error").removeClass("alert alert-danger").html("")
}
function resetForm1() {
    $("#signupForm").data("formValidation").resetForm(), $("#email_signup").val(""), $("#email_signupEnd").val("")
}
function resetForm2() {
    $("#password").val(""), $("#confirmPassword").val(""), $("#nome_signupEnd").val(""), $("#utilizador_signupEnd").val(""), $("#signupFormEnd").formValidation("resetForm", !0)
}
function showLoginForm() {
    $(".social").fadeIn("fast"), $(".division").fadeIn("fast"), $(".registerBox-2").fadeOut("fast"), $("#loginModal .registerBox").fadeOut("fast", function () {
        $(".loginBox").fadeIn("fast"), $(".register-footer").fadeOut("fast", function () {
            $(".login-footer").fadeIn("fast")
        }), $(".modal-title").html("Entrar")
    }), $(".error").removeClass("alert alert-danger").html("")
}
function openLoginModal() {
    showLoginForm(), setTimeout(function () {
        $("#loginModal").modal("show")
    }, 230)
}
function openRegisterModal() {
    showRegisterForm(), setTimeout(function () {
        $("#loginModal").modal("show")
    }, 230)
}
function shakeModal() {
    $("#loginModal .modal-dialog").addClass("shake"), setTimeout(function () {
        $("#loginModal .modal-dialog").removeClass("shake")
    }, 1e3)
}
function submitLogin() {
    var e = $("#login_email").val(), t = $("#login_password").val(), i = $("#keep_connected").is(":checked") ? 1 : 0, r = "emailUtilizador=" + e + "&palavraPasseUtilizador=" + t + "&continuarLogado=" + i;
    $.ajax({
        type: "POST", url: "api/verificacoes/verificaLogin.php", data: r, success: function (e) {
            return e.startsWith("entrar") === !1 && e.startsWith("bloqueado") === !1 && e.startsWith("validado") === !1 ? ($("#loginModal").modal("toggle"), window.location.href = e, !0) : "entrar=2" == e ? (shakeModal(), $("#login_email").val(""), $(".error").addClass("alert alert-danger").html("Verifica se o email que introduziste é válido."), !0) : "entrar=3" == e ? (shakeModal(), $(".error").addClass("alert alert-info").html("Para acederes a esta página precisas de estar autenticado."), !0) : "entrar=4" == e ? (shakeModal(), $("#login_password").val(""), $(".error").addClass("alert alert-danger").html("Verifica se a palavra-passe que introduziste está correta."), !0) : "validado=0" == e ? (shakeModal(), $(".error").addClass("alert alert-info").html("Necessitas de aceder ao teu email para validar esta conta."), !0) : "bloqueado=1" == e ? (shakeModal(), $(".error").addClass("alert alert-warning").html("Esta conta encontra-se bloqueada pela administração."), !0) : "entrar=5" == e ? (shakeModal(), $(".error").addClass("alert alert-info").html("O email que introduziste não se encontra registado."), !0) : void 0
        }
    })
}
function submitSignup() {
    var e = $("#email_signup").val();
    return $("#email_signupEnd").val(e), showRegisterForm2(), !0
}
function submitSignup2() {
    var e = $("#email_signup").val(), t = "emailUtilizador=" + e;
    $.ajax({
        type: "POST", url: "api/verificacoes/verificaRegistoEmail.php", data: t, success: function (t) {
            return "registo=0" == t ? (shakeModal(), $(".error").addClass("alert alert-danger").html("O email introduzido já encontra registado."), !0) : "registo=1" == t ? ($("#email_signupEnd").val(e), showRegisterForm2(), !0) : "registo=2" == t ? (shakeModal(), $(".error").addClass("alert alert-danger").html("Verifica se o email que introduziste é válido."), !0) : "registo=3" == t ? (shakeModal(), $(".error").addClass("alert alert-info").html("Para acederes a esta página precisas de estar autenticado."), !0) : void 0
        }
    })
}
function submitRegist() {
    var e = $("#email_signupEnd").val(), t = $("#password").val(), i = $("#confirmPassword").val(), r = $("#nome_signupEnd").val(), o = $("#utilizador_signupEnd").val(), s = "emailUtilizador=" + e + "&palavraPasseUtilizador=" + t + "&confirmarPalavraPasseUtilizador=" + i + "&nomeUtilizador=" + r + "&utilizadorId=" + o;
    $.ajax({
        type: "POST", url: "api/verificacoes/verificaRegisto.php", data: s, success: function (e) {
            return "registo=0" == e ? (shakeModal(), $(".error").addClass("alert alert-danger").html("O email introduzido já encontra registado."), !0) : ("registo=1" == e && ($("#loginModal").modal("hide"), noty({
                text: "O teu registo foi concluído com <b>sucesso</b>! <br> Acede ao <b>email inserido</b> para validares a tua conta.",
                type: "success",
                layout: "topRight",
                theme: "bootstrapTheme",
                animation: {
                    open: "animated bounceInLeft",
                    close: "animated bounceOutRight",
                    easing: "swing",
                    speed: 250
                },
                timeout: 1e4
            })), "registo=3" == e ? (shakeModal(), $(".error").addClass("alert alert-danger").html("Verifica se as palavras-passes que introduziste coincidem."), !0) : "registo=4" == e ? (shakeModal(), $(".error").addClass("alert alert-danger").html("Verifica se o email introduzido é válido."), !0) : "registo=3" == e ? (shakeModal(), $(".error").addClass("alert alert-info").html("Para acederes a esta página precisas de estar autenticado."), !0) : void 0)
        }
    })
}
InfoBox.prototype = new google.maps.OverlayView, InfoBox.prototype.createInfoBoxDiv_ = function () {
    var e, t, i, r = this, o = function (e) {
        e.cancelBubble = !0, e.stopPropagation && e.stopPropagation()
    }, s = function (e) {
        e.returnValue = !1, e.preventDefault && e.preventDefault(), r.enableEventPropagation_ || o(e)
    };
    if (!this.div_) {
        if (this.div_ = document.createElement("div"), this.setBoxStyle_(), "undefined" == typeof this.content_.nodeType ? this.div_.innerHTML = this.getCloseBoxImg_() + this.content_ : (this.div_.innerHTML = this.getCloseBoxImg_(), this.div_.appendChild(this.content_)), this.getPanes()[this.pane_].appendChild(this.div_), this.addClickHandler_(), this.div_.style.width ? this.fixedWidthSet_ = !0 : 0 !== this.maxWidth_ && this.div_.offsetWidth > this.maxWidth_ ? (this.div_.style.width = this.maxWidth_, this.div_.style.overflow = "auto", this.fixedWidthSet_ = !0) : (i = this.getBoxWidths_(), this.div_.style.width = this.div_.offsetWidth - i.left - i.right + "px", this.fixedWidthSet_ = !1), this.panBox_(this.disableAutoPan_), !this.enableEventPropagation_) {
            for (this.eventListeners_ = [], t = ["mousedown", "mouseover", "mouseout", "mouseup", "click", "dblclick", "touchstart", "touchend", "touchmove"], e = 0; e < t.length; e++)this.eventListeners_.push(google.maps.event.addDomListener(this.div_, t[e], o));
            this.eventListeners_.push(google.maps.event.addDomListener(this.div_, "mouseover", function (e) {
                this.style.cursor = "default"
            }))
        }
        this.contextListener_ = google.maps.event.addDomListener(this.div_, "contextmenu", s), google.maps.event.trigger(this, "domready")
    }
}, InfoBox.prototype.getCloseBoxImg_ = function () {
    var e = "";
    return "" !== this.closeBoxURL_ && (e = "<img", e += " src='" + this.closeBoxURL_ + "'", e += " align=right", e += " style='", e += " position: relative;", e += " cursor: pointer;", e += " margin: " + this.closeBoxMargin_ + ";", e += "'>"), e
}, InfoBox.prototype.addClickHandler_ = function () {
    var e;
    "" !== this.closeBoxURL_ ? (e = this.div_.firstChild, this.closeListener_ = google.maps.event.addDomListener(e, "click", this.getCloseClickHandler_())) : this.closeListener_ = null
}, InfoBox.prototype.getCloseClickHandler_ = function () {
    var e = this;
    return function (t) {
        t.cancelBubble = !0, t.stopPropagation && t.stopPropagation(), google.maps.event.trigger(e, "closeclick"), e.close()
    }
}, InfoBox.prototype.panBox_ = function (e) {
    var t, i, r = 0, o = 0;
    if (!e && (t = this.getMap(), t instanceof google.maps.Map)) {
        t.getBounds().contains(this.position_) || t.setCenter(this.position_), i = t.getBounds();
        var s = t.getDiv(), a = s.offsetWidth, n = s.offsetHeight, l = this.pixelOffset_.width, p = this.pixelOffset_.height, d = this.div_.offsetWidth, h = this.div_.offsetHeight, u = this.infoBoxClearance_.width, c = this.infoBoxClearance_.height, g = this.getProjection().fromLatLngToContainerPixel(this.position_);
        if (g.x < -l + u ? r = g.x + l - u : g.x + d + l + u > a && (r = g.x + d + l + u - a), this.alignBottom_ ? g.y < -p + c + h ? o = g.y + p - c - h : g.y + p + c > n && (o = g.y + p + c - n) : g.y < -p + c ? o = g.y + p - c : g.y + h + p + c > n && (o = g.y + h + p + c - n), 0 !== r || 0 !== o) {
            t.getCenter();
            t.panBy(r, o)
        }
    }
}, InfoBox.prototype.setBoxStyle_ = function () {
    var e, t;
    if (this.div_) {
        this.div_.className = this.boxClass_, this.div_.style.cssText = "", t = this.boxStyle_;
        for (e in t)t.hasOwnProperty(e) && (this.div_.style[e] = t[e]);
        "undefined" != typeof this.div_.style.opacity && "" !== this.div_.style.opacity && (this.div_.style.filter = "alpha(opacity=" + 100 * this.div_.style.opacity + ")"), this.div_.style.position = "absolute", this.div_.style.visibility = "hidden", null !== this.zIndex_ && (this.div_.style.zIndex = this.zIndex_)
    }
}, InfoBox.prototype.getBoxWidths_ = function () {
    var e, t = {top: 0, bottom: 0, left: 0, right: 0}, i = this.div_;
    return document.defaultView && document.defaultView.getComputedStyle ? (e = i.ownerDocument.defaultView.getComputedStyle(i, ""), e && (t.top = parseInt(e.borderTopWidth, 10) || 0, t.bottom = parseInt(e.borderBottomWidth, 10) || 0, t.left = parseInt(e.borderLeftWidth, 10) || 0, t.right = parseInt(e.borderRightWidth, 10) || 0)) : document.documentElement.currentStyle && i.currentStyle && (t.top = parseInt(i.currentStyle.borderTopWidth, 10) || 0, t.bottom = parseInt(i.currentStyle.borderBottomWidth, 10) || 0, t.left = parseInt(i.currentStyle.borderLeftWidth, 10) || 0, t.right = parseInt(i.currentStyle.borderRightWidth, 10) || 0), t
}, InfoBox.prototype.onRemove = function () {
    this.div_ && (this.div_.parentNode.removeChild(this.div_), this.div_ = null)
}, InfoBox.prototype.draw = function () {
    this.createInfoBoxDiv_();
    var e = this.getProjection().fromLatLngToDivPixel(this.position_);
    this.div_.style.left = e.x + this.pixelOffset_.width + "px", this.alignBottom_ ? this.div_.style.bottom = -(e.y + this.pixelOffset_.height) + "px" : this.div_.style.top = e.y + this.pixelOffset_.height + "px", this.isHidden_ ? this.div_.style.visibility = "hidden" : this.div_.style.visibility = "visible"
}, InfoBox.prototype.setOptions = function (e) {
    "undefined" != typeof e.boxClass && (this.boxClass_ = e.boxClass, this.setBoxStyle_()), "undefined" != typeof e.boxStyle && (this.boxStyle_ = e.boxStyle, this.setBoxStyle_()), "undefined" != typeof e.content && this.setContent(e.content), "undefined" != typeof e.disableAutoPan && (this.disableAutoPan_ = e.disableAutoPan), "undefined" != typeof e.maxWidth && (this.maxWidth_ = e.maxWidth), "undefined" != typeof e.pixelOffset && (this.pixelOffset_ = e.pixelOffset), "undefined" != typeof e.alignBottom && (this.alignBottom_ = e.alignBottom), "undefined" != typeof e.position && this.setPosition(e.position), "undefined" != typeof e.zIndex && this.setZIndex(e.zIndex), "undefined" != typeof e.closeBoxMargin && (this.closeBoxMargin_ = e.closeBoxMargin), "undefined" != typeof e.closeBoxURL && (this.closeBoxURL_ = e.closeBoxURL), "undefined" != typeof e.infoBoxClearance && (this.infoBoxClearance_ = e.infoBoxClearance), "undefined" != typeof e.isHidden && (this.isHidden_ = e.isHidden), "undefined" != typeof e.visible && (this.isHidden_ = !e.visible), "undefined" != typeof e.enableEventPropagation && (this.enableEventPropagation_ = e.enableEventPropagation), this.div_ && this.draw()
}, InfoBox.prototype.setContent = function (e) {
    this.content_ = e, this.div_ && (this.closeListener_ && (google.maps.event.removeListener(this.closeListener_), this.closeListener_ = null), this.fixedWidthSet_ || (this.div_.style.width = ""), "undefined" == typeof e.nodeType ? this.div_.innerHTML = this.getCloseBoxImg_() + e : (this.div_.innerHTML = this.getCloseBoxImg_(), this.div_.appendChild(e)), this.fixedWidthSet_ || (this.div_.style.width = this.div_.offsetWidth + "px", "undefined" == typeof e.nodeType ? this.div_.innerHTML = this.getCloseBoxImg_() + e : (this.div_.innerHTML = this.getCloseBoxImg_(), this.div_.appendChild(e))), this.addClickHandler_()), google.maps.event.trigger(this, "content_changed")
}, InfoBox.prototype.setPosition = function (e) {
    this.position_ = e, this.div_ && this.draw(), google.maps.event.trigger(this, "position_changed")
}, InfoBox.prototype.setZIndex = function (e) {
    this.zIndex_ = e, this.div_ && (this.div_.style.zIndex = e), google.maps.event.trigger(this, "zindex_changed")
}, InfoBox.prototype.setVisible = function (e) {
    this.isHidden_ = !e, this.div_ && (this.div_.style.visibility = this.isHidden_ ? "hidden" : "visible")
}, InfoBox.prototype.getContent = function () {
    return this.content_
}, InfoBox.prototype.getPosition = function () {
    return this.position_
}, InfoBox.prototype.getZIndex = function () {
    return this.zIndex_
}, InfoBox.prototype.getVisible = function () {
    var e;
    return e = "undefined" == typeof this.getMap() || null === this.getMap() ? !1 : !this.isHidden_
}, InfoBox.prototype.show = function () {
    this.isHidden_ = !1, this.div_ && (this.div_.style.visibility = "visible")
}, InfoBox.prototype.hide = function () {
    this.isHidden_ = !0, this.div_ && (this.div_.style.visibility = "hidden")
}, InfoBox.prototype.open = function (e, t) {
    var i = this;
    t && (this.position_ = t.getPosition(), this.moveListener_ = google.maps.event.addListener(t, "position_changed", function () {
        i.setPosition(this.getPosition())
    })), this.setMap(e), this.div_ && this.panBox_()
}, InfoBox.prototype.close = function () {
    var e;
    if (this.closeListener_ && (google.maps.event.removeListener(this.closeListener_), this.closeListener_ = null), this.eventListeners_) {
        for (e = 0; e < this.eventListeners_.length; e++)google.maps.event.removeListener(this.eventListeners_[e]);
        this.eventListeners_ = null
    }
    this.moveListener_ && (google.maps.event.removeListener(this.moveListener_), this.moveListener_ = null), this.contextListener_ && (google.maps.event.removeListener(this.contextListener_), this.contextListener_ = null), this.setMap(null)
}, MarkerClusterer.prototype.MARKER_CLUSTER_IMAGE_PATH_ = "../images/m", MarkerClusterer.prototype.MARKER_CLUSTER_IMAGE_EXTENSION_ = "png", MarkerClusterer.prototype.extend = function (e, t) {
    return function (e) {
        for (var t in e.prototype)this.prototype[t] = e.prototype[t];
        return this
    }.apply(e, [t])
}, MarkerClusterer.prototype.onAdd = function () {
    this.setReady_(!0)
}, MarkerClusterer.prototype.draw = function () {
}, MarkerClusterer.prototype.setupStyles_ = function () {
    if (!this.styles_.length)for (var e, t = 0; e = this.sizes[t]; t++)this.styles_.push({
        url: this.imagePath_ + (t + 1) + "." + this.imageExtension_,
        height: e,
        width: e
    })
}, MarkerClusterer.prototype.fitMapToMarkers = function () {
    for (var e, t = this.getMarkers(), i = new google.maps.LatLngBounds, r = 0; e = t[r]; r++)i.extend(e.getPosition());
    this.map_.fitBounds(i)
}, MarkerClusterer.prototype.setStyles = function (e) {
    this.styles_ = e
}, MarkerClusterer.prototype.getStyles = function () {
    return this.styles_
}, MarkerClusterer.prototype.isZoomOnClick = function () {
    return this.zoomOnClick_
}, MarkerClusterer.prototype.isAverageCenter = function () {
    return this.averageCenter_
}, MarkerClusterer.prototype.getMarkers = function () {
    return this.markers_
}, MarkerClusterer.prototype.getTotalMarkers = function () {
    return this.markers_.length
}, MarkerClusterer.prototype.setMaxZoom = function (e) {
    this.maxZoom_ = e
}, MarkerClusterer.prototype.getMaxZoom = function () {
    return this.maxZoom_
}, MarkerClusterer.prototype.calculator_ = function (e, t) {
    for (var i = 0, r = e.length, o = r; 0 !== o;)o = parseInt(o / 10, 10), i++;
    return i = Math.min(i, t), {text: r, index: i}
}, MarkerClusterer.prototype.setCalculator = function (e) {
    this.calculator_ = e
}, MarkerClusterer.prototype.getCalculator = function () {
    return this.calculator_
}, MarkerClusterer.prototype.addMarkers = function (e, t) {
    for (var i, r = 0; i = e[r]; r++)this.pushMarkerTo_(i);
    t || this.redraw()
}, MarkerClusterer.prototype.pushMarkerTo_ = function (e) {
    if (e.isAdded = !1, e.draggable) {
        var t = this;
        google.maps.event.addListener(e, "dragend", function () {
            e.isAdded = !1, t.repaint()
        })
    }
    this.markers_.push(e)
}, MarkerClusterer.prototype.addMarker = function (e, t) {
    this.pushMarkerTo_(e), t || this.redraw()
}, MarkerClusterer.prototype.removeMarker_ = function (e) {
    var t = -1;
    if (this.markers_.indexOf)t = this.markers_.indexOf(e); else for (var i, r = 0; i = this.markers_[r]; r++)if (i == e) {
        t = r;
        break
    }
    return -1 == t ? !1 : (e.setMap(null), this.markers_.splice(t, 1), !0)
}, MarkerClusterer.prototype.removeMarker = function (e, t) {
    var i = this.removeMarker_(e);
    return !t && i ? (this.resetViewport(), this.redraw(), !0) : !1
}, MarkerClusterer.prototype.removeMarkers = function (e, t) {
    for (var i, r = !1, o = 0; i = e[o]; o++) {
        var s = this.removeMarker_(i);
        r = r || s
    }
    return !t && r ? (this.resetViewport(), this.redraw(), !0) : void 0
}, MarkerClusterer.prototype.setReady_ = function (e) {
    this.ready_ || (this.ready_ = e, this.createClusters_())
}, MarkerClusterer.prototype.getTotalClusters = function () {
    return this.clusters_.length
}, MarkerClusterer.prototype.getMap = function () {
    return this.map_
}, MarkerClusterer.prototype.setMap = function (e) {
    this.map_ = e
}, MarkerClusterer.prototype.getGridSize = function () {
    return this.gridSize_
}, MarkerClusterer.prototype.setGridSize = function (e) {
    this.gridSize_ = e
}, MarkerClusterer.prototype.getMinClusterSize = function () {
    return this.minClusterSize_
}, MarkerClusterer.prototype.setMinClusterSize = function (e) {
    this.minClusterSize_ = e
}, MarkerClusterer.prototype.getExtendedBounds = function (e) {
    var t = this.getProjection(), i = new google.maps.LatLng(e.getNorthEast().lat(), e.getNorthEast().lng()), r = new google.maps.LatLng(e.getSouthWest().lat(), e.getSouthWest().lng()), o = t.fromLatLngToDivPixel(i);
    o.x += this.gridSize_, o.y -= this.gridSize_;
    var s = t.fromLatLngToDivPixel(r);
    s.x -= this.gridSize_, s.y += this.gridSize_;
    var a = t.fromDivPixelToLatLng(o), n = t.fromDivPixelToLatLng(s);
    return e.extend(a), e.extend(n), e
}, MarkerClusterer.prototype.isMarkerInBounds_ = function (e, t) {
    return t.contains(e.getPosition())
}, MarkerClusterer.prototype.clearMarkers = function () {
    this.resetViewport(!0), this.markers_ = []
}, MarkerClusterer.prototype.resetViewport = function (e) {
    for (var t, i = 0; t = this.clusters_[i]; i++)t.remove();
    for (var r, i = 0; r = this.markers_[i]; i++)r.isAdded = !1, e && r.setMap(null);
    this.clusters_ = []
}, MarkerClusterer.prototype.repaint = function () {
    var e = this.clusters_.slice();
    this.clusters_.length = 0, this.resetViewport(), this.redraw(), window.setTimeout(function () {
        for (var t, i = 0; t = e[i]; i++)t.remove()
    }, 0)
}, MarkerClusterer.prototype.redraw = function () {
    this.createClusters_()
}, MarkerClusterer.prototype.distanceBetweenPoints_ = function (e, t) {
    if (!e || !t)return 0;
    var i = 6371, r = (t.lat() - e.lat()) * Math.PI / 180, o = (t.lng() - e.lng()) * Math.PI / 180, s = Math.sin(r / 2) * Math.sin(r / 2) + Math.cos(e.lat() * Math.PI / 180) * Math.cos(t.lat() * Math.PI / 180) * Math.sin(o / 2) * Math.sin(o / 2), a = 2 * Math.atan2(Math.sqrt(s), Math.sqrt(1 - s)), n = i * a;
    return n
}, MarkerClusterer.prototype.addToClosestCluster_ = function (e) {
    for (var t, i = 4e4, r = null, o = (e.getPosition(), 0); t = this.clusters_[o]; o++) {
        var s = t.getCenter();
        if (s) {
            var a = this.distanceBetweenPoints_(s, e.getPosition());
            i > a && (i = a, r = t)
        }
    }
    if (r && r.isMarkerInClusterBounds(e))r.addMarker(e); else {
        var t = new Cluster(this);
        t.addMarker(e), this.clusters_.push(t)
    }
}, MarkerClusterer.prototype.createClusters_ = function () {
    if (this.ready_)for (var e, t = new google.maps.LatLngBounds(this.map_.getBounds().getSouthWest(), this.map_.getBounds().getNorthEast()), i = this.getExtendedBounds(t), r = 0; e = this.markers_[r]; r++)!e.isAdded && this.isMarkerInBounds_(e, i) && this.addToClosestCluster_(e)
}, Cluster.prototype.isMarkerAlreadyAdded = function (e) {
    if (this.markers_.indexOf)return -1 != this.markers_.indexOf(e);
    for (var t, i = 0; t = this.markers_[i]; i++)if (t == e)return !0;
    return !1
}, Cluster.prototype.addMarker = function (e) {
    if (this.isMarkerAlreadyAdded(e))return !1;
    if (this.center_) {
        if (this.averageCenter_) {
            var t = this.markers_.length + 1, i = (this.center_.lat() * (t - 1) + e.getPosition().lat()) / t, r = (this.center_.lng() * (t - 1) + e.getPosition().lng()) / t;
            this.center_ = new google.maps.LatLng(i, r), this.calculateBounds_()
        }
    } else this.center_ = e.getPosition(), this.calculateBounds_();
    e.isAdded = !0, this.markers_.push(e);
    var o = this.markers_.length;
    if (o < this.minClusterSize_ && e.getMap() != this.map_ && e.setMap(this.map_), o == this.minClusterSize_)for (var s = 0; o > s; s++)this.markers_[s].setMap(null);
    return o >= this.minClusterSize_ && e.setMap(null), this.updateIcon(), !0
}, Cluster.prototype.getMarkerClusterer = function () {
    return this.markerClusterer_
}, Cluster.prototype.getBounds = function () {
    for (var e, t = new google.maps.LatLngBounds(this.center_, this.center_), i = this.getMarkers(), r = 0; e = i[r]; r++)t.extend(e.getPosition());
    return t
}, Cluster.prototype.remove = function () {
    this.clusterIcon_.remove(), this.markers_.length = 0, delete this.markers_
}, Cluster.prototype.getSize = function () {
    return this.markers_.length
}, Cluster.prototype.getMarkers = function () {
    return this.markers_
}, Cluster.prototype.getCenter = function () {
    return this.center_
}, Cluster.prototype.calculateBounds_ = function () {
    var e = new google.maps.LatLngBounds(this.center_, this.center_);
    this.bounds_ = this.markerClusterer_.getExtendedBounds(e)
}, Cluster.prototype.isMarkerInClusterBounds = function (e) {
    return this.bounds_.contains(e.getPosition())
}, Cluster.prototype.getMap = function () {
    return this.map_
}, Cluster.prototype.updateIcon = function () {
    var e = this.map_.getZoom(), t = this.markerClusterer_.getMaxZoom();
    if (t && e > t)for (var i, r = 0; i = this.markers_[r]; r++)i.setMap(this.map_); else {
        if (this.markers_.length < this.minClusterSize_)return void this.clusterIcon_.hide();
        var o = this.markerClusterer_.getStyles().length, s = this.markerClusterer_.getCalculator()(this.markers_, o);
        this.clusterIcon_.setCenter(this.center_), this.clusterIcon_.setSums(s), this.clusterIcon_.show()
    }
}, ClusterIcon.prototype.triggerClusterClick = function (e) {
    var t = this.cluster_.getMarkerClusterer();
    google.maps.event.trigger(t, "clusterclick", this.cluster_, e), t.isZoomOnClick() && this.map_.fitBounds(this.cluster_.getBounds())
}, ClusterIcon.prototype.onAdd = function () {
    if (this.div_ = document.createElement("DIV"), this.visible_) {
        var e = this.getPosFromLatLng_(this.center_);
        this.div_.style.cssText = this.createCss(e), this.div_.innerHTML = this.sums_.text
    }
    var t = this.getPanes();
    t.overlayMouseTarget.appendChild(this.div_);
    var i = this, r = !1;
    google.maps.event.addDomListener(this.div_, "click", function (e) {
        r || i.triggerClusterClick(e)
    }), google.maps.event.addDomListener(this.div_, "mousedown", function () {
        r = !1
    }), google.maps.event.addDomListener(this.div_, "mousemove", function () {
        r = !0
    })
}, ClusterIcon.prototype.getPosFromLatLng_ = function (e) {
    var t = this.getProjection().fromLatLngToDivPixel(e);
    return "object" == typeof this.iconAnchor_ && 2 === this.iconAnchor_.length ? (t.x -= this.iconAnchor_[0], t.y -= this.iconAnchor_[1]) : (t.x -= parseInt(this.width_ / 2, 10), t.y -= parseInt(this.height_ / 2, 10)), t
}, ClusterIcon.prototype.draw = function () {
    if (this.visible_) {
        var e = this.getPosFromLatLng_(this.center_);
        this.div_.style.top = e.y + "px", this.div_.style.left = e.x + "px"
    }
}, ClusterIcon.prototype.hide = function () {
    this.div_ && (this.div_.style.display = "none"), this.visible_ = !1
}, ClusterIcon.prototype.show = function () {
    if (this.div_) {
        var e = this.getPosFromLatLng_(this.center_);
        this.div_.style.cssText = this.createCss(e), this.div_.style.display = ""
    }
    this.visible_ = !0
}, ClusterIcon.prototype.remove = function () {
    this.setMap(null)
}, ClusterIcon.prototype.onRemove = function () {
    this.div_ && this.div_.parentNode && (this.hide(), this.div_.parentNode.removeChild(this.div_), this.div_ = null)
}, ClusterIcon.prototype.setSums = function (e) {
    this.sums_ = e, this.text_ = e.text, this.index_ = e.index, this.div_ && (this.div_.innerHTML = e.text), this.useStyle()
}, ClusterIcon.prototype.useStyle = function () {
    var e = Math.max(0, this.sums_.index - 1);
    e = Math.min(this.styles_.length - 1, e);
    var t = this.styles_[e];
    this.url_ = t.url, this.height_ = t.height, this.width_ = t.width, this.textColor_ = t.textColor, this.anchor_ = t.anchor, this.textSize_ = t.textSize, this.backgroundPosition_ = t.backgroundPosition, this.iconAnchor_ = t.iconAnchor
}, ClusterIcon.prototype.setCenter = function (e) {
    this.center_ = e
}, ClusterIcon.prototype.createCss = function (e) {
    var t = [];
    t.push("background-image:url(" + this.url_ + ");");
    var i = this.backgroundPosition_ ? this.backgroundPosition_ : "0 0";
    t.push("background-position:" + i + ";"), "object" == typeof this.anchor_ ? ("number" == typeof this.anchor_[0] && this.anchor_[0] > 0 && this.anchor_[0] < this.height_ ? t.push("height:" + (this.height_ - this.anchor_[0]) + "px; padding-top:" + this.anchor_[0] + "px;") : "number" == typeof this.anchor_[0] && this.anchor_[0] < 0 && -this.anchor_[0] < this.height_ ? t.push("height:" + this.height_ + "px; line-height:" + (this.height_ + this.anchor_[0]) + "px;") : t.push("height:" + this.height_ + "px; line-height:" + this.height_ + "px;"), "number" == typeof this.anchor_[1] && this.anchor_[1] > 0 && this.anchor_[1] < this.width_ ? t.push("width:" + (this.width_ - this.anchor_[1]) + "px; padding-left:" + this.anchor_[1] + "px;") : t.push("width:" + this.width_ + "px; text-align:center;")) : t.push("height:" + this.height_ + "px; line-height:" + this.height_ + "px; width:" + this.width_ + "px; text-align:center;");
    var r = this.textColor_ ? this.textColor_ : "black", o = this.textSize_ ? this.textSize_ : 11;
    return t.push("cursor:pointer; top:" + e.y + "px; left:" + e.x + "px; color:" + r + "; position:absolute; font-size:" + o + "px; font-family:Arial,sans-serif; font-weight:bold"), t.join("")
}, window.MarkerClusterer = MarkerClusterer, MarkerClusterer.prototype.addMarker = MarkerClusterer.prototype.addMarker, MarkerClusterer.prototype.addMarkers = MarkerClusterer.prototype.addMarkers, MarkerClusterer.prototype.clearMarkers = MarkerClusterer.prototype.clearMarkers, MarkerClusterer.prototype.fitMapToMarkers = MarkerClusterer.prototype.fitMapToMarkers, MarkerClusterer.prototype.getCalculator = MarkerClusterer.prototype.getCalculator, MarkerClusterer.prototype.getGridSize = MarkerClusterer.prototype.getGridSize, MarkerClusterer.prototype.getExtendedBounds = MarkerClusterer.prototype.getExtendedBounds, MarkerClusterer.prototype.getMap = MarkerClusterer.prototype.getMap, MarkerClusterer.prototype.getMarkers = MarkerClusterer.prototype.getMarkers, MarkerClusterer.prototype.getMaxZoom = MarkerClusterer.prototype.getMaxZoom, MarkerClusterer.prototype.getStyles = MarkerClusterer.prototype.getStyles, MarkerClusterer.prototype.getTotalClusters = MarkerClusterer.prototype.getTotalClusters,MarkerClusterer.prototype.getTotalMarkers = MarkerClusterer.prototype.getTotalMarkers,MarkerClusterer.prototype.redraw = MarkerClusterer.prototype.redraw,MarkerClusterer.prototype.removeMarker = MarkerClusterer.prototype.removeMarker,MarkerClusterer.prototype.removeMarkers = MarkerClusterer.prototype.removeMarkers,MarkerClusterer.prototype.resetViewport = MarkerClusterer.prototype.resetViewport,MarkerClusterer.prototype.repaint = MarkerClusterer.prototype.repaint,MarkerClusterer.prototype.setCalculator = MarkerClusterer.prototype.setCalculator,MarkerClusterer.prototype.setGridSize = MarkerClusterer.prototype.setGridSize,MarkerClusterer.prototype.setMaxZoom = MarkerClusterer.prototype.setMaxZoom,MarkerClusterer.prototype.onAdd = MarkerClusterer.prototype.onAdd,MarkerClusterer.prototype.draw = MarkerClusterer.prototype.draw,Cluster.prototype.getCenter = Cluster.prototype.getCenter,Cluster.prototype.getSize = Cluster.prototype.getSize,Cluster.prototype.getMarkers = Cluster.prototype.getMarkers,ClusterIcon.prototype.onAdd = ClusterIcon.prototype.onAdd,ClusterIcon.prototype.draw = ClusterIcon.prototype.draw,ClusterIcon.prototype.onRemove = ClusterIcon.prototype.onRemove;
var searchVisible = 0, transparent = !0, transparentDemo = !0, fixedTop = !1, navbar_initialized = !1;
$(document).ready(function () {
    $(".ui-loader").html(" ");
    $(window).width();
    $('[data-toggle="morphing"]').each(function () {
        $(this).morphingButton()
    }), $('[rel="tooltip"]').tooltip(), 0 != $(".switch").length && $(".switch").bootstrapSwitch(), 0 != $("[data-toggle='switch']").length && $("[data-toggle='switch']").wrap('<div class="switch" />').parent().bootstrapSwitch(), 0 != $(".selectpicker").length && $(".selectpicker").selectpicker(), 0 != $(".tagsinput").length && $(".tagsinput").tagsInput(), 0 != $(".tagsinput-autocomplete").length && $(".tagsinput-autocomplete").tagsInput({
        autocomplete_url: [{
            value: "Alien",
            id: 1
        }, {value: "Alex", id: 2}, {value: "Alexander", id: 3}, {value: "Alejandro", id: 4}]
    }), 0 != $(".datepicker").length && $(".datepicker").datepicker({
        weekStart: 1,
        color: "{color}"
    }), $(".btn-tooltip").tooltip(), $(".label-tooltip").tooltip(), $(".form-control").on("focus", function () {
        $(this).parent(".input-group").addClass("input-group-focus")
    }).on("blur", function () {
        $(this).parent(".input-group").removeClass("input-group-focus")
    }), 0 != $(".alert-auto-close").length && setTimeout(function () {
        $(".alert-auto-close").fadeOut(function () {
            $(this).remove()
        })
    }, 5e3), demo.initPickColor(), gsdk.fitBackgroundForCards(), gsdk.initNavbarSearch(), gsdk.initPopovers(), gsdk.initCollapseArea(), gsdk.initSliders()
});
var gsdk = {
    misc: {navbar_menu_visible: 0}, fitBackgroundForCards: function () {
        $(".card").each(function () {
            if (!$(this).hasClass("card-many") && !$(this).hasClass("card-user")) {
                var e = $(this).find(".image img");
                e.hide();
                var t = e.attr("src");
                $(this).find(".image").css({
                    "background-image": "url('" + t + "')",
                    "background-position": "center center",
                    "background-size": "cover"
                })
            }
        })
    }, initPopovers: function () {
        0 != $('[data-toggle="popover"]').length && ($("body").append('<div class="popover-filter"></div>'), $('[data-toggle="popover"]').popover().on("show.bs.popover", function () {
            $(".popover-filter").click(function () {
                $(this).removeClass("in"), $('[data-toggle="popover"]').popover("hide")
            }), $(".popover-filter").addClass("in")
        }).on("hide.bs.popover", function () {
            $(".popover-filter").removeClass("in")
        }))
    }, initCollapseArea: function () {
        $('[data-toggle="gsdk-collapse"]').each(function () {
            var e = $(this).attr("data-target");
            $(e).addClass("gsdk-collapse")
        }), $('[data-toggle="gsdk-collapse"]').hover(function () {
            var e = $(this).attr("data-target");
            $(this).hasClass("state-open") || ($(this).addClass("state-hover"), $(e).css({height: "30px"}))
        }, function () {
            var e = $(this).attr("data-target");
            $(this).removeClass("state-hover"), $(this).hasClass("state-open") || $(e).css({height: "0px"})
        }).click(function (e) {
            e.preventDefault();
            var t = $(this).attr("data-target"), i = $(t).children(".panel-body").height();
            $(this).hasClass("state-open") ? ($(t).css({height: "0px"}), $(this).removeClass("state-open")) : ($(t).css({height: i + 30}), $(this).addClass("state-open"))
        })
    }, initSliders: function () {
        0 != $("#slider-range").length && $("#slider-range").slider({
            range: !0,
            min: 0,
            max: 500,
            values: [75, 300]
        }), 0 != $("#refine-price-range").length && $("#refine-price-range").slider({
            range: !0,
            min: 0,
            max: 999,
            values: [100, 850],
            slide: function (e, t) {
                var i = t.values[0], r = t.values[1];
                $(this).siblings(".price-left").html("&euro; " + i), $(this).siblings(".price-right").html("&euro; " + r)
            }
        }), 0 == $("#slider-default").length && 0 == $("#slider-default2").length || $("#slider-default, #slider-default2").slider({
            value: 70,
            orientation: "horizontal",
            range: "min",
            animate: !0
        })
    }, initNavbarSearch: function () {
        $('[data-toggle="search"]').click(function () {
            0 == searchVisible ? (searchVisible = 1, $(this).parent().addClass("active"), $(".navbar-search-form").fadeIn(function () {
                $(".navbar-search-form input").focus()
            })) : (searchVisible = 0, $(this).parent().removeClass("active"), $(this).blur(), $(".navbar-search-form").fadeOut(function () {
                $(".navbar-search-form input").blur()
            }))
        })
    }
}, demo = {
    initPickColor: function () {
        $(".pick-class-label").click(function () {
            var e = $(this).attr("new-class"), t = $("#display-buttons").attr("data-class"), i = $("#display-buttons");
            if (i.length) {
                var r = i.find(".btn");
                r.removeClass(t), r.addClass(e), i.attr("data-class", e)
            }
        })
    }
}, examples = {
    initContactUsMap: function () {
        var e = new google.maps.LatLng(44.43353, 26.093928), t = {
            zoom: 14,
            center: e,
            scrollwheel: !1
        }, i = new google.maps.Map(document.getElementById("contactUsMap"), t), r = new google.maps.Marker({
            position: e,
            title: "Hello World!"
        });
        r.setMap(i)
    }
};
NProgress.configure({showSpinner: !1}), $(window).load(function () {
    NProgress.done()
}), $(document).ready(function () {
    NProgress.start()
}), $(document).ready(function () {
    function e() {
        $(window).width() < 992 ? ($("#topbar").addClass("navbar-white"), $("#topbar").removeClass("navbar-transparent"), $(".brand-img").attr("src", "images/logo.svg")) : ($("#topbar").removeClass("navbar-white"), $("#topbar").addClass("navbar-transparent"), $(".brand-img").attr("src", "images/logo-w.svg"))
    }

    $("body").addClass(navigator.appVersion + " is-js"), e(), checkTransparent(), $(window).resize(function () {
        e(), checkTransparent()
    }), $("#topbar").scrollupbar()
}), function (e) {
    Array.prototype.forEach || (e.forEach = e.forEach || function (e, t) {
            for (var i = 0, r = this.length; r > i; i++)i in this && e.call(t, this[i], i, this)
        })
}(Array.prototype);
var mapObject, markers = [];
window.onload = function (e) {
    initialize()
}, !function (e) {
    var t = function (e, t) {
        this.init(e, t)
    };
    t.prototype = {
        constructor: t, init: function (t, i) {
            var r = this.$element = e(t);
            this.options = e.extend({}, e.fn.checkbox.defaults, i), r.before(this.options.template), this.setState()
        }, setState: function () {
            var e = this.$element, t = e.closest(".checkbox");
            e.prop("disabled") && t.addClass("disabled"), e.prop("checked") && t.addClass("checked")
        }, toggle: function () {
            var t = "checked", i = this.$element, r = i.closest(".checkbox"), o = i.prop(t), s = e.Event("toggle");
            0 == i.prop("disabled") && (r.toggleClass(t) && o ? i.removeAttr(t) : i.prop(t, t), i.trigger(s).trigger("change"))
        }, setCheck: function (t) {
            var i = "checked", r = this.$element, o = r.closest(".checkbox"), s = "check" == t, a = e.Event(t);
            o[s ? "addClass" : "removeClass"](i) && s ? r.prop(i, i) : r.removeAttr(i), r.trigger(a).trigger("change")
        }
    };
    var i = e.fn.checkbox;
    e.fn.checkbox = function (i) {
        return this.each(function () {
            var r = e(this), o = r.data("checkbox"), s = e.extend({}, e.fn.checkbox.defaults, r.data(), "object" == typeof i && i);
            o || r.data("checkbox", o = new t(this, s)), "toggle" == i && o.toggle(), "check" == i || "uncheck" == i ? o.setCheck(i) : i && o.setState()
        })
    }, e.fn.checkbox.defaults = {template: '<span class="icons"><span class="first-icon fa fa-square-o"></span><span class="second-icon fa fa-check-square-o"></span></span>'}, e.fn.checkbox.noConflict = function () {
        return e.fn.checkbox = i, this
    }, e(document).on("click.checkbox.data-api", "[data-toggle^=checkbox], .checkbox", function (t) {
        var i = e(t.target);
        "A" != t.target.tagName && (t && t.preventDefault() && t.stopPropagation(), i.hasClass("checkbox") || (i = i.closest(".checkbox")), i.find(":checkbox").checkbox("toggle"))
    }), e(function () {
        e('[data-toggle="checkbox"]').each(function () {
            var t = e(this);
            t.checkbox()
        })
    })
}(window.jQuery), $(document).ready(function () {
    $("#login_email").keyup(function () {
        $(".error").removeClass("alert alert-danger").html(""), $(".error").removeClass("alert alert-info").html(""), $(".error").removeClass("alert alert-info").html("")
    }), $("#login_password").keyup(function () {
        $(".error").removeClass("alert alert-danger").html(""), $(".error").removeClass("alert alert-info").html(""), $(".error").removeClass("alert alert-info").html("")
    }), $("#loginForm").formValidation({
        framework: "bootstrap",
        icon: {
            valid: "glyphicon glyphicon-ok",
            invalid: "glyphicon glyphicon-remove",
            validating: "glyphicon glyphicon-refresh"
        },
        fields: {
            email_login: {
                validators: {
                    notEmpty: {message: "Necessitas de introduzir um email"},
                    regexp: {
                        regexp: /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/,
                        message: "O email introduzido não é válido"
                    }
                }
            }, password_login: {validators: {notEmpty: {message: "Necessitas de introduzir uma palavra-passe"}}}
        }
    }).on("success.form.fv", function (e) {
        e.preventDefault(), submitLogin()
    }), $("#signupForm").formValidation({
        framework: "bootstrap",
        icon: {
            valid: "glyphicon glyphicon-ok",
            invalid: "glyphicon glyphicon-remove",
            validating: "glyphicon glyphicon-refresh glyphicon-refresh-animate"
        },
        fields: {
            email_signup: {
                validators: {
                    notEmpty: {message: "Necessitas de introduzir um email"},
                    regexp: {
                        regexp: /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/,
                        message: "O email introduzido não é válido"
                    },
                    remote: {
                        headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"},
                        url: "api/verificacoes/verificaRegistoEmail.php",
                        data: {type: "username"},
                        message: "O email introduzido já se encontra registado",
                        type: "POST"
                    }
                }
            }
        }
    }).on("success.form.fv", function (e) {
        e.preventDefault(), submitSignup()
    }), $("#signupFormEnd").formValidation({
        framework: "bootstrap",
        icon: {
            valid: "glyphicon glyphicon-ok",
            invalid: "glyphicon glyphicon-remove",
            validating: "glyphicon glyphicon-refresh"
        },
        fields: {
            nome_signupEnd: {
                validators: {
                    notEmpty: {message: "Necessitas de introduzir um nome"},
                    regexp: {
                        regexp: /^[A-zÀ-ú]+[\s|,][A-zÀ-ú]{1,19}$/,
                        message: "Deves introduzir um nome próprio e apelido válidos"
                    },
                    stringLength: {max: 38, message: "O teu nome não deve possuir mais que 38 caracteres"}
                }
            },
            utilizador_signupEnd: {
                validators: {
                    notEmpty: {message: "Necessitas de introduzir um nome de utilizador"},
                    remote: {
                        headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"},
                        url: "api/verificacoes/verificaUserID.php",
                        data: {type: "username"},
                        message: "O nome de utilizador introduzido já se encontra registado",
                        type: "POST"
                    }
                }
            },
            agree: {
                excluded: !1,
                validators: {
                    callback: {
                        message: "Deves concordar com os termos e condições",
                        callback: function (e, t, i) {
                            return "yes" === e
                        }
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {message: "Necessitas de introduzir uma palavra-passe"},
                    callback: {
                        callback: function (e, t, i) {
                            var r = i.val();
                            if ("" == r)return !0;
                            var o = zxcvbn(r), s = o.score, a = "Esta palavra-passe é fraca", n = $("#strengthBar");
                            switch (s) {
                                case 0:
                                    n.attr("class", "progress-bar progress-bar-danger").css("width", "1%");
                                    break;
                                case 1:
                                    n.attr("class", "progress-bar progress-bar-danger").css("width", "25%");
                                    break;
                                case 2:
                                    n.attr("class", "progress-bar progress-bar-danger").css("width", "50%");
                                    break;
                                case 3:
                                    n.attr("class", "progress-bar progress-bar-warning").css("width", "75%");
                                    break;
                                case 4:
                                    n.attr("class", "progress-bar progress-bar-success").css("width", "100%")
                            }
                            return 3 > s ? {valid: !1, message: a} : !0
                        }
                    }
                }
            },
            confirmPassword: {
                validators: {
                    identical: {
                        field: "password",
                        message: "As palavras-passes introduzidas não coincidem"
                    }
                }
            }
        }
    }).on("success.form.fv", function (e) {
        e.preventDefault(), submitRegist()
    }), $("#click-agree").on("click", function () {
        "no" == $("#agree").val() ? $("#agree").val("yes") : $("#agree").val("no"), $("#signupFormEnd").formValidation("revalidateField", "agree")
    })
});