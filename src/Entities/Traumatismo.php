<?php
declare(strict_types=1);
namespace App\Entities;
use JsonSerializable;
use Serializable;

class Traumatismo implements JsonSerializable
{
    private int $id;
    private int $id_paciente;
    private bool $traumatismo;
    private int $id_trauma;
    private ?string $trauma;
    private ?string $zona_afectada;
    private string $fecha;
    private int $id_tratamiento;
    private ?string $tratamiento;
    private bool $secuelas;
    private int $id_secuela;
    private ?string $secuela;
    private ?string $observaciones;
    private \DateTimeInterface $created_at;
    private \DateTimeInterface $updated_at;

    public function __construct(
        int $id = 0,
        int $id_paciente = 0,
        bool $traumatismo = false,
        int $id_trauma = 0,
        ?string $trauma = null,
        ?string $zona_afectada = null,
        string $fecha = '',
        int $id_tratamiento = 0,
        ?string $tratamiento = null,
        bool $secuelas = false,
        int $id_secuela = 0,
        ?string $secuela = null,
        ?string $observaciones = null,
        string $created_at = '',
        string $updated_at = ''
    ) {
        $this->id = $id;
        $this->id_paciente = $id_paciente;
        $this->traumatismo = $traumatismo;
        $this->id_trauma = $id_trauma;
        $this->trauma = $trauma;
        $this->zona_afectada = $zona_afectada;
        $this->fecha = $fecha;
        $this->id_tratamiento = $id_tratamiento;
        $this->tratamiento = $tratamiento;
        $this->secuelas = $secuelas;
        $this->id_secuela = $id_secuela;
        $this->secuela = $secuela;
        $this->observaciones = $observaciones;
        $this->created_at = new \DateTimeImmutable('now');;
        $this->updated_at = new \DateTimeImmutable('now');;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getIdPaciente(): int
    {
        return $this->id_paciente;
    }

    public function setIdPaciente(int $id_paciente): void
    {
        $this->id_paciente = $id_paciente;
    }

    public function getTraumatismo(): bool
    {
        return $this->traumatismo;
    }

    public function setTraumatismo(bool $traumatismo): void
    {
        $this->traumatismo = $traumatismo;
    }

    public function getIdTrauma(): int
    {
        return $this->id_trauma;
    }

    public function setIdTrauma(int $id_trauma): void
    {
        $this->id_trauma = $id_trauma;
    }

    public function getTrauma(): ?string
    {
        return $this->trauma;
    }

    public function setTrauma(?string $trauma): void
    {
        $this->trauma = $trauma;
    }

    public function getZonaAfectada(): ?string
    {
        return $this->zona_afectada;
    }

    public function setZonaAfectada(?string $zona_afectada): void
    {
        $this->zona_afectada = $zona_afectada;
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function setFecha(string $fecha): void
    {
        $this->fecha = $fecha;
    }

    public function getIdTratamiento(): int
    {
        return $this->id_tratamiento;
    }

    public function setIdTratamiento(int $id_tratamiento): void
    {
        $this->id_tratamiento = $id_tratamiento;
    }

    public function getTratamiento(): ?string
    {
        return $this->tratamiento;
    }

    public function setTratamiento(?string $tratamiento): void
    {
        $this->tratamiento = $tratamiento;
    }

    public function getSecuelas(): bool
    {
        return $this->secuelas;
    }

    public function setSecuelas(bool $secuelas): void
    {
        $this->secuelas = $secuelas;
    }

    public function getIdSecuela(): int
    {
        return $this->id_secuela;
    }

    public function setIdSecuela(int $id_secuela): void
    {
        $this->id_secuela = $id_secuela;
    }

    public function getSecuela(): ?string
    {
        return $this->secuela;
    }

    public function setSecuela(?string $secuela): void
    {
        $this->secuela = $secuela;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): void
    {
        $this->observaciones = $observaciones;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): void
    {
        $this->created_at = $createdAt;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): void
    {
        $this->updated_at = $updatedAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'id_paciente' => $this->id_paciente,
            'traumatismo' => $this->traumatismo,
            'id_trauma' => $this->id_trauma,
            'trauma' => $this->trauma,
            'zona_afectada' => $this->zona_afectada,
            'fecha' => $this->fecha,
            'id_tratamiento' => $this->id_tratamiento,
            'tratamiento' => $this->tratamiento,
            'secuelas' => $this->secuelas,
            'id_secuela' => $this->id_secuela,
            'secuela' => $this->secuela,
            'observaciones' => $this->observaciones,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    public function jsonSerialize(): array
    {
       return [
            'id' => $this->id,
            'id_paciente' => $this->id_paciente,
            'traumatismo' => $this->traumatismo,
            'id_trauma' => $this->id_trauma,
            'trauma' => $this->trauma,
            'zona_afectada' => $this->zona_afectada,
            'fecha' => $this->fecha?->format('Y-m-d'),
            'id_tratamiento' => $this->id_tratamiento,
            'tratamiento' => $this->tratamiento,
            'secuelas' => $this->secuelas,
            'id_secuela' => $this->id_secuela,
            'secuela' => $this->secuela,
            'observaciones' => $this->observaciones,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s')
        ];
    }


}
