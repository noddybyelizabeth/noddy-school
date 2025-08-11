<?php

namespace lib\Entities\User\Enums;

enum NameTitle: string {
	case MR = "Mr.";
	case MS = "Ms.";
	case MRS = "Mrs.";
	case MISS = "Miss";
	case DR = "Dr.";
	case OTHER = "Other";
}