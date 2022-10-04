<?php


namespace App\Tests\Controller;

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

class ArticleControllerTest extends WebTestCase
{
    protected $client;

    protected $databaseTool;
    protected function setUp(): void
    {
        $this->client = self::createClient();

        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();
        $this->databaseTool->loadAliceFixture([
            dirname(__DIR__) . '/Fixtures/UserFixtures.yaml',
            dirname(__DIR__) . '/Fixtures/TagFixtures.yaml',
            dirname(__DIR__) . '/Fixtures/ArticleFixtures.yaml',
        ]);
    }

    public function getPage(): Crawler
    {
      return  $this->client->request('GET','/article/liste');
    }

    public function testGetArticleListePage()
    {
        $this->getPage();

        $this->assertResponseIsSuccessful();
    }
    public function testFormArticleListePage()
    {
        $this->getPage();

        $this->assertSelectorExists('.form-filter');

    }
    public function testFormArticleListPage()
    {
        $this->getPage();

        $this->assertSelectorExists('form.form-filter');
    }

    public function testNumberArticleListPage()
    {
        $crawler = $this->getPage();

        $this->assertCount(6, $crawler->filter('.blog-card'));
    }
}