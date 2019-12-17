<?php
declare(strict_types=1);
namespace SimpleMVC\Model;

use SimpleMVC\Helper\QueryHandler;
use Articolo;

// invert inheritance: ArticoloDb extends ArticoloClient.
// ArticoloCLient only has select methods 
// (it does not implement DbInterface, but ArticoloDb does)
// but has methods named and declared as the select methods in DbInterface
class ArticoloClient extends QueryHandler {

    
    public function selectAll() :?array{
        $query = "SELECT * FROM articolo";
        $args = [];
        return $this->selectQueries($query, $args, Articolo::class);
    }
    public function selectByKey(array $key) :?array{
        $query = "SELECT * FROM articolo WHERE titolo = :titolo";
        return $this->selectQueries($query, $key, Articolo::class);
    }

}