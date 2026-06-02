<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../Controller/suppliersController.php";

$controller = new SuppliersController();
$action = $_GET['action'] ?? 'index';
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$sort = $_GET['sort'] ?? 'supplier_id';
$order = $_GET['order'] ?? 'DESC';

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store();
        break;
    case 'edit':
        if ($id === null) {
            die("Missing supplier id");
        }
        $controller->edit($id);
        break;
    case 'update':
        if ($id === null) {
            die("Missing supplier id");
        }
        $controller->update($id);
        break;
    case 'delete':
        if ($id === null) {
            die("Missing supplier id");
        }
        $controller->delete($id);
        break;
    default:
        $controller->index($sort, $order);
        break;
}
?>