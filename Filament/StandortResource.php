<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use App\Models\Standort;

use Filament\Tables\Table;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\StandortResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StandortResource\RelationManagers;

class StandortResource extends Resource
{
    protected static ?string $model             = Standort::class;
    //protected static ?string $navigationIcon    =   'heroicon-o-home';
    protected static ?string $navigationGroup   =   'Filialverwaltung';
    protected static ?string $navigationLabel   =   'Filialen';
    protected static ?string $modelLabel        =   'Filiale';
    protected static ?string $slug              =   'filialen';


    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('access-module-branch');
    }

    public static function getPluralLabel(): ?string {
        return "Filialen";
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kunde_id')->hidden(),//->value(Auth::user()->kunde_id),
                Forms\Components\FileUpload::make('bild_filiale')
                ->label('Bild der Filiale')
                ->image()->maxSize(3000),
                Forms\Components\TextInput::make('nummer')
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('strasse')
                    ->maxLength(255),
                Forms\Components\TextInput::make('hausnummer')
                    ->maxLength(255),
                Forms\Components\TextInput::make('plz')
                    ->maxLength(255),
                Forms\Components\TextInput::make('ort')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('webseite')
                    ->maxLength(255),
                Forms\Components\Textarea::make('ansprechpartner')
                    ->maxLength(65535),
                    Forms\Components\FileUpload::make('bild_ansprechpartner')
                    ->label('Bild des Ansprechspartners')
                    ->image()->maxSize(3000),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nummer')->Label('Filial Nummer'),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('strasse'),
                Tables\Columns\TextColumn::make('hausnummer'),
                Tables\Columns\TextColumn::make('plz'),
                Tables\Columns\TextColumn::make('ort')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('webseite'),
                Tables\Columns\TextColumn::make('ansprechpartner'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListStandorts::route('/'),
            'create' => Pages\CreateStandort::route('/create'),
            'edit' => Pages\EditStandort::route('/{record}/edit'),
        ];
    }
}
