<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://community-campbell.p.rapidapi.com/brandservice.svc/api/search?app_key=undefined&app_id=undefined&format=json&category=1&keyword=garlic&ingredient=beef",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: community-campbell.p.rapidapi.com",
		"x-rapidapi-key: 6288b04b82msh924ce912f68ff81p1c951cjsn7b55d5b23d03"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}