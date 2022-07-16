<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class BaseHttpController.
 */
class BaseHttpController
{
    /*
    * Mayday mayday, Houston we have a problem in our hands!
    */
    private function deAuthorize()
    {
        if ($this->user && $this->user->isAdmin()) {
            return redirect()->route('admin.dashboard')->withFlashDanger(__($this->forbiddenMessage));
        } else {
            return redirect()->route('frontend.index')->withFlashDanger(__('You do not have access to do that.'));
        }
    }

    private function getDataController()
    {
        return [
            'routes'           => $this->routes,
            'model'            => $this->model,
            'resourceName'     => $this->resourceName,
            'permissions'      => $this->permissions,
            'forbiddenMessage' => $this->forbiddenMessage,
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->user = Auth::user();
        if (!$this->user) {
            return $this->deAuthorize();
        }

        if ($this->user->can($this->permissions['read'])) {
            return view(
                $this->views['index'],
                ['data' => $this->getDataController()]
            );
        } else {
            return $this->deAuthorize();
        }
    }
}
