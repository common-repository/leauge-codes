<?php
/*
Plugin Name: LeagueCodes
Plugin URI: http://kim-nuernberger.eu/category/code/lolc/
Description: This plugin provides access to stats of "League Of Legends" by using the http://legendaryapi.com - API
Version: 0.3.0
Author: Kim-Maximilian Nürnberger
Author URI: http://kim-nuernberger.eu
License: GPL2

Copyright 2013 Kim-Maximilian Nürnberger (email : contact@kim-nuernberger.eu)

All images included in this plugin are property of Riot Games, Inc.

LeagueCodes isn’t endorsed by Riot Games and doesn’t reflect the views or opinions of Riot Games or anyone officially involved in producing or managing League of Legends. 
League of Legends and Riot Games are trademarks or registered trademarks of Riot Games, Inc. League of Legends © Riot Games, Inc.

Riot Games, League of Legends and PvP.net are trademarks, 
services marks, or registered trademarks of Riot Games, Inc.

Note that additional using licenses are needed if you want to sell this programm, however generating ad revenue is okay.
For more infos see the Riot Games guidelines on http://www.riotgames.com/legal-jibber-jabber

This plugin uses the http://legendaryapi.com - API to get its data.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
    wp_enqueue_script('jquery');
    $counter = 0;

    function getLeagueShortcut($atts)
    {
        extract(shortcode_atts(array(
            'summonername' => 'Noobie3110',
            'region' => 'euw',
            'async' => "true"
        ), $atts));
    
        global $counter;
        
        $summonerid = json_decode(file_get_contents(plugin_dir_url(__FILE__) . "/API/LeagueAPI.php?request=name&summonername=$summonername&region=$region"))->summonerid;
        $identifer = $summonerid . "C$counter";
        $return = "";

        if($async == "true")
        {
            $script = 
                "<script id=\"summonerScript$identifer\" type=\"text/javascript\">
                    jQuery.get(\"" . plugin_dir_url(__FILE__) . "API/LeagueAPI.php\", { request: \"league\", summonerid: \"$summonerid\", region: \"$region\" })
                    .done( function(data)
                    {
                        jQuery(\"#summonerStat$identifer\").css({\"width\" : \"192px\"});
                        jQuery(\"<img src=\\\"\" + data[\"image\"] + \"\\\" />\").insertBefore(\"#summonerStatText$identifer\");
                        jQuery(\"#summonerStatText$identifer\").text(data[\"league\"][\"text\"]);
                        jQuery(\"#summonerStatText$identifer\").css({\"margin-top\" : \"-20px\", \"text-align\" : \"center\" });
                        jQuery(\"#summonerStatLoadingPlaceholder$identifer\").remove();
                        jQuery(\"#summonerScript$identifer\").remove();
                    });
                </script>";
        
            $loadingGif =  "<img id=\"spinner$identifer\" style=\"float: left;\" src=\"" . plugin_dir_url(__FILE__) . "img/loading.gif\" />";
            $loadingPlaceholder = "<div id=\"summonerStatLoadingPlaceholder$identifer\" style=\"width: 150px; margin-left: auto; margin-right: auto;\">$loadingGif Loading..</div>";
            $resultHolder = "<div id=\"summonerStat$identifer\"><p id=\"summonerStatText$identifer\">$loadingPlaceholder</p></div>";
            $return = $script . $resultHolder;
        }else{
            $summonerinfo = json_decode(file_get_contents(plugin_dir_url(__FILE__) . "/API/LeagueAPI.php?request=league&summonerid=$summonerid&region=$region"));
            $summonerLeague = $summonerinfo->league;
            $output = "<div id=\"summonerStat$identifer\" style=\"width: 192px;\">
                            <img src=\"$summonerinfo->image\" />
                            <p id=\"summonerStatText$identifer\" style=\"margin-top: -20px; text-align: center;\">$summonerLeague->text</p>
                        </div>";
            $return = $output; 
        }
        
        $counter++;
        return $return;
    }
    
    //Add Shortcuts
    add_shortcode('LoL_GetLeague', 'getLeagueShortcut');
    add_shortcode('LoL_GetLeauge', 'getLeagueShortcut');
?>