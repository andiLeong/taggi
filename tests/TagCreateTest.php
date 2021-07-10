<?php


use Illuminate\Foundation\Testing\RefreshDatabase;

class TagCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \Andileong\Taggi\Models\Tag
     */
    private $tag;

    public function setUp(): void
    {
        parent::setUp();
        $this->tag = new \Andileong\Taggi\Models\Tag;;
    }

    /** @test */
    function a_tag_can_be_added()
    {
        $tag = $this->tag->put('tag name');
        $this->assertEquals('tag name' , $tag->name);
    }

    /** @test */
    function a_tag_can_be_mass_insert()
    {
        $data = ['name1','name2','name3'];
        $this->tag->massPut($data);
        $result = $this->tag->whereIn('name' , $data)->exists();
        $this->assertEquals(true , $result);
    }

    /** @test */
    function a_tag_name_is_uniquely_save_to_db()
    {
        $data = ['Name1','name1','NAME1'];
        $result = $this->tag->massPut($data);
        $count2 =  \Andileong\Taggi\Models\Tag::whereIn('name',$data)->count();

        $this->assertEquals(1 , $count2);
    }

    /** @test */
    function a_tag_string_with_separator_can_be_save_to_db()
    {
        $data1 = "tag1.tag2.tag3";
        $data2 = "tag5,tag6,tag7";

        $parser = new \Andileong\Taggi\Models\Tag();
        $pharseData1 = $parser->parser($data1);
        $pharseData2 = $parser->parser($data2);

        $result1 = $this->tag->massPut($pharseData1);
        $count1 =  \Andileong\Taggi\Models\Tag::whereIn('name',$pharseData1)->count();

        $tag2 = new \Andileong\Taggi\Models\Tag;
        $result2 = $tag2->massPut($pharseData2);
        $count2 =  \Andileong\Taggi\Models\Tag::whereIn('name',$pharseData2)->count();

        $this->assertEquals(3 , $count1);
        $this->assertEquals(3 , $count2);
    }


}
