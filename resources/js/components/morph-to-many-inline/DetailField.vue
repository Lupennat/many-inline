<template>
    <PanelItem :index="index" :field="field">
        <template #value>
            <ResourceIndexInline
                :field="field"
                :resource-name="field.resourceName"
                :via-resource="resourceName"
                :via-resource-id="resourceId"
                :via-relationship="field.morphToManyRelationship"
                :relationship-type="'morphToMany'"
                @actionExecuted="actionExecuted"
                :load-cards="false"
                :initialPerPage="field.perPage || 5"
                :should-override-meta="false"
            />
        </template>
    </PanelItem>
</template>

<script>
    import ResourceIndexInline from '../Index';
    import MorphToManyField from '@/fields/Detail/MorphToManyField.vue';

    export default {
        mixins: [MorphToManyField],
        components: { ResourceIndexInline }
    };
</script>
