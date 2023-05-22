<template>
    <PanelItem :index="index" :field="field">
        <template #value>
            <ResourceIndexInline
                :field="field"
                :resource-name="field.resourceName"
                :via-resource="resourceName"
                :via-resource-id="resourceId"
                :via-relationship="field.hasManyThroughRelationship"
                :relationship-type="'hasManyThrough'"
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
    import HasManyThroughField from '@/fields/Detail/HasManyThroughField.vue';

    export default {
        mixins: [HasManyThroughField],
        components: { ResourceIndexInline }
    };
</script>
