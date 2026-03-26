<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Books;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $book = new Books();
            $book->setTitle('Book ' . $i);
            $book->setCoverText('Quatrième de couverture numéro :  ' . $i);
            $manager->persist($book);
        }

        $manager->flush();
    }
}
