<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociatedTask extends Model
{
    use HasFactory;
    protected $table = 'associated_tasks';
    protected $guarded = [];
}
