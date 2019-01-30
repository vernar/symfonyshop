<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 27.01.19
 * Time: 21:45
 */

namespace App\Controller;


use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CustomerController extends BaseController
{

    /**
     * @Route("/customer/account/order")
     *
     */
    public function accountOrderAction()
    {

    }

    /**
     * @Route("/customer/account/{tab}", name="app_account")
     */
    public function accountInfoAction(
        UserPasswordEncoderInterface $passwordEncoder,
        \Symfony\Component\HttpFoundation\Request $request,
        CustomerRepository $customerRepository,
        $tab = 'list'
    ){
        $currentUser = $this->get('security.token_storage')->getToken()->getUser();

        if ($request->isMethod('POST')) {
            $post = $request->request->all();
            if(isset($post['email']) && null !== $customerRepository->checkEmailDuplication($currentUser->getId(),
                    $post['email']
            )){
                $this->addFlash("error", "Email already exist");
                return $this->redirectToRoute('app_account');
                exit;
            }
            $user = $this->getDoctrine()
                ->getManager()
                ->getRepository(Customer::class)
                ->find($currentUser->getId());

            if (isset($post['email']) && $post['email'] != ''){
                $user->setEmail($post['email']);
            }
            if (isset($post['name']) && $post['name'] != ''){
                $user->setFirstName($post['name']);
            }
            if (isset($post['address']) && $post['address'] != ''){
                $user->setAddress($post['address']);
            }
            if (isset($post['password']) && $post['password'] != ''){
                $user->setPassword($passwordEncoder->encodePassword(
                    $user,
                    $post['password']
                ));
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash("success", "Your information saved success");
        }
        $customer = $this->getDoctrine()
            ->getRepository(Customer::class)
            ->find($currentUser->getId());
        if($tab == 'address'){
            return $this->render('customer/address.html.twig', [
                'customer' => $customer,
                'tab' => $tab,
            ]);
        } elseif($tab == 'orders'){
            return $this->render('customer/orders.html.twig', [
                'customer' => $customer,
                'tab' => $tab,
            ]);
        } elseif($tab == 'cart'){
            return $this->render('customer/cart.html.twig', [
                'customer' => $customer,
                'tab' => $tab,
            ]);
        } else {  //$tab == info
            return $this->render('customer/info.html.twig', [
                'customer' => $customer,
                'tab' => $tab,
            ]);
        }

    }

    /**
     * @Route("/customer/account/newslatter")
     *
     */
    public function accountNewslatterAction()
    {

    }
}