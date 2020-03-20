<?php
namespace ILABAmazon\DocDB;

use ILABAmazon\AwsClient;

/**
 * This client is used to interact with the **Amazon DocumentDB with MongoDB compatibility** service.
 * @method \ILABAmazon\Result addTagsToResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise addTagsToResourceAsync(array $args = [])
 * @method \ILABAmazon\Result applyPendingMaintenanceAction(array $args = [])
 * @method \GuzzleHttp\Promise\Promise applyPendingMaintenanceActionAsync(array $args = [])
 * @method \ILABAmazon\Result copyDBClusterParameterGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise copyDBClusterParameterGroupAsync(array $args = [])
 * @method \ILABAmazon\Result copyDBClusterSnapshot(array $args = [])
 * @method \GuzzleHttp\Promise\Promise copyDBClusterSnapshotAsync(array $args = [])
 * @method \ILABAmazon\Result createDBCluster(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createDBClusterAsync(array $args = [])
 * @method \ILABAmazon\Result createDBClusterParameterGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createDBClusterParameterGroupAsync(array $args = [])
 * @method \ILABAmazon\Result createDBClusterSnapshot(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createDBClusterSnapshotAsync(array $args = [])
 * @method \ILABAmazon\Result createDBInstance(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createDBInstanceAsync(array $args = [])
 * @method \ILABAmazon\Result createDBSubnetGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createDBSubnetGroupAsync(array $args = [])
 * @method \ILABAmazon\Result deleteDBCluster(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteDBClusterAsync(array $args = [])
 * @method \ILABAmazon\Result deleteDBClusterParameterGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteDBClusterParameterGroupAsync(array $args = [])
 * @method \ILABAmazon\Result deleteDBClusterSnapshot(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteDBClusterSnapshotAsync(array $args = [])
 * @method \ILABAmazon\Result deleteDBInstance(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteDBInstanceAsync(array $args = [])
 * @method \ILABAmazon\Result deleteDBSubnetGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteDBSubnetGroupAsync(array $args = [])
 * @method \ILABAmazon\Result describeDBClusterParameterGroups(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeDBClusterParameterGroupsAsync(array $args = [])
 * @method \ILABAmazon\Result describeDBClusterParameters(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeDBClusterParametersAsync(array $args = [])
 * @method \ILABAmazon\Result describeDBClusterSnapshotAttributes(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeDBClusterSnapshotAttributesAsync(array $args = [])
 * @method \ILABAmazon\Result describeDBClusterSnapshots(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeDBClusterSnapshotsAsync(array $args = [])
 * @method \ILABAmazon\Result describeDBClusters(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeDBClustersAsync(array $args = [])
 * @method \ILABAmazon\Result describeDBEngineVersions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeDBEngineVersionsAsync(array $args = [])
 * @method \ILABAmazon\Result describeDBInstances(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeDBInstancesAsync(array $args = [])
 * @method \ILABAmazon\Result describeDBSubnetGroups(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeDBSubnetGroupsAsync(array $args = [])
 * @method \ILABAmazon\Result describeEngineDefaultClusterParameters(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeEngineDefaultClusterParametersAsync(array $args = [])
 * @method \ILABAmazon\Result describeEventCategories(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeEventCategoriesAsync(array $args = [])
 * @method \ILABAmazon\Result describeEvents(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeEventsAsync(array $args = [])
 * @method \ILABAmazon\Result describeOrderableDBInstanceOptions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeOrderableDBInstanceOptionsAsync(array $args = [])
 * @method \ILABAmazon\Result describePendingMaintenanceActions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describePendingMaintenanceActionsAsync(array $args = [])
 * @method \ILABAmazon\Result failoverDBCluster(array $args = [])
 * @method \GuzzleHttp\Promise\Promise failoverDBClusterAsync(array $args = [])
 * @method \ILABAmazon\Result listTagsForResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listTagsForResourceAsync(array $args = [])
 * @method \ILABAmazon\Result modifyDBCluster(array $args = [])
 * @method \GuzzleHttp\Promise\Promise modifyDBClusterAsync(array $args = [])
 * @method \ILABAmazon\Result modifyDBClusterParameterGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise modifyDBClusterParameterGroupAsync(array $args = [])
 * @method \ILABAmazon\Result modifyDBClusterSnapshotAttribute(array $args = [])
 * @method \GuzzleHttp\Promise\Promise modifyDBClusterSnapshotAttributeAsync(array $args = [])
 * @method \ILABAmazon\Result modifyDBInstance(array $args = [])
 * @method \GuzzleHttp\Promise\Promise modifyDBInstanceAsync(array $args = [])
 * @method \ILABAmazon\Result modifyDBSubnetGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise modifyDBSubnetGroupAsync(array $args = [])
 * @method \ILABAmazon\Result rebootDBInstance(array $args = [])
 * @method \GuzzleHttp\Promise\Promise rebootDBInstanceAsync(array $args = [])
 * @method \ILABAmazon\Result removeTagsFromResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise removeTagsFromResourceAsync(array $args = [])
 * @method \ILABAmazon\Result resetDBClusterParameterGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise resetDBClusterParameterGroupAsync(array $args = [])
 * @method \ILABAmazon\Result restoreDBClusterFromSnapshot(array $args = [])
 * @method \GuzzleHttp\Promise\Promise restoreDBClusterFromSnapshotAsync(array $args = [])
 * @method \ILABAmazon\Result restoreDBClusterToPointInTime(array $args = [])
 * @method \GuzzleHttp\Promise\Promise restoreDBClusterToPointInTimeAsync(array $args = [])
 */
class DocDBClient extends AwsClient {}
