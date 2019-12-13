<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Model\ArticoloClient;

class Home implements ControllerInterface
{
    protected $plates;
    protected $article;

    public function __construct(Engine $plates, ArticoloClient $article)
    {
        $this->plates  = $plates;
        $this->article = $article;
    }

    public function execute(ServerRequestInterface $request)
    {
        $articles = [];     //call to db
        /* array_push($articles, new Articolo(2, "Titolo con caràttèrì spécialò", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin convallis ex interdum, tincidunt neque vel, gravida lorem. Vestibulum at nunc non libero bibendum condimentum. Sed a facilisis enim, sed vestibulum ex. Mauris dignissim magna libero, et vehicula risus fringilla a. Vivamus nibh mauris, elementum at commodo sed, lacinia vel nulla. Duis et libero porttitor, sollicitudin nisl a, pulvinar elit. Morbi condimentum orci eget pretium bibendum. Suspendisse luctus mattis dui, ac facilisis enim eleifend quis. Vestibulum at convallis ligula, vitae tempor nisl. Donec scelerisque rutrum ullamcorper. Cras tincidunt pretium consequat. Quisque est nisl, ornare at sapien id, sollicitudin lobortis ex. Morbi.", "Autore", "12/12/23"));
        array_push($articles, new Articolo(2, "Titolo-2", "Contenuto-2", "Autore-2", "12/12/23"));
        */
        $articles = $this->article->selectAll();
        echo $this->plates->render('home', ['articles' => $articles]);
    }
}
