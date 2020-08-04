<?php

namespace App;


use Illuminate\Auth\MustVerifyEmail; 
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Notifications\PasswordResetNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable  {  

    use MustVerifyEmail, Notifiable;  //MustVerifyEmailを追加


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['shop_name', 'branch_name', 'prefecture','address','email', 'password','img'];

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











//-----------------------------------------------------------
//記事とのリレーション
//-----------------------------------------------------------
public function products(): HasMany
{
return $this->hasMany('App\Product');
}
    
 public function soldProduct()
{
 return $this->hasManyThrough('App\Order', 'App\Product', 'user_id', 'product_id','id','id');
    }
    

public function sendPasswordResetNotification($token)
{
  $this->notify(new PasswordResetNotification($token));
}


}
