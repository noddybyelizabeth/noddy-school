<?php

namespace lib\Components\Form\Inputs\Enums;

enum Type: string {
	case TEXT = "text";
	case EMAIL = "email";
	case USERNAME = "username";
	case PASSWORD = "password";
}