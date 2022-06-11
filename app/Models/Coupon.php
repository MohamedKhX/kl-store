<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use phpDocumentor\Reflection\Types\This;

class Coupon extends Model
{
    use HasFactory;

    protected $dates = ['expire_at'];

    public static function findCoupon($code)
    {
        return self::where('code', '=', $code)->first();
    }


    public function isValidToUse(): bool
    {
        if($this->status === false) {
            return false;
        }

        if(! $this->max_users == null) {
            if($this->number_of_uses >= $this->max_users) {
                return false;
            }
        }

        if(! $this->expire_at == null) {
            if(! $this->expire_at->isFuture()) {
                return false;
            }
        }

        return true;
    }

    public function discount($total)
    {
        if($this->type == 'fixed') {
            return $this->value;
        } elseif ($this->type == 'percent_off') {
            return ($total / 100) * $this->percent_off;
        } else {
            return 0;
        }
    }
}
