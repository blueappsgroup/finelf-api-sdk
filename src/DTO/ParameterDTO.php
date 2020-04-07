<?php

namespace Finelf\DTO;

use function json_decode;

class ParameterDTO extends BaseDTO {
    private const SPECIAL_TYPES = [
        4 => 'formatBooleanValue',
        5 => 'formatJSONValue',
        6 => 'formatDateTimeRangeValue'
    ];
    public $name;
    public $type;
    public $value;
    public $slug;

    protected function parameter($parameter) {
        $this->name  = $parameter->name;
        $this->type  = $parameter->type;
        $this->slug  = $parameter->slug;
        $this->value = $this->formatValue($parameter->prefix, $parameter->suffix, $this->value, $parameter->type);
    }

    private function formatValue($prefix, $suffix, $value, $type) {
        if (isset(self::SPECIAL_TYPES[ $type ])) {
            return $this->{self::SPECIAL_TYPES[ $type ]}($value);
        }

        if (!empty($prefix)) {
            $prefix .= ' ';
        }

        if (!empty($suffix)) {
            $value .= ' ';
        }

        return $prefix . $value . $suffix;
    }

    private function formatBooleanValue($value) {
        return $value === '1' ? 'Tak' : 'Nie';
    }

    private function formatJSONValue($value) {
        return json_decode($value);
    }

    private function formatDateTimeRangeValue($value) {
        if (preg_match('/^[0-9]+-[0-9]+$/', $value)) {
            $days     = [
                'inYear'  => 365,
                'inMonth' => 30,
                'inWeek'  => 7
            ];
            $suffixes = [
                'days'   => 'dni',
                'weeks'  => 'tygodni',
                'months' => 'miesięcy',
                'years'  => 'lat'
            ];

            $values = explode('-', $value);
            $from   = $values[0];
            $to     = $values[1];

            if (($from % $days['inYear']) == false && ($to % $days['inYear']) == false) {
                $fromValue = $from / $days['inYear'];
                $toValue   = $to / $days['inYear'];

                return $fromValue . '-' . $toValue . ' ' . $suffixes['years'];
            }

            if (($from % $days['inMonth']) == false && ($to % $days['inMonth']) == false) {
                $fromValue = $from / $days['inMonth'];
                $toValue   = $to / $days['inMonth'];

                return $fromValue . '-' . $toValue . ' ' . $suffixes['months'];
            }

            if (($from % $days['inWeek']) == false && ($to % $days['inWeek']) == false) {
                $fromValue = $from / $days['inWeek'];
                $toValue   = $to / $days['inWeek'];

                return $fromValue . '-' . $toValue . ' ' . $suffixes['weeks'];
            }

            return $from . '-' . $to . ' ' . $suffixes['days'];
        }
    }
}
