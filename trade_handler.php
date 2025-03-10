<?php
// Configuration
$log_dir = __DIR__.'/trade_logs/';
$log_file = $log_dir.'trades_'.date('Y-m-d').'.log';

// Create log directory if not exists
if (!is_dir($log_dir)) {
    mkdir($log_dir, 0755, true);
}

// Get raw POST data
$json_input = file_get_contents('php://input');
$data = json_decode($json_input, true);

// Validate input
if (empty($data) || !is_array($data)) {
    http_response_code(400);
    die("Invalid trade data received");
}

// Prepare log entry
$log_entry = "[" . date('Y-m-d H:i:s') . "] Received trade data:\n";
$log_entry .= "Raw JSON: " . $json_input . "\n";

foreach ($data as $index => $trade) {
    $log_entry .= "Trade #" . ($index + 1) . ":\n";
    $log_entry .= "  Ticket: " . ($trade['ticket'] ?? 'N/A') . "\n";
    $log_entry .= "  Type: " . ($trade['type'] ?? 'Unknown') . "\n";
    $log_entry .= "  Symbol: " . ($trade['symbol'] ?? 'N/A') . "\n";
    $log_entry .= "  Volume: " . ($trade['volume'] ?? 0) . "\n";
    $log_entry .= "  Price: " . ($trade['open_price'] ?? 0) . "\n";
    $log_entry .= "  Profit: " . ($trade['profit'] ?? 0) . "\n";
    $log_entry .= "  Timestamp: " . ($trade['timestamp'] ?? 'Unknown') . "\n";
    $log_entry .= str_repeat("-", 40) . "\n";
}

// Save to log file
if (file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX)) {
    $response = "Trade data logged successfully";
} else {
    $response = "Error saving trade data";
    error_log("Failed to write trade log: " . $log_file);
}

// Send response
header('Content-Type: application/json');
echo json_encode([
    'status' => file_exists($log_file) ? 'success' : 'error',
    'message' => $response,
    'log_path' => $log_file
]);
?>
