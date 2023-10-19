//TIME SCRIPT
function getTheDate()
{
    Todays = new Date();
    TheDate = "" + (Todays.getMonth() + 1) + " / " + Todays.getDate() + " / " + (Todays.getYear() - 100);
    document.getElementById("date").innerText = TheDate;
}

var timerID = null;
var timerRunning = false;

function stopClock()
{
    if(timerRunning)
        clearTimeout(timerID);

    timerRunning = false;
}

function startClock()
{
    stopClock();
    getTheDate();
    showTime();
}

function showTime()
{
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();

    var timeValue = "" + ((hours > 12) ? hours -12 :hours);
    timeValue += ((minutes < 10) ? ":0" : ":") + minutes;
    timeValue += ((seconds < 10) ? ":0" : ":") + seconds;
    timeValue += ((hours >= 12) ? " P.M. " : " A.M. ");
    document.getElementById("watch").innerText = timeValue;
    timerID = setTimeout("showTime()", 1000)
    timerRunning = true;
}

showTime();