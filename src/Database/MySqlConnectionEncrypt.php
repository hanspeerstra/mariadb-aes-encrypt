<?php

namespace redsd\AESEncrypt\Database;

use Illuminate\Database\MySqlConnection;

use redsd\AESEncrypt\Database\Query\Grammars\MySqlGrammarEncrypt as QueryGrammar;

class MySqlConnectionEncrypt extends MySqlConnection
{
    private $encryptionKey;
    private $encryptionMode;

    public function __construct($pdo, $database, $tablePrefix, array $config, $encryptionKey, $encryptionMode)
    {
        $this->encryptionKey = $encryptionKey;
        $this->encryptionMode = $encryptionMode;
        parent::__construct($pdo, $database, $tablePrefix, $config);
    }

    /**
     * Get the default query grammar instance.
     *
     * @return \redsd\AESEncrypt\Database\Query\Grammars\MySqlGrammarEncrypt
     */
    protected function getDefaultQueryGrammar()
    {
        // default charset
        $charset = 'utf8mb4';

        if (isset($this->config['charset'])) {
            $charset = $this->config['charset'];
        }

        return $this->withTablePrefix(new QueryGrammar($charset, $this->encryptionKey, $this->encryptionMode));
    }
}
