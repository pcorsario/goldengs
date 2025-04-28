<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstudianteResource\Pages;
use App\Filament\Resources\EstudianteResource\RelationManagers;
use App\Models\Estudiante;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;
class EstudianteResource extends Resource
{
    protected static ?string $model = Estudiante::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('cedula')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('apellidos')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nombres')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('fecha_nacimiento')
                    ->label('Fecha de Nacimiento')
                    ->required()
                    ->maxDate(now()),
                Forms\Components\TextInput::make('edad')
                    ->required()
                    ->integer()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ciudad')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('colegio')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('correo')
                    ->required()
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('direccion')
                    ->required()
                    ->maxLength(255),
 Forms\Components\TextInput::make('telefono')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('periodo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('grupo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('horario')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('usuario')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('contrasena')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('representante_id')
                    ->relationship('representante', 'nombres')
                    ->searchable()
                    ->preload()
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state) {
                        if ($state === 'OTRO') {
                            $set('representante_id', null);
                        }
                    })
                    ->createOptionForm([
                        Forms\Components\TextInput::make('cedula')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('apellidos')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nombres')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('parentesco')
                            ->label('Parentesco')
                            ->options([
                                'PAPÁ' => 'PAPÁ',
                                'MAMÁ' => 'MAMÁ',
                                'ABUELO' => 'ABUELO',
                                'ABUELA' => 'ABUELA',
                                'TIO' => 'TIO',
                                'TIA' => 'TIA',
                                'PRIMO' => 'PRIMO',
                                'PRIMA' => 'PRIMA',
                                'HERMANO' => 'HERMANO',
                                'HERMANA' => 'HERMANA',
                                'PAREJA' => 'PAREJA',
                                'OTRO' => 'OTRO',
                            ])
                            ->required()
                            ->reactive(),
                        Forms\Components\TextInput::make('telefono')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               Tables\Columns\TextColumn::make('cedula')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellidos')
                    ->sortable()
                    
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombres')
                    ->sortable()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('fecha_nacimiento')
                //     ->label('Fecha de Nacimiento')
                //     ->sortable()
                //     ->date(),
                // Tables\Columns\TextColumn::make('edad')
                //     ->sortable()
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('ciudad')
                //     ->sortable()
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('colegio')
                //     ->sortable()
                //     ->searchable(),
                Tables\Columns\TextColumn::make('correo')
                    ->sortable()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('direccion')
                //     ->sortable()
                //     ->searchable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->sortable()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('periodo')
                //     ->sortable()
                //     ->searchable(),
                Tables\Columns\TextColumn::make('grupo')
                    ->sortable()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('horario')
                //     ->sortable()
                //     ->searchable(),
            ])
            ->filters([
                 SelectFilter::make('grupo')
    ->options([
        'I' => 'Grupo 1',
        'II' => 'Grupo 2',
        'III' => 'Grupo 3',
            ])
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
            RelationManagers\ServiciosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEstudiantes::route('/'),
            'create' => Pages\CreateEstudiante::route('/create'),
            'edit' => Pages\EditEstudiante::route('/{record}/edit'),
        ];
    }
}
