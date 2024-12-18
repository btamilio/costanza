<?php 


namespace App\Models;



use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
 
use Illuminate\Notifications\Notifiable;

use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

use Illuminate\Support\Facades\Hash;
use App\Models\Poem;

class User extends Authenticatable 
{
    use Notifiable, HasApiTokens, HasFactory, SoftDeletes;

    public $table = 'users';


    protected $fillable = [
        'email',
        'name',
        'email_verified_at'
    ];

    public function poems() {
        return $this->hasMany(Poem::class, 'user_id', 'id');
    }


 
}