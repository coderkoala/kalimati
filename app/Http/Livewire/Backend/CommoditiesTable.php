<?php

namespace App\Http\Livewire\Backend;

use App\Models\Backend\Commodities as table_model;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class ArticleTable.
 */
class CommoditiesTable extends DataTableComponent
{
    /**
     * @var
     */
    public $status;

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return table_model::withTrashed()->orderBy('id')
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Commodity Identifier'), 'name')
                ->sortable(),
            Column::make(__('Commodity Name'), 'commodity_'.app()->getLocale())
                ->sortable(),
            Column::make(__('Commodity Unit'), 'unit_'.app()->getLocale())
                ->sortable(),
            Column::make(__('Created By'), 'created_by')->sortable(),
            Column::make(__('Created At'), 'created_at')->sortable(),
            Column::make(__('Status'), 'status'),
            Column::make(__('Actions')),
        ];
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.commodities.includes.row';
    }
}
