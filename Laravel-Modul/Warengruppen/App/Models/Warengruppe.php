<?php

namespace Modules\Warengruppen\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Warengruppen\Database\factories\WarengruppeFactory;

class Warengruppe extends Model
{

    protected $table = 'warengruppen';

    protected $fillable = [
        'nummer',
        'bezeichnung',
        'dk_main_cat',
        'dk_sub_cat',
        'type',
        'kunde_id',
    ];

}
