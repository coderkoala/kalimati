<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Backend\Notices as table_model;

/**
 * Class NoticesTable.
 */
class NoticesTable extends DataTableComponent
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
            Column::make(__('Title'), 'title_' . app()->getLocale())
                ->sortable(),
            Column::make(__('Type'), 'type')
                ->sortable(),
            Column::make(__('Created By'), 'created_by')
                ->sortable(),
            Column::make(__('Published At'), 'published_at')
                ->sortable(),
            Column::make(__('Created On'), 'created_at')->sortable(),
            Column::make(__('Status'), 'status'),
            Column::make(__('Actions')),
        ];
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.notices.includes.row';
    }
}
