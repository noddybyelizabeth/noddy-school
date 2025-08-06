<?php

namespace pages;

use lib\Components\Header;
use lib\Infrastructure\Database\Database;

Header::printTitle("Messages");
Header::printBreadcrumb();

$database = Database::getInstance();
