<?php
namespace ArtinCMS\LTS;
use Illuminate\Support\Facades\Facade;

class LTSFacade extends Facade
{
	protected static function getFacadeAccessor() {
		return 'LTS';
	}
}