<!-- 08/06/2026 made by: Gio-->

<?php
// Load the employee controller for all page actions
require_once __DIR__ . "/../Controller/employeesController.php";

$controller = new EmployeesController();
$action = $_GET['action'] ?? 'index';
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

// Decide which employee action to run
switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store();
        break;
    case 'edit':
        if ($id === null) {
            die("Missing employee id");
        }
        $controller->edit($id);
        break;
    case 'update':
        if ($id === null) {
            die("Missing employee id");
        }
        $controller->update($id);
        break;
    default:
        $controller->index();
        break;
}
?>