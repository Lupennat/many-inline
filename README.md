1. [Requirements](#Requirements)
1. [Installation](#Installation)
1. [Usage](#Usage)

## Requirements

- `php: ^7.4 | ^8`
- `laravel/nova: ^4`

## Installation

You can install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require lupennat/many-inline
```

## Usage

ManyInline Packages automatically enable a new method `inline` for all Many Relationship Fields:

- HasMany
- BelongsToMany
- HasManyThrough
- MorphToMany

The table will be displayed as a Field of the resource, without any actions and without the toolbar.

```php

use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Resource
{

    public function fields(Request $request)
    {
        return [
            HasMany::make('User Post', 'posts', Post::class)->inline();
        ];
    }
}
```

You can manage Field visibility on related resource through the new methods `hideWhenInline` or `onlyOnInline`.\

> to manage field visibility you must include the `HasManyInline` trait on related resource.

```php

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Lupennat\ManyInline\HasManyInline;

class Posts extends Resource
{

    use HasManyInline;

    public function fields(Request $request)
    {
        return [
            ID::make(),
            BelongsTo::make(__('User'), 'user', User::class)->hideWhenInline(),
            Text::make(__('Extra Field'), 'extra')->onlyOnInline()
        ];
    }
}
```
