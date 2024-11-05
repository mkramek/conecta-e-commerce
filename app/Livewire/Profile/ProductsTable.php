<?php

namespace App\Livewire\Profile;

use App\Models\ProductVariant;
use Illuminate\Support\Collection;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class ProductsTable extends PowerGridComponent
{
    use WithExport;

    public function datasource(): ?Collection
    {
        return ProductVariant::all();
    }

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            // Exportable::make('export')
            //     ->striped()
            //     ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('categories', function ($entry) {
                $first = $entry->product->firstLevelCategories;
                $second = $entry->product->secondLevelCategories;
                $third = $entry->product->thirdLevelCategories;
                $categories = [...$first, ...$second, ...$third];

                return implode('\n', array_map(fn($cat) => $cat->name_pl, $categories));
            })
            ->add('name_pl', function ($entry) {
                $route = route('product.pl', [
                    'id' => $entry->product->id,
                    'slug' => $entry->product->slug_pl,
                    'variant' => $entry->id,
                ]);
                return "<a href='$route'>{$entry->product->name_pl}</a>";
            })
            ->add('color', function ($entry) {
                return $entry->color === 'BRAK' ? '-' : $entry->color;
            })
            ->add('size', function ($entry) {
                return $entry->size === '0' ? '-' : $entry->size;
            })
            ->add(
                'netto_price',
                function ($entry) {
                    return number_format($entry->netto_price, 2) . " PLN";
                }
                /**, function ($entry) {
                $promo = $entry->individualPromotions()->where('customer_id', auth()->id())->first();
                $actual_price = $promo ? $promo->price_net : $entry->netto_price;
                $old_price = $promo ? $entry->netto_price : '';

                $actual_price_currency = number_format($actual_price, 2) . ' PLN';
                $old_price_currency = $old_price ? number_format($old_price, 2) . ' PLN' : '';

                $class = $promo ? 'text-red-500 font-bold' : '';
                $actual_price_str = "<span class='$class'>$actual_price_currency</span>";
                $old_price_str = $old_price_currency ? "<span class='line-through mr-1'>$old_price_currency</span>" : '';

                return $old_price_str . $actual_price_str;
            } */
            )
            ->add(
                'brutto_price',
                function ($entry) {
                    return number_format($entry->brutto_price, 2) . " PLN";
                }
                /**, function ($entry) {
                $promo = $entry->individualPromotions()->where('customer_id', auth()->id())->first();
                $actual_price = $promo ? $promo->price_gross : $entry->brutto_price;
                $old_price = $promo ? $entry->brutto_price : '';

                $actual_price_currency = number_format($actual_price, 2) . ' PLN';
                $old_price_currency = $old_price ? number_format($old_price, 2) . ' PLN' : '';

                $class = $promo ? 'text-red-500 font-bold' : '';
                $actual_price_str = "<span class='$class'>$actual_price_currency</span>";
                $old_price_str = $old_price_currency ? "<span class='line-through mr-1'>$old_price_currency</span>" : '';

                return $old_price_str . $actual_price_str;
            }*/
            );
    }

    public function columns(): array
    {
        return [
            Column::make('Kategorie', 'categories')
                ->searchable(),

            Column::make('Nazwa', 'name_pl')
                ->searchable()
                ->sortable(),

            Column::make('Kolor', 'color')
                ->searchable(),

            Column::make('Rozmiar', 'size')
                ->searchable(),

            Column::make('Cena netto', 'netto_price')
                ->sortable(),

            Column::make('Cena brutto', 'brutto_price')
                ->sortable(),

            Column::action('Akcje'),
        ];
    }

    public function actions($row): array
    {
        return [
            Button::add('add-to-cart')
                ->slot('Dodaj do koszyka')
                ->class('bg-primary-500 text-white px-2 py-1 rounded-full')
                ->openModal('modals.add-to-cart-modal', ['variant' => $row]),
        ];
    }
}
