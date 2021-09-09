<?php
include './MantisAPI.php';
$api = new MantisAPI('http://localhost/mantisbt', 'ACCESS_TOKEN');

#Get all issues
$issues = $api->getIssues();
echo json_encode($issues);