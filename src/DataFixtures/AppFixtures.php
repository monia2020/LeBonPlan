<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\User;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('admin@test.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPseudo('Abi');

        $password = $this->encoder->encodePassword($user, 'pass_1234');
        $user->setPassword($password);
        
        // $product = new Product();
        $manager->persist($user);

        $manager->flush();

        $user = new User();
        $user->setEmail('admin2@test.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPseudo('Monia');
  
        $password = $this->encoder->encodePassword($user, 'pass_1234');
        $user->setPassword($password);
        
        // $product = new Product();
        $manager->persist($user);

        $manager->flush();

        $user = new User();
        $user->setEmail('Caroline@test.fr');
        $user->setRoles(['ROLE_USER']);
        $user->setPseudo('Caro');
       

        $password = $this->encoder->encodePassword($user, 'pass_1234');
        $user->setPassword($password);
        
        // $product = new Product();
        $manager->persist($user);

        $manager->flush();

        $user = new User();
        $user->setEmail('Sonia@test.fr');
        $user->setRoles(['ROLE_USER']);
        $user->setPseudo('Soso');
      
        $password = $this->encoder->encodePassword($user, 'pass_1234');
        $user->setPassword($password);
        
        // $product = new Product();
        $manager->persist($user);

        $manager->flush();

        $user = new User();
        $user->setEmail('Joseph@test.fr');
        $user->setRoles(['ROLE_USER']);
        $user->setPseudo('Jojo93');
  
        $password = $this->encoder->encodePassword($user, 'pass_1234');
        $user->setPassword($password);
        
        // $product = new Product();
        $manager->persist($user);

        $manager->flush();


        $user = new User();
        $user->setEmail('Lea@test.fr');
        $user->setRoles(['ROLE_USER']);
        $user->setPseudo('LeaBohaboha');

        $password = $this->encoder->encodePassword($user, 'pass_1234');
        $user->setPassword($password);
        
        // $product = new Product();
        $manager->persist($user);

        $manager->flush();

        $user = new User();
        $user->setEmail('Sephora@test.fr');
        $user->setRoles(['ROLE_USER']);
        $user->setPseudo('Sephora');

        $password = $this->encoder->encodePassword($user, 'pass_1234');
        $user->setPassword($password);
        
        // $product = new Product();
        $manager->persist($user);

        $manager->flush();



    }    

}
