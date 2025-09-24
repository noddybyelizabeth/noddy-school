<?php

namespace pages;

use lib\Components\Header;
use lib\Components\Table\Table;
use lib\Components\Layout\Spacer;
use lib\Components\Table\TableCell;
use lib\Components\Typography\Paragraph;
use lib\Components\Table\Enums\Alignment;

Header::printTitle("Students");
Header::printBreadcrumb();

Paragraph::text(
	"Manage all students in one place.",
)->print();

Spacer::medium()->print();

Table::create(
	Table::head(
		TableCell::createHeader("#")->setWidth(75)->setAlignment(Alignment::CENTER),
		TableCell::createHeader("First Name")->setWidth(200),
		TableCell::createHeader("Last Name")->setWidth(200),
	),
	Table::body(
		Table::row(
			TableCell::create("1"),
			TableCell::create("Korn"),
			TableCell::create("Rojrattanapanya"),
		),
		Table::row(
			TableCell::create("2"),
			TableCell::create("Naruporn"),
			TableCell::create("Aroonsiri"),
		),
	),
)
	->setNewItemLink("/students/new")
	->print();