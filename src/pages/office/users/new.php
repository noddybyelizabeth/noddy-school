<?php

namespace pages;

use lib\Utilities\Text;
use lib\Components\Header;
use lib\Entities\User\User;
use lib\Utilities\DateTime;
use lib\Components\Layout\Spacer;
use lib\Entities\User\Enums\Role;
use lib\Entities\User\UserRepository;
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
	Grid::size1(
		Cell::size1(
			InputFactory::text("first_name", "First name"),
		),
		Cell::size1(
			InputFactory::text("last_name", "Last name"),
		),
	),
)->print();

$password = Text::random();
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$dateNow = new DateTime();

$user = new User(-1);

$user->setFirstName("Korn");
$user->setLastName("Rojrattanapanya");
$user->setUsername("kornyellow");
$user->setEmail("korn.rojr@noddybyelizabeth.ac.th");
$user->setPasswordHash($passwordHash);
$user->setRole(Role::ADMIN);
$user->setEnable(true);
$user->setCreatedAt($dateNow);
$user->setUpdatedAt($dateNow);

UserRepository::replace($user);