-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 16, 2023 at 12:37 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progappwww`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ciekawostki`
--

CREATE TABLE `ciekawostki` (
  `id` int(11) NOT NULL,
  `tekst` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ciekawostki`
--

INSERT INTO `ciekawostki` (`id`, `tekst`) VALUES
(1, 'Najdłuższy most na świecie: Najdłuższym mostem na świecie jest most Danyang-Kunshan w Chinach, który ma imponującą długość wynoszącą 164,8 kilometra. Został otwarty w 2011 roku i łączy miasta Danyang i Kunshan.'),
(2, 'Pierwszy samochód: Pierwszy samochód napędzany silnikiem spalinowym został zbudowany przez Karla Benza w 1885 roku. Nazwany \"Benz Patent-Motorwagen,\" ten trójkołowy pojazd miał silnik o mocy 0,75 KM.'),
(3, 'Pierwszy lot samolotem: Bracia Wright, Orville i Wilbur Wright, dokonali pierwszego udanego lotu samolotem w 1903 roku w Kitty Hawk, Karolina Północna, USA. Ich samolot \"Flyer\" przeleciał dystans 36,5 metra.'),
(4, 'Najdłuższa kolejka górska: Najdłuższą kolejką górską na świecie jest The Steel Dragon 2000 w parku rozrywki Nagashima Spa Land w Japonii. Kolejka ma 2479 metrów długości i została otwarta w 2000 roku.'),
(5, 'Najszybszy pociąg na świecie: Najszybszy pociąg na świecie to japoński maglev o nazwie JR-Maglev, który osiągnął prędkość 603 km/h (375 mph) podczas testów w 2015 roku. Maglev wykorzystuje technologię unoszenia na magnetycznym polu i nie ma fizycznego kontaktu z torami.'),
(6, 'Największy port na świecie: Port Tianjin w Chinach jest uważany za największy port na świecie pod względem przepustowości. Jest ważnym punktem transportu morskiego i obsługuje znaczną część chińskiego handlu zagranicznego.'),
(7, 'Pierwszy telewizyjny wyścig samochodowy: Pierwszy telewizyjny wyścig samochodowy odbył się w 1937 roku w Stanach Zjednoczonych. Wyścig ten, zorganizowany przez AAA (American Automobile Association), został pokazany na antenie NBC.'),
(8, 'Pierwszy lot człowieka w kosmos: Pierwszym człowiekiem, który poleciał w kosmos, był Jurij Gagarin, radziecki kosmonauta. W dniu 12 kwietnia 1961 roku poleciał on na pokładzie statku kosmicznego Wostok 1 i okrążył Ziemię.'),
(9, 'Najwyższy most na świecie: Najwyższym mostem na świecie jest Most Xingkai, który łączy Chiny i Rosję. Ma on wysokość wynoszącą 385 metrów nad rzeką Amur.'),
(10, 'Pierwszy przelot samolotem przez Atlantyk: Charles Lindbergh dokonał pierwszego samotnego przelotu nad Atlantykiem w 1927 roku. Jego samolot, Spirit of St. Louis, wystartował z Nowego Jorku i wylądował w Paryżu.'),
(11, 'Najstarszy tramwaj: Pierwszy regularny tramwaj na świecie rozpoczął działalność w Nowym Jorku w 1832 roku. Był to tramwaj konny.'),
(12, 'Najdłuższa sieć metra: Najdłuższą sieć metra na świecie ma Shanghai Metro w Chinach, z ponad 700 kilometrami torów. System ten ciągle się rozwija.'),
(13, 'Największa liczba pasażerów w jednym dniu: W czasie chińskiego Nowego Roku w 2018 roku, metro w Pekinie przewiozło rekordową liczbę pasażerów wynoszącą 13,7 miliona osób w jednym dniu.'),
(14, 'Największa ilość ruchu rowerowego: Amsterdam jest jednym z miast z największą ilością ruchu rowerowego na świecie. Tamtejsze ulice i ścieżki rowerowe są używane przez miliony rowerzystów każdego dnia.'),
(15, 'Największa kapsuła kolejki górskiej na świecie: Wielka kapsuła kolejki górskiej \"London Eye\" w Londynie może pomieścić do 25 pasażerów naraz i oferuje im panoramiczny widok na miasto.'),
(16, 'Najstarsza linia metra: Londyńskie metro, znane jako \"The Tube,\" otwarto w 1863 roku. To jedna z najstarszych linii metra na świecie.'),
(17, 'Pierwszy autobus elektryczny: Pierwszy autobus elektryczny pojawił się w Londynie w 1882 roku. Był to pojazd o nazwie \"Elektromote\" i zasilał go prąd z trakcji napowietrznej.'),
(18, 'Największy terminal autobusowy: Terminal autobusowy \"Durgam Cheruvu\" w Hajdarabadzie, w Indiach, jest uważany za największy na świecie i może obsłużyć ponad 1 500 autobusów naraz.'),
(19, 'Najdłuższa trasa tramwajowa: Tramwaj numer 11 w Melbourne, Australii, obsługuje trasę liczącą ponad 60 kilometrów.'),
(20, 'Największa liczba przewożonych pasażerów: Tokijska linia kolejowa Yamanote to jedna z najbardziej ruchliwych na świecie. Codziennie przewozi ona ponad 3,6 miliona pasażerów.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `type` enum('Bus','Tram','Metro','Train') DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `country_of_origin` varchar(255) DEFAULT NULL,
  `production_year` int(11) DEFAULT NULL,
  `engine_type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `type`, `name`, `country_of_origin`, `production_year`, `engine_type`, `description`, `city`) VALUES
(1, 'Bus', 'Solaris Urbino 18', 'Polska', 2014, 'Spalinowy, Hybrydowy, Elektryczny, Wodorowy', 'Solaris Urbino 18 to duży autobus miejski produkowany przez Solaris Bus & Coach z Polski, \r\n            oferujący dużą pojemność i dostępny w różnych wariantach napędu, w tym spalinowym,  \r\n            hybrydowym i elektrycznym. Posiada komfortowe wnętrze i jest stosowany w miastach do  \r\n            obsługi ruchliwych tras miejskich i podmiejskich.', 'Poznań'),
(2, 'Bus', 'Solaris Urbino 12', 'Polska', 2014, 'Spalinowy, Hybrydowy, Elektryczny, Wodorowy', 'Solaris Urbino 12 to średniej wielkości autobus miejski produkowany przez firmę Solaris Bus\r\n            & Coach z Polski. Jest dostępny w różnych wariantach napędu, w tym spalinowym, \r\n            hybrydowym i elektrycznym, co czyni go ekologicznym rozwiązaniem. Autobus ten jest \r\n            zaprojektowany z myślą o komforcie pasażerów, oferując klimatyzację i nowoczesny design \r\n            wnętrza. Jest popularnym wyborem dla miast, które dążą do poprawy transportu \r\n            publicznego i zmniejszenia emisji spalin.', 'Warszawa'),
(3, 'Bus', 'Man Lion\'s City G', 'Niemcy', 2008, 'Spalinowy, Hybrydowy', 'MAN Lion\'s City G to rodzina autobusów przegubowych produkowanych przez niemieckiego \r\n            producenta MAN Truck & Bus. Są to duże i przegubowe autobusy miejskie, które oferują \r\n            dużą pojemność pasażerów. Warianty Lion\'s City G mogą być dostępne z różnymi rodzajami \r\n            napędu, w tym spalinowym lub hybrydowym. Są wyposażone w nowoczesne udogodnienia,  \r\n            takie jak klimatyzacja i ergonomiczne wnętrze, zapewniając komfort pasażerom. Autobusy  \r\n            Lion\'s City G często obsługują linie komunikacji publicznej w miastach na całym świecie.', 'Olsztyn'),
(4, 'Bus', 'Mercedes-Benz CapaCity', 'Niemcy', 2015, 'Spalinowy, Hybrydowy, Elektryczny', 'Mercedes-Benz Capacity to rodzina autobusów przegubowych produkowanych przez \r\n            niemieckiego producenta Mercedes-Benz. Są to przegubowe autobusy miejskie, które \r\n            charakteryzują się dużą pojemnością pasażerów. Autobusy Capacity są używane w miastach \r\n            do obsługi ruchliwych tras miejskich i oferują komfortowe wnętrze oraz różne warianty \r\n            napędu, w tym spalinowy i hybrydowy. To popularny wybór w transporcie publicznym w \r\n            miastach na całym świecie.', 'Katowice'),
(5, 'Bus', 'Solaris Trollino', 'Polska', 2018, 'Elektryczny(Sieć trakcyjna)', 'Solaris Trollino to rodzina trolejbusów produkowanych przez polskiego producenta Solaris \r\n            Bus & Coach. Są to pojazdy elektryczne zasilane z linii trakcyjnej lub za pomocą \r\n            akumulatorów. Trollino jest ekologicznym środkiem transportu miejskiego, który nie emituje  \r\n            spalin, co przyczynia się do ochrony środowiska. Trolejbusy Solaris Trollino są  \r\n            wykorzystywane w miastach na całym świecie jako część systemów transportu publicznego.', 'Gdynia'),
(6, 'Bus', 'Volvo 7700', 'Szwecja', 2010, 'Spalinowy, Hybrydowy, Elektryczny', 'Volvo 7700 to model autobusu produkowanego przez szwedzkiego producenta pojazdów Volvo Group. Jest to autobus miejski, który charakteryzuje się nowoczesnym designem, przestronnym wnętrzem i zaawansowanymi rozwiązaniami technologicznymi. Autobus ten jest dostępny w różnych wersjach, w tym wariantach napędowych i konfiguracjach siedzeń, co pozwala na dostosowanie go do różnych potrzeb i warunków transportu publicznego. Volvo 7700 to pojazd, który łączy w sobie komfort podróży i dbałość o środowisko, ponieważ jest dostępny w wersji z napędem hybrydowym lub elektrycznym, co sprawia, że jest przyjazny dla środowiska.', 'Olsztyn'),
(7, 'Bus', 'Volvo 7900', 'Szwecja', 2018, 'Spalinowy, Gazowy, Elektryczny,  Hybrydowym', 'Volvo 7900 to nowoczesny autobus miejski produkowany przez firmę Volvo Group. Jest to pojazd z zaawansowanymi technologiami, charakteryzujący się wygodnym wnętrzem i różnymi opcjami konfiguracyjnymi. Volvo 7900 jest dostępny w wersjach z napędem elektrycznym, co czyni go ekologicznym rozwiązaniem transportowym dla miast.', 'Łódź'),
(8, 'Bus', 'Mercedes-Benz Citaro', 'Niemcy', 2020, 'Spalinowy, Hybrydowy, Elektryczny', 'Mercedes-Benz Citaro to popularny autobus miejski produkowany przez niemieckiego  \r\n            producenta Mercedes-Benz. Oferuje różne warianty napędu, w tym spalinowe, hybrydowe i  \r\n            elektryczne. Ten autobus jest stosowany w miastach na całym świecie i jest znany z  \r\n            wydajności, komfortu i nowoczesnego designu wnętrza.', 'Wrocław'),
(9, 'Bus', 'Scania Omnilink', 'Szwecja', 2010, 'Spalinowy, Hybrydowy', 'Scania Omnilink to autobus produkowany przez szwedzką firmę Scania. Jest to model  \r\n            autobusu miejskiego wyposażonego w różne warianty napędu, w tym spalinowy i hybrydowy.  \r\n            Scania Omnilink jest stosowana w miastach i obszarach miejskich do transportu  \r\n            publicznego. To popularny wybór ze względu na swoją niezawodność i efektywność.', 'Olsztyn'),
(10, 'Tram', 'Hyundai Rotem 140N', 'Korea Południowa', 2020, 'Elektryczny(Sieć trakcyjna)', 'Hyundai Rotem 140N to wieloczłonowy tramwaj niskopodłogowy produkowany od 2020 roku przez Hyundai Rotem w Changwon, Korei Południowej. Tramwaje te zostały zakupione przez Tramwaje Warszawskie w Polsce. Mają 5 członów, długość wynoszącą 32,9 metra, a ich maksymalna prędkość to 70 km/h. Wnętrze tramwaju oferuje 31 miejsc siedzących i 100% niskopodłogowości. Pierwsze dwa wagony tego typu dotarły do Warszawy w czerwcu 2021, a ich premierowa jazda z pasażerami miała miejsce we wrześniu 2021.', 'Warszawa'),
(11, 'Tram', 'Solaris Tramino', 'Polska', 2015, 'Elektryczny(Sieć trakcyjna)', 'Solaris Tramino to rodzina niskopodłogowych tramwajów produkowanych przez polskiego producenta Solaris Bus & Coach. Są one przegubowe, co zwiększa pojemność przewozową. Tramwaje te mają nowoczesny design, są wygodne dla pasażerów i często dostępne w wariantach elektrycznych, co jest przyjazne dla środowiska. Służą do transportu publicznego w miastach na całym świecie.', 'Olsztyn'),
(12, 'Tram', 'Moderus Gamma', 'Polska', 2016, 'Elektryczny(Sieć trakcyjna)', 'Moderus Gamma to rodzina tramwajów niskopodłogowych produkowanych przez polskiego producenta Modertrans. Te tramwaje są zaprojektowane z myślą o ruchu miejskim i regionalnym, oferując wysoki poziom niskopodłogowości, co ułatwia wsiadanie i wysiadanie pasażerom, w tym osobom niepełnosprawnym. Gamma to rodzina pojazdów, która może być dostosowana do różnych potrzeb przewoźników i miast. Moderus Gamma jest popularnym modelem tramwaju w Polsce i innych krajach, pomagając poprawić jakość transportu publicznego oraz przyczyniając się do zrównoważonego transportu miejskiego.', 'Poznań'),
(13, 'Tram', 'Pesa Swing', 'Polska', 2011, 'Elektryczny(Sieć trakcyjna)', 'PESA Swing to rodzina tramwajów niskopodłogowych produkowanych przez polską firmę PESA Bydgoszcz S.A. Tramwaje PESA Swing są przeznaczone do przewozu pasażerów w ruchu miejskim i regionalnym. Charakteryzują się niskim poziomem podłogi, co ułatwia wsiadanie i wysiadanie pasażerom, w tym osobom niepełnosprawnym.\r\n\r\nPESA Swing jest dostępna w różnych wariantach i konfiguracjach, w zależności od potrzeb przewoźników i miast. Tramwaje te cechuje nowoczesny design, wygodne wnętrze, a także różne rozwiązania techniczne, takie jak systemy informacji pasażerskiej czy systemy monitoringu.\r\n\r\nSwing to popularny model tramwaju, który jest wykorzystywany w różnych miastach w Polsce i innych krajach, przyczyniając się do poprawy jakości transportu publicznego i zrównoważonego transportu miejskiego.', 'Wrocław'),
(14, 'Tram', 'Pesa Twist', 'Polska', 2014, 'Elektryczny(Sieć trakcyjna)', 'PESA Twist to rodzina tramwajów niskopodłogowych produkowanych przez polską firmę PESA Bydgoszcz S.A. Tramwaje PESA Twist są przeznaczone do ruchu miejskiego i regionalnego oraz charakteryzują się niskim poziomem podłogi, co ułatwia wsiadanie i wysiadanie pasażerom, w tym osobom niepełnosprawnym.\r\n\r\nTwist to rodzina tramwajów dostępna w różnych wariantach, w tym jedno- i dwuczłonowych. Tramwaje te oferują nowoczesny design i wygodne wnętrze, z dużą przestrzenią dla pasażerów. Są wyposażone w systemy informacji pasażerskiej, monitoring oraz inne rozwiązania techniczne, które poprawiają komfort podróżowania.\r\n\r\nPESA Twist to popularny model tramwaju, który jest wykorzystywany w różnych miastach w Polsce i poza nią. Pomaga poprawić jakość transportu publicznego i zrównoważonego transportu miejskiego, przyczyniając się do ułatwienia dostępu do komunikacji publicznej dla mieszkańców i turystów.', 'Kraków'),
(15, 'Tram', 'Durmazlar Panorama', 'Turcja', 2020, 'Elektryczny(Sieć trakcyjna)', 'Durmazlar Panorama to rodzina tramwajów produkowanych przez turecką firmę Durmazlar. Tramwaje Durmazlar Panorama są niskopodłogowe i zaprojektowane z myślą o przewozie pasażerów w ruchu miejskim. Charakteryzują się nowoczesnym designem, wygodnym wnętrzem i niskim poziomem podłogi, co ułatwia wsiadanie i wysiadanie pasażerom.\r\n\r\nTramwaje Panorama są dostępne w różnych wariantach i konfiguracjach, umożliwiając przewoźnikom dostosowanie ich do konkretnych potrzeb i wymagań miast. Są wyposażone w systemy informacji pasażerskiej, systemy monitoringu oraz inne techniczne rozwiązania, które poprawiają jakość podróży pasażerów.\r\n\r\nDurmazlar Panorama to popularny model tramwaju, wykorzystywany w różnych miejscach na świecie do poprawy transportu publicznego w miastach i przyczyniający się do zrównoważonego transportu miejskiego.', 'Olsztyn'),
(16, 'Tram', 'Konstal 105Na', 'Polska', 1995, 'Elektryczny(Sieć trakcyjna)', 'Konstal 105Na to rodzina tramwajów wyprodukowanych przez polską firmę Konstal w latach 70. i 80. XX wieku. Tramwaje te były szeroko używane w polskich miastach i innych krajach bloku wschodniego. Charakteryzowały się one charakterystycznym wyglądem, z dwoma charakterystycznymi reflektorami na przodzie i czarnym pasem wokół okien.\r\n\r\nKonstal 105Na były tramwajami niskopodłogowymi i przegubowymi, co oznaczało, że miały niską podłogę i mogły pomieścić większą liczbę pasażerów. Wnętrze tramwajów było wyposażone w drewniane siedzenia i miało klasyczny wygląd charakterystyczny dla tramwajów tamtych lat.\r\n\r\nChociaż Konstal 105Na były popularne w swoim czasie, to obecnie wiele z nich zostało wycofanych z eksploatacji, a wiele miast zmodernizowało swoje floty tramwajowe na bardziej nowoczesne modele. Jednak niektóre tramwaje Konstal 105Na wciąż można spotkać na niektórych liniach tramwajowych w Polsce i innych krajach.', 'Wrocław'),
(17, 'Tram', 'Stadler Variobahn', 'Niemcy', 2000, 'Elektryczny(Sieć trakcyjna)', 'Stadler Variobahn to rodzina tramwajów produkowanych przez szwajcarską firmę Stadler Rail Group. Variobahn to tramwaje niskopodłogowe, które zostały wyprodukowane w różnych wariantach i konfiguracjach, w zależności od potrzeb przewoźników i miast.\r\n\r\nCharakterystyczna cechą tramwajów Stadler Variobahn jest ich niskopodłogowość, co sprawia, że są wygodne dla pasażerów, w tym dla osób niepełnosprawnych oraz rodziców z wózkami dziecięcymi. Tramwaje te często są wyposażone w klimatyzację, systemy informacji pasażerskiej i wiele innych nowoczesnych udogodnień, które poprawiają jakość podróży.\r\n\r\nStadler Variobahn były wykorzystywane w różnych miastach na całym świecie, a firma Stadler jest znana z produkcji tramwajów i innych pojazdów kolejowych o wysokiej jakości. Variobahn przyczyniły się do zmodernizowania transportu publicznego w wielu miejscach i promowania zrównoważonego transportu miejskiego.', 'Londyn'),
(18, 'Tram', 'Moderus Beta', 'Polska', 2011, 'Elektryczny(Sieć trakcyjna)', 'Moderus Beta to rodzina tramwajów niskopodłogowych produkowanych przez polską firmę Modertrans. Tramwaje Moderus Beta są zaprojektowane z myślą o przewozie pasażerów w ruchu miejskim i regionalnym. Charakteryzują się niską podłogą, co ułatwia wsiadanie i wysiadanie pasażerom, w tym osobom niepełnosprawnym.\r\n\r\nModerus Beta jest dostępna w różnych wariantach i konfiguracjach, co pozwala dostosować tramwaje do konkretnych potrzeb przewoźników i miast. Tramwaje te oferują nowoczesny design, wygodne wnętrze i różne rozwiązania techniczne, takie jak systemy informacji pasażerskiej czy monitoring.\r\n\r\nModerus Beta to popularny model tramwaju w Polsce i innych krajach, pomagając poprawić jakość transportu publicznego i zrównoważonego transportu miejskiego.', 'Poznań');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `ciekawostki`
--
ALTER TABLE `ciekawostki`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ciekawostki`
--
ALTER TABLE `ciekawostki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
