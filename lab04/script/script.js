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

function getInfo(vehicleDiv)
{
        let infoDiv = document.getElementById("info")
    infoDiv.classList.remove("hidden")
    infoDiv.classList.add("visible")
    infoDiv.innerHTML = "";

    let tempInfoArray = getVehicleInfo(vehicleDiv.innerHTML);

    let vehicle = tempInfoArray[0];

    let vehicleInfoArray = vehicle.split("-");
    for(let i = 0; i < vehicleInfoArray.length; i++)
    {
        if(vehicleInfoArray[i] == "mercedesbenz")
            vehicleInfoArray[i] = "mercedes-Benz";
        vehicleInfoArray[i] = capitalise(vehicleInfoArray[i])
    }

    vehicle = vehicleInfoArray.join(" ");

    console.log(vehicleInfoArray);

    let city = tempInfoArray[1];

    city = capitalise(city);

    const infoElements = [];
    let closeMark = document.createElement("span")
    closeMark.classList.add("text-left");
    closeMark.setAttribute("onclick", "closeInfo()")
    closeMark.innerHTML = "&#10005;"
    infoElements.push(closeMark)

    let h1 = document.createElement("h1");
    h1.innerText = "Pojazd: " + vehicle + ", Miasto: " + city;
    infoElements.push(h1)

    let vehicleImgDiv = document.createElement("div");
    vehicleImgDiv.classList.add("center-img");
    let vehicleImg = vehicleDiv.children[0].cloneNode(true);
    vehicleImgDiv.append(vehicleImg);
    infoElements.push(vehicleImgDiv);

    let text = document.createElement("span");
    text.style.display = "block";
    text.style.padding = "2%";
    switch(vehicle)
    {
        case "Solaris Urbino 12":
            text.innerText="Solaris Urbino 12 to średniej wielkości autobus miejski produkowany przez firmę Solaris Bus"+
            "& Coach z Polski. Jest dostępny w różnych wariantach napędu, w tym spalinowym, "+
            "hybrydowym i elektrycznym, co czyni go ekologicznym rozwiązaniem. Autobus ten jest "+
            "zaprojektowany z myślą o komforcie pasażerów, oferując klimatyzację i nowoczesny design "+
            "wnętrza. Jest popularnym wyborem dla miast, które dążą do poprawy transportu "+
            "publicznego i zmniejszenia emisji spalin.";
        break;
        case "Solaris Urbino 18":
            text.innerText = "Solaris Urbino 18 to duży autobus miejski produkowany przez Solaris Bus & Coach z Polski, "+
            "oferujący dużą pojemność i dostępny w różnych wariantach napędu, w tym spalinowym, " +
            "hybrydowym i elektrycznym. Posiada komfortowe wnętrze i jest stosowany w miastach do " +
            "obsługi ruchliwych tras miejskich i podmiejskich.";
        break;
        case "Man Lion's City G":
            text.innerText = "MAN Lion's City G to rodzina autobusów przegubowych produkowanych przez niemieckiego "+
            "producenta MAN Truck & Bus. Są to duże i przegubowe autobusy miejskie, które oferują "+
            "dużą pojemność pasażerów. Warianty Lion's City G mogą być dostępne z różnymi rodzajami "+
            "napędu, w tym spalinowym lub hybrydowym. Są wyposażone w nowoczesne udogodnienia, " +
            "takie jak klimatyzacja i ergonomiczne wnętrze, zapewniając komfort pasażerom. Autobusy " +
            "Lion's City G często obsługują linie komunikacji publicznej w miastach na całym świecie.";
            break;
        case "Mercedes-Benz CapaCity":
            text.innerText = "Mercedes-Benz Capacity to rodzina autobusów przegubowych produkowanych przez "+
            "niemieckiego producenta Mercedes-Benz. Są to przegubowe autobusy miejskie, które "+
            "charakteryzują się dużą pojemnością pasażerów. Autobusy Capacity są używane w miastach "+
            "do obsługi ruchliwych tras miejskich i oferują komfortowe wnętrze oraz różne warianty "+
            "napędu, w tym spalinowy i hybrydowy. To popularny wybór w transporcie publicznym w "+
            "miastach na całym świecie.";
            break;
        case "Solaris Trollino":
            text.innerText = "Solaris Trollino to rodzina trolejbusów produkowanych przez polskiego producenta Solaris "+
            "Bus & Coach. Są to pojazdy elektryczne zasilane z linii trakcyjnej lub za pomocą "+
            "akumulatorów. Trollino jest ekologicznym środkiem transportu miejskiego, który nie emituje " +
            "spalin, co przyczynia się do ochrony środowiska. Trolejbusy Solaris Trollino są " +
            "wykorzystywane w miastach na całym świecie jako część systemów transportu publicznego.";
            break;
        case "Volvo 7900 Electric":
            text.innerText = "Volvo 7900 Electric to elektryczny autobus miejski produkowany przez firmę Volvo. Jest " +
            "przyjazny dla środowiska, działa na zasilanie elektryczne i nie emituje spalin. Autobus ten " +
            "jest używany w miastach jako ekologiczna alternatywa dla tradycyjnych pojazdów z silnikiem " +
            "spalinowym.";
            break;
        case "Mercedes-Benz Citaro":
            text.innerText = "Mercedes-Benz Citaro to popularny autobus miejski produkowany przez niemieckiego " +
            "producenta Mercedes-Benz. Oferuje różne warianty napędu, w tym spalinowe, hybrydowe i " +
            "elektryczne. Ten autobus jest stosowany w miastach na całym świecie i jest znany z " +
            "wydajności, komfortu i nowoczesnego designu wnętrza.";
            break;
        case "Scania Omnilink":
            text.innerText = "Scania Omnilink to autobus produkowany przez szwedzką firmę Scania. Jest to model " +
            "autobusu miejskiego wyposażonego w różne warianty napędu, w tym spalinowy i hybrydowy. " +
            "Scania Omnilink jest stosowana w miastach i obszarach miejskich do transportu " +
            "publicznego. To popularny wybór ze względu na swoją niezawodność i efektywność."
            break;
        default:
            text.innerText="Nie prawidłowy pojazd";
    }

    infoElements.push(text);

    let table = document.createElement("table");
    //table.classList.add("center");
    table.style.width = "90%";
    table.style.textAlign = "center";
    table.insertRow();
    table.insertRow();
    table.rows[0].insertCell();
    table.rows[0].insertCell();
    table.rows[0].insertCell();
    table.rows[0].insertCell();
    table.rows[0].cells[0].innerText = "Producent";
    table.rows[0].cells[1].innerText = "Model";
    table.rows[0].cells[2].innerText = "Kraj Pochodzenia";
    table.rows[0].cells[3].innerText = "Rodzaje silnika";
    table.rows[1].insertCell();
    table.rows[1].insertCell();
    table.rows[1].insertCell();
    table.rows[1].insertCell();
    switch(vehicle)
    {
        case "Solaris Urbino 12":
            table.rows[1].cells[0].innerText = "Solaris";
            table.rows[1].cells[1].innerText = "Urbino 12";
            table.rows[1].cells[2].innerText = "Polska";
            table.rows[1].cells[3].innerText = "Spalinowy, Hybrydowy, Elektryczny, Wodorowy";
            break;
        case "Solaris Urbino 18":
            table.rows[1].cells[0].innerText = "Solaris";
            table.rows[1].cells[1].innerText = "Urbino 18";
            table.rows[1].cells[2].innerText = "Polska";
            table.rows[1].cells[3].innerText = "Spalinowy, Hybrydowy, Elektryczny, Wodorowy";
            break;
        case "Man Lion's City G":
            table.rows[1].cells[0].innerText = "Man";
            table.rows[1].cells[1].innerText = "Lion's City G";
            table.rows[1].cells[2].innerText = "Niemcy";
            table.rows[1].cells[3].innerText = "Spalinowy, Hybrydowy";
            break;
        case "Mercedes-Benz CapaCity":
            table.rows[1].cells[0].innerText = "Mercedes-Benz";
            table.rows[1].cells[1].innerText = "CapaCity";
            table.rows[1].cells[2].innerText = "Niemcy";
            table.rows[1].cells[3].innerText = "Spalinowy, Hybrydowy, Elektryczny";
            break;
        case "Solaris Trollino":
            table.rows[1].cells[0].innerText = "Solaris";
            table.rows[1].cells[1].innerText = "Trollino";
            table.rows[1].cells[2].innerText = "Polska";
            table.rows[1].cells[3].innerText = "Elektryczny(Akumulator)";
            break;
        case "Volvo 7900 Electric":
            table.rows[1].cells[0].innerText = "Volvo";
            table.rows[1].cells[1].innerText = "7900 Electric";
            table.rows[1].cells[2].innerText = "Szwecja";
            table.rows[1].cells[3].innerText = "Elektryczny(Bateria)";
            break;
        case "Mercedes-Benz Citaro":
            table.rows[1].cells[0].innerText = "Mercedes-Benz";
            table.rows[1].cells[1].innerText = "Citaro";
            table.rows[1].cells[2].innerText = "Niemcy";
            table.rows[1].cells[3].innerText = "Spalinowy, Hybrydowy, Elektryczny";
            break;
        case "Scania Omnilink":
            table.rows[1].cells[0].innerText = "Scania";
            table.rows[1].cells[1].innerText = "Omnilink";
            table.rows[1].cells[2].innerText = "Szwecja";
            table.rows[1].cells[3].innerText = "Spalinowy, Hybrydowy";
            break;
    }
    infoElements.push(table);

    




    infoElements.forEach(element =>{
        infoDiv.append(element);
    });
}

function closeInfo()
{
    let infoDiv = document.getElementById("info")
    infoDiv.classList.remove("visible")
    infoDiv.classList.add("hidden")
}

function getVehicleInfo(vehicleImgPath)
{
    let vehicleAndCityArray = vehicleImgPath.split("_");

    let vehicle = vehicleAndCityArray[0];
    vehicle = removeTextBeforeChar(vehicle, "/");

    let city = vehicleAndCityArray[1];
    city = removeTextAfterChar(city, ".");

    vehicleAndCityArray[0] = vehicle;
    vehicleAndCityArray[1] = city;

    return vehicleAndCityArray;
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