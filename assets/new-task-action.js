function send_post_data(url, data) {
	var form_data;
	if (data instanceof FormData) {
		form_data = data;
	} else {
		form_data = new FormData();

		for(var name in data) {
			form_data.append(name, data[name]);
		}
	}
	return fetch(url, {
		method: 'POST',
		credentials: 'include',
		body: form_data
	});
}

function new_task_action(evt) {
	var form, i;
	for(i=0;i<evt.path.length;i++) {
		if (evt.path[i] instanceof HTMLFormElement) {
			form = evt.path[i];
			break;
		}
	}
	if (form instanceof HTMLFormElement) {
		form.querySelectorAll(".mdl-button").forEach(function(button) {
			button.setAttribute("disabled", "")
		})
		send_post_data(
			normalize_path(window.appRoot+"/api/save-task/"),
			new FormData(form)
		).catch(console.error).then(function(r) {
			return r.text();
		}).catch(console.error).then(function(response) {
			if (response.indexOf("<!doctype html") === 0) {
				document.body.innerHTML = "Unexpected response: POST responded with full page";
			} else if (response !== "OK") {
				if (form.querySelector(".errors")) {
					form.querySelector(".errors").innerHTML = response;
				}
				form.querySelectorAll(".mdl-button").forEach(function(button) {
					button.removeAttribute("disabled")
				});
			} else {
				change_content(form.getAttribute("action"));
			}
		});
	} else {
		console.warn("Could not find the new task form");
	}
}

function new_task_click(evt) {
	(evt && evt.preventDefault && evt.preventDefault());
	new_task_action(evt);
	return false;
}
