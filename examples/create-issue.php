<?php
include './MantisAPI.php';
$api = new MantisAPI('http://localhost/mantisbt', 'ACCESS_TOKEN');

#Create an issue
$data = array(
    'summary' => 'Sample REST issue',
    'description' => "Description for sample REST issue.",
    "additional_information" => "More info about the issue",
    "project" => array(
        "id" => 1,
        "name" => "mantisbt"
    ),
    "category" => array(
        "id" => 5,
        "name" => "bugtracker"
    ),
    "handler" => array(
        "name" => "vboctor"
    ),
    "view_state" => array(
        "id" => 10,
        "name" => "public"
    ),
    "priority" => array(
        "name" => "normal"
    ),
    "severity" => array(
        "name" => "trivial"
    ),
    "reproducibility" => array(
        "name" => "always"
    ),
    "sticky" => false,
    "custom_fields" => [
        array(
            "field" => array(
                "id" => 4,
                "name" => "The City"
            ),
            "value" => "Seattle"
        )
    ],
    "tags" => [
        array(
            "name" => "mantishub"
        )
    ]
);
$result = $api->createIssue($data);
echo json_encode($result);
