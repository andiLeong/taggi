<?php

use Andileong\Taggi\Models\Tag;
use Andileong\Taggi\Models\Taggi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicStubs extends Model
{
    protected $connection = "testbench";
    protected $table = "topics";
    protected $guarded;
    use HasFactory , taggi;


}

