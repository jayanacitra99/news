<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadLogModel extends Model
{
    use HasFactory;

    protected $table = "readlog";

    protected $fillable = ['contentID','category'];

    public $timestamps = false;
}
