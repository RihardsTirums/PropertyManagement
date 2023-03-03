<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static whereDoesntHave(string $string)
 * @method static findOrFail($personId)
 * @method static find($personId)
 * @property mixed $name
 * @property mixed $surname
 * @property mixed $type
 * @property mixed $title
 * @property mixed $registration_number
 * @property mixed|null $personal_code
 * @property mixed $id
 */
class Person extends Model
{
    use HasFactory;
    protected $table = "persons";
    protected $fillable = ['name', 'surname', 'type', 'personal_code', 'title', 'registration_number'];

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class, 'persons_id');
    }
}
