<?php namespace Wedocreatives\Toggl\Traits;


use stdClass;

trait WorkspaceTrait
{
    /**
     * Get workspace projects
     *
     * @return stdClass
     */
    public function workspaceProjects()
    {
        return $this->sendGetMessage('https://www.toggl.com/api/v8/workspaces/' . $this->workspaceId . '/projects');

    }

}