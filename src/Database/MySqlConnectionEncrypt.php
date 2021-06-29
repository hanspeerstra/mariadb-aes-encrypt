<?php

namespace redsd\AESEncrypt\Database;

use Illuminate\Database\MySqlConnection;

use redsd\AESEncrypt\Database\Schema\MySqlBuilderEncrypt;
use redsd\AESEncrypt\Database\Query\Grammars\MySqlGrammarEncrypt as QueryGrammar;

class MySqlConnectionEncrypt extends MySqlConnection
{
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

        return $this->withTablePrefix(new QueryGrammar($charset));
    }
}
