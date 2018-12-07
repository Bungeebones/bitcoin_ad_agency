In order for the enterprise level agent to send updates from their registrations, downlines, deposits, sales etc it is necessary for them to create a secure connection with the Manna Network and with each other. That is accoplished by installing server software from the Pusher.com website. You acquire the Pusher server files from the Manna Network but it is necessary that you install the server files with Composer.  

Open a terminal window and enter the following command
$ composer require pusher/pusher-php-server 
(This assumes you have Composer installed. If not, find installation instructions appropriate for your system).



Open the following link and copy/paste the contents (sic latest PHP code) into the agent/outgoing/message_sender.php file</h4>
<a href="https://mannanetwork.co/agent/install/create_pusher/server.txt">Server file</a><br>
If running the page results in a json file not found error, there is a help section in the file telling how to adjust the path.

The Manna Network will enter it into a "pool of peers" that the clients of the other agents will be able to listen in on to receive updates your site sends regarding new advertisers and new sales. The Manna Network will also be notified of new advertisers and sales as well as handle deposits and funding of your customers. 

The folder will have to parse the data coming from their forms, insert it into their own tables, and forward parts of it to the network. Hopefully they will be able to broadcast through peers and not directly with central.

The sql will have to use the install/db_write_config/db_root_auth.php. 
