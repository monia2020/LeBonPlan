<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Annonce;
use App\Entity\Categorie;
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
        /** Partie Utilisateurs **/

        $user = new User();
        $user->setPseudo('admin1');
        $user->setEmail('admin1@test.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setAdresse('Paris');
        

        $password = $this->encoder->encodePassword($user, 'pass_1234');
        $user->setPassword($password);



        $user2 = new User();
        $user2->setPseudo('admin2');
        $user2->setEmail('admin2@test.fr');
        $user2->setRoles(['ROLE_ADMIN']);
        $user2->setAdresse('Lyon');

        $password = $this->encoder->encodePassword($user2, 'pass_1234');
        $user2->setPassword($password);


        $user3 = new User();
        $user3->setPseudo('user');
        $user3->setEmail('user@test.fr');
        $user3->setRoles(['ROLE_USER']);
        $user3->setAdresse('Marseille');
        

        $password = $this->encoder->encodePassword($user3, 'pass_1234');
        $user3->setPassword($password);


        $user4 = new User();
        $user4->setPseudo('user2');
        $user4->setEmail('user2@test.fr');
        $user4->setRoles(['ROLE_USER']);
        $user4->setAdresse('Nantes');
        

        $password = $this->encoder->encodePassword($user4, 'pass_1234');
        $user4->setPassword($password);


        // $product = new Product();
        $manager->persist($user);
        $manager->persist($user2);
        $manager->persist($user3);
        $manager->persist($user4);

        $this->addReference('user', $user3);
        $this->addReference('user2', $user4);


        /** Partie Catégorie **/

        $categorie = new Categorie();
        $categorie->setTitre('Homme');
        $manager->persist($categorie);

        $categorie1 = new Categorie();
        $categorie1->setTitre('Femme');
        $manager->persist($categorie1);

        $categorie2 = new Categorie();
        $categorie2->setTitre('Enfant');
        $manager->persist($categorie2);

        $categorie3 = new Categorie();
        $categorie3->setTitre('Univers_bebe');
        $manager->persist($categorie3);

        $categorie4 = new Categorie();
        $categorie4->setTitre('Depannage');
        $manager->persist($categorie4);

        $categorie5 = new Categorie();
        $categorie5->setTitre('Maison');
        $manager->persist($categorie5);

        /** Déclaration de reference pour chaque fixture **/

        $this->addReference('categorie',$categorie);
        $this->addReference('categorie1',$categorie1);
        $this->addReference('categorie2',$categorie2);
        $this->addReference('categorie3',$categorie3);
        $this->addReference('categorie4',$categorie4);
        $this->addReference('categorie5',$categorie5);


        /** Partie Annonces **/

        $annonce = new Annonce();
        $annonce->setTitre('Robe fille');
        $annonce->setCreatedAt(new \Datetime());
        $annonce->setType('offre');
        $annonce->setPrix(10);
        $annonce->setCategorie($this->getReference('categorie2'));
        $annonce->setImage('image.jpg');
        $annonce->setDescription('Bon etat');
        $manager->persist($annonce);
        $annonce->setUser($this->getReference('user'));
        
        $annonce8 = new Annonce();
        $annonce8->setTitre('Talons Noir');
        $annonce8->setCreatedAt(new \Datetime());
        $annonce8->setType('offre');
        $annonce8->setPrix(20);
        $annonce8->setCategorie($this->getReference('categorie1'));
        $annonce8->setImage('talon.jpeg');
        $annonce8->setDescription("Portés une seule fois");
        $manager->persist($annonce8);
        $annonce8->setUser($this->getReference('user2'));

        $annonce1 = new Annonce();
        $annonce1->setTitre('Sandale bleu');
        $annonce1->setCreatedAt(new \Datetime());
        $annonce1->setType('offre');
        $annonce1->setPrix(15);
        $annonce1->setCategorie($this->getReference('categorie2'));
        $annonce1->setImage('téléchargement.jpg');
        $annonce1->setDescription('bleu jamais portée');
        $manager->persist($annonce1);
        $annonce1->setUser($this->getReference('user'));

        $annonce2 = new Annonce();
        $annonce2->setTitre('Aspirateur');
        $annonce2->setCreatedAt(new \Datetime());
        $annonce2->setType('offre');
        $annonce2->setPrix(30);
        $annonce2->setCategorie($this->getReference('categorie5'));
        $annonce2->setImage('imag.jpg');
        $annonce2->setDescription('en bon etat');
        $manager->persist($annonce2);
        $annonce2->setUser($this->getReference('user'));
        
        $annonce10 = new Annonce();
        $annonce10->setTitre('Robe');
        $annonce10->setCreatedAt(new \Datetime());
        $annonce10->setType('offre');
        $annonce10->setPrix(12);
        $annonce10->setCategorie($this->getReference('categorie1'));
        $annonce10->setImage('robefleuri.jpg');
        $annonce10->setDescription("Robe fleurie femme");
        $manager->persist($annonce10);
        $annonce10->setUser($this->getReference('user'));


        $annonce3 = new Annonce();
        $annonce3->setTitre('Peinture');
        $annonce3->setCreatedAt(new \Datetime());
        $annonce3->setType('demande');
        $annonce3->setPrix(400);
        $annonce3->setCategorie($this->getReference('categorie4'));
        $annonce3->setImage('peinture-cuisine.jpg');
        $annonce3->setDescription("Bonjour, j'ai besoin de quelqu'un pour me faire la peinture à ma cuisine");
        $manager->persist($annonce3);
        $annonce3->setUser($this->getReference('user'));

        $annonce4 = new Annonce();
        $annonce4->setTitre('Chaise haute bébé');
        $annonce4->setCreatedAt(new \Datetime());
        $annonce4->setType('offre');
        $annonce4->setPrix(25);
        $annonce4->setCategorie($this->getReference('categorie3'));
        $annonce4->setImage('chaise-haute.jpg');
        $annonce4->setDescription("En très bon état, elle s'adapte facilement à la croissance de l'enfant. Elle comprend un siège à trois positions d'inclinaison et à sept réglages en hauteur qui permet de nourrir plus facilement les jeunes bébés.");
        $manager->persist($annonce4);
        $annonce4->setUser($this->getReference('user'));

        $annonce5 = new Annonce();
        $annonce5->setTitre('Chemisette blanche');
        $annonce5->setCreatedAt(new \Datetime());
        $annonce5->setType('offre');
        $annonce5->setPrix(40);
        $annonce5->setCategorie($this->getReference('categorie'));
        $annonce5->setImage('chemise-homme.jpg');
        $annonce5->setDescription("Chemise Hugo Boss, taille M slim fit, parfait état");
        $manager->persist($annonce5);
        $annonce5->setUser($this->getReference('user'));


        $annonce6 = new Annonce();
        $annonce6->setTitre('Sac à main noir');
        $annonce6->setCreatedAt(new \Datetime());
        $annonce6->setType('offre');
        $annonce6->setPrix(60);
        $annonce6->setCategorie($this->getReference('categorie1'));
        $annonce6->setImage('sacamain.jpg');
        $annonce6->setDescription("Sac à Main Grand Noir crocodile Femme en cuir Haute capacité, il est parfait pour printemps, Eté, automne, hiver");
        $manager->persist($annonce6);
        $annonce6->setUser($this->getReference('user2'));

        $annonce7 = new Annonce();
        $annonce7->setTitre('Pyjama bébé fille');
        $annonce7->setCreatedAt(new \Datetime());
        $annonce7->setType('offre');
        $annonce7->setPrix(6);
        $annonce7->setCategorie($this->getReference('categorie2'));
        $annonce7->setImage('pyjama.jpg');
        $annonce7->setDescription("Pyjama 6 mois fille marque noukies ,en excellente etat");
        $manager->persist($annonce7);
        $annonce7->setUser($this->getReference('user2'));

        $annonce9 = new Annonce();
        $annonce9->setTitre('Montre');
        $annonce9->setCreatedAt(new \Datetime());
        $annonce9->setType('offre');
        $annonce9->setPrix(5);
        $annonce9->setCategorie($this->getReference('categorie1'));
        $annonce9->setImage('montre.jpeg');
        $annonce9->setDescription("Montre femme");
        $manager->persist($annonce9);
        $annonce9->setUser($this->getReference('user2'));


        $manager->flush();
    }
}
