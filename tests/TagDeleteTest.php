<?php


use Andileong\Taggi\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagDeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_tag_can_be_deleted()
    {
        $tag = Tag::create([
            'name' => 'programming'
        ]);
        $this->assertEquals(1,Tag::count());

        $result = $tag->remove();
        $this->assertTrue($result);
        $this->assertEquals(0,Tag::count());
    }

    /** @test */
    public function once_a_tag_is_deleted_its_all_tag_relation_will_be_remove_as_well()
    {
        $tag = Tag::create([
            'name' => 'programming'
        ]);

        $topic = TopicStubs::create(['name' => 'php']);

        $topic->tag($tag);
        $this->assertTrue( $topic->tagged($tag) );

        $tag->remove();
        $this->assertEquals(0,Tag::count());
        $this->assertFalse( $topic->refresh()->tagged($tag) );
    }
}
