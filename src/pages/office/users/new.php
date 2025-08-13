<?php

namespace pages;

use lib\Components\Header;
use lib\Components\Layout\Spacer;
use lib\Components\Typography\Paragraph;
use lib\Components\Layout\Container\Grid;
use lib\Components\Layout\Container\Cell;
use lib\Components\Form\Forms\FormFactory;
use lib\Components\Form\Inputs\InputFactory;

Header::printTitle("New User");
Header::printBreadcrumb([
	["Users", "/users"],
]);

Paragraph::text(
	"Add new users by assigning roles, access levels, and login credentials to manage system access.",
)->print();

Spacer::medium()->print();

FormFactory::post(
	Cell::size1(
		InputFactory::image("profile_image", "Profile Image"),
	),
	Grid::size3(
		Cell::size1(
			InputFactory::select("name_title", "Name title"),
		),
		Cell::size1(
			InputFactory::text("first_name", "First name"),
		),
		Cell::size1(
			InputFactory::text("last_name", "Last name"),
		),
	),
	Grid::size3(
		Cell::size1(
			InputFactory::text("email", "Email address"),
		),
		Cell::size1(
			InputFactory::text("password", "Password"),
		),
		Cell::size1(
			InputFactory::text("enrollment_date", "Enrollment date"),
		),
	),
	Cell::size1(
		InputFactory::textarea("remark", "Remark"),
	),
)->print();