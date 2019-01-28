<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 27.01.19
 * Time: 21:54
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends Controller
{
    /**
     * @Route("/cart/view")
     */
    public function viewAction()
    {
        return $this->render('cart.html.twig');

    }

    /**
     * @Route("/cart/success")
     */
    public function successAction()
    {

    }

    /**
     * @Route("/cart/checkout")
     */
    public function checkoutAction()
    {

    }

    /**
     * @Route("/cart/ajaxadd")
     */
    public function ajaxAddAction()
    {

    }

    /**
     * @Route("/cart/ajaxdel")
     */
    public function ajaxDeleteAction()
    {

    }

    /**
     * @Route("/cart/ajaxupdatecart")
     */
    public function ajaxUpdateCartAction()
    {

    }

    /**
     * @Route("/cart/ajaxupdatemenu")
     */
    public function ajaxUpdateMenuAction()
    {

    }
}