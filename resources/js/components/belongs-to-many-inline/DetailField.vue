<template>
    <PanelItem :index="index" :field="field">
        <template #value>
            <ResourceIndexInline
                :field="field"
                :resource-name="field.resourceName"
                :via-resource="resourceName"
                :via-resource-id="resourceId"
                :via-relationship="field.belongsToManyRelationship"
                :relationship-type="'belongsToMany'"
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
    import BelongsToManyField from '@/fields/Detail/BelongsToManyField.vue';

    export default {
        mixins: [BelongsToManyField],
        components: { ResourceIndexInline }
    };
</script>
