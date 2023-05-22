<template>
    <PanelItem :index="index" :field="field">
        <template #value>
            <ResourceIndexInline
                :field="field"
                :resource-name="field.resourceName"
                :via-resource="resourceName"
                :via-resource-id="resourceId"
                :via-relationship="field.hasManyRelationship"
                :relationship-type="'hasMany'"
                :load-cards="false"
                :initialPerPage="field.perPage || 5"
                :should-override-meta="false"
            />
        </template>
    </PanelItem>
</template>

<script>
    import ResourceIndexInline from '../Index';
    import HasManyField from '@/fields/Detail/HasManyField.vue';

    export default {
        mixins: [HasManyField],
        components: { ResourceIndexInline }
    };
</script>
