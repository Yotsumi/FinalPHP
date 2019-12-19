<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Model\ArticoloClient;
use SimpleMVC\Model\Articolo;
use SimpleMVC\Helper\SessionHandle;

class Home implements ControllerInterface
{
    protected $plates;
    protected $article;
    protected $session;

    public function __construct(Engine $plates, ArticoloClient $article, SessionHandle $session)
    {
        $this->plates  = $plates;
        $this->article = $article;
        $this->session = $session;
    }

    public function execute(ServerRequestInterface $request)
    {
        $articles = [];
        $articles = $this->article->selectDailyArticles();
        if (! is_null($articles) && count($articles) > 0){
            for ($i = 0; $i < count($articles); $i++) {
                $objArt = new Articolo();
                $objArt->setByArray($articles[$i]);
                $articles[$i] = $objArt;
            }
        }

        $btn = ['Login' => '/login'];
        $user = '';
        if ($this->session->getLen() > 0) {
            $btn = ['Dashboard' => '/dashboard'];
            $user = $this->session->get(SessionHandle::SESSION_USERNAME);
        }

        echo $this->plates->render('home', [
            'articles' => $articles, 
            'btn' => $btn,
            'user' => $user
        ]);
    }
}
