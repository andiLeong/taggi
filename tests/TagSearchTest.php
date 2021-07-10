<?php


use Andileong\Taggi\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagSearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_tag_can_be_search_by_name()
    {
        //arrange
        $tag = Tag::create(['name' => 'laravel']);
        $tag2 = Tag::create(['name' => 'codeigniter']);
        $tag3 = Tag::create(['name' => 'coder']);

        //act
        $tagCollection = $tag->like('laravel');
        $this->assertEquals(1 , $tagCollection->count() );

        $tagCollection2 = $tag->like('code');
        $this->assertEquals(2 , $tagCollection2->count() );
    }
}
