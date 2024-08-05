<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicamentosResource\Pages;
use App\Filament\Resources\MedicamentosResource\RelationManagers;

use App\Models\Medicamentos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicamentosResource extends Resource
{
    protected static ?string $model = Medicamentos::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(100)
                    ->unique(),
                Forms\Components\Select::make('tipo')
                    ->options([
                        'Pastillas o tabletas' => 'Pastillas o tabletas',
                        'Jarabes' => 'Jarabes',
                        'Inyecciones' => 'Inyecciones',
                        'Cremas y ungüentos' => 'Cremas y ungüentos',
                        'Inhaladores' => 'Inhaladores',
                    ])
                    ->nullable()
                    ->required(),
                Forms\Components\MarkdownEditor::make('descripcion')->columnSpan('full')
                    ->nullable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('descripcion')
                    ->limit(50),
                Tables\Columns\TextColumn::make('tipo'),
            ])
            ->filters([
                // Puedes agregar filtros aquí
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

    public static function getRelations(): array
    {
        return [
            //RelationManagers\InventarioRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedicamentos::route('/'),
            'create' => Pages\CreateMedicamentos::route('/create'),
            'edit' => Pages\EditMedicamentos::route('/{record}/edit'),
        ];
    }
}
