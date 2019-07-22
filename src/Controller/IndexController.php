<?php

namespace App\Controller;

use App\Service\GeoService;
use GeoIp2\Exception\AddressNotFoundException;
use MaxMind\Db\Reader\InvalidDatabaseException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     *
     * @param Request    $request
     * @param GeoService $geoService
     *
     * @return JsonResponse
     *
     * @throws AddressNotFoundException
     * @throws InvalidDatabaseException
     */
    public function index(Request $request, GeoService $geoService): JsonResponse
    {
        $ip = $request->get('ip');

        return $this->json([
            'ip'      => $ip,
            'country' => $geoService->getIpCountry($ip),
        ]);
    }
}
