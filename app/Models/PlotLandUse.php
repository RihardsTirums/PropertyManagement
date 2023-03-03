<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlotLandUse extends Model
{
    use HasFactory;
    protected $fillable = ['plot_id', 'land_use_id'];
}
