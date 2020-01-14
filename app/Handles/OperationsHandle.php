<?php


namespace App\Handles;

use Carbon\Carbon;

class OperationsHandle
{
    /**
     * Returns start date and end date depending on the selected period
     *
     * @param $period
     * @return array
     */
    public function defineDateStartDateEndForPeriod($period){
        switch ($period){
            case 'today':
                $dateStart = Carbon::today();
                $dateEnd = Carbon::tomorrow();
                break;
            case 'yesterday':
                $dateStart = Carbon::yesterday();
                $dateEnd = Carbon::today();
                break;
            case 'week':
                $dateStart = Carbon::today()->subWeek();
                $dateEnd = Carbon::tomorrow();
                break;
            case 'month':
                $dateStart = Carbon::today()->subMonth();
                $dateEnd = Carbon::tomorrow();
                break;
            case 'quarter':
                $dateStart = Carbon::today()->subMonth(3);
                $dateEnd = Carbon::tomorrow();
                break;
            case 'year':
                $dateStart = Carbon::today()->subYear();
                $dateEnd = Carbon::tomorrow();
                break;
        }
        return ['dateStart' => $dateStart, 'dateEnd' => $dateEnd];
    }
}