<?php

namespace App\Service\User;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterService
{
    /**
     * @var UserPasswordEncoderInterface
     */
    public $encoder;
    /**
     * @var EntityManagerInterface
     */
    public $manager;

    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager)
    {
        $this->encoder = $encoder;
        $this->manager = $manager;
    }

    public function registerUser(User $user)
    {
        $pass = $user->getPassword();
        $hashPass = $this->encoder->encodePassword($user, $pass);
        $user->setPassword($hashPass)
        ->setCreatedAt(new \DateTime())
        ->setRoles(['ROLE_USER']);

        $this->manager->persist($user);
        $this->manager->flush();

        return $user;
    }
}