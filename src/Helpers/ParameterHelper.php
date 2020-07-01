<?php

namespace Finelf_Api_Sdk\Helpers;

use function array_key_exists;
use function count;
use function explode;
use function intval;
use function json_decode;
use function number_format;
use function rawurldecode;
use function str_replace;
use function strpos;

class ParameterHelper {
    const SPECIAL_TYPES
        = [
            1 => 'formatNumberValue',
            3 => 'formatRangeValue',
            4 => 'formatBooleanValue',
            5 => 'formatJSONValue',
            6 => 'formatDateTimeRangeValue',
        ];
    const DATE_TIME_RANGE_SETTINGS
        = [
            'days'     => [
                365,
                30,
                7,
                1,
            ],
            'suffixes' => [
                ['rok', 'lata', 'lat'],
                ['miesiąc', 'miesiące', 'miesięcy'],
                ['tydzień', 'tygodnie', 'tygodni'],
                ['dzień', 'dni', 'dni'],
            ],
        ];

    public static function formatValue(string $prefix, string $suffix, string $value, int $type)
    {
        $returnedValue = $value;

        if (isset(self::SPECIAL_TYPES[$type])) {
            $returnedValue = self::{self::SPECIAL_TYPES[$type]}($value);
        }

        if (is_array($returnedValue)) {
            return $returnedValue;
        }

        if ( ! empty($prefix)) {
            $prefix .= ' ';
        }

        if ( ! empty($suffix)) {
            $returnedValue .= ' ';
        }

        return $prefix.$returnedValue.$suffix;
    }

    public static function formatRangeValue(string $value): string
    {
        $values = explode('-', $value);
        $from   = array_key_exists(0, $values) ? self::formatNumberValue($values[0]) : 0;
        $to     = array_key_exists(1, $values) ? self::formatNumberValue($values[1]) : 0;

        return $from.' - '.$to;
    }

    public static function formatNumberValue(string $value): string
    {
        if (strpos($value, ',') !== false || strpos($value, '.') !== false) {
            $value = (float)str_replace(',', '.', $value);

            return number_format($value, 2, ',', ' ');
        }

        return number_format((float)$value, 0, ',', ' ');
    }

    public static function formatBooleanValue(string $value): string
    {
        return $value === '1' ? 'Tak' : 'Nie';
    }

    public static function formatJSONValue(string $value): array
    {
        return json_decode(rawurldecode($value));
    }

    public static function formatDateTimeRangeValue(string $value): string
    {
        $values = explode('-', $value);
        $from   = array_key_exists(0, $values) ? intval($values[0]) : 0;
        $to     = array_key_exists(1, $values) ? intval($values[1]) : 0;

        if ($from && $to) {
            return self::dateTimeRangeValueCalculate($from, $to);
        }

        return '';
    }

    public static function dateTimeRangeValueCalculate(int $from, int $to, int $unit = 0): string
    {
        $days = self::DATE_TIME_RANGE_SETTINGS['days'][$unit];

        if (($from % $days) == 0 && ($to % $days) == 0) {
            $fromValue = $from / $days;
            $toValue   = $to / $days;

            if ($fromValue === $toValue) {
                return self::formatSingleValueSuffix($fromValue, $unit);
            }

            return $fromValue.' - '.$toValue.' '.self::DATE_TIME_RANGE_SETTINGS['suffixes'][$unit][2];
        }

        if ($unit > (count(self::DATE_TIME_RANGE_SETTINGS['days']) - 1)) {
            return '';
        }

        return self::dateTimeRangeValueCalculate($from, $to, $unit + 1);
    }

    public static function formatSingleValueSuffix($value, $unit)
    {
        if ($value === 1) {
            return $value.' '.self::DATE_TIME_RANGE_SETTINGS['suffixes'][$unit][0];
        }

        if ($value % 10 > 1 && $value % 10 < 5 && ! ($value % 100 >= 10 && $value % 100 <= 21)) {
            return $value.' '.self::DATE_TIME_RANGE_SETTINGS['suffixes'][$unit][1];
        }

        return $value.' '.self::DATE_TIME_RANGE_SETTINGS['suffixes'][$unit][2];
    }
}
