<?php

namespace App\Filament\Resources\EstudianteResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Estudiante;
use App\Models\Servicio;
class EstudiantesStats extends BaseWidget
{
 protected function getHeading(): ?string
    {
        return 'Resumen de Servicios';
    }
protected static ?int $sort = 2; // Orden en el dashboard
    protected function getStats(): array
    {
$total = Servicio::sum('valor'); // Asegúrate que 'valor' sea el nombre correcto de tu columna
        
        return [
  Stat::make('Total Facturado', number_format($total, 2).' USD')
                ->description('Suma de todos los servicios')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('info')
                ->chart([7, 3, 4, 5, 6, 3, 5]) // Datos de ejemplo para gráfico
                ->extraAttributes([
                    'class' => 'border-l-4 border-green-500' // Borde izquierdo verde
                ]),
            Stat::make('Estudiantes Registrados', Estudiante::count())
                ->description('Total de inscritos')
                ->descriptionIcon('heroicon-o-users')
                ->color('success'),
        ];
    }
}
