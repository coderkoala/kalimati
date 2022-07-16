<?php

namespace App\Http\Controllers\Backend\Actions;

use App\Models\Backend\Incident\Investigation as model;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\BaseHttpController;

class InvestigationController extends BaseHttpController
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
        'all' => 'admin.incident_investigation',
        'create' => 'admin.incident_investigation.create',
        'read' => 'admin.incident_investigation.view',
        'update' => 'admin.incident_investigation.update',
        'delete' => 'admin.incident_investigation.delete',
    ];

    // Necessary. Traits are hollow.
    protected $routes = [
        'index' => 'admin.incident-investigation',
    ];

    // This will be injected in all KoalaHttpController functors.
    protected $resourceName = 'Incident Investigation';

    // Forbidden message. Functor will display whatever message you want, eg. "You need X permission, etc".
    protected $forbiddenMessage = 'Forbidden: You do not have enough privileges to access the Incident Investigation Portal.';
}
