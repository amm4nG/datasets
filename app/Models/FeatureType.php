<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureType extends Model
{
    use HasFactory;
    protected $table = 'feature_types';
    protected $guarded = [];
}
