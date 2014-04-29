var timerStarted = false;
var textCount = 0;
var notextCount = 0;
var numofCars = 0;
var percentage = 0;
var timeInter;
var timeStart;
var timeEnd;
var textRecentlyStack = [];
var elapsedInMili = 0;
var place;
var pid;
var finalStartTime;


function stopper(element) {

    var milisec = Date.now() - timeStart + parseInt(elapsedInMili);
    var seconds = Math.round(milisec / 1000);
    var minutes = Math.floor(seconds / 60);
    var hours = Math.floor(minutes / 60);

    seconds = seconds % 60;
    minutes = minutes % 60;
    var timeElapsed = ((hours < 10 ? "0" : "") + hours + ":") +
                     ((minutes < 10) ? "0" : "")
                     + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;

    $(element).text(timeElapsed);
}
function formatTime(milisec) {
    var seconds = Math.round(milisec / 1000);
    var minutes = Math.floor(seconds / 60);
    var hours = Math.floor(minutes / 60);
    seconds = seconds % 60;
    minutes = minutes % 60;
    var timeElapsed = ((hours < 10 ? "0" : "") + hours + ":") +
                     ((minutes < 10) ? "0" : "")
                     + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
    return timeElapsed;
}
$(function () {
    $("#progressbar").progressbar({
        value: percentage

    });
});

$(document).on("pageinit", "#pageone", function () {

    textRecentlyStack.push(false);
    $.mobile.activeBtnClass = 'unused';
    pid = user_name;
    place = user_place;



    if (localStorage.length > 0) {

        var tempTextCount = localStorage.getItem("no");
        console.log(tempTextCount);
        if (isNaN(notextCount = parseInt(localStorage.getItem("no")))) {
            notextCount = 0;
        }
        $("#notextCount").text(notextCount);
        if (isNaN(textCount = parseInt(localStorage.getItem("yes")))) {
            textCount = 0;
        }

        $("#textCount").text(textCount);
        elapsedInMili = localStorage.getItem("elapsedInMili");
        var temp = formatTime(elapsedInMili);
        $("#timeElapsed").text(temp);
        numofCars = parseInt(localStorage.getItem("numofCars"));
        percentage = textCount / numofCars * 100;
        $("#progressbar").progressbar({ value: percentage });
        finalStartTime = parseInt(localStorage.getItem("timeStart"));

        timeEnd = parseInt(localStorage.getItem("timeEnd"));



    }

    $("#texting").on("tap", function () {
        if (timerStarted === true) {
            textRecentlyStack.push(true);
            textCount += 1;
            numofCars += 1;
            percentage = textCount / numofCars * 100;
            $("#progressbar").progressbar({ value: percentage });
            $("#textCount").text(textCount);
            localStorage.setItem("yes", textCount);
            localStorage.setItem("numofCars", numofCars);

        }
        else {

            $.mobile.changePage("#warning_info", { role: "dialog" });
        }
    });

    $("#notexting").on("tap", function () {
        if (timerStarted === true) {
            textRecentlyStack.push(false);
            notextCount += 1;
            numofCars += 1;
            percentage = textCount / numofCars * 100;
            $("#progressbar").progressbar({ value: percentage });
            $("#notextCount").text(notextCount);
            localStorage.setItem("no", notextCount);
        }
        else {
            $.mobile.changePage("#warning_info", { role: "dialog" });
        }
    });
    $("#save").on("tap", function () {
        if ((timeStart == "" || timeStart == null) && finalStartTime == null) {
            $.mobile.changePage("#start_info", { role: "dialog" });
        }
        else if (timeEnd == "" || timeEnd == null) {
            $.mobile.changePage("#end_info", { role: "dialog" });
        }
        else {





            var d = new Date(finalStartTime);
            var ds = d.toDateString();
            var ts = d.toLocaleTimeString();
            var e = new Date(timeEnd);
            var te = e.toLocaleTimeString();


            $("#pid_text").text(pid);
            document.forms["saved_data"]["pid"].value = pid;
            $("#date_text").text(ds);
            document.forms["saved_data"]["date"].value = ds;
            $("#start_text").text(ts);
            document.forms["saved_data"]["start"].value = ts;
            $("#end_text").text(te);
            document.forms["saved_data"]["end"].value = te;
            $("#text_text").text(textCount);
            document.forms["saved_data"]["text"].value = textCount;
            $("#notext_text").text(notextCount);
            document.forms["saved_data"]["notext"].value = notextCount;
            $("#place_text").text(place);
            document.forms["saved_data"]["place"].value = place;
            $.mobile.changePage("#save_data", { role: "dialog" });

        }
    });
    $("#startButton").on("tap", function () {
        if (timerStarted == false) {
            timeStart = Date.now();
            if (localStorage.getItem("timeStart") == null) {
                finalStartTime = Date.now();
                localStorage.setItem("timeStart", timeStart);
            }

            timeEnd = null;
            timeInter = setInterval(function () { stopper("#timeElapsed") }, 1000);
            timerStarted = true;
        }




    });
    $("#stopButton").on("tap", function () {

        if (timerStarted == true) {
            timeEnd = Date.now();
            var elapsed = timeEnd - timeStart;
            elapsedInMili = parseInt(elapsedInMili) + elapsed;
            localStorage.setItem("elapsedInMili", elapsedInMili);
            localStorage.setItem("timeEnd", timeEnd);
            clearInterval(timeInter);
            timerStarted = false;
        }
    });

    $("#undoButton").on("tap", function () {

        if (numofCars > 0) {

            if (textRecentlyStack.pop() == true) {
                --textCount;
                localStorage.setItem("yes", textCount);

                $("#textCount").text(textCount);
            }
            else {
                --notextCount;
                localStorage.setItem("no", notextCount);
                $("#notextCount").text(notextCount);

            }
            --numofCars;
            localStorage.setItem("numofCars", numofCars);
            percentage = textCount / numofCars * 100;
            $("#progressbar").progressbar({ value: percentage });
        }
    });
    $("#clearButton").on("tap", function () {
        var r = confirm("Are you sure you want to clear data? \n You will not be able to retrieve it !")
        if (r === true) {
            numofCars = 0;
            textCount = 0;
            notextCount = 0;
            $("#notextCount").text(notextCount);
            $("#textCount").text(textCount);
            percentage = 0;
            elapsedInMili = 0;
            $("#progressbar").progressbar({ value: percentage });
            $("#timeElapsed").text("00:00:00");

            localStorage.clear();
        }
    });
    $("#cont_btn").on("tap", function () {
        place = "<?php echo($_SESSION['place'])?>";
        localStorage.setItem("place", place);
        if (place == "" || place == null) {
            alert("Please enter place description");
        }

        else {

            if (locaStorage.getItem("timeStart")) {

            }
            var d = new Date(parseInt(finalStartime));
            var ds = d.toDateString();
            var ts = d.toLocaleTimeString();
            var e = new Date(timeEnd);
            var te = e.toLocaleTimeString();

            $("#pid_text").text(pid);
            document.forms["saved_data"]["pid"].value = pid;
            $("#date_text").text(ds);
            document.forms["saved_data"]["date"].value = ds;
            $("#start_text").text(ts);
            document.forms["saved_data"]["start"].value = ts;
            $("#end_text").text(te);
            document.forms["saved_data"]["end"].value = te;
            $("#text_text").text(textCount);
            document.forms["saved_data"]["text"].value = textCount;
            $("#notext_text").text(notextCount);
            document.forms["saved_data"]["notext"].value = notextCount;
            $("#place_text").text(place);
            document.forms["saved_data"]["place"].value = place;
            $.mobile.changePage("#save_data", { role: "dialog" });
        }
    });
    $("#cancel_data").on("tap", function () {

        $.mobile.changePage("#pageone", { transition: "slidefade" });
    });

});

$(document).ready(function () {
    alert("Remember to ask yourself: are the drivers of passing vehicles manipulating a mobile device?");
}); 