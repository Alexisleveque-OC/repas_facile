<?php

namespace App\DataFixtures;

use App\Entity\DayMenu;
use App\Entity\FavoriteRecipe;
use App\Entity\LineShopping;
use App\Entity\MesureType;
use App\Entity\Month;
use App\Entity\Product;
use App\Entity\ProductType;
use App\Entity\Recipe;
use App\Entity\RecipeLine;
use App\Entity\ShoppingList;
use App\Entity\User;
use App\Entity\WeekMenu;
use App\Repository\MesureTypeRepository;
use App\Repository\MomentRepository;
use App\Repository\MonthRepository;
use App\Repository\ProductTypeRepository;
use App\Repository\RecipeSpecialRepository;
use App\Repository\RecipeTypeRepository;
use App\Service\Finder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Data extends Fixture
{

    public $monthRepo;
    public $mesureRepo;
    public $productTypeRepo;
    public $momentRepo;
    public $recipeSpecialRepo;
    public $recipeTypeRepo;

    //    private $container;
    //
    //    public function setContainer(ContainerInterface $container)
    //    {
    //
    //    }

    public function __construct(Finder $finder)
    {
        $this->monthRepo         = $finder->findMonth();
        $this->mesureRepo        = $finder->findMesureTypes();
        $this->productTypeRepo   = $finder->findProduct();
        $this->momentRepo        = $finder->findMoments();
        $this->recipeSpecialRepo = $finder->findRecipesSpecials();
        $this->recipeTypeRepo    = $finder->findRecipeTypes();
    }

    public function load(ObjectManager $manager)
    {
        //        $productTypes   = $this->productTypeRepo;
        //        $months         = $this->monthRepo;
        //        $mesureTypes    = $this->mesureRepo;
        //        $recipeTypes    = $this->recipeTypeRepo;
        //        $recipeSpecials = $this->recipeSpecialRepo;
        //        $moments        = $this->momentRepo;


        $users    = [];
        $products = [];
        $recipes  = [];
        $weeks    = [];

        $user = new User();
        $user->setUsername("admin")
            ->setPassword('admin')
            ->setCreatedAt(new \DateTime())
            ->setEmail("admin@admin.com")
            ->setRoles(['ROLE_ADMIN', 'ROLE_USER']);

        $manager->persist($user);

        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setUsername(sprintf("User%s", $i))
                ->setPassword(sprintf('user%s', $i))
                ->setCreatedAt(new \DateTime())
                ->setEmail(sprintf("user%s@user.com", $i))
                ->setRoles(['ROLE_USER']);

            $manager->persist($user);
            $users[] = $user;
        }

        foreach ($this->productTypeRepo as $productType) {
            for ($j = 0; $j < 10; $j++) {
                /** @var MesureType $mesureType * */
                $mesureType = $this->getRandomObject('mesure');

                /** @var Month $month */
                $month = $this->getRandomObject('month');

                $product = new Product();
                $product->setTitle(sprintf($productType->getName() . '%s', $j))
                    ->setDescription("Ceci est le {$productType->getName()} numéro $j")
                    ->setMesureType($mesureType)
                    ->addMonth($month)
                    ->setType($productType);

                $manager->persist($product);

                $products[] = $product;
            }
        }

        foreach ($this->recipeTypeRepo as $recipeType) {
            for ($k = 0; $k < 10; $k++) {
                $user = $users[array_rand($users)];

                $recipe = new Recipe();
                $recipe->setTitle(sprintf($recipeType->getName() . ' numéro %s', $k))
                    ->setDescription(sprintf('Ceci est un(e) ' . $recipeType->getName() . ' avec le numéro %s', $k))
                    ->setCreator($user)
                    ->addRecipeSpecial($this->getRandomObject('recipe_special'))
                    ->addRecipeType($this->getRandomObject('recipe_type'));

                $manager->persist($recipe);

                $recipes[] = $recipe;

                for ($l = 0; $l < mt_rand(1, 6); $l++) {
                    $recipeLine = new RecipeLine();
                    $product    = $products[array_rand($products)];
                    $recipeLine->setProduct($product)
                        ->setRecipe($recipe)
                        ->setQuantity(mt_rand(1, 10));

                    $manager->persist($recipeLine);
                }
            }
        }

        foreach ($users as $user) {
            $weekMenu  = new WeekMenu();
            $dateDebut = new \DateTime("2020-12-12");
            $dateFin   = new \DateTime("2020-12-19");
            $weekMenu->setStartAt($dateDebut)
                ->setEndAt($dateFin)
                ->setUser($user);

            $manager->persist($weekMenu);
            $weeks[] = $weekMenu;

            for ($m = 0; $m < 5; $m++) {
                $date = $dateDebut;
                if ($m != 0) {
                    $date = $dateDebut->modify("+ 1 Days");
                }

                $dayMenu = new DayMenu();
                $dayMenu->setWeekMenu($weekMenu)
                    ->setDate($date)
                    ->setMoment($this->getRandomObject('moment'))
                    ->addRecipe($recipes[mt_rand(0, count($recipes) - 1)]);

                $manager->persist($dayMenu);
            }
        }

        foreach ($recipes as $recipe) {
            for ($n = 0; $n < mt_rand(0, 20); $n++) {
                $favoriteRecipe = new FavoriteRecipe();
                $favoriteRecipe->setRecipe($recipe)
                    ->setUser($users[mt_rand(0, count($users) - 1)]);

                $manager->persist($favoriteRecipe);
            }
        }

        foreach ($weeks as $week) {
            $shoppingList = new ShoppingList();
            $shoppingList->setCreatedAt(new \DateTime())
                ->setWeekMenu($week);

            $manager->persist($shoppingList);

            $lineShopping = new LineShopping();
            $lineShopping->setShoppingList($shoppingList)
                ->setQuantity(mt_rand(1, 100))
                ->setProduct($products[mt_rand( 0, count($products) - 1)]);

            $manager->persist($lineShopping);
        }

        $manager->flush();
    }

    private function getRandomObject(string $repoName)
    {
        switch ($repoName) {
            case 'month':
                $month_id = array_rand($this->monthRepo);

                return $this->monthRepo[$month_id];
                break;
            case 'mesure':
                $mesureType_id = array_rand($this->mesureRepo);

                return $this->mesureRepo[$mesureType_id];
                break;
            case 'product_type':
                $productType_id = array_rand($this->productTypeRepo);

                return $this->productTypeRepo[$productType_id];
                break;
            case 'moment':
                $moment_id = array_rand($this->momentRepo);

                return $this->momentRepo[$moment_id];
                break;
            case 'recipe_special':
                $recipeSpecial_id = array_rand($this->recipeSpecialRepo);

                return $this->recipeSpecialRepo[$recipeSpecial_id];
                break;
            case 'recipe_type':
                $recipeType_id = array_rand($this->recipeTypeRepo);

                return $this->recipeTypeRepo[$recipeType_id];
                break;

            default:
                return null;
        }
    }
}