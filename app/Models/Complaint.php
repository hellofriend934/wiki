<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function reasonName()
    {
        return $this->belongsTo(ComplaintReason::class,'complaint_reason_id','id');
    }
}
