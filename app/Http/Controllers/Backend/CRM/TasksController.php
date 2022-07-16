<?php

namespace App\Http\Controllers\Backend\CRM;

use App\Http\Controllers\Traits\BaseHttpController;
use App\Models\Backend\CRM\Task as model;

class TasksController extends BaseHttpController
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
        'all' => 'admin.task',
        'create' => 'admin.task.create',
        'read' => 'admin.task.view',
        'update' => 'admin.task.update',
        'delete' => 'admin.task.delete',
    ];

    // Necessary. Traits are hollow.
    protected $routes = [
        'index' => 'admin.account-tasks',
    ];

    // This will be injected in all KoalaHttpController functors.
    protected $resourceName = 'Account Tasks';

    // Forbidden message. Functor will display whatever message you want, eg. "You need X permission, etc".
    protected $forbiddenMessage = 'Forbidden: You do not have enough privileges to access the Account Tasks Portal.';
}
