<?php
    header('Content-Type: application/json');
    
    require_once './Unirest.php';

    $request = $_GET['request'];
    if(isset($_GET['summonerid']))
        $summonerid = $_GET['summonerid'];
   
    if(isset($_GET['summonername']))
        $summonername = $_GET['summonername'];
    
    if(isset($_GET['teamID']))
        $teamID = $_GET['teamID'];

    $region = $_GET['region'];

    /*
    $request = "name";
    $summonerid = "";
    $summonername = "Noobie3110";
    $region = "euw";
    */
    
    $answer = array();
    
    switch($request)
    {
        case "league":
        {
            $answer['league'] = getLeague($summonerid, $region);
            $answer['image'] = "http://" . $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']) . "/images/ranks/" . $answer['league']['tier'] . "_" .  $answer['league']['rank'] . ".png";
            break;
        }
        case "name":
        {
            $answer['summonerid'] = getName($summonername, $region);
            break;
        }
        case "matchesTeam":
        {
            $matches = getRecentTeamMatches($teamID, $region)->matchHistory;
            
            $c = 0;
            foreach ($matches as $match => $value) {
                $answer['matches']['match' . $c] = $value;
                $c++;
            }

            break;
        }
    }
    
    echo json_encode($answer);
    
    function reciveDataFromTimtastic($reqURL)
    {
        $response = Unirest::get(
        $reqURL,
          array(
            "X-Mashape-Authorization" => "brFC05ade6D2K7h21h5GSpvlJZfCWEvZ"
          )
        );

        return json_decode($response->raw_body);
    }

    function reciveFromRiot($reqURL)
    {
        $api_key = "xxxx-xxxx-xxxx-xxxx-xxxx"; //Add your riot key here, don't have a production key now
        return json_decode(file_get_contents($reqURL . "?api_key=" . $api_key));
    }

    function getRecentTeamMatches($teamID, $region)
    {
        return reciveFromRiot("https://prod.api.pvp.net/api/lol/$region/v2.2/team/$teamID")->$teamID;
    }

    function getLeague($summonerid, $region)
    {
        $response = reciveDataFromTimtastic("https://community-league-of-legends.p.mashape.com/api/v1.0/$region/summoner/getLeagueForPlayer/$summonerid");
        $return = array();
        $return['tier'] = $response->tier;
        $return['rank'] =  $response->requestorsRank;
        $return['text'] = "$response->tier $response->requestorsRank";
        
        return $return;
    }
    
    function getName($summonername, $region)
    {
        $response = reciveDataFromTimtastic("https://community-league-of-legends.p.mashape.com/api/v1.0/$region/summoner/getSummonerByName/$summonername");
        return $response->summonerId;
    }
   
?>