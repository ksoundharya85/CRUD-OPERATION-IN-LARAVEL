<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentdata extends Model
{
    use HasFactory;
    protected $table="studentdata";
    protected $guarded=[];
    public $timestamps=false;
    protected $primaryKey = 'studentid';
    public $incrementing = true;
     protected $keyType = 'int';


}
