<?php

namespace Finelf_Api_Sdk\Formatters;

use function array_key_exists;
use function count;
use function explode;
use function intval;
use function is_array;
use function json_decode;
use function number_format;
use function rawurldecode;
use function str_replace;
use function strpos;

class ParamFormatter {
	const SPECIAL_TYPES
		= [
			1 => 'formatNumberValue',
			3 => 'formatRangeValue',
			4 => 'formatBooleanValue',
			5 => 'formatJSONValue',
			6 => 'formatDateTimeRangeValue',
		];
	const DATE_TIME_RANGE_DAYS_OPTIONS = [ 0 => 365, 1 => 30, 2 => 7, 3 => 1, ];

	public static function formatValue( string $prefix, string $suffix, string $value, int $type ) {
		$returnedValue = $value;

		if ( isset( self::SPECIAL_TYPES[ $type ] ) ) {
			$returnedValue = self::{self::SPECIAL_TYPES[ $type ]}( $value );
		}

		if ( is_array( $returnedValue ) ) {
			return $returnedValue;
		}

		if ( ! empty( $prefix ) ) {
			$prefix .= ' ';
		}

		if ( ! empty( $suffix ) ) {
			$returnedValue .= ' ';
		}

		return __( $prefix, 'finelf-ranking' ) . $returnedValue . __( $suffix, 'finelf-ranking' );
	}

	public static function formatRawValue( string $value, int $type ) {
		$returnedValue = $value;

		if ( isset( self::SPECIAL_TYPES[ $type ] ) ) {
			$returnedValue = self::{self::SPECIAL_TYPES[ $type ]}( $value );
		}

		if ( is_array( $returnedValue ) ) {
			return $returnedValue;
		}

		return $returnedValue;
	}

	public static function formatRangeValue( string $value ): string {
		$values = explode( '-', $value );
		$from   = array_key_exists( 0, $values ) ? self::formatNumberValue( $values[0] ) : 0;
		$to     = array_key_exists( 1, $values ) ? self::formatNumberValue( $values[1] ) : 0;

		return $from . ' - ' . $to;
	}

	public static function formatNumberValue( string $value ): string {
		if ( strpos( $value, ',' ) !== false || strpos( $value, '.' ) !== false ) {
			$value = (float) str_replace( ',', '.', $value );

			return number_format( $value, 2, ',', ' ' );
		}

		return number_format( (float) $value, 0, ',', ' ' );
	}

	public static function formatBooleanValue( string $value ): string {
		return $value === '1' ? __( 'Tak', 'finelf-ranking' ) : __( 'Nie', 'finelf-ranking' );
	}

	public static function formatJSONValue( string $value ): array {
		return json_decode( rawurldecode( $value ) );
	}

	public static function formatDateTimeRangeValue( string $value ): string {
		$values = explode( '-', $value );
		$from   = array_key_exists( 0, $values ) ? intval( $values[0] ) : 0;
		$to     = array_key_exists( 1, $values ) ? intval( $values[1] ) : 0;

		if ( $from && $to ) {
			return self::dateTimeRangeValueCalculate( $from, $to );
		}

		return '';
	}

	public static function dateTimeRangeValueCalculate( int $from, int $to, int $unit = 0 ): string {
		$days = self::DATE_TIME_RANGE_DAYS_OPTIONS[ $unit ];

		if ( ( $from % $days ) == 0 && ( $to % $days ) == 0 ) {
			$fromValue = $from / $days;
			$toValue   = $to / $days;

			if ( $fromValue === $toValue ) {
				return self::formatSingleValueSuffix( $fromValue, $unit );
			}

			return $fromValue . ' - ' . $toValue . ' ' . self::getDateTimeRangeSuffix( $unit, 2 );
		}

		if ( $unit > ( count( self::DATE_TIME_RANGE_DAYS_OPTIONS ) - 1 ) ) {
			return '';
		}

		return self::dateTimeRangeValueCalculate( $from, $to, $unit + 1 );
	}

	public static function formatSingleValueSuffix( $value, $unit ) {
		if ( $value === 1 ) {
			return $value . ' ' . self::getDateTimeRangeSuffix( $unit, 0 );
		}

		if ( $value % 10 > 1 && $value % 10 < 5 && ! ( $value % 100 >= 10 && $value % 100 <= 21 ) ) {
			return $value . ' ' . self::getDateTimeRangeSuffix( $unit, 1 );
		}

		return $value . ' ' . self::getDateTimeRangeSuffix( $unit, 2 );
	}

	public static function getDateTimeRangeSuffix( int $unit, int $element ): string {
		$suffixes = [
			[ __( 'rok', 'finelf-ranking' ), __( 'lata', 'finelf-ranking' ), __( 'lat', 'finelf-ranking' ) ],
			[ __( 'miesiąc', 'finelf-ranking' ), __( 'miesiące', 'finelf-ranking' ), __( 'miesięcy', 'finelf-ranking' ) ],
			[ __( 'tydzień', 'finelf-ranking' ), __( 'tygodnie', 'finelf-ranking' ), __( 'tygodni', 'finelf-ranking' ) ],
			[ __( 'dzień', 'finelf-ranking' ), __( 'dni', 'finelf-ranking' ), __( 'dni', 'finelf-ranking' ) ],
		];

		return $suffixes[ $unit ][ $element ];
	}

	public static function calculateDateTimeValue( int $value = 1, string $rangeType = 'day' ): string {
		$rangeTypesCalculations = [
			'day'   => ParamFormatter::DATE_TIME_RANGE_DAYS_OPTIONS[3],
			'week'  => ParamFormatter::DATE_TIME_RANGE_DAYS_OPTIONS[2],
			'month' => ParamFormatter::DATE_TIME_RANGE_DAYS_OPTIONS[1],
			'year'  => ParamFormatter::DATE_TIME_RANGE_DAYS_OPTIONS[0],
		];

		return $value / $rangeTypesCalculations[ $rangeType ];
	}
}
