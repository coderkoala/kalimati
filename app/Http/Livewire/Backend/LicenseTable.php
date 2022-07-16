<?php

namespace App\Http\Livewire\Backend;

use App\Models\Backend\License;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class LicenseTable.
 */
class LicenseTable extends DataTableComponent
{
    /**
     * @var
     */
    public $status;

    /**
     * @var array|string[]
     */
    public array $sortNames = [
        'name' => 'Shipping Company',
        'slug' => 'Company Slug',
    ];

    /**
     * @var array|string[]
     */
    public array $filterNames = [
        'name' => 'Shipping Company Name',
        'slug' => 'Aftership Shipping Slug',
    ];

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return License::withTrashed()->orderBy('id')
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Licensee'), 'name')
                ->sortable(),
            Column::make(__('License Key'), 'license_uuid')
                ->sortable(),
            Column::make(__('Licensee User'), 'user_id')
                ->sortable(),
            Column::make(__('Created On'), 'valid_until'),
            Column::make(__('Expires on'), 'valid_until'),
            Column::make(__('Status'), 'status'),
            Column::make(__('Actions')),
        ];
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.license.includes.row';
    }
}
