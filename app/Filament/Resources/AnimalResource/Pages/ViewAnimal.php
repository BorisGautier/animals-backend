<?php

namespace App\Filament\Resources\AnimalResource\Pages;

use App\Filament\Resources\AnimalResource;
use App\Models\Animal;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Redirect;

class ViewAnimal extends ViewRecord
{
    protected static string $resource = AnimalResource::class;

    protected static ?string $title = 'Animal Details';

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('Voir la fiche')
                ->action('openTab')
                ->openUrlInNewTab()
                ->color('success'),
        ];
    }

    public function openTab()
    {
        $id = $this->record->id;
        return Redirect::away("http://animal.position.cm/?id=$id");
    }
}
