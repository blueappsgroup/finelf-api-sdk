<?php

namespace Finelf\DTO;

use function json_decode;

class ParameterDTO extends BaseDTO {
    private const SPECIAL_TYPES = [
        4 => 'formatBooleanValue',
        5 => 'formatJSONValue',
        6 => 'formatDateTimeRangeValue'
    ];
    private const DATETIME_RANGE_SETTINGS = [
        'days'     => [
            365,
            30,
            7,
            1
        ],
        'suffixes' => [
            'lat',
            'miesięcy',
            'tygodni',
            'dni'
        ]
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
        return json_decode(rawurldecode($value));
    }

    private function formatDateTimeRangeValue($value) {
        $values = explode('-', $value);

        if (count($values) == 2) {
            $from = intval($values[0]);
            $to   = intval($values[1]);

            if ($from && $to) {
                return $this->dateTimeRangeValueCalculate($from, $to);
            }
        }
    }

    private function dateTimeRangeValueCalculate($from, $to, $unit = 0) {
        if (($from % self::DATETIME_RANGE_SETTINGS['days'][ $unit ]) == 0 && ($to % self::DATETIME_RANGE_SETTINGS['days'][ $unit ]) == 0) {
            $fromValue = $from / self::DATETIME_RANGE_SETTINGS['days'][ $unit ];
            $toValue   = $to / self::DATETIME_RANGE_SETTINGS['days'][ $unit ];

            return $fromValue . '-' . $toValue . ' ' . self::DATETIME_RANGE_SETTINGS['suffixes'][ $unit ];
        }

        return $this->dateTimeRangeValueCalculate($from, $to, $unit + 1);
    }
}
