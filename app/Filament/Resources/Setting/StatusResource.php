<?php

namespace App\Filament\Resources\Setting;

use App\Filament\Resources\Setting\StatusResource\Pages;
use App\Filament\Resources\Setting\StatusResource\RelationManagers;
use App\Models\Status;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StatusResource extends Resource
{
    protected static ?string $model = Status::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Setting';
    protected static ?string $navigationLabel = "Status";
    protected static ?string $label = "Status";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title_en')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title_fa')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description_en')
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description_fa')
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\TextInput::make('icon')
                    ->helperText('https://fontawesome.com/v6/icons?s=light')
                    ->placeholder('fa-file-pen')
                    ->required(),
                Forms\Components\ColorPicker::make('color')
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title_en')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title_fa')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
            ])
            ->defaultSort('ordering')
            ->reorderable('ordering');
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
            'index' => Pages\ListStatuses::route('/'),
            'create' => Pages\CreateStatus::route('/create'),
            'edit' => Pages\EditStatus::route('/{record}/edit'),
        ];
    }
}
