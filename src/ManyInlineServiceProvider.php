<?php

namespace Lupennat\ManyInline;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\FieldCollection;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasManyThrough;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;

class ManyInlineServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('many-inline', __DIR__ . '/../dist/js/many-inline.js');
        });

        Field::macro('hideWhenInline', function ($callback = true) {
            $this->showOnInline = is_callable($callback) ? function () use ($callback) {
                return !call_user_func_array($callback, func_get_args());
            }
            : !$callback;

            return $this;
        });

        FieldCollection::macro('filterForInline', function (NovaRequest $request, $resource) {
            return $this->filter(function ($field) use ($resource, $request) {
                return $field->isShownOnInline($request, $resource);
            })->values();
        });

        Field::macro('isShownOnInline', function (NovaRequest $request, $resource) {
            if (property_exists($this, 'showOnInline')) {
                if (is_callable($this->showOnInline)) {
                    $this->showOnInline = call_user_func($this->showOnInline, $request, $resource);
                }

                if ($request->viaIsInline) {
                    return (bool) $this->showOnInline;
                } else {
                    return $this->showOnInline === 'only' ? false : true;
                }
            }

            return true;
        });

        Field::macro('onlyOnInline', function () {
            $this->showOnIndex = true;
            $this->showOnDetail = false;
            $this->showOnCreation = false;
            $this->showOnUpdate = false;
            $this->showOnInline = 'only';

            return $this;
        });

        Field::macro('inline', function () {
            if ($this instanceof HasMany) {
                $this->component = 'has-many-inline-field';
            } elseif ($this instanceof BelongsToMany) {
                $this->component = 'belongs-to-many-inline-field';
            } elseif ($this instanceof HasManyThrough) {
                $this->component = 'has-many-through-inline-field';
            } elseif ($this instanceof MorphToMany) {
                $this->component = 'morph-to-many-inline-field';
            }

            return $this;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
