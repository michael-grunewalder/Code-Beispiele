@extends('layouts.app')

@section('content')
    <form action="{{route('warengruppen.store')}}" method="post">
        {{csrf_field()}}
        <x-adminlte-card title="Warengruppe hinzufügen" bg="primary" class="text-bold">
            <x-adminlte-input name="nummer" id="nummer" label="Nummer" value="{{old('nummer')}}"/>
            <x-adminlte-input name="bezeichnung" id="bezeichnung" label="Bezeichnung" value="{{old('bezeichnung')}}" />
            @if(auth()->user()->isDKAdmin())
                <x-adminlte-input name="dk_main_cat" id="dk_main_cat" label="DK Main Cat" value="{{old('dk_main_cat')}}"/>
                <x-adminlte-input name="dk_sub_cat" id="dk_sub_cat" label="DK Sub Cat" value="{{old('dk_sub_cat')}}"/>
            @endif
            <x-adminlte-select name="type" id="type" label="Typ der Warengruppe" value="{{old('type')}}">
                <option value="0">Bitte auswählen</option>
                <option value="1">Haushaltsgeräte</option>
                <option value="2">Holz</option>
                <option value="3">Zubehör</option>
            </x-adminlte-select>
            <button type="submit" class="btn btn-primary">Speichern</button>
        </x-adminlte-card>
    </form>
@endsection
