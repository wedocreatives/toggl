<?php namespace Wedocreatives\Toggl\Traits;


use stdClass;

trait ReportTrait {

    /**
     * Returns an overview of what users in the workspace are doing and have been doing
     *
     * @return  stdClass
     */
    public function dashboard()
    {
        return $this->sendGetMessage( 'https://www.toggl.com/api/v8/dashboard/'. $this->workspaceId );
    }

    /**
     * Returns the aggregated time entries data
     *
     * @param   array       $data       Data payload that is to be sent with the request
     * @return  stdClass
     */
    public function summary(array $data = array())
    {
        return $this->sendGetMessage( 'https://www.toggl.com/reports/api/v2/summary', $data );
    }
    
    /**
     * Returns the time entries for the requested parameters/filters.
     *
     * @param   array       $data       Data payload that is to be sent with the request
     * @return  stdClass
     */
    public function detailedReport($page)
    {

        $data = array();
        $data[ 'workspace_id' ] = $this->workspaceId;
        $data[ 'since' ] = '2019-01-01';
        $data[ 'until' ] = date("Y-m-d");
        $data[ 'page' ] = $page;


        return $this->sendGetMessage( 'https://www.toggl.com/reports/api/v2/details', $data );
    }

    /**
     * Returns at-a glance information for a single project
     *
     * @param   array       $data       Data payload that is to be sent with the request
     * @return  stdClass
     */
    public function projectReport($id, array $data = array())
    {
        $data[ 'project_id' ] = $id;

        return $this->sendGetMessage( 'https://www.toggl.com/reports/api/v2/project', $data );
    }

}
