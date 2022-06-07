function rememberMe() {
	var email = document.forms["loginform"]["idemail"].value;
	var password = document.forms["loginform"]["idpassword"].value;
	var rememberme = document.forms["loginform"]["idremember"].checked;
	console.log("Form data:" + rememberme + "," + email + "," + password);
	if (!rememberme) {
		setCookies("cemail", "", 0);
		setCookies("cpass", "", 0);
		setCookies("crem", false, 0);
		document.forms["loginform"]["idemail"].value = "";
		document.forms["loginform"]["idpassword"].value = "";
		document.forms["loginform"]["idremember"].checked = false;
		alert("Credentials removed");
	} else {
		if (email == "" || password == "") {
			document.forms["loginform"]["idremember"].checked = false;
			return false;
		} else {
			setCookies("cemail", email, 30);
			setCookies("cpass", password, 30);
			setCookies("crem", rememberme, 30);
			alert("Credentials Stored Success");
		}
	}
}

function loadCookies() {
	var username = getCookie("cemail");
	var password = getCookie("cpass");
	var rememberme = getCookie("crem");
	console.log("COOKIES:" + username, password, rememberme);
	document.forms["loginform"]["idemail"].value = username;
	document.forms["loginform"]["idpassword"].value = password;
	if (rememberme) {
		document.forms["loginform"]["idremember"].checked = true;
	} else {
		document.forms["loginform"]["idremember"].checked = false;
	}
}

function getCookie(cname) {
	var name = cname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}


function setCookies(cookiename, cookiedata, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	var expires = "expires=" + d.toUTCString();
	document.cookie = cookiename + "=" + cookiedata + ";" + expires + ";path=/";
}


const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});