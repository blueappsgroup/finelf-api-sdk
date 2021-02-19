<?php

namespace Finelf_Api_Sdk\DTO;

use stdClass;

use function explode;
use function json_decode;
use function strpos;

class OfferDTO extends BaseDTO {
	public $id;
	public $name;
	public $product;
	public $productId;
	public $affiliateLink;
	public $prettyLink;
	public $displayName;
	public $commission = [];
	public $clicksCount;
	public $isEnabled;
	public $isActive;
	public $entity;
	public $parameters = [];
	public $debtorsBases = [];

	public function __construct( stdClass $jsonObject, stdClass $rankingsOffer = null ) {
		if ( $rankingsOffer !== null ) {
			$this->ranking = [
				'tag' => $rankingsOffer->tag,
			];
		}

		parent::__construct( $jsonObject );
	}

	protected function commission( $encodedCommission = '' ) {
		if ( ! empty( $encodedCommission ) ) {
			$commission = json_decode( $encodedCommission );

			foreach ( $commission as $value ) {
				$exploded_values = explode( '_', $value );
				$period_from     = $period_to = $exploded_values[0];
				$amount_from     = $amount_to = $exploded_values[1];

				if ( strpos( $exploded_values[0], '-' ) !== false ) {
					$period_values = explode( '-', $exploded_values[0] );
					$period_from   = $period_values[0];
					$period_to     = $period_values[1];
				}

				if ( strpos( $exploded_values[1], '-' ) !== false ) {
					$amount_values = explode( '-', $exploded_values[1] );
					$amount_from   = $amount_values[0];
					$amount_to     = $amount_values[1];
				}

				$this->commission[] = [
					'period_from' => $period_from,
					'period_to'   => $period_to,
					'amount_from' => $amount_from,
					'amount_to'   => $amount_to,
					'value'       => $exploded_values[2],
				];
			}
		}
	}

	protected function offersParameters( array $offersParameters ) {
		if ( ! empty( $offersParameters ) ) {
			foreach ( $offersParameters as $offersParameter ) {
				$this->parameters[ $offersParameter->parameter->slug ] = new ParameterDTO( $offersParameter );
			}
		}
	}

	protected function offersDebtorsBases( array $offersDebtorsBases ) {
		if ( ! empty( $offersDebtorsBases ) ) {
			foreach ( $offersDebtorsBases as $offersDebtorsBase ) {
				$this->debtorsBases[ $offersDebtorsBase->debtorsBaseId ] = new DebtorsBaseDTO( $offersDebtorsBase );
			}
		}
	}

	protected function entity( $entity ) {
		if ( ! empty( $entity ) ) {
			$this->entity = new EntityDTO( $entity );
		}
	}

	protected function product( $product ) {
		if ( ! empty( $product ) ) {
			$this->product = new ProductDTO( $product );
		}
	}
}
