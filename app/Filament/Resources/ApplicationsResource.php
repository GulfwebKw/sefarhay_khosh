<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationsResource\Pages;
use App\Models\Application;
use App\Models\Status;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use HackerESQ\Settings\Facades\Settings;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class ApplicationsResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Information')
                            ->schema([
                                Forms\Components\TextInput::make('name'),
                                Forms\Components\TextInput::make('email'),
                                Forms\Components\TextInput::make('phone'),
                                Forms\Components\Select::make('country_id')
                                    ->relationship('country', 'title_en')
                                    ->searchable()
                                    ->required(),
                                Forms\Components\FileUpload::make('passport')
                                    ->image(),
                                Forms\Components\FileUpload::make('face')
                                    ->image(),
                                Forms\Components\FileUpload::make('national_id')
                                    ->image(),
                                Forms\Components\FileUpload::make('national_id2')
                                    ->image(),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Payment Information')
                            ->schema([
                                Forms\Components\TextInput::make('gateway'),
                                Forms\Components\TextInput::make('price'),
                                Forms\Components\TextInput::make('invoiceReference'),
                                Forms\Components\TextInput::make('invoiceId'),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => fn (?Application $record) => $record === null ? 3 : 2]),

                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('status_id')
                            ->relationship('status', 'title_en')
                            ->searchable()
                            ->required(),
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn (Application $record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('paid_at')
                            ->label('Invoice paid at')
                            ->content(fn (Application $record): ?string => $record->updated_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (Application $record): ?string => $record->updated_at?->diffForHumans()),

                    ])
                    ->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('country.title_en')
                    ->label('Country')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status.title_en')
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->placeholder(fn ($state): string => 'Dec 18, ' . now()->subYear()->format('Y')),
                        Forms\Components\DatePicker::make('created_until')
                            ->placeholder(fn ($state): string => now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Application from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Application until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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

    public static function getWidgets(): array
    {
        return [
//            OrderStats::class,
        ];
    }


    public static function getNavigationBadge(): ?string
    {
        return static::$model::where('status_id',  Settings::get('first_status'))->count();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApplications::route('/'),
            'create' => Pages\CreateApplications::route('/create'),
            'edit' => Pages\EditApplications::route('/{record}/edit'),
            'view' => Pages\ViewApplications::route('/{record}'),
        ];
    }


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScope(SoftDeletingScope::class);
    }
    public static function canCreate(): bool
    {
        return false;
    }
}
