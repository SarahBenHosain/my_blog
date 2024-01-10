<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints\Date;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $premierArticle = new Article ();
        $premierArticle->setTitre('Mon premier article');
        $premierArticle->setDate(new DateTime());
        $premierArticle->setImage('ordi-quantique.png');
        $premierArticle->setContenu("Whaow ! J'ai créée mon premier article en full PDO!");

        $compremierArticle1 = new Commentaire ();
        $compremierArticle1->setTitre('Premier comments du deuieme article');
        $compremierArticle1->setContenu("constructif!");
        $compremierArticle1->setArticle($premierArticle);
        $manager->persist($compremierArticle1);

        $compremierArticle2= new Commentaire ();
        $compremierArticle2->setTitre('Deuxieme comments du deuieme article');
        $compremierArticle2->setContenu("interessant!");
        $compremierArticle2->setArticle($premierArticle);
        $manager->persist($compremierArticle2);

        $manager->persist($premierArticle);



        $deuxiemeArticle = new Article ();
        $deuxiemeArticle->setTitre('Mon deuxieme article');
        $deuxiemeArticle->setDate(new DateTime());
        $deuxiemeArticle->setImage('ordi-quantique.png');
        $deuxiemeArticle->setContenu("Whaow ! J'ai créée mon deuxieme article en full PDO!");
        $manager->persist($deuxiemeArticle);

        $comdeuxiemeArticle1 = new Commentaire ();
        $comdeuxiemeArticle1->setTitre('Premier comments du deuieme article');
        $comdeuxiemeArticle1->setContenu("Magnifique article!!");
        $comdeuxiemeArticle1->setArticle($premierArticle);
        $manager->persist($comdeuxiemeArticle1);

        $comdeuxiemeArticle2= new Commentaire ();
        $comdeuxiemeArticle2->setTitre('Deuxieme comments du deuieme article');
        $comdeuxiemeArticle2->setContenu("Cet article est tres interessant!");
        $comdeuxiemeArticle2->setArticle($premierArticle);
        $manager->persist($comdeuxiemeArticle2);

        $toto = new User();
        $toto->setEmail('toto@toto.fr');
        $hashPassword = $this->passwordHasher->hashPassword($toto, 'toto');
        $toto->setPassword($hashPassword);
        $manager->persist($toto);   

        $admin = new User();
        $admin->setEmail('admin@admin.fr');
        $hashAdminPassword = $this->passwordHasher->hashPassword($admin, 'admin');
        $admin->setPassword($hashAdminPassword);
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        
        $manager->flush();
    }
}

