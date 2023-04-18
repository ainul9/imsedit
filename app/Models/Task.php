<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'agentID',
        'agentName',
        'productID',
        'productName',
        'quantity',
        'pickupAdd',
        'pickupDate',
        'deliveryAdd',
        'deliveryDate',
        'remarks',
        'status'
    ];

    protected $guarded = ['id','agentID','agentName'];

    public function agents()
    {
        return $this->belongsTo(Agent::class, 'agentID');
    }
}
