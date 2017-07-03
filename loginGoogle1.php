<?php

    $url  = "https://www.google.com/accounts/o8/ud?";
    $url .= "openid.ns=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0&openid.mode=checkid_setup&";
    $url .= "openid.return_to=http%3A%2F%2Fwww.theunclassroom.org%2Fsmhweb%2FloginGoogle2.php&";
    $url .= "openid.realm=http%3A%2F%2Fwww.theunclassroom.org&";
    $url .= "openid.claimed_id=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select&";
    $url .= "openid.identity=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select";

    header('Location: ' . $url);
?>