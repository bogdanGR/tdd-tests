<?php

use PHPUnit\Framework\TestCase;
class ArticleTest extends TestCase
{
    protected $article;

    public function setUp(): void
    {
        $this->article = new App\Article();
    }
    public function testTitleIsEmptyByDefault()
    {

        $this->assertEmpty($this->article->title);
    }

    public function testSlugIsEmptyWithNoTitle()
    {
        $this->assertSame($this->article->getSlug(), "");
    }

    public function testSlugHasSpaceReplacedByUnderscores()
    {
        $this->article->title = 'An example article';

        $this->assertEquals($this->article->getSlug(), 'An_example_article');
    }

    public function testSlugHasWhitespacesReplacedBySingleUnderscore()
    {
        $this->article->title = "An example \n article";

        $this->assertEquals($this->article->getSlug(), 'An_example_article');
    }

    public function testSlugDoesNotStartOrEndWithAnUnderscore()
    {
        $this->article->title = " An example article ";
        $this->assertEquals($this->article->getSlug(), 'An_example_article');
    }

    public function testSlugDoesNotHaveAnyNonwordCharacters()
    {
        $this->article->title = "Read! This! Now!";
        $this->assertEquals($this->article->getSlug(), 'Read_This_Now');
    }
}