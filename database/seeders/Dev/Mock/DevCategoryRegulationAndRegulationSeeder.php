<?php

namespace Database\Seeders\Dev\Mock;


use App\Core\Traits\WithRegulationDownload;
use App\Models\RegulationCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DevCategoryRegulationAndRegulationSeeder extends Seeder
{
    use WithRegulationDownload;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $general = RegulationCategory::create([
            'name' => 'Ogólne'
        ]);

        $rodo = RegulationCategory::create([
            'name' => 'RODO'
        ]);

        $generalTitlePl = "Warunki korzystania ze sklepu";
        $generalTitleEn = "General rules for shop";
        $generalHtmlBodyPl = '<h1 style="text-align: center;">Warunki korzystania ze sklepu.</h1><ol><li style="text-align: left;">Punkt jeden</li><li style="text-align: left;">Punkt dwa</li><li style="text-align: left;">Punkt trzy</li></ol>';
        $generalHtmlBodyEn = '<h1 style="text-align: center;">General rules for shop.</h1><ol><li style="text-align: left;">One</li><li style="text-align: left;">Two</li><li style="text-align: left;">Three</li></ol>';

        $rodoTitlePl = "RODO - Informacje dla klientów";
        $rodoTitleEn = "RODO - Information for clients";
        $rodoHtmlBodyPl = '<h1 style="text-align: center;">RODO - Informacje dla klient&oacute;w</h1><ol><li style="text-align: left;">Punkt jeden</li><li style="text-align: left;">Punkt dwa</li><li style="text-align: left;">Punkt trzy</li></ol>';
        $rodoHtmlBodyEn = '<h1 style="text-align: center;">RODO - Information for clients&oacute;w</h1><ol><li style="text-align: left;">One</li><li style="text-align: left;">Two</li><li style="text-align: left;">Three</li></ol>';

        $general->regulations()->create([
            'name' => $generalTitlePl,
            'content' => $generalHtmlBodyPl,
            'slug' => Str::slug($generalTitlePl),
            'is_published' => true,
            'lang' => 'pl',
        ]);

        $general->regulations()->create([
            'name' => $generalTitleEn,
            'content' => $generalHtmlBodyEn,
            'slug' => Str::slug($generalTitleEn),
            'is_published' => true,
            'lang' => 'en',
        ]);

        $this->saveRegulationAsPDF(Str::slug($generalTitlePl), $generalHtmlBodyPl);
        $this->saveRegulationAsPDF(Str::slug($generalTitleEn), $generalHtmlBodyEn);

        $rodo->regulations()->create([
            'name' => $rodoTitlePl,
            'content' => $rodoHtmlBodyPl,
            'slug' => Str::slug($rodoTitlePl),
            'is_published' => true,
            'lang' => 'pl',
        ]);

        $rodo->regulations()->create([
            'name' => $rodoTitleEn,
            'content' => $rodoHtmlBodyEn,
            'slug' => Str::slug($rodoTitleEn),
            'is_published' => true,
            'lang' => 'en',
        ]);

        $this->saveRegulationAsPDF(Str::slug($rodoTitlePl), $rodoHtmlBodyPl);
        $this->saveRegulationAsPDF(Str::slug($rodoTitleEn), $rodoHtmlBodyEn);
    }
}
