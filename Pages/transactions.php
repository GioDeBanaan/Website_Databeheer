<?php
require_once __DIR__ . '/../Controller/transactionsController.php';

$controller = new TransactionsController();

// 1. Look at the URL to see what action we want
$action = $_GET['action'] ?? 'index';

// 2. Route the traffic based on the action
if ($action === 'store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // We caught the form submission! Run the store method.
    $controller->store();
} elseif ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // $controller->update(); 
} else {
    // Default behavior
    $controller->index();
}
?>