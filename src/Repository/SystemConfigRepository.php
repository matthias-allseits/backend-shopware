<?php

namespace App\Repository;

use App\Entity\SystemConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SystemConfig>
 */
class SystemConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SystemConfig::class);
    }

    //    /**
    //     * @return SystemConfig[] Returns an array of SystemConfig objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?SystemConfig
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    /**
     * Alle Config-Werte als Array zurückgeben
     */
    public function findAllAsKeyValue(): array
    {
        $configs = $this->findAll();
        $result = [];

        foreach ($configs as $config) {
            $result[] = [
                'key' => $config->getConfigurationKey(),
                'value' => $config->getConfigurationValue(),
            ];
        }

        return $result;
    }

    /**
     * Einen Wert speichern oder aktualisieren
     */
    public function saveValue(string $key, $value): void
{
    $em = $this->getEntityManager();
    $config = $this->findOneBy(['configurationKey' => $key]);

    if (!$config) {
        $config = new SystemConfig();
        $config->setConfigurationKey($key);
    }

    // Konsistent als JSON {"_value": ...}
    $config->setConfigurationValue(['_value' => $value]);

    $em->persist($config);
    $em->flush();
}

}
