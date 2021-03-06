<?php
namespace ILABAmazon\DatabaseMigrationService;

use ILABAmazon\AwsClient;

/**
 * This client is used to interact with the **AWS Database Migration Service** service.
 * @method \ILABAmazon\Result addTagsToResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise addTagsToResourceAsync(array $args = [])
 * @method \ILABAmazon\Result applyPendingMaintenanceAction(array $args = [])
 * @method \GuzzleHttp\Promise\Promise applyPendingMaintenanceActionAsync(array $args = [])
 * @method \ILABAmazon\Result createEndpoint(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createEndpointAsync(array $args = [])
 * @method \ILABAmazon\Result createEventSubscription(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createEventSubscriptionAsync(array $args = [])
 * @method \ILABAmazon\Result createReplicationInstance(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createReplicationInstanceAsync(array $args = [])
 * @method \ILABAmazon\Result createReplicationSubnetGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createReplicationSubnetGroupAsync(array $args = [])
 * @method \ILABAmazon\Result createReplicationTask(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createReplicationTaskAsync(array $args = [])
 * @method \ILABAmazon\Result deleteCertificate(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteCertificateAsync(array $args = [])
 * @method \ILABAmazon\Result deleteEndpoint(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteEndpointAsync(array $args = [])
 * @method \ILABAmazon\Result deleteEventSubscription(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteEventSubscriptionAsync(array $args = [])
 * @method \ILABAmazon\Result deleteReplicationInstance(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteReplicationInstanceAsync(array $args = [])
 * @method \ILABAmazon\Result deleteReplicationSubnetGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteReplicationSubnetGroupAsync(array $args = [])
 * @method \ILABAmazon\Result deleteReplicationTask(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteReplicationTaskAsync(array $args = [])
 * @method \ILABAmazon\Result describeAccountAttributes(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeAccountAttributesAsync(array $args = [])
 * @method \ILABAmazon\Result describeCertificates(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeCertificatesAsync(array $args = [])
 * @method \ILABAmazon\Result describeConnections(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeConnectionsAsync(array $args = [])
 * @method \ILABAmazon\Result describeEndpointTypes(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeEndpointTypesAsync(array $args = [])
 * @method \ILABAmazon\Result describeEndpoints(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeEndpointsAsync(array $args = [])
 * @method \ILABAmazon\Result describeEventCategories(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeEventCategoriesAsync(array $args = [])
 * @method \ILABAmazon\Result describeEventSubscriptions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeEventSubscriptionsAsync(array $args = [])
 * @method \ILABAmazon\Result describeEvents(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeEventsAsync(array $args = [])
 * @method \ILABAmazon\Result describeOrderableReplicationInstances(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeOrderableReplicationInstancesAsync(array $args = [])
 * @method \ILABAmazon\Result describePendingMaintenanceActions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describePendingMaintenanceActionsAsync(array $args = [])
 * @method \ILABAmazon\Result describeRefreshSchemasStatus(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeRefreshSchemasStatusAsync(array $args = [])
 * @method \ILABAmazon\Result describeReplicationInstanceTaskLogs(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeReplicationInstanceTaskLogsAsync(array $args = [])
 * @method \ILABAmazon\Result describeReplicationInstances(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeReplicationInstancesAsync(array $args = [])
 * @method \ILABAmazon\Result describeReplicationSubnetGroups(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeReplicationSubnetGroupsAsync(array $args = [])
 * @method \ILABAmazon\Result describeReplicationTaskAssessmentResults(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeReplicationTaskAssessmentResultsAsync(array $args = [])
 * @method \ILABAmazon\Result describeReplicationTasks(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeReplicationTasksAsync(array $args = [])
 * @method \ILABAmazon\Result describeSchemas(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeSchemasAsync(array $args = [])
 * @method \ILABAmazon\Result describeTableStatistics(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeTableStatisticsAsync(array $args = [])
 * @method \ILABAmazon\Result importCertificate(array $args = [])
 * @method \GuzzleHttp\Promise\Promise importCertificateAsync(array $args = [])
 * @method \ILABAmazon\Result listTagsForResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listTagsForResourceAsync(array $args = [])
 * @method \ILABAmazon\Result modifyEndpoint(array $args = [])
 * @method \GuzzleHttp\Promise\Promise modifyEndpointAsync(array $args = [])
 * @method \ILABAmazon\Result modifyEventSubscription(array $args = [])
 * @method \GuzzleHttp\Promise\Promise modifyEventSubscriptionAsync(array $args = [])
 * @method \ILABAmazon\Result modifyReplicationInstance(array $args = [])
 * @method \GuzzleHttp\Promise\Promise modifyReplicationInstanceAsync(array $args = [])
 * @method \ILABAmazon\Result modifyReplicationSubnetGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise modifyReplicationSubnetGroupAsync(array $args = [])
 * @method \ILABAmazon\Result modifyReplicationTask(array $args = [])
 * @method \GuzzleHttp\Promise\Promise modifyReplicationTaskAsync(array $args = [])
 * @method \ILABAmazon\Result rebootReplicationInstance(array $args = [])
 * @method \GuzzleHttp\Promise\Promise rebootReplicationInstanceAsync(array $args = [])
 * @method \ILABAmazon\Result refreshSchemas(array $args = [])
 * @method \GuzzleHttp\Promise\Promise refreshSchemasAsync(array $args = [])
 * @method \ILABAmazon\Result reloadTables(array $args = [])
 * @method \GuzzleHttp\Promise\Promise reloadTablesAsync(array $args = [])
 * @method \ILABAmazon\Result removeTagsFromResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise removeTagsFromResourceAsync(array $args = [])
 * @method \ILABAmazon\Result startReplicationTask(array $args = [])
 * @method \GuzzleHttp\Promise\Promise startReplicationTaskAsync(array $args = [])
 * @method \ILABAmazon\Result startReplicationTaskAssessment(array $args = [])
 * @method \GuzzleHttp\Promise\Promise startReplicationTaskAssessmentAsync(array $args = [])
 * @method \ILABAmazon\Result stopReplicationTask(array $args = [])
 * @method \GuzzleHttp\Promise\Promise stopReplicationTaskAsync(array $args = [])
 * @method \ILABAmazon\Result testConnection(array $args = [])
 * @method \GuzzleHttp\Promise\Promise testConnectionAsync(array $args = [])
 */
class DatabaseMigrationServiceClient extends AwsClient {}
