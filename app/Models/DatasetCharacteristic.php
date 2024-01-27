<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatasetCharacteristic extends Model
{
    use HasFactory;
    protected $table = 'dataset_characteristics';
    protected $guarded = [];
}
