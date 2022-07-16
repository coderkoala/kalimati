<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Backend\ArrivalLog;

/**
 * Class ArrivalShowTable.
 */
class ArrivalShowTable extends DataTableComponent
{
    /**
     * @var
     */
    public $entry_date;

    public bool $showSearch = true;

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return ArrivalLog::join('commodities_arrival', 'commodities_arrival.commodity_id', '=', 'daily_arrival_log.commodity_id')
        ->select(
            'daily_arrival_log.id',
            'commodities_arrival.' . "commodity_" . app()->getLocale() . ' as commodity',
            'daily_arrival_log.quantity',
            )
        ->where('daily_arrival_log.entry_date', $this->entry_date )
        ->where('commodities_arrival.deleted_at', null);
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Commodity Name'), 'commodity')->sortable(),
            Column::make(__('Quantity'), "quantity" ),
        ];
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.arrival.includes.row-single';
    }
}
