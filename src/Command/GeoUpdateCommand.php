<?php

namespace App\Command;

use PharData;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\HttpClient;

/**
 * Class GeoUpdateCommand.
 */
class GeoUpdateCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'geo-update';
    /**
     * @var string
     */
    private $cachePath;
    /**
     * @var string
     */
    private $dbFilename;

    /**
     * GeoUpdateCommand constructor.
     *
     * @param string $cachePath
     * @param string $dbFilename
     */
    public function __construct(string $cachePath, string $dbFilename)
    {
        Command::__construct();
        $this->cachePath = $cachePath;
        $this->dbFilename = $dbFilename;
    }

    protected function configure(): void
    {
        $this->setDescription('Update MaxMind countries database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $io = new SymfonyStyle($input, $output);

        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET',
            'https://geolite.maxmind.com/download/geoip/database/GeoLite2-Country.tar.gz');
        $archivePath = $this->cachePath . '/GeoLite2-Country.tar.gz';
        file_put_contents($archivePath, $response->getContent());
        $arch = new PharData($archivePath);
        $internalPathArray = explode('/', $arch->key());
        $arch->extractTo(
            $this->cachePath,
            $internalPathArray[count($internalPathArray) - 1] . '/' . $this->dbFilename,
            true
        );

        copy(
            $this->cachePath . '/' . $internalPathArray[count($internalPathArray) - 1] . '/' . $this->dbFilename,
            $this->cachePath . '/' . $this->dbFilename
        );
        unlink($this->cachePath . '/' . $internalPathArray[count($internalPathArray) - 1] . '/' . $this->dbFilename);
        rmdir($this->cachePath . '/' . $internalPathArray[count($internalPathArray) - 1]);
        unlink($archivePath);

        $io->success('MaxMind GeoLite2-Country updated.');
    }
}
