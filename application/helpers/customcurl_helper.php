<?php




function methodPost($method, $header, $parameters)
{

	$port = "";
	$base_url = "https://api.humlocal.co/";

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_PORT => $port,
		CURLOPT_URL => $base_url . $method,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $parameters,
		CURLOPT_HTTPHEADER => $header,
	));

	$response = curl_exec($curl);

	$err = curl_error($curl);


	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
		exit;
	} else {
		return $response;
	}
}


function methodGet($method, $token)
{

	$port = "";
	$base_url = "https://api.humlocal.co/";

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_PORT => $port,
		CURLOPT_URL => $base_url . $method,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"authorization: Bearer $token",
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
		exit;
	} else {
		return $response;
	}
}


function methodPatch($method, $header, $parameters)
{
	$port = "";
	$base_url = "https://api.humlocal.co/";

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_PORT => $port,
		CURLOPT_URL => $base_url . $method,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "PATCH",
		CURLOPT_POSTFIELDS => $parameters,
		CURLOPT_HTTPHEADER => $header,
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
		exit;
	} else {
		return $response;
	}
}

function methodDelete($method, $header)
{
	$port = "";
	$base_url = "https://api.humlocal.co/";
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_PORT => $port,
		CURLOPT_URL => $base_url . $method,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "DELETE",
		CURLOPT_HTTPHEADER => $header,
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
		exit;
	} else {
		return $response;
	}
}


function methodPut($method, $header, $parameters)
{

	$port = "";
	$base_url = "https://api.humlocal.co/";

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_PORT => $port,
		CURLOPT_URL => $base_url . $method,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 3000,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "PUT",
		CURLOPT_POSTFIELDS => $parameters,
		CURLOPT_HTTPHEADER => $header,
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
		exit;
	} else {
		return $response;
	}
}



function methodGetwithparm($method, $header, $parameters)
{

	$port = "";
	$base_url = "https://api.humlocal.co/";
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_PORT => $port,
		CURLOPT_URL => $base_url . $method,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 3000,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => $parameters,
		CURLOPT_HTTPHEADER => $header,
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
		exit;
	} else {
		return $response;
	}
}





function methodDeletewithparm($method, $header, $parameters)
{
	$port = "";
	$base_url = "https://api.humlocal.co/";


	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_PORT => $port,
		CURLOPT_URL => $base_url . $method,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 3000,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "DELETE",
		CURLOPT_POSTFIELDS => $parameters,
		CURLOPT_HTTPHEADER => $header,
	));

	$response = curl_exec($curl);

	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
		exit;
	} else {
		return $response;
	}
}
