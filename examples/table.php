<?php

require __DIR__ . "/../classes/CliTable.php";
require __DIR__ . "/../classes/CliText.php";

use classes\CLITable;
use classes\CliText;

$table = new CLITable();

$headers = ["First Name", "Last Name", "Position", "Salary"];
$table->setHeader($headers);

$data = [
    "First Name" => "Bob",
    "Last Name" => "Smith",
    "Position" => "Technician",
    "Salary" => "$35,000"
];
$table->addRow($data);

$data = [
    "First Name" => "Jane",
    "Last Name" => "Doe",
    "Position" => "Technician",
    "Salary" => "$37,000"
];
$table->addRow($data);

$data = [
    "First Name" => CliText::bold("Color"),
    "Last Name" => CliText::underline("Row"),
    "Position" => CliText::color("Some other position", "green"),
    "Salary" => CliText::color("$100,000", "red")
];
$table->addRow($data);

$table->draw();
