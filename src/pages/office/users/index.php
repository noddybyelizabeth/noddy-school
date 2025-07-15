<?php

namespace pages;

use lib\Components\NDCompHeader;
use lib\Components\NDCompTypography;
use lib\Components\Table\NDCompTable;
use lib\Components\Table\NDCompTableCell;
use lib\Components\Table\Enums\Alignment;

NDCompHeader::printTitle("Users");
NDCompHeader::printBreadcrumb();

NDCompTypography::printParagraph(
	"Manage all users in one place, control access, assign roles, and monitor activity across your platform.",
);

NDCompTable::printTable("users",
	NDCompTable::head(
		NDCompTableCell::createHeader("ID")->setWidth(75)->setAlignment(Alignment::CENTER),
		NDCompTableCell::createHeader("Full Name")->setWidth(200),
		NDCompTableCell::createHeader("Email")->setWidth(200),
		NDCompTableCell::createHeader("Role")->setWidth(125),
		NDCompTableCell::createHeader("Status")->setWidth(150),
		NDCompTableCell::createHeader("Created At")->setWidth(175),
		NDCompTableCell::createHeader("Last Active")->setWidth(175),
		NDCompTableCell::createHeader("Action"),
	),
	NDCompTable::body(
		NDCompTable::row(
			NDCompTableCell::create("1"),
			NDCompTableCell::create("Korn Rojrattanapanya"),
			NDCompTableCell::create("korn.roj@noddy.ac.th"),
			NDCompTableCell::create("Admin"),
			NDCompTableCell::create("Active"),
			NDCompTableCell::create("March 12, 2025"),
			NDCompTableCell::create("12 days ago"),
			NDCompTableCell::create("<a href='#' class='text-gray-500 hover:text-gray-600'><i class='fas fa-pen-to-square me-2'></i></a>"),
		),
		NDCompTable::row(
			NDCompTableCell::create("2"),
			NDCompTableCell::create("Naruporn Aroonsiri"),
			NDCompTableCell::create("naru.aro@noddy.ac.th"),
			NDCompTableCell::create("Teacher"),
			NDCompTableCell::create("Suspended"),
			NDCompTableCell::create("July 25, 2025"),
			NDCompTableCell::create("3 hours ago"),
			NDCompTableCell::create("<a href='#' class='text-gray-500 hover:text-gray-600'><i class='fas fa-pen-to-square me-2'></i></a>"),
		),
	),
);
