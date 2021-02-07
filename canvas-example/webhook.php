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
	    array(
		'command' => array(
		    'type' => "smart_app_data",
		    'smart_app_data' => array("myTest" => "data"),
		),
	    ),
	),
	'pronounceText' => "Это тест канвас смартапа.",
    ),
);

@header( "Content-type: application/json;" );
$json = json_encode($response,0);
print $json;

?>