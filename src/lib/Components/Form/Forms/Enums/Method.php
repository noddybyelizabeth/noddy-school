<?php

namespace lib\Components\Form\Forms\Enums;

enum Method: string {
	case DELETE = "DELETE";
	case POST = "POST";
	case GET = "GET";
	case PUT = "PUT";
}