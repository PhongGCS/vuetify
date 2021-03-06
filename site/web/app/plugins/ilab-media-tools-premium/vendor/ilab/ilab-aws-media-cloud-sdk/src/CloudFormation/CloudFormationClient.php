<?php
namespace ILABAmazon\CloudFormation;

use ILABAmazon\AwsClient;

/**
 * This client is used to interact with the **AWS CloudFormation** service.
 *
 * @method \ILABAmazon\Result cancelUpdateStack(array $args = [])
 * @method \GuzzleHttp\Promise\Promise cancelUpdateStackAsync(array $args = [])
 * @method \ILABAmazon\Result continueUpdateRollback(array $args = [])
 * @method \GuzzleHttp\Promise\Promise continueUpdateRollbackAsync(array $args = [])
 * @method \ILABAmazon\Result createChangeSet(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createChangeSetAsync(array $args = [])
 * @method \ILABAmazon\Result createStack(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createStackAsync(array $args = [])
 * @method \ILABAmazon\Result createStackInstances(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createStackInstancesAsync(array $args = [])
 * @method \ILABAmazon\Result createStackSet(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createStackSetAsync(array $args = [])
 * @method \ILABAmazon\Result deleteChangeSet(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteChangeSetAsync(array $args = [])
 * @method \ILABAmazon\Result deleteStack(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteStackAsync(array $args = [])
 * @method \ILABAmazon\Result deleteStackInstances(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteStackInstancesAsync(array $args = [])
 * @method \ILABAmazon\Result deleteStackSet(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteStackSetAsync(array $args = [])
 * @method \ILABAmazon\Result describeAccountLimits(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeAccountLimitsAsync(array $args = [])
 * @method \ILABAmazon\Result describeChangeSet(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeChangeSetAsync(array $args = [])
 * @method \ILABAmazon\Result describeStackDriftDetectionStatus(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeStackDriftDetectionStatusAsync(array $args = [])
 * @method \ILABAmazon\Result describeStackEvents(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeStackEventsAsync(array $args = [])
 * @method \ILABAmazon\Result describeStackInstance(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeStackInstanceAsync(array $args = [])
 * @method \ILABAmazon\Result describeStackResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeStackResourceAsync(array $args = [])
 * @method \ILABAmazon\Result describeStackResourceDrifts(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeStackResourceDriftsAsync(array $args = [])
 * @method \ILABAmazon\Result describeStackResources(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeStackResourcesAsync(array $args = [])
 * @method \ILABAmazon\Result describeStackSet(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeStackSetAsync(array $args = [])
 * @method \ILABAmazon\Result describeStackSetOperation(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeStackSetOperationAsync(array $args = [])
 * @method \ILABAmazon\Result describeStacks(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeStacksAsync(array $args = [])
 * @method \ILABAmazon\Result detectStackDrift(array $args = [])
 * @method \GuzzleHttp\Promise\Promise detectStackDriftAsync(array $args = [])
 * @method \ILABAmazon\Result detectStackResourceDrift(array $args = [])
 * @method \GuzzleHttp\Promise\Promise detectStackResourceDriftAsync(array $args = [])
 * @method \ILABAmazon\Result estimateTemplateCost(array $args = [])
 * @method \GuzzleHttp\Promise\Promise estimateTemplateCostAsync(array $args = [])
 * @method \ILABAmazon\Result executeChangeSet(array $args = [])
 * @method \GuzzleHttp\Promise\Promise executeChangeSetAsync(array $args = [])
 * @method \ILABAmazon\Result getStackPolicy(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getStackPolicyAsync(array $args = [])
 * @method \ILABAmazon\Result getTemplate(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getTemplateAsync(array $args = [])
 * @method \ILABAmazon\Result getTemplateSummary(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getTemplateSummaryAsync(array $args = [])
 * @method \ILABAmazon\Result listChangeSets(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listChangeSetsAsync(array $args = [])
 * @method \ILABAmazon\Result listExports(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listExportsAsync(array $args = [])
 * @method \ILABAmazon\Result listImports(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listImportsAsync(array $args = [])
 * @method \ILABAmazon\Result listStackInstances(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listStackInstancesAsync(array $args = [])
 * @method \ILABAmazon\Result listStackResources(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listStackResourcesAsync(array $args = [])
 * @method \ILABAmazon\Result listStackSetOperationResults(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listStackSetOperationResultsAsync(array $args = [])
 * @method \ILABAmazon\Result listStackSetOperations(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listStackSetOperationsAsync(array $args = [])
 * @method \ILABAmazon\Result listStackSets(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listStackSetsAsync(array $args = [])
 * @method \ILABAmazon\Result listStacks(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listStacksAsync(array $args = [])
 * @method \ILABAmazon\Result setStackPolicy(array $args = [])
 * @method \GuzzleHttp\Promise\Promise setStackPolicyAsync(array $args = [])
 * @method \ILABAmazon\Result signalResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise signalResourceAsync(array $args = [])
 * @method \ILABAmazon\Result stopStackSetOperation(array $args = [])
 * @method \GuzzleHttp\Promise\Promise stopStackSetOperationAsync(array $args = [])
 * @method \ILABAmazon\Result updateStack(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateStackAsync(array $args = [])
 * @method \ILABAmazon\Result updateStackInstances(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateStackInstancesAsync(array $args = [])
 * @method \ILABAmazon\Result updateStackSet(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateStackSetAsync(array $args = [])
 * @method \ILABAmazon\Result updateTerminationProtection(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateTerminationProtectionAsync(array $args = [])
 * @method \ILABAmazon\Result validateTemplate(array $args = [])
 * @method \GuzzleHttp\Promise\Promise validateTemplateAsync(array $args = [])
 */
class CloudFormationClient extends AwsClient {}
