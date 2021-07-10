<?php

class TagPharserTest extends TestCase
{
    /**
     * @dataProvider tagsProvider
     */
    public function test_it_can_transform_tags_to_array($data, $expected)
    {
        $parser = new \Andileong\Taggi\Models\Tag();
        $result = $parser->parser($data);
        $this->assertSame($expected, $result);
    }

    public function tagsProvider()
    {
        return [
            ["tag1, tag2, tag3", ["tag1", "tag2", "tag3"]],
            ["tag1,tag2,tag3", ["tag1", "tag2", "tag3"]],
            ["tag1 | tag2 | tag3", ["tag1", "tag2", "tag3"]],
            ["tag1|tag2|tag3", ["tag1", "tag2", "tag3"]],
            ["tag1!tag2!tag3", ["tag1", "tag2", "tag3"]],
            ["tag1:tag2:tag3", ["tag1", "tag2", "tag3"]],
            ["tag1 : tag2  :    tag3", ["tag1", "tag2", "tag3"]],
            ["tag1.tag2.tag3", ["tag1", "tag2", "tag3"]],
        ];
    }
}
