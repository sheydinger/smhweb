<?php
    // To see how to use OAuth, note the step at https://developers.google.com/accounts/docs/OAuth2WebServer

    $authCode = "";

    if (isset($_GET['code'])) {
        // Step 2: Calling the server in Step 1 results in an Authorization Code.  Do a POST
        // with this code, the client_id, client_secret, redirect_uri, and grant_type=authorization_code
        // in order to get an access_token that can be used to call a Google API.
        $authCode = $_GET['code'];

        $fields = array(
            'code'          => $authCode,
            'client_id'     => '1039710745910-feoe9337d7cgcmf1g1l4db4bsqphu826.apps.googleusercontent.com',
            'client_secret' => 'Vqz_zRuerv8Ve5yQ-O1N4a0t',
            'redirect_uri'  => 'http%3A%2F%2Fwww.theunclassroom.org%2Fsmhweb%2Fgoogletasks.php',
            'grant_type'    => 'authorization_code'
        );
        foreach ($fields as $key=>$value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');

        // Need to use cURL to do a POST
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://accounts.google.com/o/oauth2/token");
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

        // Without this, the curl_exec() call automatically echos the JSON results
        // and returns TRUE or FALSE,  With this, it returns the result or FALSE (failure).
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // This executes the POST
        $result = curl_exec($ch);
        curl_close($ch);

        // Step 3: We now have an access_token that can be used to access an API.
        if ($result != FALSE)
        {
//            echo $result;

            // Can't do an echo if we do a redirect below.  When doing a redirect,
            // nothing can be output first so comment out the echo.
            $jsonArray = json_decode($result, TRUE);  // Returns an Array
//            echo 'The access token is: ' . $jsonArray['access_token'];

            // Picassa Web Album doesn't appear to require the access_token
            // so don't append it to the end of the URL.
            $uri = "https://www.googleapis.com/tasks/v1/users/@me/lists";
            
            // Or, maybe it does need the token!!!
            $uri .= '?access_token=' . $jsonArray['access_token'];

            // If just do a redirect now, get back and show a bunch of JSON.  Ugly, but can be done.
//            header("Location: " . $uri);

            // Better than a redirect, use cURL and get JSON back in a variable instead
            // of display it on the screen.
            $ch = curl_init();

            // A simple GET
            curl_setopt($ch, CURLOPT_URL, $uri);

            // Without this, the curl_exec() call automatically echos the JSON results
            // and returns TRUE or FALSE,  With this, it returns the result or FALSE (failure).
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // This executes the GET
            $result = curl_exec($ch);
            curl_close($ch);

            $jsonDecode = json_decode($result);

            echo "<html><body>";
            echo $result . "<br /><br />";
            echo "Number of lists: " . sizeof($jsonDecode->items) . "<br />";
            for ($i=0; $i<sizeof($jsonDecode->items); $i++)
                echo $jsonDecode->items[$i]->title . "<br />";
            echo "</body></html>";
        }
    } else {
        // Step 1: Call the Google Authorization server.  It will come back with ?code= in the URL
        $uri  = "https://accounts.google.com/o/oauth2/auth?";
        $uri .= "redirect_uri=http%3A%2F%2Fwww.theunclassroom.org%2Fsmhweb%2Fgoogletasks.php&";
        $uri .= "response_type=code&";
        $uri .= "client_id=1039710745910-feoe9337d7cgcmf1g1l4db4bsqphu826.apps.googleusercontent.com&";
        $uri .= "approval_prompt=force&";
        $uri .= "state=SeeYaSoon&";
        $uri .= "scope=https://www.googleapis.com/auth/tasks&";
        $uri .= "access_type=offline";

        header("Location: " . $uri);
    }
?>

