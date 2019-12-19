<?php
declare(strict_types=1);

namespace SimpleMVC\Test\Controller;

use League\Plates\Engine;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\Home;
use SimpleMVC\Model\ArticoloClient;
use DI\ContainerBuilder;

final class HomeTest extends TestCase
{
    public function setUp(): void
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions('config/container.php');
        $container = $builder->build();
        $this->db = $container->get(ArticoloClient::class);
        $this->articles = $this->db->selectDailyArticles();

        $this->plates = new Engine('src/View');
        $this->home = new Home($this->plates, $this->db);
        $this->request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();     
    }

    public function testExecuteRenderHomeView(): void
    {
        $this->expectOutputString($this->plates->render('home', ['articles' => $this->articles]));
        $this->home->execute($this->request);
    }
}
