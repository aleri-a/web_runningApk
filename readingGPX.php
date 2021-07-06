<?php
require 'vendor/autoload.php';
use phpGPX\phpGPX;

$gpx = new phpGPX();
	
$file = $gpx->load('valentina1.gpx');
	
foreach ($file->tracks as $track)
{
    // Statistics for whole track
    //print_r($track->stats->toArray());
    
    foreach ($track->segments as $segment)
    {
    	// Statistics for segment of track
    	
        $oneLine= $segment->stats->toArray();
        echo ($oneLine['distance']);
        
    }
}

?>