<?php

require __DIR__ . "/../classes/CLIText.php";

use classes\CLIText;

echo "This is normal", PHP_EOL;
echo CLIText::color("This is red", "red"), PHP_EOL;
echo CLIText::bold("This is bold"), PHP_EOL;
echo CLIText::underline("This is underline"), PHP_EOL;
echo CLIText::underline(CLIText::color("This is green and underlined", "green")), PHP_EOL;
echo CLIText::bold(CLIText::color("This is purple and bold", "purple")), PHP_EOL;
