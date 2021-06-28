<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

   public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setEmail('admin@example.com')
            ->setName('admin')
            ->setPassword('tata')
            ->setRoles(['ROLE_SUPER_ADMIN'])
            ->setPassword($this->passwordEncoder->encodePassword(
             $admin,
             'tata'
         ));
        $manager->persist($admin);
        
        
        $user = new User();
        $user->setEmail('user@example.com')
            ->setName('user')
            ->setPassword('toto')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->passwordEncoder->encodePassword(
             $user,
             'toto'
         ));
        $manager->persist($user);
        $manager->flush();
    }
}
