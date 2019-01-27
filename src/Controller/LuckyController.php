<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 27.01.19
 * Time: 19:12
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends Controller
{
    /**
     * @Route("/lucky/number/{luckName}")
     */
    public function numberAction($luckName)
    {
        return $this->render('genus/show.html.twig', [
            'name' => $luckName,
        ]);
    }
}