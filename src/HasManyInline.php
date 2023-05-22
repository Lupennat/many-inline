<?php

namespace Lupennat\ManyInline;

use Laravel\Nova\Http\Requests\NovaRequest;

trait HasManyInline
{
    /**
     * Resolve the index fields.
     *
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    public function indexFields(NovaRequest $request)
    {
        return parent::indexFields($request)
            ->filterForInline($request, $this->resource);
    }
}
