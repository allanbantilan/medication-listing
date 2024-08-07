<?php

namespace App\Services;

use filament\Forms;
use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\medications;
use Illuminate\Support\Str;
use App\Services\MedicationForm;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Forms\Components\Concerns\HasHeaderActions;

final class MedicationForm
{

    public static function schema(): array
    {
        $intervalOption = [
            'Day' => 'Day'
        ];

        for ($day = 2; $day <= 31; $day++) {
            $intervalOption["$day Days"] = "$day Days";
        }

        return [
            TextInput::make('name')
                ->required()
                ->columnSpanFull(),
            TextInput::make('dosage')
                ->required()
                ->numeric(),
            Select::make('type')
                ->required()
                ->native(false)
                ->options([
                    'tablet' => 'Tablet',
                    'syrup' => 'Syrup',
                    'capsule' => 'Capsule',
                    'injectable' => 'Injectable'
                ]),
            Select::make('interval')
                ->required()
                ->prefix('Every')
                ->searchable()
                ->options($intervalOption),
        ];
    }
}
