<?php

namespace App\Controllers;

use App\Services\TraumatismoService;

class TraumatismoController {

    private TraumatismoService $traumatismoService;

    public function __construct(TraumatismoService $traumatismoService) {
        $this->traumatismoService = $traumatismoService;
    }

    private function sendResponse(int $status, array $data) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    private function sendError(int $status, string $message) {
        $this->sendResponse($status, ['error' => $message]);
    }

    public function insert() {
        http_response_code(200);
        header('Content-Type: application/json');
        $data = $this->getRequestData();

        $return = $this->traumatismoService->createTraumatismo($data);

        if (is_numeric($return)) {
            echo json_encode([
                'error' => false,
                'message' => $return
            ]);
        } else {
            echo json_encode([
                'error' => true,
                'message' => $return
            ]);
        }
    }

    public function update() {
        http_response_code(200);
        header('Content-Type: application/json');
        $data = $this->getRequestData();

        $return = $this->traumatismoService->updateTraumatismo($data);

         if ($return)
            {
            echo json_encode([
        'error' => false,
        'message' => "sucess"
        ]);

        } else {
            echo json_encode([
                'error' => true,
                'message' => $return
            ]);
        }
    }

    public function getByPacienteId(int $id_paciente) {
        http_response_code(200);
        header('Content-Type: application/json');

        try {
            $traumatismos = $this->traumatismoService->getTraumatismosByPacienteId($id_paciente);
               $this->sendResponse(200, $traumatismos);

        } catch (\Exception $e) {
            echo json_encode([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    private function getRequestData(): array {
        $input = file_get_contents('php://input');
        return json_decode($input, true);
    }

}