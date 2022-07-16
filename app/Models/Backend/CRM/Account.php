<?php

namespace App\Models\Backend\CRM;

use App\Models\Backend\Lib\Extensions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes, Extensions;

    protected $table = 'account';
    protected $primaryKey = 'id';
    protected static $modelNameCanonical = 'Customer';
    protected static $modelNameSlug = 'account';

    // Setup fillable params.
    protected $fillable = [
        'account_group',
        'name',
        'tax_id',
        'exim_code',
        'website',
    ];

    // Extended form layout in case of overrides.
    protected static $formLayout = [
        'Primary Data Entry' => [
            'account_group',
            'name',
            'tax_id',
            'exim_code',
            'website',
            'contact_form',
        ],
        'Shipping Address' => [
            'shipping_contact_form',
        ],
        'Billing Address' => [
            'billing_contact_form',
        ],
        'Notify Address' => [
            'notify_contact_form',
        ],
        'Client Instructions' => [
            'client_instruction',
        ],
    ];

    /**
     * @return array
     */
    public static function getFieldData()
    {
        return [
            'account_group' => [
                'label' => __('Account Group'),
                'placeholder' => __('Select the account group.'),
                'validation' => 'required|integer',
                'onUpdate' => 'required|integer',
                'required' => true,
                'render' => true,
                'type' => 'select',
                'model' => \App\Models\Backend\CRM\AccountGroup::class,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
                'loadOptions' => true,
            ],
            'name' => [
                'label' => __('Account Name'),
                'placeholder' => __('Account Name'),
                'validation' => 'required|max:160',
                'onUpdate' => 'required|max:160',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'tax_id' => [
                'label' => __('Tax ID'),
                'placeholder' => __('Tax ID'),
                'validation' => 'nullable|max:64',
                'onUpdate' => 'nullable|max:64',
                'type' => 'text',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'exim_code' => [
                'label' => __('Exim Code'),
                'placeholder' => __('Exim Code'),
                'validation' => 'nullable|max:24',
                'onUpdate' => 'nullable|max:24',
                'type' => 'text',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'contact_form' => [
                'label' => __('Contact Information'),
                'placeholder' => __('Contact Information'),
                'validation' => 'required|max:191',
                'onUpdate' => 'required|max:191',
                'type' => 'form',
                'model' => \App\Models\Backend\CRM\Contact::class,
                'table' => [
                    'columns' => [
                        'name' => 'Contact Person',
                        'address' => 'Address',
                    ],
                ],
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'shipping_contact_form' => [
                'label' => __('Contact Information for Shipping'),
                'placeholder' => __('Contact Information for Shipping'),
                'validation' => 'nullable|array',
                'onUpdate' => 'nullable|array',
                'type' => 'form',
                'model' => \App\Models\Backend\CRM\Contact::class,
                'table' => [
                    'columns' => [
                        'name' => 'Contact Name',
                        'address' => 'Address',
                        'telephone' => 'Telephone',
                    ],
                ],
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'billing_contact_form' => [
                'label' => __('Contact Information for Billing'),
                'placeholder' => __('Contact Information for Billing'),
                'validation' => 'nullable|array',
                'onUpdate' => 'nullable|array',
                'type' => 'form',
                'model' => \App\Models\Backend\CRM\Contact::class,
                'table' => [
                    'columns' => [
                        'name' => 'Contact Name',
                        'address' => 'Address',
                        'telephone' => 'Telephone',
                    ],
                ],
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'notify_contact_form' => [
                'label' => __('Contact Information for Notification'),
                'placeholder' => __('Contact Information for Notification'),
                'validation' => 'nullable|array',
                'onUpdate' => 'nullable|array',
                'type' => 'form',
                'model' => \App\Models\Backend\CRM\Contact::class,
                'table' => [
                    'columns' => [
                        'name' => 'Contact Name',
                        'address' => 'Address',
                        'telephone' => 'Telephone',
                    ],
                ],
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'website' => [
                'label' => __('Website'),
                'placeholder' => __('Website'),
                'validation' => 'nullable|url|max:191',
                'onUpdate' => 'nullable|url|max:191',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'client_instruction' => [
                'label' => __('Client Instructions'),
                'placeholder' => __('Client Instructions'),
                'validation' => 'nullable|array',
                'onUpdate' => 'nullable|array',
                'type' => 'form',
                'model' => \App\Models\Backend\Incident\InstructionSlave::class,
                'table' => [
                    'columns' => [
                        'name' => 'Instruction(HTML)',
                        'remarks' => 'Remarks',
                    ],
                ],
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
        ];
    }

    /**
     * @return bool
     */
    public function afterCreate($data, $model)
    {
        $this->saveData = $data;
        $this->savedModel = $model;
        unset($data, $model);

        try {
            $this->saveMetaData(
                \App\Models\Backend\CRM\Contact::class,
                \App\Models\Backend\Meta\MetaAccountToContacts::class,
                'contact_form'
            );
            $this->saveMetaData(
                \App\Models\Backend\CRM\Contact::class,
                \App\Models\Backend\Meta\MetaAccountToContacts::class,
                'shipping_contact_form'
            );
            $this->saveMetaData(
                \App\Models\Backend\CRM\Contact::class,
                \App\Models\Backend\Meta\MetaAccountToContacts::class,
                'billing_contact_form'
            );
            $this->saveMetaData(
                \App\Models\Backend\CRM\Contact::class,
                \App\Models\Backend\Meta\MetaAccountToContacts::class,
                'notify_contact_form'
            );

            // Assign Instruction, with each referred user getting their own copy of the instruction.
            $this->saveMetaData(
                \App\Models\Backend\Incident\InstructionSlave::class,
                \App\Models\Backend\Meta\MetaAccountToInstruction::class,
                'client_instruction',
                [
                    'assigned_to' => \App\Models\Backend\Meta\MetaInstructionToUsers::class,
                ]
            );

            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * @param $query
     * @param $term
     * @return mixed
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($query) use ($term) {
            $query->orWhere('name', 'like', '%'.$term.'%');
        });
    }
}
