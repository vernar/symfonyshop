<?php

namespace App\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminUserFixtures extends BaseFixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(3, 'main_users', function($i) {
            $user = new \App\Entity\AdminUser();
            $user->setEmail(sprintf('admin%d@example.com', $i));
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'admin'
            ));
            return $user;
        });
        $manager->flush();
    }
}
