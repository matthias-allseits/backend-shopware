<?php
namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Connection;

class SalesChannelRepository
{
    private Connection $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    public function findAllWithTranslations(string $locale = 'en-GB'): array
    {
        return $this->conn->fetchAllAssociative("
            SELECT 
                LOWER(HEX(sc.id)) AS id,
                sct.name
            FROM sales_channel sc
            INNER JOIN sales_channel_translation sct
                ON sc.id = sct.sales_channel_id
            INNER JOIN language l
                ON sct.language_id = l.id
            INNER JOIN locale loc
                ON l.locale_id = loc.id
            WHERE loc.code = :locale
        ", ['locale' => $locale]);
    }
}