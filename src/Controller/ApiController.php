<?php

namespace App\Controller;

use App\Entity\Acts;

use App\Entity\Grf;
use App\Entity\Societe;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use JMS\Serializer\SerializerInterface;

class ApiController extends AbstractController
{



    // dans ta classe
    private $serializer;

    public function __construct(SerializerInterface $serializer){
        $this->serializer = $serializer;
    }
    /**
     * @Route("/api/acts", name="api.acts")
     * @Method({"GET"})
     */
    public function acts()
    {
        $list_acts = $this->getDoctrine()->getRepository(Acts::class)->findAll();
        $data = $this->serializer->serialize($list_acts, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/api/grf", name="api.grf")
     * @Method({"GET"})
     */
    public function grf()
    {
        $list_grf = $this->getDoctrine()->getRepository(Grf::class)->findAll();
        $data = $this->serializer->serialize($list_grf, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/societe", name="api.societe")
     * @Method({"GET"})
     */
    public function societe()
    {
        $list_so = $this->getDoctrine()->getRepository(Societe::class)->findAll();
        $data = $this->serializer->serialize($list_so, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
