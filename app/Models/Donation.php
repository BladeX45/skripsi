<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setStatusPending(){
        $this->status = 'pending';
        self::save();
    }
    public function setStatusSuccess(){
        $this->status = 'success';
        $this->save();
    }
    public function setStatusFailed(){
        $this->status = 'failed';
        $this->save();
    }
    public function setStatusExpired(){
        $this->status = 'expired';
        $this->save();
    }

}
