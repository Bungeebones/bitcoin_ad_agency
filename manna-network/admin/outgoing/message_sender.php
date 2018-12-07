<?php
// If you get "file not found errors, get your present level by uncommenting the netxt line:
//echo dirname( __FILE__, 1 );
// Increasing the number will move the search the same number of levels;

//This was the original search location
//  require __DIR__ . '/vendor/autoload.php';

require dirname( __FILE__, 3 ). '/vendor/autoload.php';

  $options = array(
    'cluster' => 'us2',
    'encrypted' => true
  );
  $pusher = new Pusher\Pusher(
    '15733830827677a973c7',
    '509b2f830de24b4f189a',
    '540743',
    $options
  );

  $data['message'] = 'hello world fro exaple.co/agent/outgoing/message_sender.php';
  $pusher->trigger('my-channel', 'my-event', $data);
?>
