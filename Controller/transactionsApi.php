<?php
// --- HTML2PDF.app API key ---
$apiKey = 'WuMv1zDTKYkf19jv0vokYfutdkzXt3dOi6Izk9G1s38PRzqkjhEBKndNbuWCeKAz'; // Replace with your key from html2pdf.app
 
// --- DB connection ---
require_once __DIR__ . '/../Models/config.php';
 
// --- Fetch transactions (your existing query) ---
$sql = "SELECT 
            t.transaction_id,  
            t.transaction_type, 
            t.customer_name, 
            t.company, 
            t.game_id, 
            g.title AS game_name, 
            t.transaction_date, 
            t.quantity, 
            t.unit_price, 
            t.discount_percent, 
            t.tax_percent, 
            t.payment_method, 
            t.payment_status, 
            t.order_status, 
            t.created_at, 
            t.updated_at 
        FROM transactions t 
        LEFT JOIN suppliers s ON t.company = s.supplier_id 
        LEFT JOIN games g ON t.game_id = g.game_id 
        ORDER BY t.transaction_id DESC";
 
$transactionresult = $conn->query($sql);
$transactions = $transactionresult->fetchAll(PDO::FETCH_ASSOC);
 
// --- Build HTML table ---
$rows = '';
foreach ($transactions as $t) {
    $statusColor = match(strtolower($t['payment_status'])) {
        'completed' => '#198754',
        'pending'   => '#ffc107',
        'cancelled' => '#dc3545',
        default     => '#6c757d',
    };
 
    $rows .= '<tr>
        <td>' . htmlspecialchars($t['transaction_type'])   . '</td>
        <td>' . htmlspecialchars($t['customer_name'])      . '</td>
        <td>' . htmlspecialchars($t['company'])       . '</td>
        <td>' . htmlspecialchars($t['game_name'])          . '</td>
        <td>' . htmlspecialchars($t['transaction_date'])   . '</td>
        <td style="text-align:center">' . htmlspecialchars($t['quantity'])         . '</td>
        <td style="text-align:right">€' . number_format((float)$t['unit_price'], 2) . '</td>
        <td style="text-align:center">' . htmlspecialchars($t['discount_percent']) . '%</td>
        <td style="text-align:center">' . htmlspecialchars($t['tax_percent'])      . '%</td>
        <td>' . htmlspecialchars($t['payment_method'])     . '</td>
        <td style="color:' . $statusColor . ';font-weight:bold">' . htmlspecialchars($t['payment_status']) . '</td>
        <td>' . htmlspecialchars($t['order_status'])       . '</td>
    </tr>';
}
 
$generatedAt = date('Y-m-d H:i:s');
$totalRows   = count($transactions);
 
$html = <<<HTML
<html>
<head>
<style>
    body  { font-family: Arial, sans-serif; font-size: 9px; color: #222; }
    h1    { font-size: 16px; margin-bottom: 4px; }
    .meta { font-size: 8px; color: #666; margin-bottom: 12px; }
    table { width: 100%; border-collapse: collapse; margin-top: 8px; }
    th    { background-color: #343a40; color: #fff; padding: 5px 4px; text-align: left; font-size: 8px; }
    td    { padding: 4px; border-bottom: 1px solid #dee2e6; font-size: 8px; }
    tr:nth-child(even) td { background-color: #f8f9fa; }
    .footer { margin-top: 16px; font-size: 8px; color: #888; text-align: right; }
</style>
</head>
<body>
    <h1>Transactions Report</h1>
    <div class="meta">Generated: $generatedAt &nbsp;|&nbsp; Total records: $totalRows</div>
    <table>
        <thead>
            <tr>
                <th>Type</th>
                <th>Customer</th>
                <th>Company</th>
                <th>Game</th>
                <th>Date</th>
                <th>Qty</th>
                <th>Unit price</th>
                <th>Discount</th>
                <th>Tax</th>
                <th>Payment method</th>
                <th>Pay status</th>
                <th>Order status</th>
            </tr>
        </thead>
        <tbody>
            $rows
        </tbody>
    </table>
    <div class="footer">Exported from your transactions system</div>
</body>
</html>
HTML;
 
// --- Send to HTML2PDF.app API ---
$response = file_get_contents('https://api.html2pdf.app/v1/generate', false, stream_context_create([
    'http' => [
        'method'  => 'POST',
        'header'  => 'Content-Type: application/json',
        'content' => json_encode([
            'apiKey'    => $apiKey,
            'html'      => $html,
            'landscape' => true,
            'margin'    => '10mm',
        ]),
    ]
]));
 
if ($response === false) {
    die("Failed to connect to HTML2PDF.app API. Check your API key or internet connection.");
}
 
// --- Download the PDF ---
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="transactions_' . date('Y-m-d') . '.pdf"');
header('Content-Length: ' . strlen($response));
echo $response;