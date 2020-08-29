<?php
namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use App\BuyerNotifications\BuyerPasswordResetNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Notifications\PasswordResetNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Buyer extends Authenticatable
{
    use Notifiable;

    protected $guard ='buyers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'buyer_name', 'email', 'password','img'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


 public function orderProduct(): BelongsToMany
 //buyerとのリレーション(多対多)（buyerをもとにproduct取得）
    {
        return $this->belongsToMany('App\Product', 'orders','buyer_id', 'product_id')->withTimestamps();
    }


      public function sendPasswordResetNotification($token)
      {
         $this->notify(new BuyerPasswordResetNotification($token));
       }

}
