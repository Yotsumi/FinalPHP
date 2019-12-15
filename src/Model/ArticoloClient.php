<?php
declare(strict_types=1);
namespace SimpleMVC\Model;

// invert inheritance: ArticoloDb extends ArticoloClient.
// ArticoloCLient only has select methods 
// (it does not implement DbInterface, but ArticoloDb does)
// but has methods named and declared as the select methods in DbInterface
class ArticoloClient extends ArticoloDb {

}