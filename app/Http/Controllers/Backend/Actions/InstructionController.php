<?php

namespace App\Http\Controllers\Backend\Actions;

use App\Http\Controllers\Traits\BaseHttpController;
use App\Models\Backend\Incident\InstructionMaster as model;

class InstructionController extends BaseHttpController
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
        'all' => 'admin.instruction',
        'create' => 'admin.instruction.create',
        'read' => 'admin.instruction.view',
        'update' => 'admin.instruction.update',
        'delete' => 'admin.instruction.delete',
    ];

    // Necessary. Traits are hollow.
    protected $routes = [
        'index' => 'admin.incident-instructions',
    ];

    // This will be injected in all KoalaHttpController functors.
    protected $resourceName = 'Instruction';

    // Forbidden message. Functor will display whatever message you want, eg. "You need X permission, etc".
    protected $forbiddenMessage = 'Forbidden: You do not have enough privileges to access the Instruction Management Portal.';
}
