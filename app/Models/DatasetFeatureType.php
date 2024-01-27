<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatasetFeatureType extends Model
{
    use HasFactory;
    protected $table = 'dataset_feature_types';
    protected $guarded = [];
}
