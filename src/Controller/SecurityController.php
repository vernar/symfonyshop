<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Security\LoginFormAuthenticator;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends BaseController
{


    /**
     * @Route("/login", name="app_login")
     */
    public function loginCustomer(AuthenticationUtils $authenticationUtils)
    {
        if ($this->get('security.token_storage')->getToken()->getUser() != 'anon.') {
            return $this->redirectToRoute('app_account');
        }
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'categories' => $this->getMenuData(),
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/admin/login", name="app_admin_login")
     */
    public function loginAdmin(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('admin/login.html.twig', [
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function CustomerLogout()
    {
    }

    /**
     * @Route("/admin/logout", name="app_admin_logout")
     */
    public function adminLogout()
    {
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(
        \Symfony\Component\HttpFoundation\Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        \Swift_Mailer $mailer
    ){
        if ($this->get('security.token_storage')->getToken()->getUser() != 'anon.') {
            return $this->redirectToRoute('app_account');
        }
        if ($request->isMethod('POST')) {
            $user = new Customer();
            $user->setEmail($request->request->get('email'));
            $user->setFirstName('Mystery');
            $user->setIsConfirmed(false);
            $user->setToken(bin2hex(openssl_random_pseudo_bytes(10)));
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $request->request->get('password')
            ));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $message = (new \Swift_Message('SymfonyShop account confirmation'))
                ->setFrom('symfonyshop@example.com')
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView(
                        'email/confirmation.html.twig',
                        ['user' => $user]
                    ),
                    'text/html'
                )
            ;
            $mailer->send($message);
            $this->addFlash("success", "To complete the registration, click on the link in the email sent to you");
        }

        return $this->render('security/register.html.twig', [
            'categories' => $this->getMenuData(),
        ]);
    }

    /**
     * @Route("/register/confirmation/{token}", name="app_register_confirmation")
     */
    public function emailValidation(
        \Symfony\Component\HttpFoundation\Request $request,
        GuardAuthenticatorHandler $guardHandler,
        LoginFormAuthenticator $formAuthenticator,
        $token
    ){
        if ($request->isMethod('GET')) {
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(Customer::class)
            ->findOneBy(['token' => $token]);
            if($user) {
                $user->setIsConfirmed(1);
                $em->flush();
                $this->addFlash("success", "Registration complete, thank you");
                return $guardHandler->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $formAuthenticator,
                    'main'
                );
            }

        }
        $this->addFlash("error", "Incorrect validation key, please try again");
        return $this->redirectToRoute('app_login');
    }
}
