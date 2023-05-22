import HasManyInlineField from './components/has-many-inline/DetailField';
import BelongsToManyInlineField from './components/belongs-to-many-inline/DetailField';
import HasManyThroughInlineField from './components/has-many-through-inline/DetailField';
import MorphToManyInlineField from './components/morph-to-many-inline/DetailField';

Nova.booting((app, store) => {
    app.component('detail-belongs-to-many-inline-field', BelongsToManyInlineField);
    app.component('detail-has-many-inline-field', HasManyInlineField);
    app.component('detail-has-many-through-inline-field', HasManyThroughInlineField);
    app.component('detail-morph-to-many-inline-field', MorphToManyInlineField);
});
