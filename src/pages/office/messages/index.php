<?php

namespace pages;

use lib\Components\NDCompHeader;
use lib\Infrastructure\Database\NDDatabase;

NDCompHeader::printTitle("Messages");
NDCompHeader::printBreadcrumb();

$database = NDDatabase::getInstance();
