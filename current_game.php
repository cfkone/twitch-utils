<?php

define( 'API_ENDPOINT_CHANNELS', 'https://api.twitch.tv/kraken/channels/' );
define( 'API_ENDPOINT_SEARCH_GAMES', 'https://api.twitch.tv/kraken/search/games?' );
define( 'CHANNEL', 'YOURCHANNEL' );


$jsonChannelFile = @file_get_contents( API_ENDPOINT_CHANNELS.CHANNEL );
$jsonChannelObj = json_decode( $jsonChannelFile );

if (is_object($jsonChannelObj) && isset($jsonChannelObj->game)) {
	$gamename = $jsonChannelObj->game;
	$httpParams = array('q' => $gamename, 'type' => 'suggest');
	$httpQuery = http_build_query($httpParams);

	$jsonSearchGamesFile = @file_get_contents( API_ENDPOINT_SEARCH_GAMES.$httpQuery);
	$jsonSearchGamesObj = json_decode( $jsonSearchGamesFile);
	if(is_object($jsonSearchGamesObj) && isset($jsonSearchGamesObj->games)) {
		//print_r($jsonSearchGamesObj);
		echo($jsonSearchGamesObj->games[0]->name);
		// echo($jsonSearchGamesObj->games[0]->box->large);
		printf('<img src="%s"/>', $jsonSearchGamesObj->games[0]->box->large);
	}
}


?>
