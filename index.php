<!DOCTYPE HTML>
<?php 
//error_reporting(E_ERROR);
$slug = $_GET['team'];
$slug = $slug=="" ? "san-antonio-spurs" : $slug;
$filter = $_POST['filter'];
$filter = $filter==""? "home" : $filter;

$getItems = 200;
$request_url = "http://api.seatgeek.com/2/events?performers.slug={$slug}&per_page={$getItems}&page=1";
$stubhub_url = "http://www.stubhub.com/{$slug}-tickets/";
$string_array = explode("-", $slug);
$short_name = ucfirst($string_array[count($string_array)-1]);

?>
<script type="text/javascript">
    console.log("<?php echo $request_url; ?>");
</script>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo ucwords(str_replace('-', ' ', $slug)); ?> Ticket Stats</title>


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>
    <script type="text/javascript" src="./support/jquery.tablesorter.min.js"></script>

    <!-- Additional files for the Highslide popup effect -->
    <script type="text/javascript" src="./support/highslide-full.min.js"></script>
    <script type="text/javascript" src="./support/highslide.config.js" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="./support/highslide.css" />
    <script src="http://code.highcharts.com/modules/data.js"></script>

    <style>
        .debug {
            font-size: 0.5em;
            color: gray;
        }
        .fixer-container {
            text-align: center;
            margin-top: 20px;
        }
        .adContainer {
            margin-bottom: 20px;
        }

        #stats {
            font-size: 14px; 
            font-family: "Lucida Grande","Lucida Sans Unicode",Arial,Helvetica,sans-serif;
            color: #707070;
            text-align: center;
        }

        #options {
            font-size: 14px; 
            font-family: "Lucida Grande","Lucida Sans Unicode",Arial,Helvetica,sans-serif;
            color: #707070;
            text-align: center;   
            margin-bottom: 10px;  
        }

        #attribution, #attribution a {
            float:right;
            margin-right: 10px;
            color: #909090;
            font-size: 9px;
            font-family: "Lucida Grande","Lucida Sans Unicode",Arial,Helvetica,sans-serif;
            text-decoration: none;
        }

    </style>

    <link rel="stylesheet" type="text/css" href="./support/navstyle.css">
    <link rel="stylesheet" type="text/css" href="./support/tablestyle.css">


</head>

<body>
    <?php $baseURL = "index.php?team="; ?>
    <div class="fixer-container">
        <div id="nav">
            <ul>
                <li><a href="#">NBA</a>
                    <ul>
                        <li><a href="#">Eastern Conference</a>
                            <ul>
                                <li><a href="<?php echo $baseURL; ?>atlanta-hawks">Atlanta Hawks</a></li>
                                <li><a href="<?php echo $baseURL; ?>boston-celtics">Boston Celtics</a></li>
                                <li><a href="<?php echo $baseURL; ?>brooklyn-nets">Brooklyn Nets</a></li>
                                <li><a href="<?php echo $baseURL; ?>charlotte-hornets">Charlotte Hornets</a></li>
                                <li><a href="<?php echo $baseURL; ?>chicago-bulls">Chicago Bulls</a></li>
                                <li><a href="<?php echo $baseURL; ?>cleveland-cavaliers">Cleveland Cavaliers</a></li>
                                <li><a href="<?php echo $baseURL; ?>detroit-pistons">Detroit Pistons</a></li>
                                <li><a href="<?php echo $baseURL; ?>indiana-pacers">Indiana Pacers</a></li>
                                <li><a href="<?php echo $baseURL; ?>miami-heat">Miami Heat</a></li>
                                <li><a href="<?php echo $baseURL; ?>milwaukee-bucks">Milwaukee Bucks</a></li>
                                <li><a href="<?php echo $baseURL; ?>new-york-knicks">New York Knicks</a></li>
                                <li><a href="<?php echo $baseURL; ?>orlando-magic">Orlando Magic</a></li>
                                <li><a href="<?php echo $baseURL; ?>philadelphia-76ers">Philadelphia 76ers</a></li>
                                <li><a href="<?php echo $baseURL; ?>toronto-raptors">Toronto Raptors</a></li>
                                <li><a href="<?php echo $baseURL; ?>washington-wizards">Washington Wizards</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Western Conference</a>
                            <ul>
                                <li><a href="<?php echo $baseURL; ?>dallas-mavericks">Dallas Mavericks</a></li>
                                <li><a href="<?php echo $baseURL; ?>denver-nuggets">Denver Nuggets</a></li>
                                <li><a href="<?php echo $baseURL; ?>golden-state-warriors">Golden State Warriors</a></li>
                                <li><a href="<?php echo $baseURL; ?>houston-rockets">Houston Rockets</a></li>
                                <li><a href="<?php echo $baseURL; ?>los-angeles-clippers">Los Angeles Clippers</a></li>
                                <li><a href="<?php echo $baseURL; ?>los-angeles-lakers">Los Angeles Lakers</a></li>
                                <li><a href="<?php echo $baseURL; ?>memphis-grizzlies">Memphis Grizzlies</a></li>
                                <li><a href="<?php echo $baseURL; ?>minnesota-timberwolves">Minnesota Timberwolves</a></li>
                                <li><a href="<?php echo $baseURL; ?>new-orleans-pelicans">New Orleans Pelicans</a></li>
                                <li><a href="<?php echo $baseURL; ?>oklahoma-city-thunder">Oklahoma City Thunder</a></li>
                                <li><a href="<?php echo $baseURL; ?>phoenix-suns">Phoenix Suns</a></li>
                                <li><a href="<?php echo $baseURL; ?>portland-trail-blazers">Portland Trail Blazers</a></li>
                                <li><a href="<?php echo $baseURL; ?>sacramento-kings">Sacramento Kings</a></li>
                                <li><a href="<?php echo $baseURL; ?>san-antonio-spurs">San Antonio Spurs</a></li>
                                <li><a href="<?php echo $baseURL; ?>utah-jazz">Utah Jazz</a></li>
                            </ul>
                        </li>
                        
                    </ul>

                </li>
                <li><a href="#">NFL</a>
                    <ul>                        
                        <li><a href="#">American Conference</a>
                            <ul>
                                <li><a href="<?php echo $baseURL; ?>baltimore-ravens">Baltimore Ravens</a></li>
                                <li><a href="<?php echo $baseURL; ?>buffalo-bills">Buffalo Bills</a></li>
                                <li><a href="<?php echo $baseURL; ?>cincinnati-bengals">Cincinnati Bengals</a></li>
                                <li><a href="<?php echo $baseURL; ?>cleveland-browns">Cleveland Browns</a></li>
                                <li><a href="<?php echo $baseURL; ?>denver-broncos">Denver Broncos</a></li>
                                <li><a href="<?php echo $baseURL; ?>houston-texans">Houston Texans</a></li>
                                <li><a href="<?php echo $baseURL; ?>indianapolis-colts">Indianapolis Colts</a></li>
                                <li><a href="<?php echo $baseURL; ?>jacksonville-jaguars">Jacksonville Jaguars</a></li>
                                <li><a href="<?php echo $baseURL; ?>kansas-city-chiefs">Kansas City Chiefs</a></li>                                
                                <li><a href="<?php echo $baseURL; ?>miami-dolphins">Miami Dolphins</a></li>
                                <li><a href="<?php echo $baseURL; ?>new-england-patriots">New England Patriots</a></li>
                                <li><a href="<?php echo $baseURL; ?>new-york-jets">New York Jets</a></li>
                                <li><a href="<?php echo $baseURL; ?>oakland-raiders">Oakland Raiders</a></li>
                                <li><a href="<?php echo $baseURL; ?>pittsburgh-steelers">Pittsburgh Steelers</a></li>
                                <li><a href="<?php echo $baseURL; ?>san-diego-chargers">San Diego Chargers</a></li>
                                <li><a href="<?php echo $baseURL; ?>tennessee-titans">Tennessee Titans</a></li>
                            </ul>
                        </li>
                        <li><a href="#">National Conference</a>
                            <ul>
                                <li><a href="<?php echo $baseURL; ?>arizona-cardinals">Arizona Cardinals</a></li>
                                <li><a href="<?php echo $baseURL; ?>atlanta-falcons">Atlanta Falcons</a></li>
                                <li><a href="<?php echo $baseURL; ?>carolina-panthers">Carolina Panthers</a></li>
                                <li><a href="<?php echo $baseURL; ?>chicago-bears">Chicago Bears</a></li>
                                <li><a href="<?php echo $baseURL; ?>dallas-cowboys">Dallas Cowboys</a></li>
                                <li><a href="<?php echo $baseURL; ?>detroit-lions">Detroit Lions</a></li>
                                <li><a href="<?php echo $baseURL; ?>green-bay-packers">Green Bay Packers</a></li>
                                <li><a href="<?php echo $baseURL; ?>minnesota-vikings">Minnesota Vikings</a></li>
                                <li><a href="<?php echo $baseURL; ?>new-orleans-saints">New Orleans Saints</a></li>
                                <li><a href="<?php echo $baseURL; ?>new-york-giants">New York Giants</a></li>
                                <li><a href="<?php echo $baseURL; ?>philadelphia-eagles">Philadelphi Eagles</a></li>
                                <li><a href="<?php echo $baseURL; ?>san-francisco-49ers">San Francisco 49ers</a></li>
                                <li><a href="<?php echo $baseURL; ?>seattle-seahawks">Seattle Seahawks</a></li>
                                <li><a href="<?php echo $baseURL; ?>st-louis-rams">St Louis Rams</a></li>
                                <li><a href="<?php echo $baseURL; ?>tampa-bay-buccaneers">Tampa Bay Buccaneers</a></li>
                                <li><a href="<?php echo $baseURL; ?>washington-redskins">Washington Redskins</a></li>
                            </ul>
                        </li>
                    </ul>

                </li>
                <li><a href="#">MLB</a>
                    <ul>                        
                        <li><a href="#">American League</a>
                            <ul>
                                <li><a href="<?php echo $baseURL; ?>baltimore-orioles">Baltimore Orioles</a></li>
                                <li><a href="<?php echo $baseURL; ?>boston-red-sox">Boston Red Sox</a></li>
                                <li><a href="<?php echo $baseURL; ?>chicago-white-sox">Chicago White Sox</a></li>
                                <li><a href="<?php echo $baseURL; ?>cleveland-indians">Cleveland Indians</a></li>
                                <li><a href="<?php echo $baseURL; ?>detroit-tigers">Detroit Tigers</a></li>
                                <li><a href="<?php echo $baseURL; ?>houston-astros">Houston Astros</a></li>
                                <li><a href="<?php echo $baseURL; ?>kansas-city-royals">Kansas City Royals</a></li>
                                <li><a href="<?php echo $baseURL; ?>los-angeles-angels">Los Angeles Angels</a></li>
                                <li><a href="<?php echo $baseURL; ?>minnesota-twins">Minnesota Twins</a></li>
                                <li><a href="<?php echo $baseURL; ?>new-york-yankees">New York Yankees</a></li>
                                <li><a href="<?php echo $baseURL; ?>oakland-athletics">Oakland Athletics</a></li>
                                <li><a href="<?php echo $baseURL; ?>seattle-mariners">Seattle Mariners</a></li>
                                <li><a href="<?php echo $baseURL; ?>tampa-bay-rays">Tampa Bay Rays</a></li>
                                <li><a href="<?php echo $baseURL; ?>texas-rangers">Texas Rangers</a></li>
                                <li><a href="<?php echo $baseURL; ?>toronto-blue-jays">Toronto Blue Jays</a></li>
                            </ul>
                        </li>
                        <li><a href="#">National League</a>
                            <ul>
                                <li><a href="<?php echo $baseURL; ?>arizona-diamondbacks">Arizona Diamondbacks</a></li>
                                <li><a href="<?php echo $baseURL; ?>atlanta-braves">Atlanta Braves</a></li>
                                <li><a href="<?php echo $baseURL; ?>chicago-cubs">Chicago Cubs</a></li>
                                <li><a href="<?php echo $baseURL; ?>cincinnati-reds">Cincinnati Reds</a></li>
                                <li><a href="<?php echo $baseURL; ?>colorado-rockies">Colorado Rockies</a></li>
                                <li><a href="<?php echo $baseURL; ?>los-angeles-dodgers">Los Angeles Dodgers</a></li>
                                <li><a href="<?php echo $baseURL; ?>miami-marlins">Miami Marlins</a></li>
                                <li><a href="<?php echo $baseURL; ?>milwaukee-brewers">Milwaukee Brewers</a></li>
                                <li><a href="<?php echo $baseURL; ?>new-york-mets">New York Mets</a></li>
                                <li><a href="<?php echo $baseURL; ?>pittsburgh-pirates">Pittsburgh Pirates</a></li>
                                <li><a href="<?php echo $baseURL; ?>philadelphia-phillies">Philadelphia Phillies</a></li>
                                <li><a href="<?php echo $baseURL; ?>san-diego-padres">San Diego Padres</a></li>
                                <li><a href="<?php echo $baseURL; ?>san-francisco-giants">San Francisco Giants</a></li>
                                <li><a href="<?php echo $baseURL; ?>st-louis-cardinals">St Louis Cardinals</a></li>
                                <li><a href="<?php echo $baseURL; ?>washington-nationals">Washington Nationals</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="#">NHL</a>
                    <ul>                        
                        <li><a href="#">Eastern Conference</a>
                            <ul>
                                <li><a href="<?php echo $baseURL; ?>atlanta-thrashers">Atlanta Thrashers</a></li>
                                <li><a href="<?php echo $baseURL; ?>boston-bruins">Boston Bruins</a></li>
                                <li><a href="<?php echo $baseURL; ?>buffalo-sabres">Buffalo Sabres</a></li>
                                <li><a href="<?php echo $baseURL; ?>carolina-hurricanes">Carolina Hurricanes</a></li>
                                <li><a href="<?php echo $baseURL; ?>florida-panthers">Florida Panthers</a></li>
                                <li><a href="<?php echo $baseURL; ?>montreal-canadiens">Montreal Canadiens</a></li>
                                <li><a href="<?php echo $baseURL; ?>new-jersey-devils">New Jersey Devils</a></li>
                                <li><a href="<?php echo $baseURL; ?>new-york-islanders">New York Islanders</a></li>
                                <li><a href="<?php echo $baseURL; ?>new-york-rangers">New York Rangers</a></li>
                                <li><a href="<?php echo $baseURL; ?>ottawa-senators">Ottawa Senators</a></li>
                                <li><a href="<?php echo $baseURL; ?>philadelphia-flyers">Philadelphia Flyers</a></li>
                                <li><a href="<?php echo $baseURL; ?>pittsburgh-penguins">Pittsburgh Penguins</a></li>
                                <li><a href="<?php echo $baseURL; ?>tampa-bay-lightning">Tampa Bay Lightning</a></li>
                                <li><a href="<?php echo $baseURL; ?>toronto-maple-leafs">Toronto Maple Leafs</a></li>
                                <li><a href="<?php echo $baseURL; ?>washington-capitals">Washington Capitals</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Western Conference</a>
                            <ul>
                                <li><a href="<?php echo $baseURL; ?>anaheim-ducks">Anaheim Ducks</a></li>
                                <li><a href="<?php echo $baseURL; ?>calgary-flames">Calgary Flames</a></li>
                                <li><a href="<?php echo $baseURL; ?>chicago-blackhawks">Chicago Blackhawks</a></li>
                                <li><a href="<?php echo $baseURL; ?>colorado-avalanche">Colorado Avalanche</a></li>
                                <li><a href="<?php echo $baseURL; ?>columbus-blue-jackets">Columbus Blue Jackets</a></li>
                                <li><a href="<?php echo $baseURL; ?>dallas-stars">Dallas Stars</a></li>
                                <li><a href="<?php echo $baseURL; ?>edmonto-oilers">Edmonton Oilers</a></li>
                                <li><a href="<?php echo $baseURL; ?>detroit-red-wings">Detroit Red Wings</a></li>
                                <li><a href="<?php echo $baseURL; ?>los-angeles-kings">Los Angeles Kings</a></li>
                                <li><a href="<?php echo $baseURL; ?>minnesota-wild">Minnesota Wild</a></li>
                                <li><a href="<?php echo $baseURL; ?>nashville-predators">Nashville Predators</a></li>
                                <li><a href="<?php echo $baseURL; ?>phoenix-coyotes">Phoenix Coyotes</a></li>
                                <li><a href="<?php echo $baseURL; ?>san-jose-sharks">San Jose Sharks</a></li>
                                <li><a href="<?php echo $baseURL; ?>st-louis-blues">St Louis Blues</a></li>
                                <li><a href="<?php echo $baseURL; ?>vancouver-canucks">Vancouver Canucks</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div style="clear:both;"></div>

    <br/>
    <div id="options">
    <form method="POST">
        <input type="radio" name="filter" value="home" <?php echo ($filter == "home") ? "checked":""; ?>>Home
        <input type="radio" name="filter" value="away" <?php echo ($filter == "away") ? "checked":""; ?>>Away
        <input type="radio" name="filter" value="both" <?php echo ($filter == "both") ? "checked":""; ?>>Both
        &nbsp;&nbsp;<input type="submit" value="Update">
    </form> 
    </div>

    <div id="container" style="min-width: 600px; height: 450px; margin: 0 auto;"></div>



    <?php
    require_once "support/simple_html_dom.php";

    $html = new simple_html_dom();

    /* start spoofing */
    $randomIP = rand(1,255).".".rand(1,255).".".rand(1,255).".".rand(1,255);
    $opts = array('http' =>
    array(
        'method'  => "GET",
        'header' => "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8\r\n".
                    "Cache-Control:no-cache\r\n".
                    "User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36\r\n".
                    "Cookie:D_SID={$randomIP}:ZWMDctTRT/qbK5R9TSnn0kqMSPBdpkYNCCeCPAsZ4a4; D_PID=469F0452-18FF-3E05-8072-566D9785BE96; D_IID=BC4AEFAA-16B0-3504-B354-AC5A44AEB34A; D_UID=FE35D56B-5495-3098-8A35-EC9F9EE88A87; D_HID=L/0EdhGO/FxS+Ip5dtWrkVUSMzOSznyq//Ffp/B4qqI; TLTHID=56BB0EC6F53810F502B4F76C8F03399D; TLTSID=56BB0EC6F53810F502B4F76C8F03399D; DC=origin15\r\n"
        )
    );
    /* end spoofing */

    $context = stream_context_create($opts);
    $response = file_get_contents($stubhub_url, false, $context);
    
    $html->load($response);
    $rows = $html->find("table[id^=tbl]");  // selects the team schedule table

    $html->load($rows[0]->innertext);
    $rows = $html->find("a");

    $stubhubData = array();
    $pattern = '/(?P<baseurl>\S+)\-(?P<date>\d{1,2}\-\d{1,2}\-\d{4})\-(?P<eid>\d+)/';
    foreach ($rows as $row)
    {
        if ((strpos($row->href,'parking') === false) && (strpos($row->href,'package') === false)) {            
            if (preg_match($pattern, $row->href, $matches)) {
                $stubhubData[$matches['eid']] = array("url" => $row->href, "date" => $matches['date']);
            }
        }
    }
    $html->clear(); 
    unset($html);

    $response = file_get_contents($request_url);
    $response = json_decode($response);

    if (isset($response->{'error'}) || property_exists($response, 'error')) {
      echo 'Error';

  } else {

      $priceSeries = "";
      $countSeries = "";
      $gameCount = 0;
      $sumForAvg = 0;
      foreach ($response->{'events'} as $event) {

        $filterSkip = false;

        foreach ($event->{'performers'} as $performer) {
            if ($performer->{'away_team'}) {
                $away_team = $performer->{'short_name'};
                $away_img = $performer->{'images'}->{'medium'};
                $away_slug = $performer->{'slug'};
                if (($away_slug == $slug) && ($filter == "home")) {
                    $filterSkip = true;
                    continue;
                }
            } else {
                $home_team = $performer->{'short_name'};
                $home_img = $performer->{'images'}->{'medium'};
                $home_slug = $performer->{'slug'};
                if (($home_slug == $slug) && ($filter == "away")) {
                    $filterSkip = true;
                    continue;
                }
            }
        }

        if ($filterSkip) { 
            continue;
        }
        if ($home_slug == $slug) {
            $saveEvent['versus'] = $away_team;
        } else {
            $saveEvent['versus'] = $home_team;
        }

        $date_array = date_parse($event->{'datetime_local'});
        $date_string = $date_array['year'].", ".strval($date_array['month']-1).", ".$date_array['day'];
        $date = $event->{'datetime_local'};
        $my_date = date('Y, m, d', strtotime($date));

        $saveEvent['date'] = date('Y-m-d (D)' ,strtotime($date));
        $saveEvent['rawdate'] = date('n-j-Y' ,strtotime($date));
        $event_price = $event->{'stats'}->{'average_price'};
        $event_count = $event->{'stats'}->{'listing_count'};

        $saveEvent['avg_price'] = $event_price;
        $saveEvent['listing_count'] = $event_count;
        $saveEvent['title'] = $event->{'title'};
        $saveEvent['url'] = htmlspecialchars($event->{'url'});

        $prefixData = "{name:'<b>".date('D, M d' ,strtotime($date))."</b><br/><b>".htmlspecialchars($event->{'short_title'}).
                    "</b>', x:Date.UTC(".$date_string."), ";
        $suffixData = "cTitle:'".htmlspecialchars($event->{'title'})."', ".
        "cUrl:'".htmlspecialchars($event->{'url'})."', ".
        "cLocTime:'".date('l gA - M, d, Y', strtotime($event->{'datetime_local'}))."', ".
        'cVenue:"'.htmlspecialchars($event->{'venue'}->{'name'}).'", '.
        "cLocation:'".htmlspecialchars($event->{'venue'}->{'display_location'})."', ".
        "cCount:'".$event_count."', ".
        "cAvg:'".$event_price."', ".
        "cLow:'".$event->{'stats'}->{'lowest_price'}."', ".
        "cHigh:'".$event->{'stats'}->{'highest_price'}."', ".
        "cHomeImg:'".htmlspecialchars($home_img)."', ".
        "cAwayImg:'".htmlspecialchars($away_img)."', ".
        "cShUrl:'".htmlspecialchars(getStubhubStats($saveEvent['rawdate'], $stubhubData))."' }, ";

        $saveEvent['venue'] = htmlspecialchars($event->{'venue'}->{'name'});
        $saveEvent['lowest_price'] = $event->{'stats'}->{'lowest_price'};
        $saveEvent['highest_price'] = $event->{'stats'}->{'highest_price'};

        $gameCount = $gameCount + 1;
        $sumForAvgPrice = $sumForAvgPrice + $event_price;
        $sumForAvgAvail = $sumForAvgAvail + $event_count;

        if (!$event_price) {
            $event_price = '0';
        }        
        if (!$event_count) {
            $event_count = '0';
        }
        $priceSeries .= $prefixData."y:".$event_price.", ".$suffixData;
        $countSeries .= $prefixData."y:".$event_count.", ".$suffixData;

        $listOfEvents[] = $saveEvent;
    }
    $priceSeries = rtrim($priceSeries, ",");
    $countSeries = rtrim($countSeries, ",");

    if ($gameCount == 0) {
    	$avgPrice = "NA";
    	$avgAvail = "NA";
    } else {
	    $avgPrice = $sumForAvgPrice/$gameCount;
	    $avgAvail = $sumForAvgAvail/$gameCount;
	}

    echo "<div id='stats'>Total games: <b>{$gameCount}</b><br/>";
    echo "Average ticket price per game: <b>\$".number_format($avgPrice, 0)."</b><br/>";
    echo "Average available tickets per game: <b>".number_format($avgAvail, 0)."</b><br/><br/></div>";
}
?>


<table id="myTable" class="tablesorter"> 
<thead> 
<tr> 
    <th class="leftCell">Opponent</th> 
    <th class="leftCell">Venue</th> 
    <th>Date</th> 
    <th>Available Tickets</th>    
    <th>Avg Price</th> 
    <th>% Cost (vs season)</th> 
    <th>Lowest Price</th> 
    <th>Highest Price</th>
    <th>SeatGeek Link</th>
    <th>Stubhub Stats</th>
</tr> 
</thead> 
<tbody> 

<?php
    foreach ($listOfEvents as $listItem) {
        echo '<tr>';
        echo '<td class="leftCell">'.$listItem['versus'].'</td>';
        echo '<td class="leftCell">'.$listItem['venue'].'</td>';
        echo '<td>'.$listItem['date'].'</td>';
        if ($listItem['listing_count'] < $avgAvail) {
            echo '<td style="color:red">'.$listItem['listing_count'].'</td>';
        } elseif ($listItem['listing_count'] > $avgAvail) {
            echo '<td style="color:green">'.$listItem['listing_count'].'</td>';
        } else {
            echo '<td>'.$listItem['listing_count'].'</td>';
        }

        $priceDiff = round(($listItem['avg_price'] - $avgPrice) / $avgPrice * 100, 0);
        if ($priceDiff < 0) {
            echo '<td style="color:red">$'.$listItem['avg_price'].'</td>';
            echo '<td style="color:red">'.$priceDiff.'%</td>';
        } elseif ($priceDiff > 0) {
            echo '<td style="color:green">$'.$listItem['avg_price'].'</td>';
            echo '<td style="color:green">'.$priceDiff.'%</td>';
        } else {
            echo '<td>$'.$listItem['avg_price'].'</td>';
            echo '<td>'.$priceDiff.'%</td>';
        }
        
        echo '<td>$'.$listItem['lowest_price'].'</td>';
        echo '<td>$'.$listItem['highest_price'].'</td>';
        echo '<td><a href="'.$listItem['url'].'" target="_blank">Link</a></td>';
        $eid = getStubhubEventId($listItem['rawdate'], $stubhubData);
        if (!empty($eid)) {
            echo '<td><a href="'.getStubhubStatsWithEid($eid).'" target="_blank" title="If link is NA then try refreshing the page later">Link</a></td>';
        } else {
            echo '<td>NA</td>';
        }
        $eid = null;
        
    }
?>
</tbody> 
</table> 

<text id="attribution">

    <a href="http://tablesorter.com/">Tablesorter.com</a>

</text>
<br/><br/>

<?php 
echo "
        <div class='debug'>{$randomIP}</div>
        <div class='debug'>{$stubhub_url}</div>
    ";
?>

</body>

<script type="text/javascript">

    $(document).ready(function() 
    { 
        $("#myTable").tablesorter( {sortList: [[4,1]]} ); 
    });

    $(function() {

    Highcharts.setOptions({
        global: {
            useUTC: true
        }
    });

    $('#container').highcharts({
        chart: {
            zoomType: 'xy'
        },
        title: {
            text: '<?php echo ucwords(str_replace('-', ' ', $slug)); ?> Ticket Price/Availability'
        },
        subtitle: {
            text: 'Source: seatgeek.com'
        },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: { // don't display the dummy year
                day: '%b %e',
                week: '%b %e'
            },
            title: {
                text: 'Date'
            }
        },
        yAxis: [{
            labels: {
                format: '${value}',
                style: {
                    color: '#ff8000'
                }
            },
            title: {
                text: 'Price',
                style: {
                    color: '#ff8000'
                }
            },
            floor: 0,
            ceiling: 1000
        }, { // Secondary yAxis
            title: {
                text: 'Availability',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            labels: {
                format: '{value}',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            opposite: true
        }],
        legend: {
            layout: 'vertical',
            align: 'left',
            x: 120,
            verticalAlign: 'top',
            y: 75,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        plotOptions: {
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function(e) {
                            hs.htmlExpand(null, {
                                pageOrigin: {
                                    x: e.pageX,
                                    y: e.pageY
                                },
                                headingText: this.options.cTitle,
                                maincontentText: 'Location: ' + this.options.cVenue + ' (' + this.options.cLocation + ')<br/>' +
                                    'Local Start Time: ' + this.options.cLocTime + '<br/>' +
                                    '<br/>' +
                                    '<div style="float:right"><img src="' + this.options.cAwayImg + '"/>&nbsp;' +
                                    '<img src="' + this.options.cHomeImg + '"/></div>' +
                                    'Average price: <b>$' + this.options.cAvg + '</b><br/>' +
                                    'Lowest price: <b><span style="color:green">$' + this.options.cLow + '</span></b><br/>' +
                                    'Highest price: <span style="color:red">$' + this.options.cHigh + '</span><br/>' +
                                    'Tickets available: ' + this.options.cCount + '<br/>' +
                                    '<br/>' +
                                    '<a href="' + this.options.cUrl + '" target="_blank">SeatGeek Link</a>&nbsp;&nbsp;' +
                                    '<a href="' + this.options.cShUrl + '" target="_blank">Stubhub Stats</a>',
                                    
                                width: 400
                            });
                        }
                    }
                },
                marker: {
                    lineWidth: 1
                }
            }
        },
        series: [{
            name: 'Availability',
            type: 'area',
            yAxis: 1,
            data: [ <?php echo $countSeries; ?> ],
            marker: {
                enabled: false
            }
        }, {
            name: 'Average Price',
            type: 'line',
            color: '#ff8000',
            pointInterval: 24 * 3600 * 7, // one day
            data: [ <?php echo $priceSeries; ?> ],
            tooltip: {
                valuePrefix: '$'
            }

        }],
        tooltip: {
            animation: false,
            crosshairs: true,
            shared: true
        }
    });
});


</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-6074820-4', 'auto');
  ga('send', 'pageview');

</script>
</html>
<?php 

    function getStubhubEventPage($date, $shData) {
        $eid = getStubhubEventId($date, $shData);
        if ($eid !== null) {
            return $shData[$eid]['url'];
        } else {
            return null;
        }
    }

    function getStubhubStats($date, $shData) {
        $stubhubStatsBaseUrl = '../stubhubvalue/?event=';
        $eid = getStubhubEventId($date, $shData);
        if ($eid !== null) {
            return $stubhubStatsBaseUrl.$eid;
        } else {
            return null;
        }
    }

    function getStubhubStatsWithEid($eid) {
        $stubhubStatsBaseUrl = '../stubhubvalue/?event=';
        return $stubhubStatsBaseUrl.$eid;
    }

    function getStubhubEventId($date, $shData) {
        foreach ($shData as $eid => $event) {
            if ($date === $event['date']) {
                return $eid;
            }
        }
        return null;
    }
?>