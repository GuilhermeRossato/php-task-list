function wait_tick(fun, time=0) {
	if (time <= 10) {
		window.requestAnimationFrame(window.requestAnimationFrame.bind(this, fun));
	} else {
		setTimeout(fun, time);
	}
}

function on_startup() {
	if (!window.appRoot) {
		console.warn("appRoot should have been defined at another script tag");
		window.appRoot = window.location.pathname;
	}
	execute_first_content_change();
	window.dispatchEvent(new Event("contentupdate", {"bubbles": true}));
	window.addEventListener("popstate", onpopstate);
}

function execute_first_content_change() {
	var url;
	if (!window.Promise) {
		url = "/error/promise";
	} else {
		url = window.location.pathname;
	}
	if (performance.now() < 200) {
		setTimeout(change_content.bind(window, url, true), 200);
	} else {
		change_content(url, true);
	}
}

function get_content_root() {
	return document.querySelector(".page-content");
}

function on_link_click(evt) {
	(evt) && (evt.preventDefault) && (evt.preventDefault());
	var href;
	if (evt.target.hasAttribute("href")) {
		href = evt.target.getAttribute("href");
	} else if (evt.path && evt.path[0].hasAttribute("href")) {
		href = evt.path[0].getAttribute("href")
	} else if (evt.path && evt.path[1].hasAttribute("href")) {
		href = evt.path[1].getAttribute("href")
	}
	change_content(href);
	return false;
}

function normalize_path(path) {
	var prefix = (path[0] === "/")?"/":"";
	return (prefix+path.split("/").filter(function(a){return a}).join("/")+"/").replace("//", "/");
}

function onpopstate(evt) {
	change_content(normalize_path(window.location.pathname), true);
}

function get_text_response(response) {
	return response.text();
}

function change_content(url, replace=false) {
	(url[url.length-1] !== "/") && (url += "/");
	if (replace === false && window.location.pathname === url) {
		return console.log("Aborted same-page redirect");
	}
	var localUrl = (url.indexOf(window.appRoot) === 0)?url.substr(window.appRoot.length-1):url;
	var api_url = normalize_path(window.appRoot+"api"+localUrl);
	//console.log("Loading content of",url);
	var startedAt = performance.now();
	window.loading_url = api_url;
	var request = fetch(api_url).catch(console.error).then(get_text_response).catch(console.error).then(function(response) {
		var content_root = get_content_root();
		console.log("Request to '"+url+"' took", ((performance.now()-startedAt)*100|0)/100,"ms");
		if (window.loading_url === api_url) {
			content_root.style.opacity = "0";
			content_root.style.marginTop = "50px";
			if (window.location.pathname !== url) {
				if (replace) {
					history.replaceState(null, null, normalize_path(window.appRoot+localUrl));
				} else {
					history.pushState(null, null, normalize_path(window.appRoot+localUrl));
				}
			}
			wait_tick(function() {
				if (response.indexOf('<div class="api-response"') === 0) {
					content_root.innerHTML = response;
				} else {
					// Unexpected response should be top priority
					if (response.indexOf('<!doctype html>') === 0) {
						response = "Api request returned a page instead of an element";
					}
					return (document.body.innerHTML = "<div style='padding:2px 10px'>"+response+"</div>");
				}
				wait_tick(function() {
					content_root.style.opacity = "1";
					content_root.style.marginTop = "70px";
					content_root.dispatchEvent(new Event("contentupdate", {"bubbles": true}));
				});
			}, 200);
		}
	});
}

window.addEventListener("contentupdate", function(evt) {
	prepare_clickable_elements((evt.target !== window)?evt.target:document);
})

function prepare_element(element) {
	if (element.getAttribute && element.getAttribute("href")[0] === "/") {
		element.setAttribute("onclick", "return on_link_click(event);");
	}
}

function prepare_clickable_elements(root) {
	(!root) && (root = document);
	var anchors, anchor, buttons, button, i;
	anchors = root.querySelectorAll("a");
	for (i=0;i<anchors.length;i++) {
		prepare_element(anchors[i]);
	}
	buttons = root.querySelectorAll("button");
	for (i=0;i<buttons.length;i++) {
		prepare_element(buttons[i]);
	}
	(componentHandler) && (componentHandler.upgradeDom());
}

window.addEventListener("load", on_startup);