<?php

namespace App\Http\Controllers\Backend\CRM;

use App\Models\Backend\CRM\Address as model;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\BaseHttpController;

class AddressController extends BaseHttpController
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
        'all' => 'admin.account_address',
        'create' => 'admin.account_address.create',
        'read' => 'admin.account_address.view',
        'update' => 'admin.account_address.update',
        'delete' => 'admin.account_address.delete',
    ];

    // Necessary. Traits are hollow.
    protected $routes = [
        'index' => 'admin.account-address',
    ];

    // This will be injected in all KoalaHttpController functors.
    protected $resourceName = 'Account Address';

    // Forbidden message. Functor will display whatever message you want, eg. "You need X permission, etc".
    protected $forbiddenMessage = 'Forbidden: You do not have enough privileges to access the Account Address Portal.';
}
