<br/>

## Taggi --- A laravel package to make your model tag easy
<br/>

### Built with TTD, just a small adn simple package that make your taggable easy.


### installtation
It required at least php8 isntalled on your machine
```
composer require andileong/taggi
```


**Config:**

You can pull config file to your own by doing:

```
php artisan vendor:publish --tag=taggi-config //pull in the config file

php artisan vendor:publish --tag=taggi-migrations //pull in the migration file


```


**Tag Creation:**

You can Create one Tag or massily create tag.

```
 // create one tag

$tag = new \Andileong\Taggi\Models\Tag()
$tag->put('tag name');

//creating multiple tags

$data = ['name1','name2','name3'];
$tag->massPut($data);


when we massive create tag you can pass a tring or array
I will pharse the string to a array for you
$data = ['name1','name2','name3'];
$data = "tag,tag2,tag3";
$data = "tag|tag2|tag3";

by default the string separator is supported as below
'separator' => "[,|!:.]",

you can overwrite it in the config file

CAUTION the tag model is use $guarded = [];
so be sure validate the data before insert.

more information check out:
https://laravel.com/docs/8.x/eloquent#mass-assignment

```


**Tag Relation:**

You can tag your model to tag to build up morph many to many

First of all, use my tag trait inside your model

```
<?php


use Andileong\Taggi\Models\Taggi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicStubs extends Model
{
    use HasFactory , taggi;

}

all the relationship and method is defined inside the trait;


```

to tag your model
```

you can tag by a tag model isntance

$tag = \Andileong\Taggi\Models\Tag::find(1);
$post = Post::find(1);

$post->tag($tag);

you can tag by a tag collection isntance

$tags = \Andileong\Taggi\Models\Tag::take(3)->get();
$post = Post::find(1);

$post->tag($tags);

you can tag by a array()

$tags = ['tag','tag2','tag3'];
$post = Post::find(1);

$post->tag($tags);


you can tag by a string

$tags = "php|codeigniter";
$post = Post::find(1);

$post->tag($tags);

by defauault when the tag method is triggered behind the scene I use laravel toggle, that means if the tag you pass is tagged already , it will be untag,


$post->tagCount(); //return how many tag currently have
$post->tagged($tag); //check if the a tag is tagged
$post->unTagOne($tag); //untag a tag
$post->unTagAll(); //remove al lthe tags a post have

```

