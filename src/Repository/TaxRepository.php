<?php
namespace App\Repository;

use Doctrine\DBAL\Connection;

class TaxRepository
{
    private Connection $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    public function findAllTaxes(): array
    {
        return $this->conn->fetchAllAssociative("
            SELECT 
                LOWER(HEX(id)) AS id,
                name,
                tax_rate
            FROM tax
            ORDER BY position ASC
        ");
    }
}
