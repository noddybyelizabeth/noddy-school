<?php

namespace lib\Infrastructure\Query\Builder;

interface QueryBuilder {
	public function build(): string;
}