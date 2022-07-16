<?php

namespace App\Http\Controllers\Classes;

use anlutro\LaravelSettings\Facade as Setting;

/**
 * Class KoalaCipherEncrypt. Does encryption shit.
 */
class KoalaCipherEncrypt
{
    private $key = '';
    private $nonce = '';

    /**
     * @return void
     */
    public function __construct()
    {
        $this->key = $this->create_encryption_key();
        $this->nonce = $this->getNonce();
    }

    /**
     * @return type
     */
    public function getKey()
    {
        return Setting::get('SETTINGS_CRYPTO_KEY', 'dd8877523d70427f91082bee55b14a7b7cbd92fcf820ba39c659cf3093166db5');
    }

    /**
     * @return type
     */
    public function getNonce()
    {
        if ('' === $this->nonce) {
            return sodium_bin2hex($this->nonce);
        } else {
            return $this->nonce = $this->create_nonce();
        }
    }

    /**
     * @return type
     */
    private function create_encryption_key()
    {
        if ('' === $this->key) {
            return sodium_hex2bin($this->getKey());
        } else {
            return sodium_hex2bin($this->key);
        }
    }

    /**
     * @return type
     */
    private function create_nonce()
    {
        return random_bytes(
            SODIUM_CRYPTO_SECRETBOX_NONCEBYTES
        );
    }

    /**
     * Encrypt a message.
     *
     * @param  string  $message  - message to encrypt
     * @param  string  $key  - encryption key created using create_encryption_key()
     * @return string
     */
    public function encrypt($message)
    {
        $nonce = '' === $this->nonce ? $this->create_nonce() : $this->nonce;
        $cipher =
            $nonce.
            sodium_crypto_secretbox(
                $message,
                $nonce,
                $this->key
            );

        return sodium_bin2hex($cipher);
    }

    /**
     * Slugify a title into a valid slug.
     *
     * @param  string  $message  - string to slugify
     * @return string
     */
    public function slugify($message)
    {
        $message = strtolower($message);
        $message = preg_replace('/[^a-z0-9_\s-]/', '', $message);
        $message = preg_replace('/[\s-]+/', ' ', $message);
        $message = preg_replace('/[\s_]/', '-', $message);

        return $message;
    }

    /**
     * Decrypt a message.
     *
     * @param  string  $encrypted  - message encrypted with safeEncrypt()
     * @param  string  $key  - key used for encryption
     * @return string
     */
    public function decrypt($encrypted)
    {
        try {
            $decoded = sodium_hex2bin($encrypted);
        } catch (\Exception $e) {
            throw new \Exception('Encrypted message is invalid.');
        }

        if (! $decoded) {
            throw new \Exception('Decryption error : the encoding failed');
        }

        if (mb_strlen($decoded, '8bit') < (SODIUM_CRYPTO_SECRETBOX_NONCEBYTES + SODIUM_CRYPTO_SECRETBOX_MACBYTES)) {
            throw new \Exception('Decryption error : the message was truncated');
        }

        $nonce_decoded = substr(sodium_hex2bin($encrypted), 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        $ciphertext = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');
        $plain = sodium_crypto_secretbox_open(
            $ciphertext,
            $nonce_decoded,
            $this->key
        );

        if ($plain === false) {
            throw new \Exception('Decryption error : the message was tampered with in transit');
        }

        return $plain;
    }
}
