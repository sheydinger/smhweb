<?php

    // This example uses OAuth1 to get a list of
    // The steps to use the OAuth1 protocol shown below are:

    // 1) OAuthGetRequestToken
    // 2) OAuthAuthorizeToken
    // 3) OAuthGetAccessToken
    // 4) https://gdata.youtube.com/feeds/api/users/default/subscriptions

    // 1) OAuthRequestToken
    // --------------------

    // The callback from OAuthGetRequestToken should probably be a page different than this one.
    // When Google calls back there is no apparent way to determine if the callback page was called on
    // its original call, or if it is getting called back from Google.  In contrast, google_tasks_oauth1
    // _page2.php "knows" it was called back from Google.  Note that callback and scope
    // have some unexplained characters (i.e. %253A vs. expect %25).  Therefore they're
    // hardcoded when computing $sigbase.  Should try to fix this or understand why.
    $consumer_key       = "anonymous";
    $signature_method   = "HMAC-SHA1";
    $timestamp          = time();
    $nonce              = "4572616e48616d6d";
    $version            = "1.0";
    $callback           = "http://www.theunclassroom.org/smhweb/google_youtube_oauth1_page2of2.php";
    $scope              = "https://gdata.youtube.com";

    $sigbase=
        "POST&https%3A%2F%2Fwww.google.com%2Faccounts%2FOAuthGetRequestToken&%3D%26" .
        "oauth_callback%3Dhttp%253A%252F%252Fwww.theunclassroom.org%252Fsmhweb%252Fgoogle_youtube_oauth1_page2of2.php%26" .
        urlencode("oauth_consumer_key="     . $consumer_key     . "&") .
        urlencode("oauth_nonce="            . $nonce            . "&") .
        urlencode("oauth_signature_method=" . $signature_method . "&") .
        urlencode("oauth_timestamp="        . $timestamp        . "&") .
        urlencode("oauth_version="          . $version          . "&") .
        "scope%3Dhttps%253A%252F%252Fgdata.youtube.com";

    // The key is the consumer secret + "&" + the token secret.  Need "&" even if
    // consumer secret or token secret are blank.
    $signature = urlencode(base64_encode(hash_hmac("SHA1", $sigbase, "anonymous&", true)));

    // These are the POST parameters
    $fields = array(
        'oauth_consumer_key'            => $consumer_key,
        'oauth_signature_method'        => $signature_method,
        'oauth_signature'               => $signature,
        'oauth_timestamp'               => $timestamp,
        'oauth_nonce'                   => $nonce,
        'oauth_version'                 => $version,
        'oauth_callback'                => $callback,
        'scope'                         => $scope
    );

    $fields_string = "";
    foreach ($fields as $key=>$value) {
        $fields_string .= $key . '=' . $value . '&';
    }
    rtrim($fields_string, '&');

    // Need to use cURL to do a POST
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://www.google.com/accounts/OAuthGetRequestToken");
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

    // Without this, the curl_exec() call automatically echos the JSON results
    // and returns TRUE or FALSE.  With this, it returns the result or FALSE (failure).
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);



    // 2) OAuthGetRequestToken
    // -----------------------

    // This executes the POST
    $result1 = curl_exec($ch);
    curl_close($ch);

    // $result1 has $oauth_token and $oauth_token_secret.  parse_str() results
    // in the variables $oauth_token and $oauth_token_secret.  Save the secret
    // because it is used in the signature the next time around.
    parse_str(urldecode($result1));

    setcookie("oauth_token",        $oauth_token);
    setcookie("oauth_token_secret", $oauth_token_secret);

    $redir = "https://accounts.google.com/OAuthAuthorizeToken?oauth_token=" . $oauth_token . "&hd=default&hl=en";
    header( "Location: " . $redir);


/*
    // If we do this CURL, then $result2 returns the HTML of the validation page.  Echoing it
    // causes validation to be done on OUR domain!!!
    $ch2 = curl_init();

    curl_setopt($ch2, CURLOPT_URL, "https://accounts.google.com/OAuthAuthorizeToken?oauth_token=" . $oauth_token . "&hd=default&hl=en");

    // Without this, the curl_exec() call automatically echos the JSON results
    // and returns TRUE or FALSE,  With this, it returns the result or FALSE (failure).
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

    // This executes the POST
    $result2 = curl_exec($ch2);
    curl_close($ch2);

    echo $result2;
*/
?>
<!--
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html lang="en">
<head>
    <title>google_tasks_oauth1</title>
</head>
<body>
//    <?php
//        echo "result1 = "     . $result1     . "<br />";
//        echo "oauth_token = " . $oauth_token . "<br />";
//        echo "result2 = "     . $result2     . "<br />";
//    ?>
</body>
</html>
-->