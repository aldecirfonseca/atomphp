<?php

namespace Core\Library;

class ModelMain
{
    public $db;
    public $validationRules = [];
    protected $table;

    /**
     * construct
     */
    public function __construct()
    {
        $this->db = new Database(
            $_ENV['DB_CONNECTION'],
            $_ENV['DB_HOST'],
            $_ENV['DB_PORT'],
            $_ENV['DB_DATABASE'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD']
        );

        $this->db->table($this->table);
    }

    /**
     * lista
     *
     * @param string $orderby 
     * @return array
     */
    public function lista($orderby = 'descricao')
    {
        $rsc = $this->db->dbSelect("SELECT * FROM {$this->table} ORDER BY {$orderby}");

        if ($this->db->dbNumeroLinhas($rsc) > 0) {
            return $this->db->dbBuscaArrayAll($rsc);
        } else {
            return [];
        }
    }
}