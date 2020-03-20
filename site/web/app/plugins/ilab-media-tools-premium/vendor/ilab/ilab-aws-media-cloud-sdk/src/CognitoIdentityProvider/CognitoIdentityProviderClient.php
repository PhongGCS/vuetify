<?php
namespace ILABAmazon\CognitoIdentityProvider;

use ILABAmazon\AwsClient;

/**
 * This client is used to interact with the **Amazon Cognito Identity Provider** service.
 * 
 * @method \ILABAmazon\Result addCustomAttributes(array $args = [])
 * @method \GuzzleHttp\Promise\Promise addCustomAttributesAsync(array $args = [])
 * @method \ILABAmazon\Result adminAddUserToGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminAddUserToGroupAsync(array $args = [])
 * @method \ILABAmazon\Result adminConfirmSignUp(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminConfirmSignUpAsync(array $args = [])
 * @method \ILABAmazon\Result adminCreateUser(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminCreateUserAsync(array $args = [])
 * @method \ILABAmazon\Result adminDeleteUser(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminDeleteUserAsync(array $args = [])
 * @method \ILABAmazon\Result adminDeleteUserAttributes(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminDeleteUserAttributesAsync(array $args = [])
 * @method \ILABAmazon\Result adminDisableProviderForUser(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminDisableProviderForUserAsync(array $args = [])
 * @method \ILABAmazon\Result adminDisableUser(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminDisableUserAsync(array $args = [])
 * @method \ILABAmazon\Result adminEnableUser(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminEnableUserAsync(array $args = [])
 * @method \ILABAmazon\Result adminForgetDevice(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminForgetDeviceAsync(array $args = [])
 * @method \ILABAmazon\Result adminGetDevice(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminGetDeviceAsync(array $args = [])
 * @method \ILABAmazon\Result adminGetUser(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminGetUserAsync(array $args = [])
 * @method \ILABAmazon\Result adminInitiateAuth(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminInitiateAuthAsync(array $args = [])
 * @method \ILABAmazon\Result adminLinkProviderForUser(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminLinkProviderForUserAsync(array $args = [])
 * @method \ILABAmazon\Result adminListDevices(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminListDevicesAsync(array $args = [])
 * @method \ILABAmazon\Result adminListGroupsForUser(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminListGroupsForUserAsync(array $args = [])
 * @method \ILABAmazon\Result adminListUserAuthEvents(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminListUserAuthEventsAsync(array $args = [])
 * @method \ILABAmazon\Result adminRemoveUserFromGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminRemoveUserFromGroupAsync(array $args = [])
 * @method \ILABAmazon\Result adminResetUserPassword(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminResetUserPasswordAsync(array $args = [])
 * @method \ILABAmazon\Result adminRespondToAuthChallenge(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminRespondToAuthChallengeAsync(array $args = [])
 * @method \ILABAmazon\Result adminSetUserMFAPreference(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminSetUserMFAPreferenceAsync(array $args = [])
 * @method \ILABAmazon\Result adminSetUserPassword(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminSetUserPasswordAsync(array $args = [])
 * @method \ILABAmazon\Result adminSetUserSettings(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminSetUserSettingsAsync(array $args = [])
 * @method \ILABAmazon\Result adminUpdateAuthEventFeedback(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminUpdateAuthEventFeedbackAsync(array $args = [])
 * @method \ILABAmazon\Result adminUpdateDeviceStatus(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminUpdateDeviceStatusAsync(array $args = [])
 * @method \ILABAmazon\Result adminUpdateUserAttributes(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminUpdateUserAttributesAsync(array $args = [])
 * @method \ILABAmazon\Result adminUserGlobalSignOut(array $args = [])
 * @method \GuzzleHttp\Promise\Promise adminUserGlobalSignOutAsync(array $args = [])
 * @method \ILABAmazon\Result associateSoftwareToken(array $args = [])
 * @method \GuzzleHttp\Promise\Promise associateSoftwareTokenAsync(array $args = [])
 * @method \ILABAmazon\Result changePassword(array $args = [])
 * @method \GuzzleHttp\Promise\Promise changePasswordAsync(array $args = [])
 * @method \ILABAmazon\Result confirmDevice(array $args = [])
 * @method \GuzzleHttp\Promise\Promise confirmDeviceAsync(array $args = [])
 * @method \ILABAmazon\Result confirmForgotPassword(array $args = [])
 * @method \GuzzleHttp\Promise\Promise confirmForgotPasswordAsync(array $args = [])
 * @method \ILABAmazon\Result confirmSignUp(array $args = [])
 * @method \GuzzleHttp\Promise\Promise confirmSignUpAsync(array $args = [])
 * @method \ILABAmazon\Result createGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createGroupAsync(array $args = [])
 * @method \ILABAmazon\Result createIdentityProvider(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createIdentityProviderAsync(array $args = [])
 * @method \ILABAmazon\Result createResourceServer(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createResourceServerAsync(array $args = [])
 * @method \ILABAmazon\Result createUserImportJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createUserImportJobAsync(array $args = [])
 * @method \ILABAmazon\Result createUserPool(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createUserPoolAsync(array $args = [])
 * @method \ILABAmazon\Result createUserPoolClient(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createUserPoolClientAsync(array $args = [])
 * @method \ILABAmazon\Result createUserPoolDomain(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createUserPoolDomainAsync(array $args = [])
 * @method \ILABAmazon\Result deleteGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteGroupAsync(array $args = [])
 * @method \ILABAmazon\Result deleteIdentityProvider(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteIdentityProviderAsync(array $args = [])
 * @method \ILABAmazon\Result deleteResourceServer(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteResourceServerAsync(array $args = [])
 * @method \ILABAmazon\Result deleteUser(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteUserAsync(array $args = [])
 * @method \ILABAmazon\Result deleteUserAttributes(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteUserAttributesAsync(array $args = [])
 * @method \ILABAmazon\Result deleteUserPool(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteUserPoolAsync(array $args = [])
 * @method \ILABAmazon\Result deleteUserPoolClient(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteUserPoolClientAsync(array $args = [])
 * @method \ILABAmazon\Result deleteUserPoolDomain(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteUserPoolDomainAsync(array $args = [])
 * @method \ILABAmazon\Result describeIdentityProvider(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeIdentityProviderAsync(array $args = [])
 * @method \ILABAmazon\Result describeResourceServer(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeResourceServerAsync(array $args = [])
 * @method \ILABAmazon\Result describeRiskConfiguration(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeRiskConfigurationAsync(array $args = [])
 * @method \ILABAmazon\Result describeUserImportJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeUserImportJobAsync(array $args = [])
 * @method \ILABAmazon\Result describeUserPool(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeUserPoolAsync(array $args = [])
 * @method \ILABAmazon\Result describeUserPoolClient(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeUserPoolClientAsync(array $args = [])
 * @method \ILABAmazon\Result describeUserPoolDomain(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeUserPoolDomainAsync(array $args = [])
 * @method \ILABAmazon\Result forgetDevice(array $args = [])
 * @method \GuzzleHttp\Promise\Promise forgetDeviceAsync(array $args = [])
 * @method \ILABAmazon\Result forgotPassword(array $args = [])
 * @method \GuzzleHttp\Promise\Promise forgotPasswordAsync(array $args = [])
 * @method \ILABAmazon\Result getCSVHeader(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getCSVHeaderAsync(array $args = [])
 * @method \ILABAmazon\Result getDevice(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getDeviceAsync(array $args = [])
 * @method \ILABAmazon\Result getGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getGroupAsync(array $args = [])
 * @method \ILABAmazon\Result getIdentityProviderByIdentifier(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getIdentityProviderByIdentifierAsync(array $args = [])
 * @method \ILABAmazon\Result getSigningCertificate(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getSigningCertificateAsync(array $args = [])
 * @method \ILABAmazon\Result getUICustomization(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getUICustomizationAsync(array $args = [])
 * @method \ILABAmazon\Result getUser(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getUserAsync(array $args = [])
 * @method \ILABAmazon\Result getUserAttributeVerificationCode(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getUserAttributeVerificationCodeAsync(array $args = [])
 * @method \ILABAmazon\Result getUserPoolMfaConfig(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getUserPoolMfaConfigAsync(array $args = [])
 * @method \ILABAmazon\Result globalSignOut(array $args = [])
 * @method \GuzzleHttp\Promise\Promise globalSignOutAsync(array $args = [])
 * @method \ILABAmazon\Result initiateAuth(array $args = [])
 * @method \GuzzleHttp\Promise\Promise initiateAuthAsync(array $args = [])
 * @method \ILABAmazon\Result listDevices(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listDevicesAsync(array $args = [])
 * @method \ILABAmazon\Result listGroups(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listGroupsAsync(array $args = [])
 * @method \ILABAmazon\Result listIdentityProviders(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listIdentityProvidersAsync(array $args = [])
 * @method \ILABAmazon\Result listResourceServers(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listResourceServersAsync(array $args = [])
 * @method \ILABAmazon\Result listTagsForResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listTagsForResourceAsync(array $args = [])
 * @method \ILABAmazon\Result listUserImportJobs(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listUserImportJobsAsync(array $args = [])
 * @method \ILABAmazon\Result listUserPoolClients(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listUserPoolClientsAsync(array $args = [])
 * @method \ILABAmazon\Result listUserPools(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listUserPoolsAsync(array $args = [])
 * @method \ILABAmazon\Result listUsers(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listUsersAsync(array $args = [])
 * @method \ILABAmazon\Result listUsersInGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listUsersInGroupAsync(array $args = [])
 * @method \ILABAmazon\Result resendConfirmationCode(array $args = [])
 * @method \GuzzleHttp\Promise\Promise resendConfirmationCodeAsync(array $args = [])
 * @method \ILABAmazon\Result respondToAuthChallenge(array $args = [])
 * @method \GuzzleHttp\Promise\Promise respondToAuthChallengeAsync(array $args = [])
 * @method \ILABAmazon\Result setRiskConfiguration(array $args = [])
 * @method \GuzzleHttp\Promise\Promise setRiskConfigurationAsync(array $args = [])
 * @method \ILABAmazon\Result setUICustomization(array $args = [])
 * @method \GuzzleHttp\Promise\Promise setUICustomizationAsync(array $args = [])
 * @method \ILABAmazon\Result setUserMFAPreference(array $args = [])
 * @method \GuzzleHttp\Promise\Promise setUserMFAPreferenceAsync(array $args = [])
 * @method \ILABAmazon\Result setUserPoolMfaConfig(array $args = [])
 * @method \GuzzleHttp\Promise\Promise setUserPoolMfaConfigAsync(array $args = [])
 * @method \ILABAmazon\Result setUserSettings(array $args = [])
 * @method \GuzzleHttp\Promise\Promise setUserSettingsAsync(array $args = [])
 * @method \ILABAmazon\Result signUp(array $args = [])
 * @method \GuzzleHttp\Promise\Promise signUpAsync(array $args = [])
 * @method \ILABAmazon\Result startUserImportJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise startUserImportJobAsync(array $args = [])
 * @method \ILABAmazon\Result stopUserImportJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise stopUserImportJobAsync(array $args = [])
 * @method \ILABAmazon\Result tagResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise tagResourceAsync(array $args = [])
 * @method \ILABAmazon\Result untagResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise untagResourceAsync(array $args = [])
 * @method \ILABAmazon\Result updateAuthEventFeedback(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateAuthEventFeedbackAsync(array $args = [])
 * @method \ILABAmazon\Result updateDeviceStatus(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateDeviceStatusAsync(array $args = [])
 * @method \ILABAmazon\Result updateGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateGroupAsync(array $args = [])
 * @method \ILABAmazon\Result updateIdentityProvider(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateIdentityProviderAsync(array $args = [])
 * @method \ILABAmazon\Result updateResourceServer(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateResourceServerAsync(array $args = [])
 * @method \ILABAmazon\Result updateUserAttributes(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateUserAttributesAsync(array $args = [])
 * @method \ILABAmazon\Result updateUserPool(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateUserPoolAsync(array $args = [])
 * @method \ILABAmazon\Result updateUserPoolClient(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateUserPoolClientAsync(array $args = [])
 * @method \ILABAmazon\Result updateUserPoolDomain(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateUserPoolDomainAsync(array $args = [])
 * @method \ILABAmazon\Result verifySoftwareToken(array $args = [])
 * @method \GuzzleHttp\Promise\Promise verifySoftwareTokenAsync(array $args = [])
 * @method \ILABAmazon\Result verifyUserAttribute(array $args = [])
 * @method \GuzzleHttp\Promise\Promise verifyUserAttributeAsync(array $args = [])
 */
class CognitoIdentityProviderClient extends AwsClient {}
