<?php

namespace App\Controller;

use App\Service\NutApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/shop", name="shop_")
 */
class ShopController extends AbstractController
{
    private $nutApiService;

    public function __construct(NutApiService $nutApiService)
    {
        $this->nutApiService = $nutApiService;
    }

    /**
     * @return Response
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $products = $this->nutApiService->fetch();
        return $this->render('shop/index.html.twig', [
            'controller_name' => 'ShopController',
            'products' => $products,
        ]);
    }

    /**
     * @param Request $request
     * @Route("/buy", name="buy")
     */
    public function buy(Request $request): Response
    {
        $id = $request->get('product');
        $this->nutApiService->send($id);
        return $this->redirectToRoute('shop_index');
    }
}
