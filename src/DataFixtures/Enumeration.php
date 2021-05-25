<?php

namespace App\DataFixtures;

use App\Entity\MesureType;
use App\Entity\Moment;
use App\Entity\Month;
use App\Entity\Product;
use App\Entity\ProductType;
use App\Entity\RecipeSpecial;
use App\Entity\RecipeType;
use App\Entity\User;
use App\Repository\MesureTypeRepository;
use App\Repository\MomentRepository;
use App\Repository\MonthRepository;
use App\Repository\ProductTypeRepository;
use App\Repository\RecipeSpecialRepository;
use App\Repository\RecipeTypeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class Enumeration extends Fixture implements FixtureGroupInterface
{
    //complete base enum for each tab
    public function load(ObjectManager $manager)
    {
        $tabTypeRecipe = [
            "entrée",
            "plat",
            "dessert",
            "autre"
        ];

        foreach ($tabTypeRecipe as $typeRecipeName){
            $typeRecipe = new RecipeType();
            $typeRecipe->setName($typeRecipeName);
            $manager->persist($typeRecipe);
        }

        $tabSpecialRecipe = [
            "végétarien",
            "sans gluten",
            "sans lait de vache"
        ];

        foreach ($tabSpecialRecipe as $specialRecipeName){
            $specialRecipe = new RecipeSpecial();
            $specialRecipe->setName($specialRecipeName);
            $manager->persist($specialRecipe);
        }

        $tabProductType = [
            "légume",
            "viande",
            "féculent",
            "légumineuse",
            "fromage",
            "yaourt",
            "boisson",
            "fruit",
            "charcuterie",
            "autre",
        ];

        foreach ($tabProductType as $productTypeName){
            $productType = new ProductType();
            $productType->setName($productTypeName);
            $manager->persist($productType);
        }

        $tabMonth = [
            "Janvier",
            "Février",
            "Mars",
            "Avril",
            "Mai",
            "Juin",
            "Juillet",
            "Août",
            "Septembre",
            "Octobre",
            "Novembre",
            "Décembre",
        ];

        foreach ($tabMonth as $monthName){
            $month = new Month();
            $month->setName($monthName);
            $manager->persist($month);
        }

        $tabMesureType = [
            "gramme",
            "unité",
            "litre",
            "cuillère à soupe",
            "cuillère à café",
        ];

        foreach ($tabMesureType as $mesureTypeName){
            $mesureType = new MesureType();
            $mesureType->setName($mesureTypeName);
            $manager->persist($mesureType);
        }

        $tabMoment = [
            "matin",
            "déjeuner",
            "gouter",
            "diner",
        ];

        foreach ($tabMoment as $momentName){
            $moment = new Moment();
            $moment->setName($momentName);
            $manager->persist($moment);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['Enumeration'];
    }
}
