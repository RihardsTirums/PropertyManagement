<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static whereDoesntHave(string $string)
 * @method static find(mixed $input)
 * @property mixed $id
 * @property mixed $title
 * @property mixed $cadastre_number
 * @property mixed $status
 * @property mixed $persons_id
 */
class Property extends Model
{
    use HasFactory;
    protected $table = "properties";
    protected $fillable = ['title', 'cadastre_number', 'status', 'persons_id'];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'persons_id');
    }

    public function plots(): HasMany
    {
        return $this->hasMany(Plot::class);
    }
}
