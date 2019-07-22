<?php

namespace App\Service;

use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use MaxMind\Db\Reader\InvalidDatabaseException;

/**
 * Class GeoService.
 */
class GeoService
{
    /**
     * @var string
     */
    private $maxMindCountryDbFilePath;

    /**
     * GeoService constructor.
     *
     * @param string $maxMindCountryDbFilePath
     */
    public function __construct(string $maxMindCountryDbFilePath)
    {
        $this->maxMindCountryDbFilePath = $maxMindCountryDbFilePath;
    }

    /**
     * @param string $ip
     * @return string|null
     * @throws AddressNotFoundException
     * @throws InvalidDatabaseException
     */
    public function getIpCountry(string $ip): ?string
    {
        $reader = new Reader($this->maxMindCountryDbFilePath);

        return $reader->country($ip)->country->name;
    }
}
