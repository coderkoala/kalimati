<?php

namespace App\Http\Livewire\Backend;

use App\Models\Backend\PriceLog as table_model;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class ArticleTable.
 */
class PriceTable extends DataTableComponent
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
        return table_model::select('entry_date as date', \DB::raw('COUNT(commodity_id) as commodity_count'), 'price_type')->groupBy('entry_date', 'price_type')->orderBy('entry_date', 'desc')
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Price Log Date'), 'date')
                ->sortable(),
            Column::make(__('Number of Commodities Logged'), 'commodity_count')
                ->sortable(),
            Column::make(__('Commodity Price Type'), 'price_type')
                ->sortable(),
            Column::make(__('Actions')),
        ];
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.pricelog.includes.row';
    }
}
