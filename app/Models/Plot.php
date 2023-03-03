<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static whereDoesntHave(string $string)
 * @property mixed $property_id
 * @property mixed $land_uses
 * @property mixed $id
 * @property \Illuminate\Support\Carbon|mixed $updated_at
 */
class Plot extends Model
{
    use HasFactory;
    protected $table = "plots";
    protected $fillable = ['cadastral_sign', 'total_area', 'date_of_survey', 'property_id'];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function land_uses(): BelongsToMany
    {
        return $this->belongsToMany(LandUse::class, 'plot_land_uses')->withPivot('plot_id');
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
