<?php

class MantisAPI
{
    private $url;
    private $access_token;
    public function __construct($mantis_url, $access_token)
    {
        $this->url = $mantis_url;
        $this->access_token = $access_token;
    }
    private function callAPI($url, $method = 'GET', $data = null)
    {
        //Generic function for all POST requests
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url . '/api/rest/' . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $this->access_token,
                'Cookie: MANTIS_PROJECT_COOKIE=0'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $responseArr = [];
        if ($this->isJson($response)) $responseArr = json_decode($response);
        else {
            $responseArr['error'] = 'Not valid JSON';
            $responseArr['data'] = $response;
        }
        return (array) $responseArr;
    }
    private function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
    # ----------- ISSUES --------------
    public function getIssues($page_size = 10, $page = 1)
    {
        return $this->callAPI('issues?page_size=' . $page_size . '&page=' . $page, 'GET');
    }
    public function getIssue($id)
    {
        return $this->callAPI('issues/' . $id, 'GET');
    }
    public function deleteIssue($id)
    {
        return $this->callAPI('issues/' . $id, 'DELETE');
    }
    public function createIssue($data)
    {
        return $this->callAPI('issues', 'POST', $data);
    }
    public function getIssueFiles($issue_id)
    {
        return $this->callAPI('issues/' . $issue_id . '/files', 'GET');
    }
    public function getIssueFile($issue_id, $file_id)
    {
        return $this->callAPI('issues/' . $issue_id . '/files/' . $file_id, 'GET');
    }
    public function getProjectIssues($project_id)
    {
        return $this->callAPI('issues?project_id=' . $project_id, 'GET');
    }
    public function getFilteredIssues($filter_id)
    {
        return $this->callAPI('issues?filter_id=' . $filter_id, 'GET');
    }
    public function getMyAssignedIssues()
    {
        return $this->callAPI('issues?filter_id=assigned', 'GET');
    }
    public function getMyReportedIssues()
    {
        return $this->callAPI('issues?filter_id=reported', 'GET');
    }
    public function getMyMonitoredIssues()
    {
        return $this->callAPI('issues?filter_id=monitored', 'GET');
    }
    public function getUnassignedIssues()
    {
        return $this->callAPI('issues?filter_id=unassigned', 'GET');
    }
    public function updateIssue($id, $data)
    {
        return $this->callAPI('issues/' . $id, 'PATCH', $data);
    }
    public function addAttachmentsToIssue($issue_id, $data)
    {
        return $this->callAPI('issues/' . $issue_id . '/files', 'POST', $data);
    }
    public function createIssueNote($issue_id, $data)
    {
        return $this->callAPI('issues/' . $issue_id . '/notes', 'POST', $data);
    }
    public function deleteIssueNote($issue_id, $note_id)
    {
        return $this->callAPI('issues/' . $issue_id . '/notes/' . $note_id, 'DELETE');
    }
    public function monitorIssue($issue_id)
    {
        return $this->callAPI('issues/' . $issue_id . '/monitors', 'POST');
    }
    public function addTagsToIssue($issue_id, $data)
    {
        return $this->callAPI('issues/' . $issue_id . '/tags', 'POST', $data);
    }
    public function removeTagsFromIssue($issue_id, $data)
    {
        return $this->callAPI('issues/' . $issue_id . '/tags', 'POST', $data);
    }
    public function addIssueRelationship($issue_id, $data)
    {
        return $this->callAPI('issues/' . $issue_id . '/relationships/', 'POST', $data);
    }
}
