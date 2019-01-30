<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 27.01.19
 * Time: 21:36
 */

namespace App\Controller;


use App\Entity\Category;
use App\Entity\EavProductCategories;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends Controller
{

    /**
     * @Route("/category/{catName}")
     */
    public function viewAction($catName)
    {
        $currentCategory = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['category_url' => $catName]);
        if ($currentCategory == null){
            return $this->redirect('/');
        }

        $EavCollection = $this->getDoctrine()
            ->getRepository(EavProductCategories::class)
            ->findBy(['category' => $currentCategory->getId()]);

        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findBy([],['sort_order' => 'ASC']);

        return $this->render('category.html.twig', [
            'eavcollection' => $EavCollection,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/search/{word}")
     */
    public function searchAction($word)
    {

    }

}