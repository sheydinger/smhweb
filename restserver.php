<?php
    if (isset($_GET['showsource']))
    {
        show_source("restserver.php");
        die();
    }

    $date = date("h:i:s m/d/Y");
    $etag = MD5($date);
    
    // Resource state vs. Application (Session) state - REST keeps APPLICATION state on the client.
    // Example of hyperlink api using JSON

    // Use ETag: and If-Match/If-None-Match headers.  If the conditional passes, return a 2xx code.  Otherwise,
    // return a 412 Precondition Failed code.  Can be used as follows: If client wants to change something, can
    // do a conditional PUT.  If trying to change something that is different than what the client has seen before,
    // a conditional PUT notifies the client that he is changing something that is not what he expects.  After getting
    // 412 Precondition Failed, should do a new GET then maybe retry the PUT.
    header("ETag: " . $etag);

    echo '{';
    
    $method = $_SERVER['REQUEST_METHOD'];

//    $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
//    echo print_r($request) . "<br />";

    echo '"method":';

    switch ($method) {

    // Create a new object
    // /obect
    case 'POST':
        // 201-Created, with Location: header showing the URI of the new object so that GET can retrieve it later
        // 400-Bad Request, the client sent a malformed request.  The server doesn't understand what to do, i.e. a field is missing
        //     should send back a message in the body explaining why.
        // 409-Conflict  This is better than a 200 with a reason.  Need a 4** response
        // 500-Internal Server Error, the server faulted and cannot recover internally.  Client should probably try again.
        //     A way to trigger this is via catching an exception on the server (PHP has try/catch)
        echo '"got POST! (Need a Location: header)"';
        break;

    // Retrieve an object without changing it
    // /obect/{id}
    case 'GET':
        // 200-OK, return a representation of the state.  Have headers:
        //     a) Content-Type: application/xml, or something else
        //     b) Content-Length: 
        // 404-Not Found
        // 500-Internal Error
        echo '"got GET!"';
        break;

    // Update (change) an object.  To be idempotent, it changes absolute state, not relative.  Can't say, for example,
    //    to add 10 units to the existing number of units.  Need instead to provide the new number of units.
    // /obect/{id}
    // 200-OK, return a copy of the data
    // 204-No Content, has no body.  This or 200 is rather arbitrary choice.
    // 404-Not Found
    // 409-Conflict, e.g. try to change an order once it has already been served.  Should indicate back the nature of the conflict.
    // 500-Internal Error
    case 'PUT':
        echo '"got PUT!"';
        break;

    // Delete an object
    // /obect/{id}
    // 204-No Content, means the content no longer exists.
    // 404-Not Found
    // 405-Method not allowed.  I.e., delete an order once it is already served.
    // 503-Service Unavailable
    
    case 'DELETE':
        echo '"got DELETE!"';
        break;

    case 'HEAD':
        echo '"got HEAD!"';   // Nothing! Doesn't return a body!
        break;

    case 'OPTIONS':
        echo '"got OPTIONS!"';
        break;

    default:
        echo '"WTF!"';
        break;
    }

    echo ',"time":"' . $date . ',"etag":"' . $etag . '"}';
?>
