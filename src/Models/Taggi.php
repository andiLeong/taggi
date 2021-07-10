<?php
namespace Andileong\Taggi\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use function PHPUnit\Framework\throwException;

trait Taggi
{
    /**
     * define a tag relationship
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class,'taggable')->withTimestamps();
    }

    /**
     * check if a model is tagged by a tag
     * @param $tag
     * @return mixed
     */
    public function tagged($tag)
    {
        return $this->tags->contains( 'id', $tag->id);
    }

    /**
     * return how many tag count a model has
     * @return mixed
     */
    public function tagCount()
    {
        return $this->tags->count();
    }

    /**
     * remove a tag from a model
     * @param $tags
     * @return int
     */
    public function unTagOne($tags)
    {
        return $this->tags()->detach($tags);
    }

    /**
     * remove all tag from a model
     * @return array
     */
    public function unTagAll()
    {
        return $this->tags()->sync([]);
    }

    /**
     * tag a tag from a model
     * @param array|Tag|Collection|string $tags
     */
    public function tag(array|Tag|Collection|string $tags)
    {
        $tags = $this->formatTags($tags);
        $this->tags()->toggle($tags);
    }

    /**
     * return a array of tag
     * @param $tags
     * @return mixed
     */
    public function getTagsFromArray($tags)
    {
        if (is_string($tags)) {
            $tags = (new Tag)->parserToArray($tags);
        }

        (new TagCreation($tags))->persist();
        return Tag::whereIn('name', $tags)->get()->pluck('id')->toArray();
    }


    /**
     * format a tag before insert tag action
     * @param $tags
     * @return Tag|Collection|mixed
     */
    private function formatTags($tags)
    {
        if( $tags instanceof Tag){
            return $tags;
        }

        if( $tags instanceof Collection){
            $tags->each( fn($item) => $this->checkCollectionIsTag($item->table) );
            return $tags;
        }

        return $this->getTagsFromArray($tags);
    }

    /**
     * check collection pass to tag action if its tag collection
     * @param $table
     */
    private function checkCollectionIsTag($table)
    {
        $table == 'tags' ?: throw new InvalidArgumentException('Model is not tag Model instance');
    }

}
