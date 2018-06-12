<?php
session_start();
require_once 'Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '1308143469329389', // Replace {app-id} with your app id
  'app_secret' => '67bf9828e071759e2e365ff2080ddc35',
  'default_graph_version' => 'v2.2',
  ]);
?>
