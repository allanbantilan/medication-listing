<?php

namespace App\Livewire;

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
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Forms\Components\Concerns\HasHeaderActions;

class ListMedications extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    public function render()
    {
        return view('livewire.list-medications');
    }

    public function table(Table $table): Table
    {



        return $table
            ->query(Medications::query())
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('dosage')
                    ->formatStateUsing(function (Medications $record) {
                        return $record->dosage . ' ' . ucfirst(Str::plural($record->type, $record->dosage)) . ' Every ' . $record->interval;
                    }),
            ])
            ->actions([
                EditAction::make()
                    ->slideOver()
                    ->form(MedicationForm::schema()),
                DeleteAction::make()

            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->slideOver()
                    ->model(Medications::class)
                    ->form(MedicationForm::schema()),
            ]);
    }
}
