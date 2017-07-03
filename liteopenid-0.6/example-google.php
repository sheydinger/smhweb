<?php
# Logging in with Google accounts requires setting special identity, so this example shows how to do it.
require 'openid.php';
try {
    # Change 'localhost' to your domain name.
    $openid = new LightOpenID('www.theunclassroom.org/smhweb');
    if(!$openid->mode) {
file_put_contents('debug.txt', "GOOGLE     !openid->mode\n", FILE_APPEND);

        if(isset($_GET['login'])) {
file_put_contents('debug.txt', "GOOGLE     isset(login)\n", FILE_APPEND);

            $openid->identity = 'https://www.google.com/accounts/o8/id';
            header('Location: ' . $openid->authUrl());
        }
?>
<form action="?login" method="post">
    <button>Login with Google</button>
</form>
<?php
    } elseif($openid->mode == 'cancel') {
file_put_contents('debug.txt', "GOOGLE     mode=cancel\n", FILE_APPEND);
        echo 'User has canceled authentication!';
    } else {
file_put_contents('debug.txt', "GOOGLE     else\n", FILE_APPEND);
        $temp_validate = $openid->validate();
        echo 'User ' . ($temp_validate ? $openid->identity . ' has ' : 'has not ') . 'logged in.';
    }
} catch(ErrorException $e) {
    echo $e->getMessage();
}
