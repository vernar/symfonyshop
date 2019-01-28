<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 27.01.19
 * Time: 21:41
 */

namespace App\Controller;


use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends Controller
{
    /**
     * @Route("/product/{urlKey}")
     */
    public function viewAction($urlKey)
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findBy([],['sort_order' => 'ASC']);

        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findOneBy(['url_key' => $urlKey]);
        return $this->render('product.html.twig',[
            'product' => $product,
            'categories' => $categories,
        ]);
    }
}