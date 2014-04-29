//Controls input to user list
/* Remove user */
function removeUser(pid) {
    var request;
    var cf = confirm("Are you sure you want to remove \"" + pid + "\" user ?\nYou will not be able to retrieve any data about" +
			 " this user!!!");
    if (cf) {
        request = new XMLHttpRequest();
        request.onreadystatechange = removecallback;
        var url = "../Data/removeuser.php?pid=" + pid;
        request.open("GET", url, true);
        request.send();
    }
    function removecallback() {

        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == "removed") {
                var node = document.getElementById("remove" + pid);
                var parent = document.getElementsByTagName("DL")[0];
                parent.removeChild(node);
            }
            else {
                alert(request.responseText);
            }

        }
    }
}

function addUser() {
    var request;
    var pid = prompt("Please enter PID of new collector");
    if (!isBlank(pid)) {
        request = new XMLHttpRequest();
        request.onreadystatechange = addcallback;
        var url = "../Data/adduser.php";
        request.open("POST", url, true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("pid=" + pid);
    }
    else {
        alert("You have not enetered PID!");
    }
    function addcallback() {
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == pid) {
                //div
                var divEl = document.createElement("DIV");
                divEl.id = "remove" + pid;
                //dt
                var dtEl = document.createElement("DT");
                var dtTextNode = document.createTextNode(pid);
                dtEl.appendChild(dtTextNode);

                //remove button
                var removeBtnEl = document.createElement("BUTTON");
                removeBtnEl.className = "csvbtn";
                removeBtnEl.onclick = function () { removeUser(pid) };
                var buttonTextNode = document.createTextNode("Remove");
                removeBtnEl.appendChild(buttonTextNode);

                //a
                var aEl = document.createElement("A");
                aEl.href = "csvbypid.php?pid=" + pid;

                //save as csv button
                var saveBtnEl = document.createElement("BUTTON");
                saveBtnEl.className = "csvbtn";
                var removeBtnTextNode = document.createTextNode("Save as CSV file");
                saveBtnEl.appendChild(removeBtnTextNode);

                aEl.appendChild(saveBtnEl);
                dtEl.appendChild(removeBtnEl);
                dtEl.appendChild(aEl);

                divEl.appendChild(dtEl);

                document.getElementsByTagName("DL")[0].appendChild(divEl);



            }
            else {
                alert(request.responseText);
            }
        }
    }
}


function isBlank(str) {
    return (!str || /^\s*$/.test(str));
}