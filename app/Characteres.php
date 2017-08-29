<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Characteres extends Model
{
    protected $fillable = array('id', 'pseudo', 'sexe','photo','activity', 'birthdate', 'latitude', 'longitude', 'state', 'resume', 'saison');
}
