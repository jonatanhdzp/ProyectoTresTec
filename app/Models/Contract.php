<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'contract_number', 'amount', 'starts_at', 'ends_at'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
