<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';

    protected $fillable = [
        'session_id',
        'product_id',
        'price',
        'quantity',
    ];

    public function __construct()
    {
        if (!Session::has('cart')) {
            Session::put('cart', []);
        }
    }

    public static function get() {
        return self::where(['session_id' => session()->getId()])->get();
    }

    public static function remove($id) {
        return self::destroy($id);
    }

    public static function flush() {
        return self::where(['session_id' => session()->getId()])->delete();
    }

    public static function total() {
        return self::where(['session_id' => session()->getId()])->get()->map(function ($item) {
            return $item->price * $item->quantity;
        })->sum();
    }
}
