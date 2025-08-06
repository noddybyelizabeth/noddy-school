<?php

namespace lib\Components;

interface ComponentRenderable {
	public function __toString(): string;
}