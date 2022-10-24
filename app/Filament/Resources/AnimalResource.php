<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnimalResource\Pages;
use App\Filament\Resources\AnimalResource\RelationManagers;
use App\Filament\Widgets\Deplacements;
use App\Models\Animal;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\TemporaryUploadedFile;

class AnimalResource extends Resource
{
    protected static ?string $model = Animal::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description'),
                Forms\Components\TextInput::make('classe')
                    ->maxLength(255),
                Forms\Components\TextInput::make('order')
                    ->maxLength(255),
                Forms\Components\TextInput::make('family')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date_naissance'),
                Forms\Components\TextInput::make('sexe')
                    ->maxLength(255),
                Forms\Components\TextInput::make('localisation')
                    ->maxLength(255),
                Forms\Components\TextInput::make('longitude')
                    ->maxLength(255),
                Forms\Components\TextInput::make('latitude')
                    ->maxLength(255),
                Forms\Components\Textarea::make('funfact'),
                Forms\Components\TextInput::make('diet'),
                Forms\Components\Textarea::make('habitat'),
                Forms\Components\Textarea::make('menaces'),
                Repeater::make('medias')
                    ->relationship()
                    ->schema([
                        Select::make('type_media_id')
                            ->relationship('typeMedia', 'name')
                            ->required(),
                        FileUpload::make('media_url')
                            ->disk('public')
                            ->directory('uploads/animals/images')
                            ->image()
                            ->loadingIndicatorPosition('left')
                            ->enableDownload()
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                                return (string) str($file->getClientOriginalName())->prepend(time() . '_');
                            }),

                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('family'),
                Tables\Columns\TextColumn::make('localisation'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TrackingsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnimals::route('/'),
            'create' => Pages\CreateAnimal::route('/create'),
            'view' => Pages\ViewAnimal::route('/{record}'),
            'edit' => Pages\EditAnimal::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
