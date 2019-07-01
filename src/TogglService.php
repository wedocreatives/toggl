<?php namespace Wedocreatives\Toggl;


use Ixudra\Curl\Builder;
use Ixudra\Curl\CurlService;
use Wedocreatives\Toggl\Traits\ClientTrait;
use Wedocreatives\Toggl\Traits\GroupTrait;
use Wedocreatives\Toggl\Traits\ProjectTrait;
use Wedocreatives\Toggl\Traits\ReportTrait;
use Wedocreatives\Toggl\Traits\ReportUtilityTrait;
use Wedocreatives\Toggl\Traits\TagTrait;
use Wedocreatives\Toggl\Traits\TaskTrait;
use Wedocreatives\Toggl\Traits\TimeEntryTrait;
use Wedocreatives\Toggl\Traits\WorkspaceTrait;
use Wedocreatives\Toggl\Traits\WorkspaceUsersTrait;
use stdClass;

class TogglService {

    use ReportTrait, ReportUtilityTrait, ClientTrait, TaskTrait, TagTrait, GroupTrait, ProjectTrait, TimeEntryTrait, WorkspaceTrait, WorkspaceUsersTrait;


    /** @var CurlService $curlService */
    protected $curlService = null;

    /** @var integer $workspaceId */
    protected $workspaceId = null;

    /** @var string $apiToken */
    protected $apiToken = null;


    public function __construct($workspaceId = null, $apiToken = null)
    {
        $this->workspaceId = $workspaceId;
        $this->apiToken = $apiToken;
    }


    /**
     * Send a GET message to the Toggl API
     *
     * @param   string      $url        Url to which the request is to be sent
     * @param   array       $data       Data payload that is to be sent with the request
     * @return  stdClass
     */
    protected function sendGetMessage($url, array $data = array())
    {
        return $this->prepareMessage( $url, $data )
            ->get();
    }

    /**
     * Send a POST message to the Toggl API
     *
     * @param   string      $url        Url to which the request is to be sent
     * @param   array       $data       Data payload that is to be sent with the request
     * @return  stdClass
     */
    protected function sendPostMessage($url, array $data = array())
    {
        return $this->prepareMessage( $url, $data )
            ->post();
    }

    /**
     * Send a PUT message to the Toggl API
     *
     * @param   string      $url        Url to which the request is to be sent
     * @param   array       $data       Data payload that is to be sent with the request
     * @return  stdClass
     */
    protected function sendPutMessage($url, array $data = array())
    {
        return $this->prepareMessage( $url, $data )
            ->put();
    }

    /**
     * Send a DELETE message to the Toggl API
     *
     * @param   string      $url        Url to which the request is to be sent
     * @return  stdClass
     */
    protected function sendDeleteMessage($url)
    {
        return $this->prepareMessage( $url )
            ->delete();
    }

    /**
     * Prepare a request that is to be sent to the Toggl API
     *
     * @param   string      $url        Url to which the request is to be sent
     * @param   array       $data       Data payload that is to be sent with the request
     * @return  Builder
     */
    protected function prepareMessage($url, array $data = array())
    {
        $data[ 'workspace_id' ] = $this->workspaceId;
        $data[ 'user_agent' ] = 'ixudra';

        return $this->getCurlService()
            ->to( $url )
            ->withOption('USERPWD', $this->apiToken .':api_token')
            ->withData( $data )
            ->asJson();
    }


    /**
     * Return an instance of the Ixudra\Curl\CurlService
     *
     * @return  CurlService
     */
    protected function getCurlService()
    {
        if( is_null($this->curlService) ) {
            $this->curlService = new CurlService();
        }

        return $this->curlService;
    }

}
