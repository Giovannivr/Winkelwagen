<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/", name="product_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="product_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_show", methods={"GET"})
     */
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_index');
    }

     /**
     * @Route("/{id}/add", name="product_add", methods={"GET","POST"})
     */
    public function add(Request $request, Product $product): Response
    {
        $em = $this->getDoctrine()->getManager();
        // haal de gegevens op van het gekozen product via $id in de product repository
        $producten = $em->getRepository('App:Product')->findOneBySomeField($product->getId());
        # dump($producten);
        // schrijf de relevante gegevens in variabelen
        $idproduct = $producten->getid();
        $naam = $producten->getNaam();
        $prijs = $producten->getPrijs();
        $omschrijving = $producten->getOmschrijving();
     // deze regel hieronder gebruiken alleen om tijdens programmeren de sessie even helemaal leeg te maken voor Cart  
     //   $this->session->remove('Cart');
        $getCart = $this->session->get('Cart');
            if(isset($getCart[$product->getId()])) {
                $getCart[$product->getId()]['aantal']++;
            }else {
            // de eerste keer dat in de sessie op add gedrukt wordt bij een product de waarden schrijven
            $getCart[$product->getId()] = array('id' => $idproduct, 'naam' => $naam, 'omschrijving' => $omschrijving, 'aantal' => 1, 'prijs' => $prijs);

            }
            
        
            $this->session->set('Cart',  $getCart);

          //  var_dump($this->session->get('Cart'));
            

        return $this->render('product/add.html.twig', [
            'cart' => $getCart,
        ]);
    }

}

