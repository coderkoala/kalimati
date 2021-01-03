<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use App\Models\commodityPriceDaily as commodity;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;


class FetchDailyCommodityPriceTable extends LivewireDatatable
{
	public $hideable = 'select';
    public $exportable = true;
    public $afterTableSlot = 'components.selected';
	public $model = commodity::class;

    public function builder()
    {
        return commodity::getPrice( date('Y-m-d', time() ) );
	}

	public function columns()
    {
        return [
            Column::name('commodityname')
                ->filterable()
                ->label('Name'),
            Column::name('commodityunit')
                ->filterable()
                ->label('Unit'),
            Column::name('minprice')
                ->filterable()
                ->label('Minimum'),
            Column::name('maxprice')
                ->filterable()
                ->label('Maximum'),
            Column::name('avgprice')
                ->filterable()
                ->label('Average'),
		];
	}
}
