<?php
include './MantisAPI.php';
$api = new MantisAPI('http://localhost/mantisbt', 'ACCESS_TOKEN');

#Get all issues
$issue = $api->getIssue(1234);
echo json_encode($issue);