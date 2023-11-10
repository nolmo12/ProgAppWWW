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

var isInfoOpen = false;
var maxScrollPosition = 0;

function getInfo(vehicle_id)
{
    let infoDiv = $('#info');
    id = vehicle_id;
    //infoDiv.css('width', '0');
    //infoDiv.css('height', '0');  
    infoDiv.removeClass("hidden").addClass("visible");
    if (!isInfoOpen) {
        $.ajax({
          type: "GET",
          url: "server_script/get_vehicle_info.php",
          data: {
            'id': id
          },
          success: function(data) {
            infoDiv.html(data);
          }
        });

        infoDiv.css({
          top: 0,
          display: 'block'
        });
    
        infoDiv.animate({
          top: '15%',
        }, 1500, function() {
          // Animation complete
        });
        isInfoOpen = true;
      }
      else
      {
        $.ajax({
          type: "GET",
          url: "server_script/get_vehicle_info.php",
          data: {
            'id': id
          },
          success: function(data) {
            infoDiv.html(data);
          }
        });
      }
      // let inAnimation = false;
      // if(isInfoOpen)
      // {

      //   $(document).scroll(function(){
      //     if(!inAnimation)
      //     {
      //       inAnimation = true;
      //       maxScrollPosition = $(document).height() - $(window).height();
      //       let currentScrollPosition = $(window).scrollTop();
      //       console.log(currentScrollPosition);

      //       let normalValue = ((currentScrollPosition - 15) / (35 - 15));
      //       let topPosition = normalValue * 15 + (1 - normalValue) * 35;

      //       if(topPosition > 35)
      //         topPosition = 35;
      //       else if(topPosition < 15)
      //         topPosition = 15;
      //       if(normalValue < 0 )
      //         normalValue = 0;

      //         console.log(normalValue);
      //         console.log(topPosition);
      //         infoDiv.animate({
      //           top: topPosition + "%"
      //       }, function(){
      //         inAnimation = false;
      //       });
      //     }
      //   });
      // }
}

function closeInfo()
{
    let infoDiv = document.getElementById("info")
    infoDiv.classList.remove("visible")
    infoDiv.classList.add("hidden")
    infoDiv.innerHTML = "";
    isInfoOpen = false;
}

function removeTextBeforeChar(text, char)
{
    let tempTextArray = text.split(char);
    return tempTextArray[tempTextArray.length-1];
}

function removeTextAfterChar(text, char)
{
    let tempTextArray = text.split(char);
    return tempTextArray[0];
}

function capitalise(text)
{
    if(!(text.charCodeAt(0) > 47) || !(text.charCodeAt(0) < 58))
    {
        let polishChars = /[ĄąĆćĘęŁłŃńÓóŚśŹźŻż]/;
        let regExpression = new RegExp(polishChars);
        if(regExpression.test(text[0]))
        {
            let letter = text.charCodeAt(0);
            letter -= 1;
            letter = String.fromCharCode(letter);
            let tempTextArray = text.split('');
            tempTextArray[0] = letter;
            let tempText = tempTextArray.join("");
            return tempText;
        }
        else
        {
            let letter = text.charCodeAt(0);
            letter -= 32;
            letter = String.fromCharCode(letter);
            let tempTextArray = text.split('');
            tempTextArray[0] = letter;
            let tempText = tempTextArray.join("");
            return tempText;
        }
    }

    return text;

}

$(document).on('keyup', function(e) {
    if (e.key == "Escape") $('.text-left').click();
  });