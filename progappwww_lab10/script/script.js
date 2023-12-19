// TIME SCRIPT

// Function to get the current date and update the "date" element
function getTheDate() {
  Todays = new Date();
  TheDate = "" + (Todays.getMonth() + 1) + " / " + Todays.getDate() + " / " + (Todays.getYear() - 100);
  document.getElementById("date").innerText = TheDate;
}

var timerID = null;
var timerRunning = false;

// Function to stop the clock
function stopClock() {
  if (timerRunning)
      clearTimeout(timerID);

  timerRunning = false;
}

// Function to start the clock
function startClock() {
  stopClock();
  getTheDate();
  showTime();
}

// Function to display the current time and update the "watch" element
function showTime() {
  var now = new Date();
  var hours = now.getHours();
  var minutes = now.getMinutes();
  var seconds = now.getSeconds();

  var timeValue = "" + ((hours > 12) ? hours - 12 : hours);
  timeValue += ((minutes < 10) ? ":0" : ":") + minutes;
  timeValue += ((seconds < 10) ? ":0" : ":") + seconds;
  timeValue += ((hours >= 12) ? " P.M. " : " A.M. ");
  document.getElementById("watch").innerText = timeValue;
  timerID = setTimeout("showTime()", 1000);
  timerRunning = true;
}

var isInfoOpen = false;
var maxScrollPosition = 0;

// Function to get information about a vehicle using AJAX
function getInfo(vehicle_id) {
  let infoDiv = $('#info');
  id = vehicle_id;
  infoDiv.removeClass("hidden").addClass("visible");
  
  if (!isInfoOpen) {
      $.ajax({
          type: "GET",
          url: "server_script/get_vehicle_info.php",
          data: {
              'id': id
          },
          success: function (data) {
              infoDiv.html(data);
          }
      });

      infoDiv.css({
          top: 0,
          display: 'block'
      });

      infoDiv.animate({
          top: '15%',
      }, 1500, function () {
          // Animation complete
      });
      isInfoOpen = true;
  } else {
      $.ajax({
          type: "GET",
          url: "server_script/get_vehicle_info.php",
          data: {
              'id': id
          },
          success: function (data) {
              infoDiv.html(data);
          }
      });
  }
}

// Function to close the vehicle information div
function closeInfo() {
  let infoDiv = document.getElementById("info")
  infoDiv.classList.remove("visible")
  infoDiv.classList.add("hidden")
  infoDiv.innerHTML = "";
  isInfoOpen = false;
}

// Function to remove text before a specified character in a string
function removeTextBeforeChar(text, char) {
  let tempTextArray = text.split(char);
  return tempTextArray[tempTextArray.length - 1];
}

// Function to remove text after a specified character in a string
function removeTextAfterChar(text, char) {
  let tempTextArray = text.split(char);
  return tempTextArray[0];
}

// Function to capitalize the first letter of a string
function capitalise(text) {
  if (!(text.charCodeAt(0) > 47) || !(text.charCodeAt(0) < 58)) {
      let polishChars = /[ĄąĆćĘęŁłŃńÓóŚśŹźŻż]/;
      let regExpression = new RegExp(polishChars);
      if (regExpression.test(text[0])) {
          let letter = text.charCodeAt(0);
          letter -= 1;
          letter = String.fromCharCode(letter);
          let tempTextArray = text.split('');
          tempTextArray[0] = letter;
          let tempText = tempTextArray.join("");
          return tempText;
      } else {
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

// Function to remember the selected item in a list
function rememberSelectedItem(list) {
  var currentURL = new URL(window.location.href);
  let params = currentURL.searchParams;

  listElements = [...list.children];

  listElements.forEach(option => {
    switch(list.name)
    {
      case "pages":
        if (params.get("pages") == option.value)
        list.value = option.value;
      break;
      case "categories":
        if (params.get("categories") == option.value)
        list.value = option.value;
      break;
    }
  });
}

// Function to set the active navigation link based on the current URL
function setActiveNav() {
  var currentURL = new URL(window.location.href);

  let nav = document.getElementsByTagName("nav")
  if (nav.children != null) {
      let ulNav = nav[0].children[0];
      let liUlNav = [...ulNav.children];
      liUlNav.forEach(link => {
          if (currentURL.href === link.children[0].href) {
              link.children[0].classList.add("active");
          }
      });
  }
}
setActiveNav();

// Event listener for the 'Escape' key to close the information
$(document).on('keyup', function (e) {
  if (e.key == "Escape") $('.text-left').click();
});
