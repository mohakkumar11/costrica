// deprecated; can be used by legacy pipe, but only modifies the first frame
function resizeIframe(height) {
	CLEVERGRIT.widgets[0].portal.height = parseInt(height);
}
if (!window.CLEVERGRIT) (function () {
	CLEVERGRIT = {
		widgets: [],
		Widget: function (cnf) {
			this.cnf = cnf;
			this.render = function () {
				var target = document.getElementById(this.cnf.target);
				this.portal = document.createElement('iframe');
				this.portal.name = 'CLEVERGRIT';
				this.portal.className = 'CLEVERGRIT_DROPLET';
				this.cnf.host = this.cnf.host.toLowerCase();

				var portal_url = window.location.protocol + '//' + this.cnf.host + '/reserve/?inline=1';
				if (this.cnf.width) portal_url += '&width=' + parseInt(this.cnf.width,10);

				if (this.cnf.layout) portal_url += '&layout=' + encodeURIComponent(this.cnf.layout);
				if (this.cnf.filter_category_id) portal_url +=  '&filter_category_id=' + encodeURIComponent(this.cnf.filter_category_id);
				if (this.cnf.category_id) portal_url +=  '&category_id=' + encodeURIComponent(this.cnf.category_id);
				if (this.cnf.item_id) portal_url +=  '&item_id=' + encodeURIComponent(this.cnf.item_id);
				if (this.cnf.lang_id) portal_url +=  '&lang_id=' + encodeURIComponent(this.cnf.lang_id);
				if (this.cnf.locale_id) portal_url +=  '&locale_id=' + encodeURIComponent(this.cnf.locale_id);
				if (this.cnf.theme) portal_url += '&theme=' + encodeURIComponent(this.cnf.theme);
				if (this.cnf.discount_code) portal_url += '&discount=' + encodeURIComponent(this.cnf.discount_code);
				if (this.cnf.discount) portal_url += '&discount=' + encodeURIComponent(this.cnf.discount);
				if (this.cnf.partner_id) portal_url += '&partner_id=' + encodeURIComponent(this.cnf.partner_id);
				if (this.cnf.tid) portal_url += '&tid=' + encodeURIComponent(this.cnf.tid);
				if (this.cnf.date) portal_url += '&date=' + encodeURIComponent(this.cnf.date);
				if (this.cnf.end_date) portal_url += '&end_date=' + encodeURIComponent(this.cnf.end_date);
				if (this.cnf.options) portal_url += '&options=' + encodeURIComponent(this.cnf.options);
				if (this.cnf.style) portal_url +=  '&style=' + encodeURIComponent(this.cnf.style);
				if (this.cnf.provider) portal_url +=  '&provider=' + encodeURIComponent(this.cnf.provider);
				if (this.cnf.popup) portal_url += '&popup=' + encodeURIComponent(this.cnf.popup);
				if (this.cnf.pipe) {
					if (!this.cnf.pipe.match(/http:|https:/)) {
						this.cnf.pipe = window.location.protocol + '//' + window.location.hostname + this.cnf.pipe;
					}
					portal_url+= '&pipe=' + encodeURIComponent(this.cnf.pipe);
				}

				if (window.location.protocol === 'https:') portal_url += '&ssl=1';

				// &src is currently used to indicate where the frame's messages should be targetted
				portal_url += '&src=' + encodeURIComponent(window.location.protocol + '//' + window.location.host);
				portal_url += '&' + new Date().getTime();

				if (window.ga) {
					ga(function(tracker) {
						var linker = new window.gaplugins.Linker(tracker);
						portal_url = linker.decorate(portal_url);
					});
				} else if (window._gat && window._gat._getTracker) {
					_gaq.push(function() {
						var pageTracker = _gat._getTrackerByName();
						portal_url = pageTracker._getLinkerUrl(portal_url);
					});
				}

				this.portal.src = portal_url;
				this.portal.height = this.cnf.height || '800px';
				this.portal.width = '100%';
				this.portal.frameBorder = 0;
				this.portal.scrolling = 'no';
				this.portal.style.display = 'none';
				this.portal.style.minHeight = '60px';
				this.portal.style.overflow = 'hidden';

				this.portal.callback = this.cnf.callback;

				// add event handlers
				if (this.portal.addEventListener) {
					this.portal.addEventListener('load', CLEVERGRIT.onLoad, false);
				} else if (this.portal.attachEvent) {
					this.portal.attachEvent('onload', CLEVERGRIT.onLoad);
				}

				target.appendChild(this.portal);
				CLEVERGRIT.widgets.push(this);
				return this
			}
		},

		onLoad: function (e) {
			var portal = (e.target || e.srcElement);
			while (portal.previousSibling) {
				portal.parentNode.removeChild(portal.parentNode.firstChild);
			}

			if (portal.style.display == 'block') {
				portal.scrollIntoView(true);
			} else {
				portal.style.display = 'block';
			}

			if (typeof portal.callback === 'function')
				portal.callback(portal);
		},

		// process messages recieved by the window and size the iframe that originated the message
		onSize: function (e) {
			// should be effective for multiple frames, and shouldn't interfere with other scripts running on the page
			for (var i = 0; i < CLEVERGRIT.widgets.length; i++) {

				if (CLEVERGRIT.widgets[i].portal.contentWindow === e.source) {

					var portal = CLEVERGRIT.widgets[i].portal;

					// verify the message origin is correct and the data is an integer
					if (e.origin.match(/\/\/([^\/]+)/)[1] == CLEVERGRIT.widgets[i].cnf.host) {

						if ((e.data | 0) > 0 && e.data != portal.height) {

							portal.height = e.data;
							if (portal.getBoundingClientRect().bottom - window.innerHeight/2 < 100) portal.scrollIntoView(false);

						} else if (typeof e.data === "string" && e.data.substr(0,4) === "http") {
							window.location.href = e.data;
						}
					}	
				}
			}
		}
	};

	// we only hook the event on initial load, since the messages are being recieved by the window
	if (window.addEventListener) {
		window.addEventListener('message', CLEVERGRIT.onSize, false);
	} else if (window.attachEvent) {
		window.attachEvent('onmessage', CLEVERGRIT.onSize);
	}
})();



// Legacy v1.0 Interface Replacement
if(document.getElementById('CLEVERGRIT_WIDGET_01') == null && document.getElementById('CF') != null) {

function CLEVERGRIT_widget() {
   jQuery(document).ready(function() {
        jQuery('#CF_load').hide();
        var CLEVERGRIT_LEGACY_HOST = document.getElementById('CF').className;
        new CLEVERGRIT.Widget ({
            host: CLEVERGRIT_LEGACY_HOST,
            target: 'CF',
            provider: 'legacy'
        }).render();
        jQuery('#CF').show();
	});
}
function CLEVERGRIT_lib_load(i, g) {
	var h = arguments.callee;

    if (!("queue" in h)) {
        h.queue = {}
    }
    var f = h.queue;
    if (i in f) {
        if (g) {
            if (f[i]) {
                f[i].push(g)
            } else {
                g()
            }
        }
        return
    }
    f[i] = g ? [g] : [];
    var j = document.createElement("script");
    j.type = "text/javascript";
    j.onload = j.onreadystatechange = function () {
        if (j.readyState && j.readyState != "loaded" && j.readyState != "complete") {
            return
        }
        j.onreadystatechange = j.onload = null;
        while (f[i].length) {
            f[i].shift()()
        }
        f[i] = null
    };
	j.src = i;
    document.getElementsByTagName("head")[0].appendChild(j)
}

if (typeof jQuery == "undefined") {
	CLEVERGRIT_lib_load("//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js", function () {
		CLEVERGRIT_widget()
	})
} else {
	CLEVERGRIT_widget()
}

}
