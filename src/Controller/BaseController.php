<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 29.01.19
 * Time: 12:28
 */

namespace App\Controller;


use App\Entity\Category;
use App\Repository\CategoryRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BaseController extends Controller
{
    protected $categoryRepository;
    public $session;

    public function __construct(
        CategoryRepository $categoryRepository,
        SessionInterface $session
    ){
        $this->categoryRepository = $categoryRepository;
        $this->session = $session;
        $this->session->set('catmenu', $this->categoryRepository->getCategoryCollection());
    }


    protected function getMenuData()
    {

        $this->get('session')->set('kkkkkkkk','555555');


        $this->session->set('asdf','ffffff');

        return $this->getDoctrine()
            ->getRepository(Category::class)
            ->findBy([],['sort_order' => 'ASC']);
    }
}