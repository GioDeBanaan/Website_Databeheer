<?php
require_once __DIR__ . '/../Controller/transactionsController.php';

$controller = new TransactionsController();
$action = $_GET['action'] ?? 'index';

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

switch ($action) {
    case 'create':
        $controller->create();
        break;
        
    case 'store':
        $controller->store();
        break;
        
    case 'edit':
        if ($id === null) {
            die("Missing transaction id");
        }
        $controller->edit($id);
        break;
        
    case 'update':
        if ($id === null) {
            die("Missing transaction id");
        }
        $controller->update($id);
        break;
        
    case 'delete':
        if ($id === null) {
            die("Missing transaction id");
        }
        $controller->delete($id);
        break;
        
    default:
        $controller->index();
        break;
}
?>