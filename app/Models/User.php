<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'phone', 'birth_date',
    ];

    // phone column mutator
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = ltrim($value, '+');
    }

    public function scopeSearch($query, array $search)
    {

        $query->when($search['search'] ?? false, function ($query, $searchString) {

            $query->where(function ($query) use ($searchString) {

                if (ctype_digit($searchString)) {
                    // Calculate birth date range for the specified age
                    $minBirthDate = now()->subYears($searchString)->addDay()->toDateString();
                    $maxBirthDate = now()->subYears($searchString + 1)->subDay()->toDateString();

                    // Add where clause to filter users by birth date range
                    $query->whereBetween('birth_date', [$maxBirthDate, $minBirthDate]);
                }

                $query->orWhere('name', 'like', '%' . $searchString . '%')
                ->orWhere('email', 'like', '%' . $searchString . '%')
                ->orWhere('phone', 'like', '%' . $searchString . '%');
            });
        });
    }
}
