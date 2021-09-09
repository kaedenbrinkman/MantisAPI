<?php
include './MantisAPI.php';
$api = new MantisAPI('http://localhost/mantisbt', 'ACCESS_TOKEN');

#Get all issues
$result = $api->deleteIssue(1234);
echo json_encode($result);