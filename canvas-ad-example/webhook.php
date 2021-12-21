<?php
$inputPostData = file_get_contents("php://input");
$param = json_decode($inputPostData,true,512);

$response = array(
    'messageId' => $param['messageId'],
    'sessionId' => $param['sessionId'],
    'messageName' => "ANSWER_TO_USER",
    'uuid' => $param['uuid'],
    'payload' => array(
	'auto_listening' => true,
	'finished' => false,
	'device' => $param['payload']['device'],
	'items' => array(
	    array(
		'bubble' => array(
		    'text' => "Canvas app test",
		    'markdown' => false,
		    'expand_policy' => "force_expand",
		),
	    ),
	),
	'pronounceText' => "Это тест канвас смартапа.",
    ),
);

if ($param['session']['new'] === true){
    //Отправляем данные во front для SberDevicesAdSDK (используем из в window.SberDevicesAdSDK.initWithParams)
    $response['payload']['items'][] =  array(
	'command' => array(
	    'type' => "smart_app_data",
	    'smart_app_data' => array(
		'ad' => array(
		    'sub' => $param['uuid']['sub'],
		    'projectName' => $param['payload']['projectName'],
		    'device' => $param['payload']['device'],
		    'app_info' => $param['payload']['app_info'],
		),
	    ),
	),
    );
}

@header( "Content-type: application/json;" );
$json = json_encode($response,0);
print $json;

?>