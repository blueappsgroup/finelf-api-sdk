<?php

namespace Finelf_Api_Sdk\Modules;

use Finelf_Api_Sdk\DTO\OfferDTO;

class OfferModule extends BaseModule {
	protected $baseRoute = 'offers';

	public function getById( int $id, string $relations = '' ): OfferDTO {
		if ( empty( $id ) ) {
			return new OfferDTO( [] );
		}

		if ( ! empty( $relations ) ) {
			$id .= '?relations=' . $relations;
		}

		return new OfferDTO( parent::get( $id ) );
	}

	public function createClick( int $id ): void {
		if ( ! empty( $id ) ) {
			parent::post( $id . '/clicks' );
		}
	}

}
