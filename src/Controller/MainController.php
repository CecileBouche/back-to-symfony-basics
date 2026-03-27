<?php

namespace App\Controller;

use App\Repository\StarshipRepository;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bridge\Twig\Command\DebugCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MainController extends AbstractController
{
    /**
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException
     */
    #[Route('/', name: 'app_homepage')]
    public function homepage(
        StarshipRepository $repository,
        HttpClientInterface $client,
        CacheInterface $issLocationPool,
        //        #[Autowire(param: 'iss_location_cache_ttl')] $issLocationCacheTtl,
        int $issLocationCacheTtl,
        //        #[Autowire(service: 'twig.command.debug')]
        //        DebugCommand $twigDebugCommand,
    ): Response {
        //        $input = new ArrayInput([]);
        //        $output = new BufferedOutput();
        //        $twigDebugCommand->run($input, $output);
        //        dd($output);
        //        dd($this->getParameter('iss_location_cache_ttl'));
        $ships = $repository->findAll();
        $myShip = $ships[array_rand($ships)];

        //        $issData = $issLocationPool->get('iss_location_data', function () use ($client) {
        //            $response = $client->request('GET', 'https://api.wheretheiss.at/v1/satellites/25544');
        //
        //            return $response->toArray();
        //        });

        return $this->render('homepage.html.twig', [
            'ships' => $ships,
            'myShip' => $myShip,
            //            'issData' => $issData,
        ]);
    }
}
