<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Hersteller;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HerstellerMappingUpload extends Component
{
    use WithFileUploads;

    public $csv_file    =   '';
    public $can_submit  =   false;

    public function render()
    {
        return view('livewire.hersteller-mapping-upload');
    }

    public function startImport(string $file_name, string $separator=';') {
        //Log::info('Starting to upload Haendler Match ' . $file_name);
        if (($csv_file = fopen(storage_path('app/hersteller/' . $file_name), 'rb')) !== false) {
            //skip the first row
            fgetcsv($csv_file);

            //und nun geht es los
            $aktuelle_zeile =   0;
            while (($csv_row = fgetcsv($csv_file, 1000, ";")) !== false) {
                if (sizeof($csv_row) == 3) {
                    $hersteller             =   ($csv_row[0]) ? $csv_row[0] : '';
                    $dk_hersteller_id       =   ($csv_row[1]) ? $csv_row[1] : 0;
                    $kunde_hersteller_id    =   ($csv_row[2]) ? $csv_row[2] : 0;
                    $kunde_id               =   auth()->user()->kunde_id;
                    //Haben wir den Hersteller sonst erstellen wir ihn?
                    $_tmp = Hersteller::firstOrCreate([
                        'name'              =>  $hersteller,
                        'dk_hersteller_id'  =>  $dk_hersteller_id
                    ]);
                    DB::insert('INSERT INTO hersteller_mappings (hersteller_id_kunde, hersteller_id_dk, kunde_id, hersteller_id) VALUES (?,?,?,?)',[$kunde_hersteller_id, $dk_hersteller_id, $kunde_id, $_tmp->id]);
                    $aktuelle_zeile++;
                }
            }
            return redirect('/admin');
        }

    }

    public function showProgress() {
        //Log::info('Progress Haendler');
    }

    protected $listeners = [
        'file:csv-file-uploaded'    =>  'startImport',
        'file:csv-progress'         =>  'showProgress',
    ];

}
