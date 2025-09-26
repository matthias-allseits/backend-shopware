<?php
namespace App\Repository;

use App\Entity\OrderState;
use App\Entity\PaymentState;
use Doctrine\DBAL\Connection;

class StateMachineRepository
{
    public function __construct(private Connection $connection)
    {
    }

    /**
     * @return array<int, array{id: string, name: string}>
     */
    private function fetchStates(string $machineTechnicalName, string $locale): array
    {
        $sql = <<<SQL
        SELECT LOWER(HEX(sms.id)) AS id,
               COALESCE(smst.name, sms.technical_name) AS name
        FROM state_machine sm
        JOIN state_machine_state sms ON sms.state_machine_id = sm.id
        LEFT JOIN state_machine_state_translation smst ON smst.state_machine_state_id = sms.id
        LEFT JOIN language lang ON lang.id = smst.language_id
        LEFT JOIN locale loc ON loc.id = lang.locale_id
       WHERE sm.technical_name = :machine
         AND (:locale IS NULL OR loc.code = :locale)
       ORDER BY name
    SQL;

        return $this->connection->fetchAllAssociative($sql, [
            'machine' => $machineTechnicalName,
            'locale' => $locale,
        ]);
    }

    /** @return OrderState[] */
    public function getOrderStates(string $locale = 'en-GB'): array
    {
        $rows = $this->fetchStates('order.state', $locale);
        return array_map(fn($r) => new OrderState($r['id'], $r['name']), $rows);
    }

    /** @return PaymentState[] */
    public function getPaymentStates(string $locale = 'en-GB'): array
    {
        $rows = $this->fetchStates('order_transaction.state', $locale);
        return array_map(fn($r) => new PaymentState($r['id'], $r['name']), $rows);
    }
}
