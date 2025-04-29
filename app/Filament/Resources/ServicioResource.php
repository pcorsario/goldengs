<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServicioResource\Pages;
use App\Filament\Resources\ServicioResource\RelationManagers;
use App\Models\Servicio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextArea;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Actions\Action;
class ServicioResource extends Resource
{
    protected static ?string $model = Servicio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
Forms\Components\FileUpload::make('imagen')
    ->image()
    ->required()
    ->disk('public')
    ->visibility('public')
    ->directory('servicios') // <- aquí corregido
    ->maxSize(2048)
    ->label('Comprobante de Pago')
    ->columnSpan('full')
    ->acceptedFileTypes(['image/jpeg', 'image/png']),
           
                Forms\Components\Select::make('estudiante_id')
                ->relationship('estudiante', 'nombres')
                ->required()
                ->searchable()
                ->preload()
                ->reactive(),
                Forms\Components\DatePicker::make('fecha_pago')
                ->required(),
            Forms\Components\TextInput::make('nombre_servicio')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('nrocomprobante')
                ->required()
                ->maxLength(255),
         Forms\Components\TextInput::make('forma_pago')
                ->required()
                ->maxLength(255),
            Forms\Components\Textarea::make('notes')
                ->maxLength(65535),
            
            Forms\Components\TextInput::make('valor')
                ->required()
                ->integer()
                ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 TextColumn::make('id')
                ->sortable()
                ->searchable(),
    TextColumn::make('fecha_pago')
                ->sortable()
                ->searchable(),
    TextColumn::make('nombre_servicio')
                ->sortable()
                ->searchable(),
    TextColumn::make('forma_pago')
                ->sortable()
                ->searchable(),
    TextColumn::make('estudiante.nombres')
                ->label('Estudiante')
                ->sortable()
                ->searchable(),
                TextColumn::make('valor')
                ->money('USD')
                ->summarize([
                    Sum::make()
                        ->money('USD')
                        ->label('Total')
                
                ]),
   Tables\Columns\ImageColumn::make('imagen')
                ->disk('public')
                ->visibility('public')
                ->height(60)
                ->label('Imagen')
                ->extraAttributes([
                    'class' => 'cursor-pointer', // Cambia el cursor a "clickable"
                ])
                ->action(
                    Action::make('ver_imagen')
                        ->modalHeading('Vista previa de la imagen')
                        ->modalContent(fn (Servicio $record) => view('components.ver-imagen-modal', [
                            'imagen' => asset('storage/' . $record->imagen),
                        ]))
                        ->modalSubmitAction(false) // No botón "Guardar"
                        ->modalCancelActionLabel('Cerrar') // Solo botón "Cerrar"
                ),
        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServicios::route('/'),
            'create' => Pages\CreateServicio::route('/create'),
            'edit' => Pages\EditServicio::route('/{record}/edit'),
        ];
    }
}
