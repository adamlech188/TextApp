var request;
var place;
//Controller functions for places
/* Add place */
function addPlace() {

    place = prompt("Please enter description of place.");

    if (!isBlank(place)) {

        request = new XMLHttpRequest();
        request.onreadystatechange = addcallback;
        var url = "../Data/addplace.php";
        request.open("POST", url, true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("place=" + place);
    }
    else {
        alert("Place is blank!");
    }
}
function addcallback() {

    if (request.readyState == 4 && request.status == 200) {

        if (request.responseText == place) {

            var textNode = document.createTextNode(request.responseText);
            var childNode = document.createElement("LI");
            //Create button
            var btnText = document.createTextNode("Remove");
            var buttonNode = document.createElement("BUTTON");
            var ulist = document.getElementById("places");
            var ulength = ulist.getElementsByTagName("li").length;

            buttonNode.appendChild(btnText);
            //Append nodes
            childNode.appendChild(textNode);
            childNode.appendChild(buttonNode);
            childNode.id = "litem" + ulength;
            document.getElementById("places").appendChild(childNode);
            var currentPlace = textNode.nodeValue;
            buttonNode.onclick = function () {
                removePlace(currentPlace, ulength);
            };
        }
        else {
            alert(request.responseText);
        }

    }

}
function isBlank(str) {
    return (!str || /^\s*$/.test(str));
}

/*Remove place*/
function removePlace(place, index) {

    var con = confirm("Are you sure you want to remove \"" + place + "\" place?");
    var request;
    if (con == true) {
        request = new XMLHttpRequest();
        request.onreadystatechange = removecallback;
        var url = "../Data/removeplace.php";
        request.open("POST", url, true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("place=" + place);
    }

    function removecallback() {

        if (request.readyState == 4 && request.status == 200) {

            if (request.responseText == "removed") {

                var node = document.getElementById("litem" + index);
                document.getElementById("places").removeChild(node);
            }
            else {
                alert(request.responseText);
            }

        }

    }

}