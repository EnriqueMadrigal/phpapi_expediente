<?php
namespace App\Services;
use App\Entities\Traumatismo;
use App\Repositories\TraumatismoRepository;


class TraumatismoService {
    private $traumatismoRepository;
    public function __construct(TraumatismoRepository $traumatismoRepository) {
        $this->traumatismoRepository = $traumatismoRepository;
    }   
    
    
    public function createTraumatismo(Array $data) {
        $newTraumatismo = new Traumatismo();
        $newTraumatismo = $this->traumatismoRepository->bindRowToEntity($data);
        try {
            return $this->traumatismoRepository->save($newTraumatismo);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

public function updateTraumatismo(Array $data) {
        try {
            $traumatismo = new Traumatismo();
            $traumatismo = $this->traumatismoRepository->bindRowToEntity($data);
            return $this->traumatismoRepository->update($traumatismo);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getTraumatismosByPacienteId(int $id_paciente): array {
        try {
            //return $this->traumatismoRepository->findByPaciente($id_paciente);
            $data = $this->traumatismoRepository->findByPaciente($id_paciente);
           
            return $data;   
        } catch (\Exception $e) {
            return [];
        }
    }
}

