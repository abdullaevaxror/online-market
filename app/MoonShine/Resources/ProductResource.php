<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\ProductVolume;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Fields\Text;
use \Illuminate\Database\Eloquent\Relations;

/**
 * @extends ModelResource<Product>
 */
class ProductResource extends ModelResource
{
    protected string $model = Product::class;

    protected string $title = 'Products';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')->sortable(),
            Text::make('Description'),
            Text::make('Price')->sortable(),
            Text::make('Sale Price'),
            Text::make('Quantity'),
            BelongsTo::make(
                'Category',
                'category',
                fn($item)=>"$item->id. $item->name",
                CategoryResource::class)
                    ->afterFill(
                        fn($field) => $field->setColumn('category_id')
            ),
            BelongsTo::make(
                'Volume',
                'ProductVolume',
                fn($item)=>"$item->id. $item->name",
                ProductVolumeResource::class)
                ->afterFill(
                    fn($field) => $field->setColumn('volume_id')
                )
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Name'),
                Text::make('Description'),
                Text::make('Price'),
                Text::make('Sale Price'),
                Text::make('Quantity'),
                BelongsTo::make(
                    'Category',
                    'category',
                    fn($item)=>"$item->id. $item->name",
                    CategoryResource::class)
                    ->afterFill(
                        fn($field) => $field->setColumn('category_id')
                ),
                BelongsTo::make(
                    'Volume',
                    'ProductVolume',
                    fn($item)=>"$item->id. $item->name",
                        ProductVolumeResource::class)
                ->afterFill(
                    fn($field) => $field->setColumn('volume_id')
                )
            ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Name')->sortable(),
            Text::make('Description'),
            Text::make('Price')->sortable(),
            Text::make('Sale Price'),
            Text::make('Quantity'),
            BelongsTo::make(
                'Category',
                'category',
                fn($item)=>"$item->id. $item->name",
                CategoryResource::class)
                    ->afterFill(
                        fn($field) => $field->setColumn('category_id')
            ),
        ];
    }

    /**
     * @param Product $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
