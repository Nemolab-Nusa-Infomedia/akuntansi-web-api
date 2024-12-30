<?php

namespace App\Helpers;

use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;

class Token
{
	/**
	 * @param array $data
	 * @param float $ttl
	 * @param bool $accessToken
	 * 
	 * @return \Illuminate\Support\Collection
	 */
	public static function Generate(array $data = [], float $ttl = 1, bool $accessToken = false): Collection
	{
		if ($accessToken) {
			$ttl = config('jwt.ttl');
		}

		$payload = JWTFactory::setTTL($ttl)->customClaims($data)->make();
		$exp = Carbon::createFromTimestamp($payload->get('exp'));

		return collect([
			'exp' => $exp->setHour((int) $exp->format('h') + 7),
			'token' => JWTAuth::encode($payload)->get(),
		]);
	}
}
