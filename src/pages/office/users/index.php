<?php

namespace pages;

use lib\Components\Header;
use lib\Components\Table\Table;
use lib\Components\Layout\Spacer;
use lib\Components\Table\TableCell;
use lib\Components\Typography\Paragraph;
use lib\Components\Table\Enums\Alignment;

Header::printTitle("Users");
Header::printBreadcrumb();

Paragraph::text(
	"Manage all users in one place, control access, assign roles, and monitor activity across your platform.",
)->print();

Spacer::medium()->print();

Table::create(
	Table::head(
		TableCell::createHeader("ID")->setWidth(75)->setAlignment(Alignment::CENTER),
		TableCell::createHeader("Full Name")->setWidth(200),
		TableCell::createHeader("Email")->setWidth(200),
		TableCell::createHeader("Role")->setWidth(125),
		TableCell::createHeader("Status")->setWidth(150),
		TableCell::createHeader("Created At")->setWidth(175),
		TableCell::createHeader("Last Active")->setWidth(175),
		TableCell::createHeader("Action"),
	),
	Table::body(
		Table::row(
			TableCell::create("1"),
			TableCell::create("Korn Rojrattanapanya"),
			TableCell::create("korn.roj@noddy.ac.th"),
			TableCell::create("Admin"),
			TableCell::create("Active"),
			TableCell::create("March 12, 2025"),
			TableCell::create("12 days ago"),
			TableCell::create("<a href='#' class='text-gray-500 hover:text-gray-600'><i class='fas fa-pen-to-square me-2'></i></a>"),
		),
		Table::row(
			TableCell::create("2"),
			TableCell::create("Naruporn Aroonsiri"),
			TableCell::create("naru.aro@noddy.ac.th"),
			TableCell::create("Teacher"),
			TableCell::create("Suspended"),
			TableCell::create("July 25, 2025"),
			TableCell::create("3 hours ago"),
			TableCell::create("<a href='#' class='text-gray-500 hover:text-gray-600'><i class='fas fa-pen-to-square me-2'></i></a>"),
		),
	),
)
	->setNewItemLink("/users/new")
	->print();