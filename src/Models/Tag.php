<?php

namespace Andileong\Taggi\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * create a tag
     * @param string $name
     * @return mixed
     */
    public function put(string $name)
    {
        return $this->create(['name' => $name]);
    }

    /**
     * mass create tags
     * @param array $data
     */
    public function massPut(array $data)
    {
        return (new TagCreation($data))->persist();
    }


    /**
     * remove a tag
     * @return bool|null
     */
    public function remove()
    {
        return $this->delete();
    }

    /**
     * parse a string to an array
     * @param string $tags
     * @return array
     */
    public function parserToArray(string $tags)
    {
        return $this->parser($tags);
    }

    /**
     * a phaser that actually format a string to array
     * @param string $tags
     * @return array
     */
    public function parser(string $tags): array
    {
        $pattern = "[,|!:.]";
        return preg_split("/ ?$pattern ?/", Str::remove(' ', $tags) );
    }

    /**
     * search a tag
     * @param $search
     * @return mixed
     */
    public function like($search)
    {
        return $this->where('name', 'like', '%'.$search.'%')->get();
    }

}
