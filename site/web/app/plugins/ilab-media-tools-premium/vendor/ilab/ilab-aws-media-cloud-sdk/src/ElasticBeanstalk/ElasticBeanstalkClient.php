<?php
namespace ILABAmazon\ElasticBeanstalk;

use ILABAmazon\AwsClient;

/**
 * This client is used to interact with the **AWS Elastic Beanstalk** service.
 *
 * @method \ILABAmazon\Result abortEnvironmentUpdate(array $args = [])
 * @method \GuzzleHttp\Promise\Promise abortEnvironmentUpdateAsync(array $args = [])
 * @method \ILABAmazon\Result applyEnvironmentManagedAction(array $args = [])
 * @method \GuzzleHttp\Promise\Promise applyEnvironmentManagedActionAsync(array $args = [])
 * @method \ILABAmazon\Result checkDNSAvailability(array $args = [])
 * @method \GuzzleHttp\Promise\Promise checkDNSAvailabilityAsync(array $args = [])
 * @method \ILABAmazon\Result composeEnvironments(array $args = [])
 * @method \GuzzleHttp\Promise\Promise composeEnvironmentsAsync(array $args = [])
 * @method \ILABAmazon\Result createApplication(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createApplicationAsync(array $args = [])
 * @method \ILABAmazon\Result createApplicationVersion(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createApplicationVersionAsync(array $args = [])
 * @method \ILABAmazon\Result createConfigurationTemplate(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createConfigurationTemplateAsync(array $args = [])
 * @method \ILABAmazon\Result createEnvironment(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createEnvironmentAsync(array $args = [])
 * @method \ILABAmazon\Result createPlatformVersion(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createPlatformVersionAsync(array $args = [])
 * @method \ILABAmazon\Result createStorageLocation(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createStorageLocationAsync(array $args = [])
 * @method \ILABAmazon\Result deleteApplication(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteApplicationAsync(array $args = [])
 * @method \ILABAmazon\Result deleteApplicationVersion(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteApplicationVersionAsync(array $args = [])
 * @method \ILABAmazon\Result deleteConfigurationTemplate(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteConfigurationTemplateAsync(array $args = [])
 * @method \ILABAmazon\Result deleteEnvironmentConfiguration(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteEnvironmentConfigurationAsync(array $args = [])
 * @method \ILABAmazon\Result deletePlatformVersion(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deletePlatformVersionAsync(array $args = [])
 * @method \ILABAmazon\Result describeAccountAttributes(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeAccountAttributesAsync(array $args = [])
 * @method \ILABAmazon\Result describeApplicationVersions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeApplicationVersionsAsync(array $args = [])
 * @method \ILABAmazon\Result describeApplications(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeApplicationsAsync(array $args = [])
 * @method \ILABAmazon\Result describeConfigurationOptions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeConfigurationOptionsAsync(array $args = [])
 * @method \ILABAmazon\Result describeConfigurationSettings(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeConfigurationSettingsAsync(array $args = [])
 * @method \ILABAmazon\Result describeEnvironmentHealth(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeEnvironmentHealthAsync(array $args = [])
 * @method \ILABAmazon\Result describeEnvironmentManagedActionHistory(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeEnvironmentManagedActionHistoryAsync(array $args = [])
 * @method \ILABAmazon\Result describeEnvironmentManagedActions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeEnvironmentManagedActionsAsync(array $args = [])
 * @method \ILABAmazon\Result describeEnvironmentResources(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeEnvironmentResourcesAsync(array $args = [])
 * @method \ILABAmazon\Result describeEnvironments(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeEnvironmentsAsync(array $args = [])
 * @method \ILABAmazon\Result describeEvents(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeEventsAsync(array $args = [])
 * @method \ILABAmazon\Result describeInstancesHealth(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeInstancesHealthAsync(array $args = [])
 * @method \ILABAmazon\Result describePlatformVersion(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describePlatformVersionAsync(array $args = [])
 * @method \ILABAmazon\Result listAvailableSolutionStacks(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listAvailableSolutionStacksAsync(array $args = [])
 * @method \ILABAmazon\Result listPlatformVersions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listPlatformVersionsAsync(array $args = [])
 * @method \ILABAmazon\Result listTagsForResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listTagsForResourceAsync(array $args = [])
 * @method \ILABAmazon\Result rebuildEnvironment(array $args = [])
 * @method \GuzzleHttp\Promise\Promise rebuildEnvironmentAsync(array $args = [])
 * @method \ILABAmazon\Result requestEnvironmentInfo(array $args = [])
 * @method \GuzzleHttp\Promise\Promise requestEnvironmentInfoAsync(array $args = [])
 * @method \ILABAmazon\Result restartAppServer(array $args = [])
 * @method \GuzzleHttp\Promise\Promise restartAppServerAsync(array $args = [])
 * @method \ILABAmazon\Result retrieveEnvironmentInfo(array $args = [])
 * @method \GuzzleHttp\Promise\Promise retrieveEnvironmentInfoAsync(array $args = [])
 * @method \ILABAmazon\Result swapEnvironmentCNAMEs(array $args = [])
 * @method \GuzzleHttp\Promise\Promise swapEnvironmentCNAMEsAsync(array $args = [])
 * @method \ILABAmazon\Result terminateEnvironment(array $args = [])
 * @method \GuzzleHttp\Promise\Promise terminateEnvironmentAsync(array $args = [])
 * @method \ILABAmazon\Result updateApplication(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateApplicationAsync(array $args = [])
 * @method \ILABAmazon\Result updateApplicationResourceLifecycle(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateApplicationResourceLifecycleAsync(array $args = [])
 * @method \ILABAmazon\Result updateApplicationVersion(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateApplicationVersionAsync(array $args = [])
 * @method \ILABAmazon\Result updateConfigurationTemplate(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateConfigurationTemplateAsync(array $args = [])
 * @method \ILABAmazon\Result updateEnvironment(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateEnvironmentAsync(array $args = [])
 * @method \ILABAmazon\Result updateTagsForResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateTagsForResourceAsync(array $args = [])
 * @method \ILABAmazon\Result validateConfigurationSettings(array $args = [])
 * @method \GuzzleHttp\Promise\Promise validateConfigurationSettingsAsync(array $args = [])
 */
class ElasticBeanstalkClient extends AwsClient {}
