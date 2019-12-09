<?php
declare(strict_types=1);

namespace SimpleMVC\Test\Helpers;

use PHPUnit\Framework\TestCase;
use SimpleMVC\Helper\CryptMsg;

class Crypt extends TestCase {

    public function setUp(): void
    {
        $this->crypt = CryptMsg::instance();
        $this->nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        $this->msg = 'A super secret message';
    }

    public function testAreCryptEncryptedStringEquals() :void {
        $encrypted = $this->crypt->encrypt($this->msg, $this->nonce);
        $this->assertEquals(
            $this->msg, $this->crypt->decrypt($encrypted, $this->nonce)
        );
    }
}