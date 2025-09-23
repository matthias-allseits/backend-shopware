<?php

namespace App\Repository;

use Doctrine\DBAL\Connection;

class StateMachineRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getStatesByTechnicalName(string $machineTechnicalName): array
    {
        $sql = "
            SELECT sms.id, sms.technical_name AS technicalName, smt.name
            FROM state_machine sm
            INNER JOIN state_machine_state sms ON sm.id = sms.state_machine_id
            INNER JOIN state_machine_state_translation smt ON sms.id = smt.state_machine_state_id
            WHERE sm.technical_name = :machine
        ";

        return $this->connection->fetchAllAssociative($sql, [
            'machine' => $machineTechnicalName,
        ]);
    }
}
