<?php

namespace Finelf_Api_Sdk\DTO;

use Finelf_Api_Sdk\Formatters\ParamFormatter;

class ParameterDTO extends BaseDTO {
	public $name;
	public $type;
	public $prefix;
	public $suffix;
	public $value;
	public $slug;
	public $description;
	public $rawValue = '';

	protected function parameter( $parameter ) {
		$prefix         = $parameter->prefix === null ? '' : $parameter->prefix;
		$suffix         = $parameter->suffix === null ? '' : $parameter->suffix;
		$this->name     = $parameter->name;
		$this->type     = $parameter->type;
		$this->prefix   = $prefix;
		$this->suffix   = $suffix;
		$this->slug     = $parameter->slug;
		$this->value    = ParamFormatter::formatValue( $prefix, $suffix, $this->value, $parameter->type );
		$this->rawValue = ParamFormatter::formatRawValue( $this->value, $parameter->type );
	}
}
