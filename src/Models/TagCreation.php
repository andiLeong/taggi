<?php
namespace Andileong\Taggi\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class TagCreation
{
    private $data;
    private $insertCollection;

    /**
     * tagCreation constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }


    /**
     * perform a upsert action on tag model
     * author: andi
     * date:2021/7/10
     */
    public function persist()
    {
        //using eloquent insert or update to mass insert
        $tagCollection = collect($this->data)->map( fn($item) => [
            'name' => strtolower($item),
            'slug' => Str::slug($item)
        ] )->unique('name');
        Tag::upsert($tagCollection->toArray(), ['name'], ['name']);

//        $tags = $this->fetch();
//        $dataCollection = $this->getCollectionInLowerCase();
//        $filtered = $this->removeDuplicate($dataCollection,$tags)->getNewCollection();
//
//        if($filtered->isNotEmpty()){
//            return $this->tag->insert($filtered->toArray());
//        }

        //before for reference
//        $filtered = $dataCollection
//            ->reject(  fn($value, $key)  => $tags->contains($value) )
//            ->unique()
//            ->map(function($item){
//                $data['name'] = $item;
//                $data['slug'] = Str::slug($item);
//                $data['created_at'] = now();
//                $data['updated_at'] = now();
//                return $data;
//            })->values();
    }

    /**
     * @return mixed
     * author: andi
     * date:2021/6/25
     */
    public function fetch()
    {
//        return $this->tag->whereIn('name', $this->data)->get()->pluck('name');
    }

    /**
     * @return \Illuminate\Support\Collection
     * author: andi
     * date:2021/6/25
     */
    public function getCollectionInLowerCase(): \Illuminate\Support\Collection
    {
        return collect($this->data)->map(fn($item) => strtolower($item));
    }

    /**
     * @param $dataCollection
     * @param $tags
     * @return $this
     * author: andi
     * date:2021/6/25
     */
    public function removeDuplicate($dataCollection,$tags)
    {
        $this->insertCollection = $dataCollection->reject( fn($value) => $tags->contains($value) )->unique();
        return $this;
    }
    /**
     * @param Collection $collection
     * @return Collection
     * author: andi
     * date:2021/6/25
     */
    public function getNewCollection(): Collection
    {
        return $this->insertCollection->map(function($item){
                    $data['name'] = $item;
                    $data['slug'] = Str::slug($item);
                    $data['created_at'] = now();
                    $data['updated_at'] = now();
                    return $data;
                })->values();
    }


}
