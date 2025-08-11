<?php

namespace lib\Infrastructure\Query\Builder;

interface QueryBuilderInterface {
	public function build(): string;
}