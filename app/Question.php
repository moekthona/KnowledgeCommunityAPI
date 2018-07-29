<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'tblquestion';
    public $timestamps = false;
    protected $primaryKey = 'Id';
}
