<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class AverageVisitors extends BaseChart
{
    public ?string $name = 'AverageVisitors';
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
            ->labels(['January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July ',
            'August',
            'September',
            'October',
            'November',
            'December',])
            ->dataset('Average Visitors per Month', [20, 30, 34, 46, 33, 35, 42, 47, 29, 38, 49, 33]);
    }
}