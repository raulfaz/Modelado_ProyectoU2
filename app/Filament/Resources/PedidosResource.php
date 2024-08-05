<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PedidosResource\Pages;
use App\Filament\Resources\PedidosResource\RelationManagers;
use App\Models\Pedidos;
use App\Models\User; // Cambiado a User para reflejar el modelo correcto
use App\Models\Inventario;
use App\Models\Medicamentos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\Log;
use Illuminate\Support\Facades\Auth;

class PedidosResource extends Resource
{
    protected static ?string $model = Pedidos::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('cliente_id')
                    ->default(fn () => Auth::id()),

                Forms\Components\Hidden::make('estado_pedido')
                    ->default('PENDIENTE'),

                Forms\Components\Repeater::make('detalles_pedido')
                    ->schema([
                        Forms\Components\Select::make('medicamento_id')
                            ->label('Medicamento')
                            ->options(function () {
                                $medicamentos = Medicamentos::whereHas('inventario', function ($query) {
                                    $query->where('cantidad', '>', 0);
                                })->get();

                                // Log::info('Medicamentos disponibles:', $medicamentos->toArray());

                                return $medicamentos->pluck('nombre', '_id');
                            })
                            ->required()
                            ->searchable(),

                        Forms\Components\TextInput::make('cantidad')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->afterStateUpdated(function ($set, $get, $state) {
                                $medicamentoId = $get('medicamento_id');
                                $inventario = Inventario::where('medicamento_id', $medicamentoId)->first();
                                if ($inventario && $state > $inventario->cantidad) {
                                    $set('cantidad', $inventario->cantidad);
                                }
                            }),
                    ])
                    ->required()
                    ->label('Medicamentos solicitados')
                    ->columns(2),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cliente_id') // Aquí se accede a la relación correctamente
                    ->label('Nombre del Cliente')
                    ->formatStateUsing(function ($record) {
                        $cliente = $record->cliente; // Usa la relación definida en el modelo
                        return $cliente ? $cliente->name : 'Cliente desconocido';
                    }),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Fecha del Pedido')
                    ->date('d/m/Y H:i') // Formato de fecha personalizable
                    ->sortable(),

                Tables\Columns\TextColumn::make('estado_pedido')
                    ->label('Estado')
                    ->default('Pendiente'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPedidos::route('/'),
            'create' => Pages\CreatePedidos::route('/create'),
            'edit' => Pages\EditPedidos::route('/{record}/edit'),
        ];
    }
}
