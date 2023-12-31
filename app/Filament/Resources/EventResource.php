<?php

namespace App\Filament\Resources;

use App\Enums\RecurringType;
use App\Enums\UnitType;
use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use App\Models\User;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('title')->required(),
                        TextInput::make('description')->nullable(),
                        DatePicker::make('start_date')->native(false)->required(),
                        DatePicker::make('end_date')->native(false)->nullable(),

                        ColorPicker::make('color')->nullable(),
                        FileUpload::make('logo_url')->image()->imageEditor()
                            ->openable()->downloadable(),
                        Select::make('unit')->required()->options(UnitType::getAsAssociatedArray()),

                        Select::make('recurrence_type')
                            ->required()
                            ->label('Recurrence')
                            ->options(RecurringType::getAsAssociatedArray())
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('recurrence_interval', $state === 'custom' ? null : 0))
                            ->native(false),

                        TextInput::make('recurrence_interval')
                            ->label('Interval')
                            ->numeric()
                            ->visible(fn (callable $get) => $get('recurrence_type') === 'custom'),

                        Select::make('user_id')->options(User::pluck('name', 'id'))->preload()->label('User')->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo_url'),
                ColorColumn::make('color'),
                TextColumn::make('unit'),
                TextColumn::make('title'),
                TextColumn::make('description')->limit(50)->toggleable()->toggledHiddenByDefault(),
                TextColumn::make('start_date')->dateTime(),
                TextColumn::make('end_date')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
            'view' => Pages\ViewEvent::route('/{record}'),
        ];
    }
}
