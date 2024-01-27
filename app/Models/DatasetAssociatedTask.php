<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatasetAssociatedTask extends Model
{
    use HasFactory;
    protected $table = 'dataset_associated_tasks';
    protected $guarded = [];
}
