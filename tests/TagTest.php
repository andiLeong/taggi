<?php


use Andileong\Taggi\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    private $topic;
    private $data = ['website','codeigniter','laravel'];

    public function setUp(): void
    {
        parent::setUp();
        $this->topic = TopicStubs::create(['name' => 'php']);
    }

    /** @test */
    function a_model_can_be_tagged_by_a_tag_model_instance()
    {
        $tag = Tag::create([
            'name' => 'programming'
        ]);

        //before tag it should be false
        $result1 = $this->topic->tagged($tag);
        $this->assertFalse($result1);

        //tag action
        $this->topic->tag($tag);
        //check if its tagged
        $result2 = $this->topic->refresh()->tagged($tag);

        $this->assertTrue($result2);
    }

    /** @test */
    function a_model_can_be_tagged_by_a_tag_collection()
    {
        //arrange
        $tag = new Tag();
        $tag->massPut($this->data);

        //act
        $tagCollection = Tag::query()->take(2)->get();
        //model tag action
        $this->topic->tag($tagCollection);
        //check if its tagged
        $result2 = $this->topic->tagCount();

        //Assert
        $this->assertEquals( 2 , $result2);
    }

    /** @test */
    function a_model_can_be_tagged_by_array()
    {
        $this->topic->tag($this->data);
        $result2 = $this->topic->tagCount();

        $this->assertEquals( 3 , $result2);
    }

    /** @test */
    function when_a_model_is_tag_toggling_is_executed()
    {
        //arrange
        $tag = Tag::create([
            'name' => 'laravel'
        ]);

        //act
        $this->topic->tag($tag);
        $result = $this->topic->tagged($tag);

        //Assert
        $this->assertTrue($result);

        //once I tag again result will be false
        $this->topic->tag($tag);
        $result2 = $this->topic->refresh()->tagged($tag);
        $this->assertFalse($result2);
    }

    /** @test */
    function a_model_can_untag()
    {
        //arrange
        $tag = Tag::create([
            'name' => 'laravel'
        ]);

        //act
        $this->topic->tag($tag);
        $this->topic->unTagOne($tag);

        $this->assertFalse( $this->topic->refresh()->tagged($tag) );
    }

    /** @test */
    function a_model_can_untag_all()
    {
        //arrange
        $tag = Tag::create(['name' => 'laravel']);
        $tag2 = Tag::create(['name' => 'codeigniter']);

        //act
        $this->topic->tag( Tag::get());
        $this->assertEquals(2 , $this->topic->tagCount() );

        $this->topic->unTagAll( );
        $this->assertEquals(0 , $this->topic->refresh()->tagCount() );
    }

}
