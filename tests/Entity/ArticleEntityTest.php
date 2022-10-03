<?php

namespace App\Tests\Entity;

use App\Entity\Article;
use App\Repository\UserRepository;
use App\Tests\Utils\AssertTestTrait;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

class ArticleEntityTest extends KernelTestCase
{
    use AssertTestTrait;

    protected $databaseTool;

    protected function setUp(): void
    {
        parent::setUp();
//c'est une instantation d'une classe 
        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function testRepositoryArticleCount()
    {
        $articles = $this->databaseTool->loadAliceFixture([
            dirname(__DIR__) . '/Fixtures/UserFixtures.yaml',
            dirname(__DIR__) . '/Fixtures/TagFixtures.yaml',
            dirname(__DIR__) . '/Fixtures/ArticleFixtures.yaml',
        ]);

        $articles = self::getContainer()->get(ArticleRepository::class)->count([]);

        $this->assertEquals(20, $articles);
    }
    public function getEntity(): Article
    {
        $user = self::getContainer()->get(UserRepository::class)->find(1);
        $tag = self::getContainer()->get(CategorieRepository::class)->find(1);

        return( new Article())
            ->setTitre('Article crée en test')
            ->setContent('Je suis un aqrticle de test')
            ->setUser($user)
            ->addCategory($tag)
            ->setActive(true);
    }

    public function testValideEntityArticle(){

        $this->assertHasErrors($this->getEntity());
    }

    public function testNonUniqueTitreEntityArticle(){

        $article = $this ->getEntity()
            ->setTitre('Article test');

        $this->assertHasErrors($article, 1);
    }

    public function testMinTitreEntityArticle()
    {
            $article = $this ->getEntity()
            ->setTitre('o');

        $this->assertHasErrors($article, 1);
    }



    public function testMaxTitreEntityArticle()
    {
            $article = $this ->getEntity()
            ->setTitre('oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo');

        $this->assertHasErrors($article, 1);
    }

    
    public function testMinContentEntityArticle()
    {
            $article = $this ->getEntity()
            ->setContent('og');

        $this->assertHasErrors($article, 1);
    }

}