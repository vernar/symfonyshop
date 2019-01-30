<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CustomerFixture extends BaseFixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'admin_users', function($i) {
            $user = new Customer();
            $user->setEmail(sprintf('spacebarr%d@example.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setToken(bin2hex(openssl_random_pseudo_bytes(10)));
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));
            return $user;
        });
        $manager->flush();
    }
}
