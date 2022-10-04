<?php

namespace App\Fixtures\Providers;

class TagProvider
{
    public function randomTag(): string
    {
        $tagList = [
            'Film',
            'Serie',
            'Horreur',
            'slasher ',
            'Comedie',
            'Gore',
            'Survival',
            'Thriller',
            'Zombie',
            'Jump scare',
            'Found footage',
            'Fantastique ',
            'Épouvante',
            'Drame',
            'Comédie horrifique',
        ];

        return $tagList[array_rand($tagList)];
    }
}
