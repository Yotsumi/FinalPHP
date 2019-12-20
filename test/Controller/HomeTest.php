<?php
declare(strict_types=1);

namespace SimpleMVC\Test\Controller;

use League\Plates\Engine;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\Home;
use SimpleMVC\Model\ArticoloClient;
use SimpleMVC\Model\Articolo;
use SimpleMVC\Helper\SessionHandle;
use DI\ContainerBuilder;

final class HomeTest extends TestCase
{
    public function setUp(): void
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions('config/container.php');
        $container = $builder->build();
        $this->articles = [];
       /* $this->articles[0]->setByArray([
            'id' => 1,
            'titolo' => 'titolo',
            'contenuto' => 'test test',
            'autore' => 'Auth Ore',
            'data' => date("Y-m-d")
        ]);
*/
        $this->db  = //$container->get(ArticoloCLient::class);
            (new class ($container->get('public_db_manager')) extends ArticoloCLient {
                public function __construct(\PDO $pdo){}
                public function selectDailyArticles() :?array{ 
                    return [];
                }
            });

        $this->plates = new Engine('src/View');
        //$this->db->selectDailyArticles();

        $this->home   = new Home(
            $this->plates, 
            $this->db, 
            (new class extends SessionHandle {
                public function __construct(){}
                public function getLen() :int { return 0; }
                public function get(string $key) :string{ return ''; }
            })
        );
        $this->request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();     
    }

    public function testExecuteRenderHomeView(): void
    {
        $this->expectOutputString($this->plates->render('home', [
            'articles' => $this->articles,
            'btn' => ['Login' => '/login'],
            'user' => ''
        ]));
        $this->home->execute($this->request);
    }
}
