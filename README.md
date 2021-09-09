# MantisAPI
A Simple REST API for mantisbt written in PHP

Note: This is still a work-in-progress. It has not been tested and still does not have functions for all API calls. However, it is extremely simple to add new functions to the class.

Usage:
```
include './MantisAPI.php';
$api = new MantisAPI('http://localhost/mantisbt', 'YOUR_API_KEY_HERE');
```

Examples: See [/examples/](examples/)

API Documentation: [View on Postman](https://documenter.getpostman.com/view/29959/mantis-bug-tracker-rest-api/7Lt6zkP)


List of functions currently supported:

```
getIssues($page_size = 10, $page = 1)
getIssue($id)
deleteIssue($id)
createIssue($data)
getIssueFiles($issue_id)
getIssueFile($issue_id, $file_id)
getProjectIssues($project_id)
getFilteredIssues($filter_id)
getMyAssignedIssues()
getMyReportedIssues()
getMyMonitoredIssues()
getUnassignedIssues()
updateIssue($id, $data)
addAttachmentsToIssue($issue_id, $data)
createIssueNote($issue_id, $data)
deleteIssueNote($issue_id, $note_id)
monitorIssue($issue_id)
addTagsToIssue($issue_id, $data)
removeTagsFromIssue($issue_id, $data)
addIssueRelationship($issue_id, $data)
```