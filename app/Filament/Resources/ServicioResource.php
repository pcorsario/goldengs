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
                ->disk('public')       // Asegúrate de que el disco esté configurado en Laravel
                ->directory('servicios') // Carpeta dentro del disco (ej: storage/app/public/servicios)
                ->visibility('public') // Opcional: para acceso público si usas enlaces simbólicos
                ->maxSize(2048) // Tamaño máximo en KB (ej: 2MB)
                ->label('Comprobante de Pago')
                ->directory('servicios')
                ->columnSpan('full')
                ->acceptedFileTypes(['image/jpeg', 'image/png']), // Tipos de archivo aceptados
           
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
    ImageColumn::make('imagen')
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
