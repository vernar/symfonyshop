<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 27.01.19
 * Time: 21:36
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends Controller
{
    /**
     * @Route("/category")
     */
    public function defaultViewAction()
    {
        return $this->render('category.html.twig');
    }

    /**
     * @Route("/category/{catName}")
     */
    public function viewAction($catName)
    {
        return $this->render('category.html.twig');
    }

    /**
     * @Route("/category/search/{word}")
     */
    public function searchAction($word)
    {

    }

}