<?php

namespace lib\Entities\User\Enums;

enum Role: string {
	case NONE = "NONE";
	case ADMIN = "ADMIN";
	case OFFICE = "OFFICE";
	case TEACHER = "TEACHER";
}