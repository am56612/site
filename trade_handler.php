<?php
// Get raw POST data
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Log received data
file_put_contents('trades.log', date('Y-m-d H:i:s') . " - " . print_r($data, true) . "\n", FILE_APPEND);

// Process trades
if(is_array($data)) {
    foreach($data as $trade) {
        // Insert into database or process further
        // Example: Save to database
        /*
        $db->query("INSERT INTO trades 
            (ticket, type, symbol, volume, open_price, profit, timestamp)
            VALUES 
            (?, ?, ?, ?, ?, ?, ?)",
            $trade['ticket'],
            $trade['type'],
            $trade['symbol'],
            $trade['volume'],
            $trade['open_price'],
            $trade['profit'],
            $trade['timestamp']
        );
        */
    }
    echo "Received " . count($data) . " trades";
} else {
    echo "Invalid data received";
}
?>
