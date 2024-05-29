<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Users;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UsersFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // Create an admin user
        $admin = new Users();
        $admin->setEmail('admin@example.com');
        $admin->setNom('Admin');
        $admin->setPrenom('User');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword(
            $this->passwordEncoder->hashPassword(
            $admin,
            'adminpassword'
        ));
        $manager->persist($admin);

        // Create 4 regular users
        for ($i = 1; $i <= 4; $i++) {
            $user = new Users();
            $user->setEmail('user' . $i . '@example.com');
            $user->setNom('User');
            $user->setPrenom('Number ' . $i);
            $user->setRoles(['ROLE_USER']);
            $user->setPassword(
                $this->passwordEncoder->hashPassword(
                $user,
                'userpassword'
            ));
            $manager->persist($user);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [];
    }


}
