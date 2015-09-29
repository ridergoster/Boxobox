<?php

use http\Client, http\Client\Request;
use http\QueryString;

//$params = new QueryString;
$params["foo"] = "bar";
$params["bar"] = "foo";

$request = new Request("POST", "http://www.google.com");
$request->getBody()->append($params);
$request->setContentType("application/x-www-form-urlencoded");

$client = new Client;
$client->enqueue($request);
$client->send();

$response = $client->getResponse($request);
printf("Sent:\n%s\n\n", $response->getParentMessage());
printf("%s returned '%s'\n%s\n", 
	$response->getTransferInfo("effective_url"),
	$response->getInfo(),
	$response->getBody()
);

?>
 
Sent:
POST http://example.com HTTP/1.1
Content-Type: application/x-www-form-urlencoded
Content-Length: 7
 
bar=foo
 
http://example.com/ returned 'HTTP/1.1 200 OK'
<!doctype html>
<html>
<head>
    <title>Example Domain</title>
 
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style type="text/css">
    body {
        background-color: #f0f0f2;
        margin: 0;
        padding: 0;
        font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
        
    }
    div {
        width: 600px;
        margin: 5em auto;
        padding: 50px;
        background-color: #fff;
        border-radius: 1em;
    }
    a:link, a:visited {
        color: #38488f;
        text-decoration: none;
    }
    @media (max-width: 700px) {
        body {
            background-color: #fff;
        }
        div {
            width: auto;
            margin: 0 auto;
            border-radius: 0;
            padding: 1em;
        }
    }
    </style>    
</head>
 
<body>
<div>
    <h1>Example Domain</h1>
    <p>This domain is established to be used for illustrative examples in documents. You may use this
    domain in examples without prior coordination or asking for permission.</p>
    <p><a href="http://www.iana.org/domains/example">More information...</a></p>
</div>
</body>
</html>