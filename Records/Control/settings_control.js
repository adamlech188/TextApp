var request;
function changeAdPass() {

    var newad = document.getElementById("newad").value;
    var confirmad = document.getElementById("confirmad").value;
    var current = document.getElementById("currentad").value;
    if (isBlank(current)) {
        document.getElementById("adresponse").innerHTML = " <p>Please enter your current password.</p>";
    }
    else if (isBlank(newad)) {
        document.getElementById("adresponse").innerHTML = " <p>Please enter your new password.</p>";
    }
    else if (isBlank(confirmad)) {
        document.getElementById("adresponse").innerHTML = "<p>Please confirm your new password.</p>";
    }
    else if (newad != confirmad) {
        document.getElementById("adresponse").innerHTML = " <p>Your new Password and confirmation didn't match.</br>" +
	   "Please reenter and confirm your new Password.</p>";
    }
    else {

        request = new XMLHttpRequest();
        request.onreadystatechange = adminCallback;
        url = "../Data/changeadminpw.php";
        request.open("POST", url, true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("current=" + current + "&new=" + confirmad);
    }



}
function adminCallback() {

    if (request.readyState == 4 && request.status == 200) {
        document.getElementById("adresponse").innerHTML = "<p>" + request.responseText + "</p>";
        document.getElementById("newad").value = null;
        document.getElementById("confirmad").value = null;
        document.getElementById("currentad").value = null;

    }
}

function changeUserPass() {

    var newad = document.getElementById("newmb").value;
    var confirmad = document.getElementById("confirmmb").value;
    var current = document.getElementById("currentmb").value;
    if (isBlank(current)) {
        document.getElementById("mbresponse").innerHTML = " <p>Please enter your current password.</p>";
    }
    else if (isBlank(newad)) {
        document.getElementById("mbresponse").innerHTML = " <p>Please enter your new password.</p>";
    }
    else if (isBlank(confirmad)) {
        document.getElementById("mbresponse").innerHTML = "<p>Please confirm your new password.</p>";
    }
    else if (newad != confirmad) {
        document.getElementById("mbresponse").innerHTML = " <p>Your new Password and confirmation didn't match.</br>" +
		"Please reenter and confirm your new Password.</p>";
    }
    else {

        request = new XMLHttpRequest();
        request.onreadystatechange = userCallback;
        url = "../Data/changeuserpw.php";
        request.open("POST", url, true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("current=" + current + "&new=" + confirmad);
    }



}
function userCallback() {

    if (request.readyState == 4 && request.status == 200) {
        document.getElementById("mbresponse").innerHTML = request.responseText;
        document.getElementById("newmb").value = null;
        document.getElementById("confirmmb").value = null;
        document.getElementById("currentmb").value = null;

    }
}
function isBlank(str) {
    return (!str || /^\s*$/.test(str));
}