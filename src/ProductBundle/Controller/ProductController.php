<?php

namespace ProductBundle\Controller;

use ProductBundle\Entity\Product;
use ProductBundle\Form\ProductFilterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ProductBundle\Service\ProductManager;
use Symfony\Component\Translation\Exception\InvalidArgumentException;

/**
 * Product controller.
 *
 * @Route("products")
 */
class ProductController extends Controller
{
    /**
     * Lists all product entities.
     *
     * @Route("/", name="product_index")
     * @Method("GET")
     *
     * @param Request $request
     * @param ProductManager $productManager
     * @return Response
     * @throws \LogicException
     * @throws \OutOfBoundsException
     * @throws InvalidArgumentException
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function indexAction(Request $request, ProductManager $productManager): Response
    {
        $form = $this->createForm(
            ProductFilterType::class,
            null,
            $productManager->getProductFilterOptions()
        );

        $form->handleRequest($request);

        return $this->render('ProductBundle:Product:index.html.twig', array(
            'pagination' => $productManager->getPaginatedFrontendProducts($form, $request),
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a product entity.
     *
     * @Route("/{id}", name="product_show")
     * @Method("GET")
     *
     * @param Product $product
     * @return Response
     */
    public function showAction(Product $product): Response
    {
        return $this->render('ProductBundle:Product:show.html.twig', [
            'product' => $product,
        ]);
    }
}
