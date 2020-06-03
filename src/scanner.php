<?php
require "vendor/autoload.php";


$client=new \GuzzleHttp\Client();

$csv = \League\Csv\Reader::createFromPath($argv[1]);

foreach($csv as $csvrow){
	try{
		$httpResponse = $client->request("GET",$csvrow[0]);
		if ($httpResponse->getStatusCode()>=400){
			throw new \Exception();
		}
	} catch(\Exception $e){
		echo $csvrow[0] .  PHP_EOL;
	}
}

?>
