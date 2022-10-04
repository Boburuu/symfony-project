<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Component\HttpFoundation\Response;

class MainControllerTest extends WebTestCase
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
        public function testGetHomePage()
        {
            $this->client->request('GET', '');
            
            $this->assertResponseStatusCodeSame(Response::HTTP_OK);
            // OU
            // $this->assertResponseStatusCodeSame(Response::HTTP_OK);
            // $this->assertResponseIsSuccessful();
        }
        public function testHeading1HomePage()
        {
            $this->client->request('GET','');
            $this->assertSelectorTextContains('h1.title', 'Fuyez pauvres fou');
        }

        public function testNavbarHomePage()
        {
            $this->client->request('GET','');

            $this->assertSelectorExists('header');
        }
        
        public function testArticleNumberHomePage()
        {
            
            $crawler =  $this->client->request('GET','');
            $this->assertCount(6, $crawler->filter('.blog-card'));
        }
}