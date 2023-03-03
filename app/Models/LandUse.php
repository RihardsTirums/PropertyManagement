<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static firstOrCreate(array $array)
 * @method static where(string $string, mixed $land_use)
 */
class LandUse extends Model
{
    use HasFactory;
    protected $table = "land_uses";
    protected $fillable = ['type'];

    public function plots(): BelongsToMany
    {
        return $this->belongsToMany(Plot::class, 'plot_land_uses');
    }
}
