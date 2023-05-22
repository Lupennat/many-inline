<template>
    <LoadingView :loading="initialLoading" :data-relationship="viaRelationship">
        <Card>
            <LoadingView :loading="loading">
                <IndexErrorDialog
                    v-if="resourceResponseError != null"
                    :resource="resourceInformation"
                    @click="getResources"
                />

                <template v-else>
                    <IndexEmptyDialog
                        v-if="!resources.length"
                        :create-button-label="createButtonLabel"
                        :singular-name="singularName"
                        :resource-name="resourceName"
                        :via-resource="viaResource"
                        :via-resource-id="viaResourceId"
                        :via-relationship="viaRelationship"
                        :relationship-type="relationshipType"
                        :authorized-to-create="authorizedToCreate"
                        :authorized-to-relate="authorizedToRelate"
                    />

                    <ResourceTable
                        :authorized-to-relate="authorizedToRelate"
                        :resource-name="resourceName"
                        :resources="resources"
                        :singular-name="singularName"
                        :selected-resources="selectedResources"
                        :selected-resource-ids="selectedResourceIds"
                        :actions-are-available="allActions.length > 0"
                        :should-show-checkboxes="shouldShowCheckBoxes"
                        :via-resource="viaResource"
                        :via-resource-id="viaResourceId"
                        :via-relationship="viaRelationship"
                        :relationship-type="relationshipType"
                        :update-selection-status="updateSelectionStatus"
                        :sortable="sortable"
                        @order="orderByField"
                        @reset-order-by="resetOrderBy"
                        @delete="deleteResources"
                        @restore="restoreResources"
                        @actionExecuted="getResources"
                        ref="resourceTable"
                    />

                    <ResourcePagination
                        v-if="shouldShowPagination"
                        :pagination-component="paginationComponent"
                        :has-next-page="hasNextPage"
                        :has-previous-page="hasPreviousPage"
                        :load-more="loadMore"
                        :select-page="selectPage"
                        :total-pages="totalPages"
                        :current-page="currentPage"
                        :per-page="perPage"
                        :resource-count-label="resourceCountLabel"
                        :current-resource-count="currentResourceCount"
                        :all-matching-resource-count="allMatchingResourceCount"
                    />
                </template>
            </LoadingView>
        </Card>
    </LoadingView>
</template>
<script>
    import ResourceIndex from '@/views/Index.vue';

    export default {
        mixins: [ResourceIndex],
        name: 'ResourceIndexInline',
        computed: {
            /**
             * Build the resource request query string.
             */
            resourceRequestQueryString() {
                return {
                    search: this.currentSearch,
                    filters: this.encodedFilters,
                    orderBy: this.currentOrderBy,
                    orderByDirection: this.currentOrderByDirection,
                    perPage: this.currentPerPage,
                    trashed: this.currentTrashed,
                    page: this.currentPage,
                    viaIsInline: true,
                    viaResource: this.viaResource,
                    viaResourceId: this.viaResourceId,
                    viaRelationship: this.viaRelationship,
                    viaResourceRelationship: this.viaResourceRelationship,
                    relationshipType: this.relationshipType
                };
            }
        },
        methods: {
            /**
             * Get the lenses available for the current resource.
             */
            getLenses() {},

            /**
             * Get the actions available for the current resource.
             */
            getActions() {}
        }
    };
</script>
