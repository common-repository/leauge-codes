=== League Codes ===
Contributors: Kimmax
Donate link: http://goo.gl/u1ikN8
Tags: api, League of legends, statistics, stats, async, summoner, level, information, pretty, lol, division, tier, rank
Requires at least: 2.8.0
Tested up to: 3.9
Stable tag: 0.3.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

League Codes is a plugin that provides information about the League of a summoner with help of the "League of Legends" Mashape API.

== Description ==

League Codes is a plugin that provides information about the League of the requested summoner with help of the "timtastic/League of Legends" Mashape API. The informations will be shown in form of a picture with the according tier descreption + tier level. The plugin will request the information in a method that will not block or increase your page loading speeds. This is done by building the script that requests the information on the server side (The plugin) and including it on the client. The client then executes the request, selects the image, adds the text and shows it to the user.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `LeagueCodes.php`, the `img` folder, as well as the `API` folder to the `/wp-content/plugins/League-codes` directory OR install it via the wordpress plugin menu by searching "League Codes"
2. Activate the plugin through the 'Plugins' menu in WordPress

== How to use the plugin ==
The information can be included everywhere where you can use wordpress shortcuts.
Use them like this:
`[LoL_GetLeague summonername="SummonerName" region="region"]`
Where `summonername` is the name of the summoner you want the information from and `region` is the region the summoner exits at in the following format:

* `NA` for North America 
* `EUW` for EU West 
* `EUNE` for EU Nordic & East 
* `BR` for Brazil 
* `TR` for Turkey 
* `RU` for Russia 
* `LAN` for Latin America North 
* `LAS` for Latin America South 
* `AUS` & NZ for Oceania 

== Frequently Asked Questions ==

= None yet =

== Screenshots ==

1. This screen shot shows an example of the informations requested from the API (screenshot-1.png).
2. This screen shot shows the plugin while loading data. (screenshot-2.png)

== Changelog ==
= 0.3.0 =
* Removed old style property from display (float: left)
* Preparing to switch to Riot Game-API
* Added functionality to load recent matches of a ranked team (API access only, shortcut intregration soon, Riot-Games API key needed! http://developers.riotgames.com -> Replace the xxxx-xxxx-xxxx-* key in API/LeagueAPI.php with your key to use!)

= 0.2.2 =
* Fixed the embarrassing typo "Leauge". I'm sorry ( ._.)
* Region parameter works now
* Fixed another bug that broke async disabler

= 0.2.1 =
* Fixed bug that broke async disabler
* Removed unsused pictures

= 0.2 =
* Script has functionality to disable async requests
* Updated Plugin-URL
* Added Donate Link

= 0.1.1 =
* Added screenshots
* Updated Readme

= 0.1 =
* First Version

== Upgrade Notice ==
= 0.2.2 =
Due to the typo in the plugin name the shortcut has been renamed to `LoL_GetLeague`, however the old `LoL_GetLeauge` will still work for compatibility reasons.
Please update your shortcuts!