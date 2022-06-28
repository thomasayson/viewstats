<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class MonthlyChart extends BaseChart
{
    public ?string $name = 'MonthlyChart';
    public ?string $routeName = '/welcome';
    public ?string $prefix = 'some_prefix';
    public ?array $middlewares = ['auth'];
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        return Chartisan::build()
            ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'])
            ->dataset('Total Visitors per Month', [60, 80, 89, 70, 64, 50, 49, 70, 83, 66, 65, 75]);
    }
}