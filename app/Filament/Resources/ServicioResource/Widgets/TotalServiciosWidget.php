<?php

namespace App\Filament\Resources\ServicioResource\Widgets;

use Filament\Widgets\ChartWidget;

class TotalServiciosWidget extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
