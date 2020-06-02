<?php

namespace Finelf_Api_Sdk\DTO;

use function array_key_exists;
use function json_decode;

class ParameterDTO extends BaseDTO {
    private const SPECIAL_TYPES = [
        1 => 'formatIntegerValue',
        4 => 'formatBooleanValue',
        5 => 'formatJSONValue',
        6 => 'formatDateTimeRangeValue'
    ];
    private const DATE_TIME_RANGE_SETTINGS = [
        'days'     => [
            365,
            30,
            7,
            1
        ],
        'suffixes' => [
            ['rok', 'lata', 'lat'],
            ['miesiąc', 'miesiące', 'miesięcy'],
            ['tydzień', 'tygodnie', 'tygodni'],
            ['dzień', 'dni', 'dni']
        ]
    ];

    public $name;
    public $type;
    public $value;
    public $slug;
    public $description;

    protected function parameter(object $parameter) {
        $prefix      = $parameter->prefix === null ? '' : $parameter->prefix;
        $suffix      = $parameter->suffix === null ? '' : $parameter->suffix;
        $this->name  = $parameter->name;
        $this->type  = $parameter->type;
        $this->slug  = $parameter->slug;
        $this->value = $this->formatValue($prefix, $suffix, $this->value, $parameter->type);
    }

    private function formatValue(string $prefix, string $suffix, string $value, int $type) {
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

    private function formatIntegerValue(string $value): string {
        return number_format((float)$value, 0, '.', ' ');
    }

    private function formatBooleanValue(string $value): string {
        return $value === '1' ? 'Tak' : 'Nie';
    }

    private function formatJSONValue(string $value): array {
        return json_decode(rawurldecode($value));
    }

    private function formatDateTimeRangeValue(string $value): string {
        $values = explode('-', $value);
        $from   = array_key_exists(0, $values) ? intval($values[0]) : 0;
        $to     = array_key_exists(1, $values) ? intval($values[1]) : 0;

        if ($from && $to) {
            return $this->dateTimeRangeValueCalculate($from, $to);
        }

        return '';
    }

    private function dateTimeRangeValueCalculate(int $from, int $to, int $unit = 0): string {
        $days = self::DATE_TIME_RANGE_SETTINGS['days'][ $unit ];

        if (($from % $days) == 0 && ($to % $days) == 0) {
            $fromValue = $from / $days;
            $toValue   = $to / $days;

            if($fromValue === $toValue) {
                return $this->formatSingleValueSuffix($fromValue, $unit);
            }

            return $fromValue . '-' . $toValue . ' ' . self::DATE_TIME_RANGE_SETTINGS['suffixes'][ $unit ][2];
        }

        if ($unit > (count(self::DATE_TIME_RANGE_SETTINGS['days']) - 1)) {
            return '';
        }

        return $this->dateTimeRangeValueCalculate($from, $to, $unit + 1);
    }

    private function formatSingleValueSuffix($value, $unit) {
        if ($value === 1) {
            return $value . ' ' . self::DATE_TIME_RANGE_SETTINGS['suffixes'][ $unit ][0];
        }

        if ($value % 10 > 1 && $value % 10 < 5 && !( $value % 100 >= 10 && $value % 100 <= 21)) {
            return $value . ' ' . self::DATE_TIME_RANGE_SETTINGS['suffixes'][ $unit ][1];
        }

        return $value . ' ' . self::DATE_TIME_RANGE_SETTINGS['suffixes'][ $unit ][2];
    }
}
