<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 27.01.19
 * Time: 23:44
 */

namespace App\Controller;


use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class CmsController extends Controller
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepageAction()
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findBy([],['sort_order' => 'ASC']);

        return $this->render('homepage.html.twig', [
            'categories' => $categories,
            ]);
    }
}