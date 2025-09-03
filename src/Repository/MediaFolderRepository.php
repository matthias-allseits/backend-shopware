<?php

namespace App\Repository;

use Doctrine\DBAL\Connection;

class MediaFolderRepository
{
    private Connection $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    public function findAllFolders(): array
    {
        return $this->conn->fetchAllAssociative("
            SELECT 
                LOWER(HEX(id)) AS id,
                name
            FROM media_folder
            ORDER BY name ASC
        ");
    }
}
