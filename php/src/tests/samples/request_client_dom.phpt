--TEST--
Test for request_client_dom sample
--FILE--
<?php

include_once('wsf.php');

$reqPayloadString = <<<XML
    <ns1:echoString xmlns:ns1="http://php.axis2.org/samples">
        <text>Hello World!</text>
    </ns1:echoString>
XML;

$document = new domDocument;
$document->loadXML($reqPayloadString);


try {

    $resMessage = ws_request($document, 
                        array("to"=>"http://localhost/samples/reply_echo_service.php"));
    
    printf("Response = %s <br>", htmlspecialchars($resMessage->str));

} catch (Exception $e) {

    if ($e instanceof WSFault) {
        printf("Soap Fault: %s\n", $e->Code);
    } else {
        printf("Message = %s\n",$e->getMessage());
    }
}

?>
--EXPECT--
Response = &lt;ns1:echoString xmlns:ns1=&quot;http://php.axis2.org/samples&quot;&gt;
        &lt;text&gt;Hello World!&lt;/text&gt;
    &lt;/ns1:echoString&gt; <br>
