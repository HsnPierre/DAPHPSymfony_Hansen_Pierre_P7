<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use Faker;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        $brand = ['Apple', 'Apple', 'Apple', 'Apple', 'Samsung', 'Samsung', 'Samsung', 'Samsung', 'Xiaomi', 'Xiaomi', 'Xiaomi','Huawei','Huawei','Huawei', 'Sony', 'Sony', 'Sony', 'OnePlus', 'OnePlus', 'OnePlus'];
        $name = ['iPhone 12','iPhone 12 Pro', 'iPhone SE', 'iPhone 11', 'Galaxy S21 Ultra 5G', 'Galaxy Z Flip 5G', 'Galaxy Z Fold2 5G', 'Galaxy S20 FE', 'Mi 11i 5G', 'Mi 11 Ultra', 'Mi 10T Pro', 'Mate 40 pro', 'P40 pro', 'P40', 'Xperia 1 III', 'Xperia 5 III', 'Xperia 10 III', 'OP 9 Pro', 'OP 9', 'OP 8T'];
        $desc = [
            "La vitesse 5G. Une puce A14 Bionic, la plus rapide sur smartphone. Un écran OLED bord à bord. Le Ceramic Shield, qui multiplie par quatre la résistance aux chutes. Et le mode Nuit sur chaque appareil photo. L’iPhone 12 a tout, en deux tailles parfaites.",
            "Une 5G en mode Pro. Une puce A14 Bionic qui distance nettement toutes les autres puces de smart­phone. Un système photo pro qui révolutionne la prise de vues en conditions de faible éclairage – de façon plus spectaculaire encore sur l’iPhone 12 Pro Max. Et le Ceramic Shield, qui multiplie par quatre la résistance aux chutes. La première impression est excellente. Attendez de voir la suite.",
            "iPhone SE. Une puce extrêmement puissante. Notre format d’iPhone le plus populaire. À notre prix le plus abordable. Tout ce que vous attendiez, en somme. ",
            "Apple iPhone 11 : équipé d'une double capteur photo et d'un écran de 6,1 pouces. Un processeur A13 et une batterie qui dure une heure de plus que l'iPhone XR. Disponible en 64 Go, 128 Go et 256 Go. ",
            "Découvrez le Galaxy S21 Ultra 5G. Conçu avec un appareil photo parfaitement intégré pour révolutionner la photographie, il vous permet de réaliser des vidéos en 8K dignes d’un cinéma et de prendre des photos à couper le souffle, le tout en une seule prise. Avec le processeur le plus rapide et le verre le plus résistant sur un Galaxy, la 5G et une journée complète d’autonomie, Ultra est à la hauteur de son nom.",
            "Aussi élégant que compact, le Galaxy Z Flip ne ressemble à aucun autre smartphone. Dévoilez-le au monde et affirmez votre différence. Changez les contours du futur. ",
            "Découvrez le smartphone qui change l’avenir. Avec son écran pliable, il offre de toutes nouvelles possibilités, en plus de performances exceptionnelles. Un nouveau chapitre de la technologie mobile s’ouvre.",
            "Le Galaxy S20 FE est le dernier né de la famille S20. C’est en tenant compte de vos demandes et retours que nous avons créé cette édition qui reprend l'héritage des Galaxy S20 et vient compléter la famille. Que vous soyez un fan de photographie, de jeux, ou de réseaux sociaux, ce Galaxy S20 FE réunit tout ce dont vous avez besoin, dans 6 nouvelles couleurs inspirantes. ",
            "Léger et compact, pour une prise en main confortable.Un écran plat qui réduit les touchers accidentels.Cet écran est l'un des meilleurs de sa catégorie. Il a passé avec succès les tests rigoureux de DisplayMate, l'organisme de certification d'écran de référence dans le monde, et a obtenu la note maximale de A+.",
            "Le Mi 11 Ultra offre bien plus qu'une caméra révolutionnaire. C'est un modèle ultra haut de gamme, avec des performances, un écran, une autonomie de batterie et une qualité sonore exceptionnels.",
            "Triple caméra 108MP / 64MP avec IA.Écran ultra-fluide 144Hz AdaptativeSync avec TrueColor.Qualcomm® Snapdragon™ 865 avec 5G*.Batterie haute autonomie de 5000mAh (typ) avec charge rapide 33W",
            "Voyez au-delà des apparences.Explorez l'inconnu et laissez libre cours à votre imagination.Faites le plein de puissance et de vitesse pour un bond dans le futur.Prenez un temps d'avance sur la technologie avec le HUAWEI Mate 40 Pro.",
            "Le HUAWEI P40 Pro est un smartphone d'exception. Sa quadruple caméra conçue avec Leica et son capteur Ultra Vision de 50 MP révolutionnent la photographie sur smartphone, tandis que son capteur cinématographique de 40 MP en font un véritable studio portable. Jouissez d'une vitesse à couper le souffle grâce au processeur Kirin 990 5G embarqué et laissez-vous bercer par ses lignes douces et épurées.",
            "Le HUAWEI P40 est un smartphone d'exception. Son processeur Kirin 990 5G révolutionne votre expérience globale avec une vitesse inégalée sur un appareil HUAWEI. Son triple capteur Ultra Vision conçu avec Leica change quant à lui la donne du monde de la photographie sur smartphone. Pour des images et des vidéos qui parleront pour vous, en toutes circonstances.",
            "La vitesse est au cœur de l'expérience que le Xperia 1 III vous fait vivre. L'affichage est ultra fluide et magnifique avec son écran 4K HDR OLED et son taux de rafraichissement de 120 Hz . Son appareil photo triple objectif a une mise au point automatique ultra rapide même pour les photos prises avec le téléobjectif. ",
            "Compact, mais puissant, le Xperia 5 III un autofocus ultra rapide à de nouvelles optiques allant jusqu'à une focale de 105 mm. Pour les images ou pour le jeu, ce smartphone utilisable d'une seule main va encore plus loin que ce que vous pouviez imaginer.",
            "Rapidité de la 5G, performances incroyables, grande autonomie de batterie, design élégant tenant parfaitement dans la main : goûtez à la liberté absolue.",
            "Une exclusivité OnePlus co-développée avec Hasselblad, l’Appareil photo Hasselblad pour Smartphone propose des innovations de pointe en matière de photographie mobile. Conçu pour chaque situation, il vous permet de créer sans effort des scènes inoubliables avec le monde comme toile de fond. Avec le OnePlus 9 Pro, prenez désormais votre meilleure photo sans effort.",
            "Une exclusivité OnePlus co-développée avec Hasselblad, l’Appareil photo Hasselblad pour Smartphone propose des innovations de pointe en matière de photographie mobile. Conçu pour chaque situation, il vous permet de créer sans effort des scènes inoubliables avec le monde comme toile de fond. Avec le OnePlus 9, votre meilleure photo est réalisable.",
            "L'écran Fluid AMOLED de 6,55 pouces3 du OnePlus 8T assure l'excellence dans chaque image. Transformez votre expérience avec un l'écran Fluid Display 120 Hz pour un défilement sans latence. Et avec une latence de réponse super-faible, il faut faire glisser pour y croire.",
        ];
        $price = [809,1159,489,689,723,866,1466,342,699.90,1199.90,449.90,999.99,699.99,449.99,1050,1250,1450,919,719,499];
        
        for($i = 0; $i < 20; $i++){
            $product = new Product();

            $product->setBrand($brand[$i]);
            $product->setName($name[$i]);
            $product->setDescription($desc[$i]);
            $product->setPrice($price[$i]);
            $product->setCreatedAt($faker->dateTimeThisYear());

            $manager->persist($product);
        }

        $manager->flush();
    }
}
