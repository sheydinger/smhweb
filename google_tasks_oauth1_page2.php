<?php

    // OAuthGetAccessToken
    // -------------------

    // Back from OAuthAuthorizeToken.  Contact Google OAuthGetAccessToken
    // to exchange an authorized request token for an access token.

    $consumer_key       = "anonymous";
    $nonce              = "4572616e48616d6d";
    $signature_method   = "HMAC-SHA1";
    $timestamp          = time();
    $token              = $_COOKIE['oauth_token'];  // Looks like "4/MuWajRZIxpsCv9g-uebySwEpAeys"
    $verifier           = $_GET['oauth_verifier'];
    $version            = "1.0";

    $sigbase =
        "POST&https%3A%2F%2Fwww.google.com%2Faccounts%2FOAuthGetAccessToken&%3D%26" .
        urlencode("oauth_consumer_key="     . $consumer_key     . "&") .
        urlencode("oauth_nonce="            . $nonce            . "&") .
        urlencode("oauth_signature_method=" . $signature_method . "&") .
        urlencode("oauth_timestamp="        . $timestamp        . "&") .
        // Looks like "oauth_token%3D4%252FMuWajRZIxpsCv9g-uebySwEpAeys%26" .
        urlencode("oauth_token=")           . str_replace("/", "%252F", $token) . urlencode("&") .
        urlencode("oauth_verifier="         . $verifier         . "&") .
        urlencode("oauth_version="          . $version);

    // The key is the consumer secret + "&" + the token secret.  Need "&" even if
    // consumer secret or token secret are blank.
    $signaturekey = "anonymous&" . $_COOKIE['oauth_token_secret'];

    $signature = urlencode(base64_encode(hash_hmac("SHA1", $sigbase, $signaturekey, true)));

    // These are the POST parameters
    $fields = array(
        'oauth_consumer_key'        => $consumer_key,
        'oauth_token'               => $token,
        'oauth_verifier'            => $verifier,
        'oauth_signature_method'    => $signature_method,
        'oauth_signature'           => $signature,
        'oauth_timestamp'           => $timestamp,
        'oauth_nonce'               => $nonce,
        'oauth_version'             => $version
    );

    $fields_string = "";
    foreach ($fields as $key=>$value) {
        $fields_string .= $key . '=' . $value . '&';
    }
    rtrim($fields_string, '&');

    // Need to use cURL to do a POST
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://www.google.com/accounts/OAuthGetAccessToken");
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

    // Without this, the curl_exec() call automatically echos the JSON results
    // and returns TRUE or FALSE,  With this, it returns the result or FALSE (failure).
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // This executes the POST
    $result1 = curl_exec($ch);
    curl_close($ch);

    // $result1 has $oauth_token and $oauth_token_secret.  parse_str() results
    // in the variables $oauth_token and $oauth_token_secret.
    parse_str(urldecode($result1));












    // https://gdata.youtube.com/feeds/api/users/default/subscriptions
    // ---------------------------------------------------------------
    
    // NOTE: $oauth_token and $oauth_token_secret come from the previous response parse_str() call!
    // This API is very picky.  If the signature is wrong, the message Invalid Token is returned.
    // This is very misleading.

    $consumer_key       = "anonymous";
    $nonce              = "4572616e48616d6d";
    $signature_method   = "HMAC-SHA1";
    $timestamp          = time();
    $token              = $oauth_token;
//    $verifier           = $_GET['oauth_verifier'];
    $version            = "1.0";

    $sigbase =
        "GET&https%3A%2F%2Fgdata.youtube.com%2Ffeeds%2Fapi%2Fusers%2Fdefault%2Fsubscriptions&" . // No %3D%26 after &!
        urlencode("oauth_consumer_key="     . $consumer_key     . "&") .
        urlencode("oauth_nonce="            . $nonce            . "&") .
        urlencode("oauth_signature_method=" . $signature_method . "&") .
        urlencode("oauth_timestamp="        . $timestamp        . "&") .
        urlencode("oauth_token=")           . str_replace("/", "%252F", $token) . urlencode("&") .
        urlencode("oauth_version="          . $version);

    // The key is the consumer secret + "&" + the token secret.  Need "&" even if
    // consumer secret or token secret are blank.
    $signaturekey = "anonymous&" . $oauth_token_secret;

    $signature = urlencode(base64_encode(hash_hmac("SHA1", $sigbase, $signaturekey, true)));

    $authorization  = 'Authorization: OAuth';
    $authorization .= ' oauth_version="'          . $version                . '",';
    $authorization .= ' oauth_nonce="'            . $nonce                  . '",';
    $authorization .= ' oauth_timestamp="'        . $timestamp              . '",';
    $authorization .= ' oauth_consumer_key="'     . $consumer_key           . '",';
    $authorization .= ' oauth_token="'            . urlencode($oauth_token) . '",';
    $authorization .= ' oauth_signature_method="' . $signature_method       . '",';
    $authorization .= ' oauth_signature="'        . $signature              . '"';

    // Use curl to do a GET.  The oauth* parameters are passed in the Header, not a POST body.
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://gdata.youtube.com/feeds/api/users/default/subscriptions");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: */*', $authorization, 'Content-Type: application/atom+xml', 'GData-Version: 2.0'));

    // Without this, the curl_exec() call automatically echos the JSON results
    // and returns TRUE or FALSE,  With this, it returns the result or FALSE (failure).
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // This executes the GET
    $result2 = curl_exec($ch);
    curl_close($ch);

    // This will show an ATOM feed on our domain.
    echo $result2;

    // Alternatively, could we do a redirect?

/*
    // The return values are in the URL
    echo "GET: oauth_verifier="        . $_GET['oauth_verifier']        . "<br />";
    echo "COOKIE: oauth_token="        . $_COOKIE['oauth_token']        . "<br />";
    echo "COOKIE: oauth_token_secret=" . $_COOKIE['oauth_token_secret'] . "<br />";

    echo "<br /><br />token = "         . $token;
    echo "<br /><br />sigbase = "       . $sigbase;
    echo "<br /><br />signature = "     . $signature;
    echo "<br /><br />signaturekey = "  . $signaturekey;
    echo "<br /><br />result1 = "       . $result1     . "<br />";


    echo "<br /><br />authorization = " . $authorization;
    echo "<br /><br />result2 = "       . $result2     . "<br />";
//        echo "oauth_token = " . $oauth_token . "<br />";
//        echo "result2 = "     . $result2     . "<br />";
*/
?>