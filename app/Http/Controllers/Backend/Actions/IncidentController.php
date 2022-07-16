<?php

namespace App\Http\Controllers\Backend\Actions;

use App\Models\Backend\Incident\Event as model;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\BaseHttpController;

class IncidentController extends BaseHttpController
{
    // Constructor for dependency injection.
    // Aside from users, this is the only place where you should inject your models.
    public function __construct()
    {
        $this->model = new model();
    }

    /**
     * Properties for dep injection.
     */
    protected $model;

    // Stored views, so functors can pivot out to the right view.
    protected $views = [
        'index' => 'backend.crm.base',
    ];

    // Explicitely define this, so trait functors rely on permission checking.
    protected $permissions = [
        'all' => 'admin.incident',
        'create' => 'admin.incident.create',
        'read' => 'admin.incident.view',
        'update' => 'admin.incident.update',
        'delete' => 'admin.incident.delete',
    ];

    // Necessary. Traits are hollow.
    protected $routes = [
        'index' => 'admin.incident-events',
    ];

    // This will be injected in all KoalaHttpController functors.
    protected $resourceName = 'Incident';

    // Forbidden message. Functor will display whatever message you want, eg. "You need X permission, etc".
    protected $forbiddenMessage = 'Forbidden: You do not have enough privileges to access the Incident Management Portal.';
}
