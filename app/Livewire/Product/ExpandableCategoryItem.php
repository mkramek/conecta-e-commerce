<?php

namespace App\Livewire\Product;

use App\Models\FirstLevelCategory;
use App\Models\SecondLevelCategory;
use App\Models\ThirdLevelCategory;
use Illuminate\View\View;
use Livewire\Component;

class ExpandableCategoryItem extends Component
{
    public $lang;

    public FirstLevelCategory|SecondLevelCategory|ThirdLevelCategory $category;

    /** @var "primary"|"secondary"|"tertiary" */
    public $level;

    public $expanded = false;

    public $availableSecondaryCategories = false;
    public $availableTertiaryCategories = false;

    public function mount(FirstLevelCategory|SecondLevelCategory|ThirdLevelCategory $category, $level = "primary"): void
    {
        $this->lang = app()->getLocale();
        $this->category = $category;
        $this->level = $level;

        $this->availableSecondaryCategories = $this->category->secondLevelCategories && $this->category->secondLevelCategories->isNotEmpty();
        $this->availableTertiaryCategories = $this->category->thirdLevelCategories && $this->category->thirdLevelCategories->isNotEmpty();
    }

    public function render(): View
    {
        return view('livewire.product.expandable-category-item');
    }

    public function getCategories(): array
    {
        $column_slug = "slug_{$this->lang}";
        if ($this->level === "primary") {
            return [
                'category_primary' => $this->category->$column_slug,
            ];
        }

        if ($this->level === "secondary") {
            return [
                'category_primary' => $this->category->firstLevelCategory->$column_slug,
                'category_secondary' => $this->category->$column_slug,
            ];
        }

        if ($this->level === "tertiary") {
            return [
                'category_primary' => $this->category->secondLevelCategory->firstLevelCategory->$column_slug,
                'category_secondary' => $this->category->secondLevelCategory->$column_slug,
                'category_tertiary' => $this->category->$column_slug
            ];
        }

        return [];
    }

    public function getCategoryName(): string
    {
        $column_name = "name_{$this->lang}";
        return $this->category->$column_name;
    }

    public function toggle(): void
    {
        $this->expanded = !$this->expanded;
    }
}
