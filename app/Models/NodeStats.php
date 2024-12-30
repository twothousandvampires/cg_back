<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NodeStats extends Model
{
    protected $table = 'node_stats';
    protected $fillable = ['char_id'];

    public $timestamps = false;
}
