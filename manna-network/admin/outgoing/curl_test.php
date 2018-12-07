This script demonstrates that the "/message_sender.php" page (i.e. the javascript code that has the pusher keys and sends the message through pusher) can be stored remotely and brought in basically as an "include" page with curl. Not sure how/where to use this little nugget, but curl can also have user auth in it so there might result in levels of security.

For example, the registered member needs to register as an agent too. Now they have two different encryptions of their passwords (by using two different salts to encrypt agent and members). I could do things like grab the encrypted pw from either table,add a nonce, and reencrypt and send as their pusher pw.

I could more easily change the pusger pw - daily or even mor frequently if wanted.

This system could also be used on the receiving syste by including the client software. Though less critical than the server code, it could enable alot of versatility at the client level becuase I can create the client dynamically at my server
<?php
//$url = "http://exaple.co/agent/outgoing/message_sender.php";
$url="https://agent1.com/agent/install/db_cfg/db_writer_auth_template.txt";
function getUrlContent($url){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$data = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
return ($httpcode>=200 && $httpcode<300) ? $data : false;


}



     // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "https://agent1.com/agent/install/db_cfg/db_writer_auth_template.txt");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);
