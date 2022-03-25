<?php

namespace redsd\AESEncrypt\Database\Connectors;

use Illuminate\Database\Connectors\MySqlConnector;

class MySqlConnectorEncrypt extends MySqlConnector
{
    /**
     * @var string
     */
    private $encryptionKey;

    public function __construct($encryptionKey)
    {
        $this->encryptionKey = $encryptionKey;
    }

    /**
     * Establish a database connection.
     *
     * @param  array  $config
     * @return \PDO
     */
    public function connect(array $config)
    {
        $connection = parent::connect($config);

        $this->setEncryptionKeySessionVariable($connection, $this->encryptionKey);

        return $connection;
    }

    /**
     * @param \PDO $connection
     * @param string|null $encryptionKey
     */
    private function setEncryptionKeySessionVariable($connection, $encryptionKey)
    {
        if (null === $encryptionKey) {
            return;
        }

        $connection
            ->prepare('SET @AESKEY = :key')
            ->execute(['key' => $encryptionKey]);
    }
}
