<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../controllers/PlayerController.php';
include_once '../controllers/TrainingController.php';

$request_uri = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];

$playerController = new PlayerController();
$trainingController = new TrainingController();

if ($request_uri === '/api/players' && $request_method === 'GET') {
    $playerController->read();
} else if ($request_uri === '/api/players' && $request_method === 'POST') {
    $playerController->create();
} else if ($request_uri === '/api/players' && $request_method === 'PUT') {
    $playerController->update();
} else if ($request_uri === '/api/players' && $request_method === 'DELETE') {
    $playerController->delete();
} else if ($request_uri === '/api/training' && $request_method === 'GET') {
    $trainingController->read();
} else if ($request_uri === '/api/training' && $request_method === 'POST') {
    $trainingController->create();
} else if ($request_uri === '/api/training' && $request_method === 'PUT') {
    $trainingController->update();
} else if ($request_uri === '/api/training' && $request_method === 'DELETE') {
    $trainingController->delete();
} else {
    http_response_code(404);
    echo json_encode(array('message' => 'Route not found'));
}
?>
