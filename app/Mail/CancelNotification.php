<?php
namespace App\Mail;

use App\Product;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CancelNotification extends Mailable
{
    use Queueable, SerializesModels;

  

    protected $title;
  

    public function __construct($shop, $product,$buyer_name)
    {
        $this->title = 'Haikiより商品キャンセルのご通知';
        $this->shop = $shop;
        $this->product = $product;
        $this->buyer_name =$buyer_name;

    }

    public function build()
    {
        return $this->view('mails.cancelNotification')
        ->subject($this->title)
        ->with([
            'shop' => $this->shop,
            'product' => $this->product,
            'buyer_name' => $this->buyer_name,
          ]);
           
    }
}
