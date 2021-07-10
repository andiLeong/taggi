<?php

use Andileong\Taggi\Models\Tag;
use Andileong\Taggi\Models\Taggi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagStubs extends Model
{
    protected $connection = "testbench";
    protected $table = "tags";
    use HasFactory;


}

