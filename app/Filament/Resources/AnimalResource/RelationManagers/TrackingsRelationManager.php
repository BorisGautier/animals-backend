<?php

namespace App\Filament\Resources\AnimalResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrackingsRelationManager extends RelationManager
{
    protected static string $relationship = 'trackings';

    protected static ?string $recordTitleAttribute = 'animal_id';

    protected static ?string $title = 'Déplacements';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('lon')->label('Longitude')->required(),
                TextInput::make('lat')->label('Latitude')->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lon')->label('Longitude'),
                TextColumn::make('lat')->label('Latitude')
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
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
