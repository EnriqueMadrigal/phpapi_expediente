<?php
declare(strict_types=1);
namespace App\Repositories;
use App\Entities\Traumatismo;

class TraumatismoRepository extends BaseRepository
{
    protected string $table = 'Traumatismo';

    /**
     * Convert a database row into a Traumatismo entity.
     */
    private function mapToEntity(array $row): Traumatismo
    {
        return new Traumatismo(
            (int) $row['id'],
            (int) $row['id_paciente'],
            (bool) $row['traumatismo'],
            (int) $row['id_trauma'],
            $row['trauma'],
            $row['zona_afectada'],
            $row['fecha'],
            (int) $row['id_tratamiento'],
            $row['tratamiento'],
            (bool) $row['secuelas'],
            (int) $row['id_secuela'],
            $row['secuela'],
            $row['observaciones'],
            $row['created_at'],
            $row['updated_at']
        );
    }

    /**
     * Find a Traumatismo record by ID.
     */
    public function findById(int $id): ?Traumatismo
    {
        $sql = "SELECT *
                FROM {$this->table}
                WHERE id = :id
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);

        $row = $stmt->fetch();

        if ($row === false) {
            return null;
        }

        return $this->mapToEntity($row);
    }

    /**
     * Get all Traumatismo records for a patient.
     *
     * @return Traumatismo[]|null
     */
    public function findByPaciente(int $id_paciente): array
    {
        $sql = "SELECT *
                FROM {$this->table}
                WHERE id_paciente = :id_paciente
                ORDER BY fecha DESC, id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id_paciente' => $id_paciente
        ]);

       // $entities = [];

       // while ($row = $stmt->fetch()) {
      //      $entities[] = $this->mapToEntity($row);
       // }
       $row = $stmt->fetch();
        return $this->mapRowToEntity($row);
    }

    /**
     * Get all Traumatismo records.
     *
     * @return Traumatismo[]
     */
    public function findAll(): array
    {
        $sql = "SELECT *
                FROM {$this->table}
                ORDER BY id DESC";

        $stmt = $this->pdo->query($sql);

        $entities = [];

        while ($row = $stmt->fetch()) {
            $entities[] = $this->mapToEntity($row);
        }

        return $entities;
    }

    /**
     * Insert a new Traumatismo record.
     */
    public function save(Traumatismo $traumatismo): int
    {
        $sql = "INSERT INTO {$this->table} (
                    id_paciente,
                    traumatismo,
                    id_trauma,
                    trauma,
                    zona_afectada,
                    fecha,
                    id_tratamiento,
                    tratamiento,
                    secuelas,
                    id_secuela,
                    secuela,
                    observaciones,
                    created_at,
                    updated_at
                ) VALUES (
                    :id_paciente,
                    :traumatismo,
                    :id_trauma,
                    :trauma,
                    :zona_afectada,
                    :fecha,
                    :id_tratamiento,
                    :tratamiento,
                    :secuelas,
                    :id_secuela,
                    :secuela,
                    :observaciones,
                    :created_at,
                    :updated_at
                )";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'id_paciente' => $traumatismo->getIdPaciente(),
            'traumatismo' => $traumatismo->getTraumatismo() ? 1 : 0,
            'id_trauma' => $traumatismo->getIdTrauma(),
            'trauma' => $traumatismo->getTrauma(),
            'zona_afectada' => $traumatismo->getZonaAfectada(),
            'fecha' => $traumatismo->getFecha()?->format('Y-m-d'),
            'id_tratamiento' => $traumatismo->getIdTratamiento(),
            'tratamiento' => $traumatismo->getTratamiento(),
            'secuelas' => $traumatismo->getSecuelas() ? 1 : 0,
            'id_secuela' => $traumatismo->getIdSecuela(),
            'secuela' => $traumatismo->getSecuela(),
            'observaciones' => $traumatismo->getObservaciones(),
            'created_at' => $traumatismo->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at' => $traumatismo->getUpdatedAt()?->format('Y-m-d H:i:s')
        ]);

        $lastInsertId = (int) $this->pdo->lastInsertId();
        $traumatismo->setId($lastInsertId);

        return $lastInsertId;
    }

    /**
     * Update an existing Traumatismo record.
     */
    public function update(Traumatismo $traumatismo): bool
    {
        $sql = "UPDATE {$this->table}
                SET
                    id_paciente = :id_paciente,
                    traumatismo = :traumatismo,
                    id_trauma = :id_trauma,
                    trauma = :trauma,
                    zona_afectada = :zona_afectada,
                    fecha = :fecha,
                    id_tratamiento = :id_tratamiento,
                    tratamiento = :tratamiento,
                    secuelas = :secuelas,
                    id_secuela = :id_secuela,
                    secuela = :secuela,
                    observaciones = :observaciones,
                    updated_at = :updated_at
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'id' => $traumatismo->getId(),
            'id_paciente' => $traumatismo->getIdPaciente(),
            'traumatismo' => $traumatismo->getTraumatismo() ? 1 : 0,
            'id_trauma' => $traumatismo->getIdTrauma(),
            'trauma' => $traumatismo->getTrauma(),
            'zona_afectada' => $traumatismo->getZonaAfectada(),
            'fecha' => $traumatismo->getFecha()->format('Y-m-d'),
            'id_tratamiento' => $traumatismo->getIdTratamiento(),
            'tratamiento' => $traumatismo->getTratamiento(),
            'secuelas' => $traumatismo->getSecuelas() ? 1 : 0,
            'id_secuela' => $traumatismo->getIdSecuela(),
            'secuela' => $traumatismo->getSecuela(),
            'observaciones' => $traumatismo->getObservaciones(),
            'updated_at' => $traumatismo->getUpdatedAt()->format('Y-m-d H:i:s')
        ]);

        return $stmt->rowCount() > 0;
    }

    /**
     * Delete a Traumatismo record.
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM {$this->table}
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'id' => $id
        ]);
    }

    public function mapRowToEntity(array $row): array
    {
        return [
            'id' => (int) $row['id'],
            'id_paciente' => (int) $row['id_paciente'],
            'traumatismo' => (bool) $row['traumatismo'],
            'id_trauma' => (int) $row['id_trauma'],
            'trauma' => $row['trauma'],
            'zona_afectada' => $row['zona_afectada'],
            'fecha' => $row['fecha'],
            'id_tratamiento' => (int) $row['id_tratamiento'],
            'tratamiento' => $row['tratamiento'],
            'secuelas' => (bool) $row['secuelas'],
            'id_secuela' => (int) $row['id_secuela'],
            'secuela' => $row['secuela'],
            'observaciones' => $row['observaciones'],
            'created_at' => $row['created_at'] ? new \DateTimeImmutable($row['created_at']) : null,
            'updated_at' => $row['updated_at'] ? new \DateTimeImmutable($row['updated_at']) : null,
        ];
    }
    
 


 public function bindRowToEntity(array $row): Traumatismo
    {
        return new Traumatismo(
            (int) $row['id'],
            (int) $row['id_paciente'],
            (bool) $row['traumatismo'] ? true : false,
            (int) $row['id_trauma'],
            $row['trauma'],
            $row['zona_afectada'],
            $row['fecha'],
            (int) $row['id_tratamiento'],
            $row['tratamiento'],
            (bool) $row['secuelas'] ? true : false,
            (int) $row['id_secuela'],
            $row['secuela'],
            $row['observaciones']
        );
    }


}
