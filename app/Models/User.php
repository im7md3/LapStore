<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;

    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

  
    protected $appends = [
        'profile_photo_url',
    ];


    public function cart(){
        return $this->belongsToMany(Product::class,'cart')->withPivot(['bought','number'])->wherePivot('bought',false);
    }

    public function inCart($product){
        return $this->cart()->where('id',$product)->exists();
    }

    public function scopePrice(){
        $totalPrice=0;
        foreach ($this->cart as  $product) {
            $totalPrice += $product->price * $product->pivot->number;
        }
        return $totalPrice;
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
