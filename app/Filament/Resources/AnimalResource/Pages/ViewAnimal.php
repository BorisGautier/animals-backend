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
        $code = $this->randomString() . $id;

        return Redirect::away("https://tracking.forearthver.com/?code=$code");
    }

    public function randomString($length = 8)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
