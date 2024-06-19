<?php

namespace Database\Seeders\Dev\Mock;

use App\Models\FirstLevelCategory;
use App\Models\SecondLevelCategory;
use App\Models\ThirdLevelCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DevCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kategoria ogólna
        $bezKategorii = FirstLevelCategory::create([
            'name_pl' => 'Bez kategorii',
            'name_en' => 'Uncategorized',
            'slug_pl' => Str::slug('Bez kategorii'),
            'slug_en' => Str::slug('Uncategorized'),
            'description_pl' => 'Kategoria ogólna działająca jedynie wewnątrz aplikacji BO.',
            'keywords_pl' => 'kategoria, ogolna',
            'has_second_level_categories' => false,
            'position' => 0
        ]);

        // Kategorie poziomu pierwszego
        $obuwieOchronneIRobocze = FirstLevelCategory::create([
            'name_pl' => 'OBUWIE OCHRONNE I ROBOCZE',
            'name_en' => 'SAFETY AND WORK FOOTWEAR',
            'slug_pl' => Str::slug('OBUWIE OCHRONNE I ROBOCZE'),
            'slug_en' => Str::slug('SAFETY AND WORK FOOTWEAR'),
            'description_pl' => 'Opis kategorii zostanie wprowadzony przez pracowników firmy Conecta.',
            'keywords_pl' => 'slowa, kluczowe, dla, podanej, kategorii',
            'has_second_level_categories' => true,
            'position' => $this->getFirstLevelMenuPosition()
        ]);

        $ochronaDrogOddechowych = FirstLevelCategory::create([
            'name_pl' => 'OCHRONA DRÓG ODDECHOWYCH',
            'name_en' => 'BREATHING PROTECTION',
            'slug_pl' => Str::slug('OCHRONA DRÓG ODDECHOWYCH'),
            'slug_en' => Str::slug('BREATHING PROTECTION'),
            'description_pl' => 'Opis kategorii zostanie wprowadzony przez pracowników firmy Conecta.',
            'keywords_pl' => 'slowa, kluczowe, dla, podanej, kategorii',
            'has_second_level_categories' => true,
            'position' => $this->getFirstLevelMenuPosition()
        ]);

        $ochronaGlowy = FirstLevelCategory::create([
            'name_pl' => 'OCHRONA GŁOWY',
            'name_en' => 'HEAD PROTECTION',
            'slug_pl' => Str::slug('OCHRONA GŁOWY'),
            'slug_en' => Str::slug('HEAD PROTECTION'),
            'description_pl' => 'Opis kategorii zostanie wprowadzony przez pracowników firmy Conecta.',
            'keywords_pl' => 'slowa, kluczowe, dla, podanej, kategorii',
            'has_second_level_categories' => true,
            'position' => $this->getFirstLevelMenuPosition()
        ]);

        $ochronaSluchu = FirstLevelCategory::create([
            'name_pl' => 'OCHRONA SŁUCHU',
            'name_en' => 'HEARING PROTECTION',
            'slug_pl' => Str::slug('OCHRONA SŁUCHU'),
            'slug_en' => Str::slug('HEARING PROTECTION'),
            'description_pl' => 'Opis kategorii zostanie wprowadzony przez pracowników firmy Conecta.',
            'keywords_pl' => 'slowa, kluczowe, dla, podanej, kategorii',
            'has_second_level_categories' => true,
            'position' => $this->getFirstLevelMenuPosition()
        ]);

        $ochronaWzroku = FirstLevelCategory::create([
            'name_pl' => 'OCHRONA WZROKU',
            'name_en' => 'SIGHT PROTECTION',
            'slug_pl' => Str::slug('OCHRONA WZROKU'),
            'slug_en' => Str::slug('SIGHT PROTECTION'),
            'description_pl' => 'Opis kategorii zostanie wprowadzony przez pracowników firmy Conecta.',
            'keywords_pl' => 'slowa, kluczowe, dla, podanej, kategorii',
            'has_second_level_categories' => true,
            'position' => $this->getFirstLevelMenuPosition()
        ]);

        $odziezRoboczaIOstrzegawcza = FirstLevelCategory::create([
            'name_pl' => 'ODZIEŻ ROBOCZA I OSTRZEGAWCZA',
            'name_en' => 'WORKWEAR AND WARNING CLOTHING',
            'slug_pl' => Str::slug('ODZIEŻ ROBOCZA I OSTRZEGAWCZA'),
            'slug_en' => Str::slug('WORKWEAR AND WARNING CLOTHING'),
            'description_pl' => 'Opis kategorii zostanie wprowadzony przez pracowników firmy Conecta.',
            'keywords_pl' => 'slowa, kluczowe, dla, podanej, kategorii',
            'has_second_level_categories' => true,
            'position' => $this->getFirstLevelMenuPosition()
        ]);

        $rekawiceRoboczeIOchronne = FirstLevelCategory::create([
            'name_pl' => 'RĘKAWICE ROBOCZE I  OCHRONNE',
            'name_en' => 'WORK AND PROTECTIVE GLOVES',
            'slug_pl' => Str::slug('RĘKAWICE ROBOCZE I  OCHRONNE'),
            'slug_en' => Str::slug('WORK AND PROTECTIVE GLOVES'),
            'description_pl' => 'Opis kategorii zostanie wprowadzony przez pracowników firmy Conecta.',
            'keywords_pl' => 'slowa, kluczowe, dla, podanej, kategorii',
            'has_second_level_categories' => true,
            'position' => $this->getFirstLevelMenuPosition()
        ]);

        $pracaNaWysokosci = FirstLevelCategory::create([
            'name_pl' => 'PRACA NA WYSOKOŚCI',
            'name_en' => 'WORK AT HEIGHT',
            'slug_pl' => Str::slug('PRACA NA WYSOKOŚCI'),
            'slug_en' => Str::slug('WORK AT HEIGHT'),
            'description_pl' => 'Opis kategorii zostanie wprowadzony przez pracowników firmy Conecta.',
            'keywords_pl' => 'slowa, kluczowe, dla, podanej, kategorii',
            'has_second_level_categories' => true,
            'position' => $this->getFirstLevelMenuPosition()
        ]);

        $artykulyBHP = FirstLevelCategory::create([
            'name_pl' => 'ARTYKUŁY BHP',
            'name_en' => 'BHP ARTICLES',
            'slug_pl' => Str::slug('ARTYKUŁY BHP'),
            'slug_en' => Str::slug('BHP ARTICLES'),
            'description_pl' => 'Opis kategorii zostanie wprowadzony przez pracowników firmy Conecta.',
            'keywords_pl' => 'slowa, kluczowe, dla, podanej, kategorii',
            'has_second_level_categories' => true,
            'position' => $this->getFirstLevelMenuPosition()
        ]);

        $wyprzedaz = FirstLevelCategory::create([
            'name_pl' => 'WYPRZEDAŻ',
            'name_en' => 'SALE',
            'slug_pl' => Str::slug('WYPRZEDAŻ'),
            'slug_en' => Str::slug('SALE'),
            'description_pl' => 'Opis kategorii zostanie wprowadzony przez pracowników firmy Conecta.',
            'keywords_pl' => 'slowa, kluczowe, dla, podanej, kategorii',
            'has_second_level_categories' => false,
            'display_in_menu' => false,
            'position' => $this->getFirstLevelMenuPosition()
        ]);

        // Kategorie poziomu drugiego
        $this->seedSecondLevelCategory($obuwieOchronneIRobocze, "KLAPKI/CHODAKI/SABOTY", false);
        $this->seedSecondLevelCategory($obuwieOchronneIRobocze, "KALOSZE/GUMOFILCE", false);
        $this->seedSecondLevelCategory($obuwieOchronneIRobocze, "PÓŁBUTY", false);
        $this->seedSecondLevelCategory($obuwieOchronneIRobocze, "SANDAŁY", false);
        $this->seedSecondLevelCategory($obuwieOchronneIRobocze, "TRZEWIKI", false);
        $this->seedSecondLevelCategory($obuwieOchronneIRobocze, "AKCESORIA", false);

        $this->seedSecondLevelCategory($ochronaDrogOddechowych, "FILTRY I POCHŁANIACZE", false);
        $this->seedSecondLevelCategory($ochronaDrogOddechowych, "MASKI PEŁNOTWARZOWE", false);
        $this->seedSecondLevelCategory($ochronaDrogOddechowych, "PÓŁMASKI JEDNORAZOWE", false);
        $this->seedSecondLevelCategory($ochronaDrogOddechowych, "PÓŁMASKI WIELORAZOWE", false);
        $this->seedSecondLevelCategory($ochronaDrogOddechowych, "PRZYŁBICE SPAWALNICZE", false);
        $this->seedSecondLevelCategory($ochronaDrogOddechowych, "SPRZĘT Z WYMUSZONYM PRZEPŁYWEM POWIETRZA", false);
        $this->seedSecondLevelCategory($ochronaDrogOddechowych, "AKCESORIA", false);

        $this->seedSecondLevelCategory($ochronaGlowy, "HEŁMY OCHRONNE", false);
        $this->seedSecondLevelCategory($ochronaGlowy, "LEKKIE HEŁMY OCHRONNE", false);
        $this->seedSecondLevelCategory($ochronaGlowy, "AKCESORIA", false);

        $this->seedSecondLevelCategory($ochronaSluchu, "NAUSZNIKI PRZECIWHAŁASOWE", false);
        $this->seedSecondLevelCategory($ochronaSluchu, "AKTYWNA OCHRONA SŁUCHU/SYSTEMY KOMUNIKACYJNE", false);
        $this->seedSecondLevelCategory($ochronaSluchu, "WKŁADKI PRZECIWHAŁASOWE", false);
        $this->seedSecondLevelCategory($ochronaSluchu, "AKCESORIA", false);

        $this->seedSecondLevelCategory($ochronaWzroku, "GOGLE OCHRONNE", false);
        $this->seedSecondLevelCategory($ochronaWzroku, "OKULARY OCHRONNE", false);
        $this->seedSecondLevelCategory($ochronaWzroku, "OSŁONY TWARZY/PRZYŁBICE", false);
        $this->seedSecondLevelCategory($ochronaWzroku, "AKCESORIA", false);

        $jednorazowa = $this->seedSecondLevelCategory($odziezRoboczaIOstrzegawcza, "JEDNORAZOWA", true);
        $ochronna = $this->seedSecondLevelCategory($odziezRoboczaIOstrzegawcza, "OCHRONNA", true);
        $ostrzegawcza = $this->seedSecondLevelCategory($odziezRoboczaIOstrzegawcza, "OSTRZEGAWCZA", true);
        $robocza = $this->seedSecondLevelCategory($odziezRoboczaIOstrzegawcza, "ROBOCZA", true);
        $this->seedSecondLevelCategory($odziezRoboczaIOstrzegawcza, "SPECJALNE", false);

        $dziane = $this->seedSecondLevelCategory($rekawiceRoboczeIOchronne, "DZIANE", true);
        $chemoodporne = $this->seedSecondLevelCategory($rekawiceRoboczeIOchronne, "CHEMOODPORNE", true);
        $jednorazoweRekawice = $this->seedSecondLevelCategory($rekawiceRoboczeIOchronne, "JEDNORAZOWE", true);
        $this->seedSecondLevelCategory($rekawiceRoboczeIOchronne, "OCIEPLANE", false);
        $this->seedSecondLevelCategory($rekawiceRoboczeIOchronne, "POWLEKANE", false);
        $this->seedSecondLevelCategory($rekawiceRoboczeIOchronne, "PRECIWPRZECIĘCIOWE", false);
        $this->seedSecondLevelCategory($rekawiceRoboczeIOchronne, "SKÓRZANE", false);
        $this->seedSecondLevelCategory($rekawiceRoboczeIOchronne, "SPAWALNICZE", false);
        $this->seedSecondLevelCategory($rekawiceRoboczeIOchronne, "TERMOOCHRONNE", false);
        $this->seedSecondLevelCategory($rekawiceRoboczeIOchronne, "ZARĘKAWKI", false);
        $this->seedSecondLevelCategory($rekawiceRoboczeIOchronne, "POZOSTAŁE", false);

        $this->seedSecondLevelCategory($pracaNaWysokosci, "AMORTYZATORY", false);
        $this->seedSecondLevelCategory($pracaNaWysokosci, "LINY", false);
        $this->seedSecondLevelCategory($pracaNaWysokosci, "SZELKI", false);
        $this->seedSecondLevelCategory($pracaNaWysokosci, "ZESTAWY", false);
        $this->seedSecondLevelCategory($pracaNaWysokosci, "POZOSTAŁE", false);

        $this->seedSecondLevelCategory($artykulyBHP, "APTECZKI", false);
        $this->seedSecondLevelCategory($artykulyBHP, "ZNAKI/TABLICE", false);
        $this->seedSecondLevelCategory($artykulyBHP, "MATY/TAŚMY", false);
        $this->seedSecondLevelCategory($artykulyBHP, "NARZĘDZIA", false);
        $this->seedSecondLevelCategory($artykulyBHP, "CZYŚCIWA", false);

        // kategorie poziomu trzeciego
        $this->seedThirdLevelCategory($jednorazowa, "CZEPKI");
        $this->seedThirdLevelCategory($jednorazowa, "FARTUCHY");
        $this->seedThirdLevelCategory($jednorazowa, "KOMBINEZONY");
        $this->seedThirdLevelCategory($jednorazowa, "ZARĘKAWKI");
        $this->seedThirdLevelCategory($jednorazowa, "POZOSTAŁE");

        $this->seedThirdLevelCategory($ochronna, "FARTUCHY");
        $this->seedThirdLevelCategory($ochronna, "KOMBINEZONY");

        $this->seedThirdLevelCategory($ostrzegawcza, "BLUZY");
        $this->seedThirdLevelCategory($ostrzegawcza, "KAMIZELKI");
        $this->seedThirdLevelCategory($ostrzegawcza, "KOSZULKI POLO/T-SHIRT");
        $this->seedThirdLevelCategory($ostrzegawcza, "SPODNIE");
        $this->seedThirdLevelCategory($ostrzegawcza, "KURTKI/BEZRĘKAWNIKI");
        $this->seedThirdLevelCategory($ostrzegawcza, "CZAPKI");

        $this->seedThirdLevelCategory($robocza, "BLUZY");
        $this->seedThirdLevelCategory($robocza, "CZAPKI");
        $this->seedThirdLevelCategory($robocza, "FARTUCHY");
        $this->seedThirdLevelCategory($robocza, "KAMIZELKI");
        $this->seedThirdLevelCategory($robocza, "KOMBINEZONY");
        $this->seedThirdLevelCategory($robocza, "KOSZULE");
        $this->seedThirdLevelCategory($robocza, "KOSZULKI");
        $this->seedThirdLevelCategory($robocza, "KURTKI/BEZRĘKAWNIKI");
        $this->seedThirdLevelCategory($robocza, "SPODNIE");
        $this->seedThirdLevelCategory($robocza, "POZOSTAŁE");

        $this->seedThirdLevelCategory($dziane, "BAWEŁNIANE");
        $this->seedThirdLevelCategory($dziane, "POILIAMID/NYLON");
        $this->seedThirdLevelCategory($dziane, "POLIESTER");

        $this->seedThirdLevelCategory($chemoodporne, "NEOPRENOWE");
        $this->seedThirdLevelCategory($chemoodporne, "BUTYLOWE");
        $this->seedThirdLevelCategory($chemoodporne, "NITRYLOWE");
        $this->seedThirdLevelCategory($chemoodporne, "PVC/WINYLOWE");

        $this->seedThirdLevelCategory($jednorazoweRekawice, "LATEKSOWE");
        $this->seedThirdLevelCategory($jednorazoweRekawice, "NITRYLOWE");
        $this->seedThirdLevelCategory($jednorazoweRekawice, "WINYLOWE");
    }

    private function seedSecondLevelCategory(FirstLevelCategory $firstLevelCategory,
                                             string $secondLevelCategoryNamePL,
                                             bool $hasThirdLevelCategories = false): \Illuminate\Database\Eloquent\Model
    {
        return $firstLevelCategory->secondLevelCategories()->create([
            'name_pl' => $secondLevelCategoryNamePL,
            'slug_pl' => Str::slug($secondLevelCategoryNamePL),
            'description_pl' => 'Opis kategorii zostanie wprowadzony przez pracowników firmy Conecta.',
            'keywords_pl' => 'slowa, kluczowe, dla, podanej, kategorii',
            'has_third_level_categories' => $hasThirdLevelCategories,
            'position' => $this->getSecondLevelMenuPosition()
        ]);
    }

    private function seedThirdLevelCategory(SecondLevelCategory $secondLevelCategory, string $thirdLevelCategoryNamePL): void
    {
        $secondLevelCategory->thirdLevelCategories()->create([
            'name_pl' => $thirdLevelCategoryNamePL,
            'slug_pl' => Str::slug($thirdLevelCategoryNamePL),
            'description_pl' => 'Opis kategorii zostanie wprowadzony przez pracowników firmy Conecta.',
            'keywords_pl' => 'slowa, kluczowe, dla, podanej, kategorii',
            'position' => $this->getThirdLevelMenuPosition()
        ]);
    }

    /**
     * Nadaj pozycję w menu pierwszego stopnia.
     *
     * @return int
     */
    private function getFirstLevelMenuPosition(): int
    {
        return FirstLevelCategory::max('position') + 1;
    }

    /**
     * Nadaj pozycję w menu drugiego stopnia.
     *
     * @return int
     */
    private function getSecondLevelMenuPosition(): int
    {
        return SecondLevelCategory::max('position') + 1;
    }

    /**
     * Nadaj pozycję w menu trzeciego stopnia.
     *
     * @return int
     */
    private function getThirdLevelMenuPosition(): int
    {
        return ThirdLevelCategory::max('position') + 1;
    }
}
