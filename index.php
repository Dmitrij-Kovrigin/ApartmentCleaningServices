<?php

use App\App;

require __DIR__ . '/vendor/autoload.php';

// ---------------README-----------------

// Add new client to database:
// App::addNewClient('Johny Cash', "cash@star.lt", '+37065412366', 'Vilnius, Didziosios g. 152', '2022-01-07', '11:30');

// Edit existing client in database:
// App::editClient(2, 'Johny', 'email', 'Some number', 'Some address', '2022-01-25', '12:00');

// Delete existing client in database
// App::deleteClient(7);

// Print list of records for specific date, sorted by time:
// App::showByDate('2022-01-07');

// Export all clients from database to CSV file:
// $data = App::getAllClients();
// App::printDataToCsvFile($data);

// Import entries from CSV file to database:
// $file = "dataImport.csv";
// App::importDataToDb($file);

// CLI comand to run an app: php -f index.php, just uncomment the part U are testing :)
