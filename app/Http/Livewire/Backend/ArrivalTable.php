<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Backend\ArrivalLog as table_model;

/**
 * Class ArrivalTable.
 */
class ArrivalTable extends DataTableComponent
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
        return table_model::select('entry_date as date', \DB::raw('COUNT(commodity_id) as commodity_count'))->groupBy('entry_date')->orderBy('entry_date', 'desc')
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Created At'), 'date')
                ->sortable(),
            Column::make(__('Number of Commodities Logged'), "commodity_count" )
                ->sortable(),
            Column::make(__('Actions')),
        ];
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.arrival.includes.row';
    }
}
