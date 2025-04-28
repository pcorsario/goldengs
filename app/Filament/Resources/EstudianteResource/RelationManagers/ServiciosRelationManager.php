<?php

namespace App\Filament\Resources\EstudianteResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextArea;
use Filament\Tables\Columns\Summarizers\Sum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiciosRelationManager extends RelationManager
{
    protected static string $relationship = 'servicios';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
 Forms\Components\FileUpload::make('imagen')
                ->image()
                ->required()
                ->disk('public')       // Asegúrate de que el disco esté configurado en Laravel
                 // ->directory('servicios') // Carpeta dentro del disco (ej: storage/app/public/servicios)
                ->visibility('public') // Opcional: para acceso público si usas enlaces simbólicos
                ->maxSize(2048) // Tamaño máximo en KB (ej: 2MB)
                ->label('Comprobante de Pago')
                ->acceptedFileTypes(['image/jpeg', 'image/png'])
                ->columnSpan('full'),
                Forms\Components\DatePicker::make('fecha_pago')
                    ->required()
                    ->columnSpan('full'),
                Forms\Components\TextInput::make('nrocomprobante')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nombre_servicio')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('forma_pago')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('valor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(65535)
                    ->rows(3)
                    ->placeholder('Notas adicionales'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('fecha_pago')
            ->columns([
                Tables\Columns\TextColumn::make('fecha_pago'),
TextColumn::make('nombre_servicio')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('forma_pago')
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
