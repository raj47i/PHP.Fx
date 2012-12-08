<?php

if (!class_exists("IsAlive")) {
/**
 * IsAlive
 */
class IsAlive {
}}

if (!class_exists("IsAliveResponse")) {
/**
 * IsAliveResponse
 */
class IsAliveResponse {
	/**
	 * @access public
	 * @var ANetApiResponseType
	 */
	public $IsAliveResult;
}}

if (!class_exists("ANetApiResponseType")) {
/**
 * ANetApiResponseType
 */
class ANetApiResponseType {
	/**
	 * @access public
	 * @var tnsMessageTypeEnum
	 */
	public $resultCode;
	/**
	 * @access public
	 * @var ArrayOfMessagesTypeMessage
	 */
	public $messages;
}}

if (!class_exists("MessageTypeEnum")) {
/**
 * MessageTypeEnum
 */
class MessageTypeEnum {
}}

if (!class_exists("MessagesTypeMessage")) {
/**
 * MessagesTypeMessage
 */
class MessagesTypeMessage {
	/**
	 * @access public
	 * @var sstring
	 */
	public $code;
	/**
	 * @access public
	 * @var sstring
	 */
	public $text;
}}

if (!class_exists("AuthenticateTest")) {
/**
 * AuthenticateTest
 */
class AuthenticateTest {
	/**
	 * @access public
	 * @var MerchantAuthenticationType
	 */
	public $merchantAuthentication;
}}

if (!class_exists("MerchantAuthenticationType")) {
/**
 * MerchantAuthenticationType
 */
class MerchantAuthenticationType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $name;
	/**
	 * @access public
	 * @var sstring
	 */
	public $transactionKey;
}}

if (!class_exists("AuthenticateTestResponse")) {
/**
 * AuthenticateTestResponse
 */
class AuthenticateTestResponse {
	/**
	 * @access public
	 * @var ANetApiResponseType
	 */
	public $AuthenticateTestResult;
}}

if (!class_exists("ARBCreateSubscription")) {
/**
 * ARBCreateSubscription
 */
class ARBCreateSubscription {
	/**
	 * @access public
	 * @var MerchantAuthenticationType
	 */
	public $merchantAuthentication;
	/**
	 * @access public
	 * @var ARBSubscriptionType
	 */
	public $subscription;
}}

if (!class_exists("ARBSubscriptionType")) {
/**
 * ARBSubscriptionType
 */
class ARBSubscriptionType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $name;
	/**
	 * @access public
	 * @var PaymentScheduleType
	 */
	public $paymentSchedule;
	/**
	 * @access public
	 * @var sdecimal
	 */
	public $amount;
	/**
	 * @access public
	 * @var sdecimal
	 */
	public $trialAmount;
	/**
	 * @access public
	 * @var PaymentType
	 */
	public $payment;
	/**
	 * @access public
	 * @var OrderType
	 */
	public $order;
	/**
	 * @access public
	 * @var CustomerType
	 */
	public $customer;
	/**
	 * @access public
	 * @var NameAndAddressType
	 */
	public $billTo;
	/**
	 * @access public
	 * @var NameAndAddressType
	 */
	public $shipTo;
}}

if (!class_exists("PaymentScheduleType")) {
/**
 * PaymentScheduleType
 */
class PaymentScheduleType {
	/**
	 * @access public
	 * @var PaymentScheduleTypeInterval
	 */
	public $interval;
	/**
	 * @access public
	 * @var sdate
	 */
	public $startDate;
	/**
	 * @access public
	 * @var sshort
	 */
	public $totalOccurrences;
	/**
	 * @access public
	 * @var sshort
	 */
	public $trialOccurrences;
}}

if (!class_exists("PaymentScheduleTypeInterval")) {
/**
 * PaymentScheduleTypeInterval
 */
class PaymentScheduleTypeInterval {
	/**
	 * @access public
	 * @var sshort
	 */
	public $length;
	/**
	 * @access public
	 * @var tnsARBSubscriptionUnitEnum
	 */
	public $unit;
}}

if (!class_exists("ARBSubscriptionUnitEnum")) {
/**
 * ARBSubscriptionUnitEnum
 */
class ARBSubscriptionUnitEnum {
}}

if (!class_exists("PaymentType")) {
/**
 * PaymentType
 */
class PaymentType {
	/**
	 * @access public
	 * @var CreditCardType
	 */
	public $creditCard;
	/**
	 * @access public
	 * @var BankAccountType
	 */
	public $bankAccount;
}}

if (!class_exists("CreditCardType")) {
/**
 * CreditCardType
 */
class CreditCardType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $cardNumber;
	/**
	 * @access public
	 * @var sgYearMonth
	 */
	public $expirationDate;
}}

if (!class_exists("CreditCardSimpleType")) {
/**
 * CreditCardSimpleType
 */
class CreditCardSimpleType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $cardNumber;
	/**
	 * @access public
	 * @var sgYearMonth
	 */
	public $expirationDate;
}}

if (!class_exists("BankAccountBaseType")) {
/**
 * BankAccountBaseType
 */
class BankAccountBaseType {
	/**
	 * @access public
	 * @var tnsBankAccountTypeEnum
	 */
	public $accountType;
	/**
	 * @access public
	 * @var sstring
	 */
	public $nameOnAccount;
	/**
	 * @access public
	 * @var tnsEcheckTypeEnum
	 */
	public $echeckType;
	/**
	 * @access public
	 * @var sstring
	 */
	public $bankName;
}}

if (!class_exists("BankAccountTypeEnum")) {
/**
 * BankAccountTypeEnum
 */
class BankAccountTypeEnum {
}}

if (!class_exists("EcheckTypeEnum")) {
/**
 * EcheckTypeEnum
 */
class EcheckTypeEnum {
}}

if (!class_exists("OrderType")) {
/**
 * OrderType
 */
class OrderType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $invoiceNumber;
	/**
	 * @access public
	 * @var sstring
	 */
	public $description;
}}

if (!class_exists("CustomerType")) {
/**
 * CustomerType
 */
class CustomerType {
	/**
	 * @access public
	 * @var tnsCustomerTypeEnum
	 */
	public $type;
	/**
	 * @access public
	 * @var sstring
	 */
	public $id;
	/**
	 * @access public
	 * @var sstring
	 */
	public $email;
	/**
	 * @access public
	 * @var sstring
	 */
	public $phoneNumber;
	/**
	 * @access public
	 * @var sstring
	 */
	public $faxNumber;
	/**
	 * @access public
	 * @var DriversLicenseType
	 */
	public $driversLicense;
	/**
	 * @access public
	 * @var sstring
	 */
	public $taxId;
}}

if (!class_exists("CustomerTypeEnum")) {
/**
 * CustomerTypeEnum
 */
class CustomerTypeEnum {
}}

if (!class_exists("DriversLicenseBaseType")) {
/**
 * DriversLicenseBaseType
 */
class DriversLicenseBaseType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $state;
}}

if (!class_exists("NameAndAddressType")) {
/**
 * NameAndAddressType
 */
class NameAndAddressType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $firstName;
	/**
	 * @access public
	 * @var sstring
	 */
	public $lastName;
	/**
	 * @access public
	 * @var sstring
	 */
	public $company;
	/**
	 * @access public
	 * @var sstring
	 */
	public $address;
	/**
	 * @access public
	 * @var sstring
	 */
	public $city;
	/**
	 * @access public
	 * @var sstring
	 */
	public $state;
	/**
	 * @access public
	 * @var sstring
	 */
	public $zip;
	/**
	 * @access public
	 * @var sstring
	 */
	public $country;
}}

if (!class_exists("ARBCreateSubscriptionResponse")) {
/**
 * ARBCreateSubscriptionResponse
 */
class ARBCreateSubscriptionResponse {
	/**
	 * @access public
	 * @var ARBCreateSubscriptionResponseType
	 */
	public $ARBCreateSubscriptionResult;
}}

if (!class_exists("ARBCreateSubscriptionResponseType")) {
/**
 * ARBCreateSubscriptionResponseType
 */
class ARBCreateSubscriptionResponseType extends ANetApiResponseType {
	/**
	 * @access public
	 * @var slong
	 */
	public $subscriptionId;
}}

if (!class_exists("ARBUpdateSubscription")) {
/**
 * ARBUpdateSubscription
 */
class ARBUpdateSubscription {
	/**
	 * @access public
	 * @var MerchantAuthenticationType
	 */
	public $merchantAuthentication;
	/**
	 * @access public
	 * @var slong
	 */
	public $subscriptionId;
	/**
	 * @access public
	 * @var ARBSubscriptionType
	 */
	public $subscription;
}}

if (!class_exists("ARBUpdateSubscriptionResponse")) {
/**
 * ARBUpdateSubscriptionResponse
 */
class ARBUpdateSubscriptionResponse {
	/**
	 * @access public
	 * @var ARBUpdateSubscriptionResponseType
	 */
	public $ARBUpdateSubscriptionResult;
}}

if (!class_exists("ARBUpdateSubscriptionResponseType")) {
/**
 * ARBUpdateSubscriptionResponseType
 */
class ARBUpdateSubscriptionResponseType extends ANetApiResponseType {
}}

if (!class_exists("ARBCancelSubscription")) {
/**
 * ARBCancelSubscription
 */
class ARBCancelSubscription {
	/**
	 * @access public
	 * @var MerchantAuthenticationType
	 */
	public $merchantAuthentication;
	/**
	 * @access public
	 * @var slong
	 */
	public $subscriptionId;
}}

if (!class_exists("ARBCancelSubscriptionResponse")) {
/**
 * ARBCancelSubscriptionResponse
 */
class ARBCancelSubscriptionResponse {
	/**
	 * @access public
	 * @var ARBCancelSubscriptionResponseType
	 */
	public $ARBCancelSubscriptionResult;
}}

if (!class_exists("ARBCancelSubscriptionResponseType")) {
/**
 * ARBCancelSubscriptionResponseType
 */
class ARBCancelSubscriptionResponseType extends ANetApiResponseType {
}}

if (!class_exists("CreateCustomerProfile")) {
/**
 * CreateCustomerProfile
 */
class CreateCustomerProfile {
	/**
	 * @access public
	 * @var MerchantAuthenticationType
	 */
	public $merchantAuthentication;
	/**
	 * @access public
	 * @var CustomerProfileType
	 */
	public $profile;
}}

if (!class_exists("CustomerProfileBaseType")) {
/**
 * CustomerProfileBaseType
 */
class CustomerProfileBaseType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $merchantCustomerId;
	/**
	 * @access public
	 * @var sstring
	 */
	public $description;
	/**
	 * @access public
	 * @var sstring
	 */
	public $email;
}}

if (!class_exists("CustomerPaymentProfileBaseType")) {
/**
 * CustomerPaymentProfileBaseType
 */
class CustomerPaymentProfileBaseType {
	/**
	 * @access public
	 * @var tnsCustomerTypeEnum
	 */
	public $customerType;
	/**
	 * @access public
	 * @var CustomerAddressType
	 */
	public $billTo;
}}

if (!class_exists("CustomerAddressType")) {
/**
 * CustomerAddressType
 */
class CustomerAddressType extends NameAndAddressType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $phoneNumber;
	/**
	 * @access public
	 * @var sstring
	 */
	public $faxNumber;
}}

if (!class_exists("PaymentSimpleType")) {
/**
 * PaymentSimpleType
 */
class PaymentSimpleType {
	/**
	 * @access public
	 * @var CreditCardSimpleType
	 */
	public $creditCard;
	/**
	 * @access public
	 * @var BankAccountType
	 */
	public $bankAccount;
}}

if (!class_exists("CreateCustomerProfileResponse")) {
/**
 * CreateCustomerProfileResponse
 */
class CreateCustomerProfileResponse {
	/**
	 * @access public
	 * @var CreateCustomerProfileResponseType
	 */
	public $CreateCustomerProfileResult;
}}

if (!class_exists("CreateCustomerProfileResponseType")) {
/**
 * CreateCustomerProfileResponseType
 */
class CreateCustomerProfileResponseType extends ANetApiResponseType {
	/**
	 * @access public
	 * @var slong
	 */
	public $customerProfileId;
}}

if (!class_exists("CreateCustomerPaymentProfile")) {
/**
 * CreateCustomerPaymentProfile
 */
class CreateCustomerPaymentProfile {
	/**
	 * @access public
	 * @var MerchantAuthenticationType
	 */
	public $merchantAuthentication;
	/**
	 * @access public
	 * @var slong
	 */
	public $customerProfileId;
	/**
	 * @access public
	 * @var CustomerPaymentProfileType
	 */
	public $paymentProfile;
	/**
	 * @access public
	 * @var tnsValidationModeEnum
	 */
	public $validationMode;
}}

if (!class_exists("ValidationModeEnum")) {
/**
 * ValidationModeEnum
 */
class ValidationModeEnum {
}}

if (!class_exists("CreateCustomerPaymentProfileResponse")) {
/**
 * CreateCustomerPaymentProfileResponse
 */
class CreateCustomerPaymentProfileResponse {
	/**
	 * @access public
	 * @var CreateCustomerPaymentProfileResponseType
	 */
	public $CreateCustomerPaymentProfileResult;
}}

if (!class_exists("CreateCustomerPaymentProfileResponseType")) {
/**
 * CreateCustomerPaymentProfileResponseType
 */
class CreateCustomerPaymentProfileResponseType extends ANetApiResponseType {
	/**
	 * @access public
	 * @var slong
	 */
	public $customerPaymentProfileId;
	/**
	 * @access public
	 * @var sstring
	 */
	public $validationDirectResponse;
}}

if (!class_exists("CreateCustomerShippingAddress")) {
/**
 * CreateCustomerShippingAddress
 */
class CreateCustomerShippingAddress {
	/**
	 * @access public
	 * @var MerchantAuthenticationType
	 */
	public $merchantAuthentication;
	/**
	 * @access public
	 * @var slong
	 */
	public $customerProfileId;
	/**
	 * @access public
	 * @var CustomerAddressType
	 */
	public $address;
}}

if (!class_exists("CreateCustomerShippingAddressResponse")) {
/**
 * CreateCustomerShippingAddressResponse
 */
class CreateCustomerShippingAddressResponse {
	/**
	 * @access public
	 * @var CreateCustomerShippingAddressResponseType
	 */
	public $CreateCustomerShippingAddressResult;
}}

if (!class_exists("CreateCustomerShippingAddressResponseType")) {
/**
 * CreateCustomerShippingAddressResponseType
 */
class CreateCustomerShippingAddressResponseType extends ANetApiResponseType {
	/**
	 * @access public
	 * @var slong
	 */
	public $customerAddressId;
}}

if (!class_exists("GetCustomerProfile")) {
/**
 * GetCustomerProfile
 */
class GetCustomerProfile {
	/**
	 * @access public
	 * @var MerchantAuthenticationType
	 */
	public $merchantAuthentication;
	/**
	 * @access public
	 * @var slong
	 */
	public $customerProfileId;
}}

if (!class_exists("GetCustomerProfileResponse")) {
/**
 * GetCustomerProfileResponse
 */
class GetCustomerProfileResponse {
	/**
	 * @access public
	 * @var GetCustomerProfileResponseType
	 */
	public $GetCustomerProfileResult;
}}

if (!class_exists("GetCustomerProfileResponseType")) {
/**
 * GetCustomerProfileResponseType
 */
class GetCustomerProfileResponseType extends ANetApiResponseType {
	/**
	 * @access public
	 * @var CustomerProfileMaskedType
	 */
	public $profile;
}}

if (!class_exists("CustomerProfileExType")) {
/**
 * CustomerProfileExType
 */
class CustomerProfileExType extends CustomerProfileBaseType {
	/**
	 * @access public
	 * @var slong
	 */
	public $customerProfileId;
}}

if (!class_exists("CustomerPaymentProfileMaskedType")) {
/**
 * CustomerPaymentProfileMaskedType
 */
class CustomerPaymentProfileMaskedType extends CustomerPaymentProfileBaseType {
	/**
	 * @access public
	 * @var slong
	 */
	public $customerPaymentProfileId;
	/**
	 * @access public
	 * @var PaymentMaskedType
	 */
	public $payment;
	/**
	 * @access public
	 * @var DriversLicenseMaskedType
	 */
	public $driversLicense;
	/**
	 * @access public
	 * @var sstring
	 */
	public $taxId;
}}

if (!class_exists("PaymentMaskedType")) {
/**
 * PaymentMaskedType
 */
class PaymentMaskedType {
	/**
	 * @access public
	 * @var BankAccountMaskedType
	 */
	public $bankAccount;
	/**
	 * @access public
	 * @var CreditCardMaskedType
	 */
	public $creditCard;
}}

if (!class_exists("BankAccountMaskedType")) {
/**
 * BankAccountMaskedType
 */
class BankAccountMaskedType extends BankAccountBaseType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $routingNumber;
	/**
	 * @access public
	 * @var sstring
	 */
	public $accountNumber;
}}

if (!class_exists("CreditCardMaskedType")) {
/**
 * CreditCardMaskedType
 */
class CreditCardMaskedType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $cardNumber;
	/**
	 * @access public
	 * @var sstring
	 */
	public $expirationDate;
}}

if (!class_exists("DriversLicenseMaskedType")) {
/**
 * DriversLicenseMaskedType
 */
class DriversLicenseMaskedType extends DriversLicenseBaseType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $number;
	/**
	 * @access public
	 * @var sstring
	 */
	public $dateOfBirth;
}}

if (!class_exists("CustomerAddressExType")) {
/**
 * CustomerAddressExType
 */
class CustomerAddressExType extends CustomerAddressType {
	/**
	 * @access public
	 * @var slong
	 */
	public $customerAddressId;
}}

if (!class_exists("GetCustomerPaymentProfile")) {
/**
 * GetCustomerPaymentProfile
 */
class GetCustomerPaymentProfile {
	/**
	 * @access public
	 * @var MerchantAuthenticationType
	 */
	public $merchantAuthentication;
	/**
	 * @access public
	 * @var slong
	 */
	public $customerProfileId;
	/**
	 * @access public
	 * @var slong
	 */
	public $customerPaymentProfileId;
}}

if (!class_exists("GetCustomerPaymentProfileResponse")) {
/**
 * GetCustomerPaymentProfileResponse
 */
class GetCustomerPaymentProfileResponse {
	/**
	 * @access public
	 * @var GetCustomerPaymentProfileResponseType
	 */
	public $GetCustomerPaymentProfileResult;
}}

if (!class_exists("GetCustomerPaymentProfileResponseType")) {
/**
 * GetCustomerPaymentProfileResponseType
 */
class GetCustomerPaymentProfileResponseType extends ANetApiResponseType {
	/**
	 * @access public
	 * @var CustomerPaymentProfileMaskedType
	 */
	public $paymentProfile;
}}

if (!class_exists("GetCustomerShippingAddress")) {
/**
 * GetCustomerShippingAddress
 */
class GetCustomerShippingAddress {
	/**
	 * @access public
	 * @var MerchantAuthenticationType
	 */
	public $merchantAuthentication;
	/**
	 * @access public
	 * @var slong
	 */
	public $customerProfileId;
	/**
	 * @access public
	 * @var slong
	 */
	public $customerAddressId;
}}

if (!class_exists("GetCustomerShippingAddressResponse")) {
/**
 * GetCustomerShippingAddressResponse
 */
class GetCustomerShippingAddressResponse {
	/**
	 * @access public
	 * @var GetCustomerShippingAddressResponseType
	 */
	public $GetCustomerShippingAddressResult;
}}

if (!class_exists("GetCustomerShippingAddressResponseType")) {
/**
 * GetCustomerShippingAddressResponseType
 */
class GetCustomerShippingAddressResponseType extends ANetApiResponseType {
	/**
	 * @access public
	 * @var CustomerAddressExType
	 */
	public $address;
}}

if (!class_exists("UpdateCustomerProfile")) {
/**
 * UpdateCustomerProfile
 */
class UpdateCustomerProfile {
	/**
	 * @access public
	 * @var MerchantAuthenticationType
	 */
	public $merchantAuthentication;
	/**
	 * @access public
	 * @var CustomerProfileExType
	 */
	public $profile;
}}

if (!class_exists("UpdateCustomerProfileResponse")) {
/**
 * UpdateCustomerProfileResponse
 */
class UpdateCustomerProfileResponse {
	/**
	 * @access public
	 * @var UpdateCustomerProfileResponseType
	 */
	public $UpdateCustomerProfileResult;
}}

if (!class_exists("UpdateCustomerProfileResponseType")) {
/**
 * UpdateCustomerProfileResponseType
 */
class UpdateCustomerProfileResponseType extends ANetApiResponseType {
}}

if (!class_exists("UpdateCustomerPaymentProfile")) {
/**
 * UpdateCustomerPaymentProfile
 */
class UpdateCustomerPaymentProfile {
	/**
	 * @access public
	 * @var MerchantAuthenticationType
	 */
	public $merchantAuthentication;
	/**
	 * @access public
	 * @var slong
	 */
	public $customerProfileId;
	/**
	 * @access public
	 * @var CustomerPaymentProfileExType
	 */
	public $paymentProfile;
}}

if (!class_exists("UpdateCustomerPaymentProfileResponse")) {
/**
 * UpdateCustomerPaymentProfileResponse
 */
class UpdateCustomerPaymentProfileResponse {
	/**
	 * @access public
	 * @var UpdateCustomerPaymentProfileResponseType
	 */
	public $UpdateCustomerPaymentProfileResult;
}}

if (!class_exists("UpdateCustomerPaymentProfileResponseType")) {
/**
 * UpdateCustomerPaymentProfileResponseType
 */
class UpdateCustomerPaymentProfileResponseType extends ANetApiResponseType {
}}

if (!class_exists("UpdateCustomerShippingAddress")) {
/**
 * UpdateCustomerShippingAddress
 */
class UpdateCustomerShippingAddress {
	/**
	 * @access public
	 * @var MerchantAuthenticationType
	 */
	public $merchantAuthentication;
	/**
	 * @access public
	 * @var slong
	 */
	public $customerProfileId;
	/**
	 * @access public
	 * @var CustomerAddressExType
	 */
	public $address;
}}

if (!class_exists("UpdateCustomerShippingAddressResponse")) {
/**
 * UpdateCustomerShippingAddressResponse
 */
class UpdateCustomerShippingAddressResponse {
	/**
	 * @access public
	 * @var UpdateCustomerShippingAddressResponseType
	 */
	public $UpdateCustomerShippingAddressResult;
}}

if (!class_exists("UpdateCustomerShippingAddressResponseType")) {
/**
 * UpdateCustomerShippingAddressResponseType
 */
class UpdateCustomerShippingAddressResponseType extends ANetApiResponseType {
}}

if (!class_exists("DeleteCustomerProfile")) {
/**
 * DeleteCustomerProfile
 */
class DeleteCustomerProfile {
	/**
	 * @access public
	 * @var MerchantAuthenticationType
	 */
	public $merchantAuthentication;
	/**
	 * @access public
	 * @var slong
	 */
	public $customerProfileId;
}}

if (!class_exists("DeleteCustomerProfileResponse")) {
/**
 * DeleteCustomerProfileResponse
 */
class DeleteCustomerProfileResponse {
	/**
	 * @access public
	 * @var DeleteCustomerProfileResponseType
	 */
	public $DeleteCustomerProfileResult;
}}

if (!class_exists("DeleteCustomerProfileResponseType")) {
/**
 * DeleteCustomerProfileResponseType
 */
class DeleteCustomerProfileResponseType extends ANetApiResponseType {
}}

if (!class_exists("DeleteCustomerPaymentProfile")) {
/**
 * DeleteCustomerPaymentProfile
 */
class DeleteCustomerPaymentProfile {
	/**
	 * @access public
	 * @var MerchantAuthenticationType
	 */
	public $merchantAuthentication;
	/**
	 * @access public
	 * @var slong
	 */
	public $customerProfileId;
	/**
	 * @access public
	 * @var slong
	 */
	public $customerPaymentProfileId;
}}

if (!class_exists("DeleteCustomerPaymentProfileResponse")) {
/**
 * DeleteCustomerPaymentProfileResponse
 */
class DeleteCustomerPaymentProfileResponse {
	/**
	 * @access public
	 * @var DeleteCustomerPaymentProfileResponseType
	 */
	public $DeleteCustomerPaymentProfileResult;
}}

if (!class_exists("DeleteCustomerPaymentProfileResponseType")) {
/**
 * DeleteCustomerPaymentProfileResponseType
 */
class DeleteCustomerPaymentProfileResponseType extends ANetApiResponseType {
}}

if (!class_exists("DeleteCustomerShippingAddress")) {
/**
 * DeleteCustomerShippingAddress
 */
class DeleteCustomerShippingAddress {
	/**
	 * @access public
	 * @var MerchantAuthenticationType
	 */
	public $merchantAuthentication;
	/**
	 * @access public
	 * @var slong
	 */
	public $customerProfileId;
	/**
	 * @access public
	 * @var slong
	 */
	public $customerAddressId;
}}

if (!class_exists("DeleteCustomerShippingAddressResponse")) {
/**
 * DeleteCustomerShippingAddressResponse
 */
class DeleteCustomerShippingAddressResponse {
	/**
	 * @access public
	 * @var DeleteCustomerShippingAddressResponseType
	 */
	public $DeleteCustomerShippingAddressResult;
}}

if (!class_exists("DeleteCustomerShippingAddressResponseType")) {
/**
 * DeleteCustomerShippingAddressResponseType
 */
class DeleteCustomerShippingAddressResponseType extends ANetApiResponseType {
}}

if (!class_exists("CreateCustomerProfileTransaction")) {
/**
 * CreateCustomerProfileTransaction
 */
class CreateCustomerProfileTransaction {
	/**
	 * @access public
	 * @var MerchantAuthenticationType
	 */
	public $merchantAuthentication;
	/**
	 * @access public
	 * @var ProfileTransactionType
	 */
	public $transaction;
	/**
	 * @access public
	 * @var sstring
	 */
	public $extraOptions;
}}

if (!class_exists("ProfileTransactionType")) {
/**
 * ProfileTransactionType
 */
class ProfileTransactionType {
	/**
	 * @access public
	 * @var ProfileTransAuthOnlyType
	 */
	public $profileTransAuthOnly;
	/**
	 * @access public
	 * @var ProfileTransCaptureOnlyType
	 */
	public $profileTransCaptureOnly;
	/**
	 * @access public
	 * @var ProfileTransAuthCaptureType
	 */
	public $profileTransAuthCapture;
}}

if (!class_exists("ProfileTransAmountType")) {
/**
 * ProfileTransAmountType
 */
class ProfileTransAmountType {
	/**
	 * @access public
	 * @var sdecimal
	 */
	public $amount;
	/**
	 * @access public
	 * @var ExtendedAmountType
	 */
	public $tax;
	/**
	 * @access public
	 * @var ExtendedAmountType
	 */
	public $shipping;
	/**
	 * @access public
	 * @var ExtendedAmountType
	 */
	public $duty;
	/**
	 * @access public
	 * @var LineItemType[]
	 */
	public $lineItems;
}}

if (!class_exists("ExtendedAmountType")) {
/**
 * ExtendedAmountType
 */
class ExtendedAmountType {
	/**
	 * @access public
	 * @var sdecimal
	 */
	public $amount;
	/**
	 * @access public
	 * @var sstring
	 */
	public $name;
	/**
	 * @access public
	 * @var sstring
	 */
	public $description;
}}

if (!class_exists("LineItemType")) {
/**
 * LineItemType
 */
class LineItemType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $itemId;
	/**
	 * @access public
	 * @var sstring
	 */
	public $name;
	/**
	 * @access public
	 * @var sstring
	 */
	public $description;
	/**
	 * @access public
	 * @var sdecimal
	 */
	public $quantity;
	/**
	 * @access public
	 * @var sdecimal
	 */
	public $unitPrice;
	/**
	 * @access public
	 * @var sboolean
	 */
	public $taxable;
}}

if (!class_exists("OrderExType")) {
/**
 * OrderExType
 */
class OrderExType extends OrderType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $purchaseOrderNumber;
}}

if (!class_exists("CreateCustomerProfileTransactionResponse")) {
/**
 * CreateCustomerProfileTransactionResponse
 */
class CreateCustomerProfileTransactionResponse {
	/**
	 * @access public
	 * @var CreateCustomerProfileTransactionResponseType
	 */
	public $CreateCustomerProfileTransactionResult;
}}

if (!class_exists("CreateCustomerProfileTransactionResponseType")) {
/**
 * CreateCustomerProfileTransactionResponseType
 */
class CreateCustomerProfileTransactionResponseType extends ANetApiResponseType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $directResponse;
}}

if (!class_exists("ValidateCustomerPaymentProfile")) {
/**
 * ValidateCustomerPaymentProfile
 */
class ValidateCustomerPaymentProfile {
	/**
	 * @access public
	 * @var MerchantAuthenticationType
	 */
	public $merchantAuthentication;
	/**
	 * @access public
	 * @var slong
	 */
	public $customerProfileId;
	/**
	 * @access public
	 * @var slong
	 */
	public $customerPaymentProfileId;
	/**
	 * @access public
	 * @var slong
	 */
	public $customerShippingAddressId;
	/**
	 * @access public
	 * @var tnsValidationModeEnum
	 */
	public $validationMode;
}}

if (!class_exists("ValidateCustomerPaymentProfileResponse")) {
/**
 * ValidateCustomerPaymentProfileResponse
 */
class ValidateCustomerPaymentProfileResponse {
	/**
	 * @access public
	 * @var ValidateCustomerPaymentProfileResponseType
	 */
	public $ValidateCustomerPaymentProfileResult;
}}

if (!class_exists("ValidateCustomerPaymentProfileResponseType")) {
/**
 * ValidateCustomerPaymentProfileResponseType
 */
class ValidateCustomerPaymentProfileResponseType extends ANetApiResponseType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $directResponse;
}}

if (!class_exists("CreditCardType")) {
/**
 * CreditCardType
 */
class CreditCardType extends CreditCardSimpleType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $cardCode;
}}

if (!class_exists("BankAccountType")) {
/**
 * BankAccountType
 */
class BankAccountType extends BankAccountBaseType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $routingNumber;
	/**
	 * @access public
	 * @var sstring
	 */
	public $accountNumber;
}}

if (!class_exists("DriversLicenseType")) {
/**
 * DriversLicenseType
 */
class DriversLicenseType extends DriversLicenseBaseType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $number;
	/**
	 * @access public
	 * @var sdate
	 */
	public $dateOfBirth;
}}

if (!class_exists("CustomerProfileType")) {
/**
 * CustomerProfileType
 */
class CustomerProfileType extends CustomerProfileBaseType {
	/**
	 * @access public
	 * @var ArrayOfCustomerPaymentProfileType
	 */
	public $paymentProfiles;
	/**
	 * @access public
	 * @var ArrayOfCustomerAddressType
	 */
	public $shipToList;
}}

if (!class_exists("CustomerPaymentProfileType")) {
/**
 * CustomerPaymentProfileType
 */
class CustomerPaymentProfileType extends CustomerPaymentProfileBaseType {
	/**
	 * @access public
	 * @var PaymentSimpleType
	 */
	public $payment;
	/**
	 * @access public
	 * @var DriversLicenseType
	 */
	public $driversLicense;
	/**
	 * @access public
	 * @var sstring
	 */
	public $taxId;
}}

if (!class_exists("CustomerProfileMaskedType")) {
/**
 * CustomerProfileMaskedType
 */
class CustomerProfileMaskedType extends CustomerProfileExType {
	/**
	 * @access public
	 * @var ArrayOfCustomerPaymentProfileMaskedType
	 */
	public $paymentProfiles;
	/**
	 * @access public
	 * @var ArrayOfCustomerAddressExType
	 */
	public $shipToList;
}}

if (!class_exists("CustomerPaymentProfileExType")) {
/**
 * CustomerPaymentProfileExType
 */
class CustomerPaymentProfileExType extends CustomerPaymentProfileType {
	/**
	 * @access public
	 * @var slong
	 */
	public $customerPaymentProfileId;
}}

if (!class_exists("ProfileTransOrderType")) {
/**
 * ProfileTransOrderType
 */
class ProfileTransOrderType extends ProfileTransAmountType {
	/**
	 * @access public
	 * @var slong
	 */
	public $customerProfileId;
	/**
	 * @access public
	 * @var slong
	 */
	public $customerPaymentProfileId;
	/**
	 * @access public
	 * @var slong
	 */
	public $customerShippingAddressId;
	/**
	 * @access public
	 * @var OrderExType
	 */
	public $order;
	/**
	 * @access public
	 * @var sboolean
	 */
	public $taxExempt;
	/**
	 * @access public
	 * @var sboolean
	 */
	public $recurringBilling;
	/**
	 * @access public
	 * @var sstring
	 */
	public $cardCode;
}}

if (!class_exists("ProfileTransAuthCaptureType")) {
/**
 * ProfileTransAuthCaptureType
 */
class ProfileTransAuthCaptureType extends ProfileTransOrderType {
}}

if (!class_exists("ProfileTransCaptureOnlyType")) {
/**
 * ProfileTransCaptureOnlyType
 */
class ProfileTransCaptureOnlyType extends ProfileTransOrderType {
	/**
	 * @access public
	 * @var sstring
	 */
	public $approvalCode;
}}

if (!class_exists("ProfileTransAuthOnlyType")) {
/**
 * ProfileTransAuthOnlyType
 */
class ProfileTransAuthOnlyType extends ProfileTransOrderType {
}}

if (!class_exists("AuthorizeNetWS")) {
/**
 * AuthorizeNetWS
 * @author WSDLInterpreter
 */
class AuthorizeNetWS extends SoapClient {
	/**
	 * Default class map for wsdl=>php
	 * @access private
	 * @var array
	 */
	private static $classmap = array(
		"IsAlive" => "IsAlive",
		"IsAliveResponse" => "IsAliveResponse",
		"ANetApiResponseType" => "ANetApiResponseType",
		"MessageTypeEnum" => "MessageTypeEnum",
		"MessagesTypeMessage" => "MessagesTypeMessage",
		"AuthenticateTest" => "AuthenticateTest",
		"MerchantAuthenticationType" => "MerchantAuthenticationType",
		"AuthenticateTestResponse" => "AuthenticateTestResponse",
		"ARBCreateSubscription" => "ARBCreateSubscription",
		"ARBSubscriptionType" => "ARBSubscriptionType",
		"PaymentScheduleType" => "PaymentScheduleType",
		"PaymentScheduleTypeInterval" => "PaymentScheduleTypeInterval",
		"ARBSubscriptionUnitEnum" => "ARBSubscriptionUnitEnum",
		"PaymentType" => "PaymentType",
		"CreditCardType" => "CreditCardType",
		"CreditCardSimpleType" => "CreditCardSimpleType",
		"BankAccountType" => "BankAccountType",
		"BankAccountBaseType" => "BankAccountBaseType",
		"BankAccountTypeEnum" => "BankAccountTypeEnum",
		"EcheckTypeEnum" => "EcheckTypeEnum",
		"OrderType" => "OrderType",
		"CustomerType" => "CustomerType",
		"CustomerTypeEnum" => "CustomerTypeEnum",
		"DriversLicenseType" => "DriversLicenseType",
		"DriversLicenseBaseType" => "DriversLicenseBaseType",
		"NameAndAddressType" => "NameAndAddressType",
		"ARBCreateSubscriptionResponse" => "ARBCreateSubscriptionResponse",
		"ARBCreateSubscriptionResponseType" => "ARBCreateSubscriptionResponseType",
		"ARBUpdateSubscription" => "ARBUpdateSubscription",
		"ARBUpdateSubscriptionResponse" => "ARBUpdateSubscriptionResponse",
		"ARBUpdateSubscriptionResponseType" => "ARBUpdateSubscriptionResponseType",
		"ARBCancelSubscription" => "ARBCancelSubscription",
		"ARBCancelSubscriptionResponse" => "ARBCancelSubscriptionResponse",
		"ARBCancelSubscriptionResponseType" => "ARBCancelSubscriptionResponseType",
		"CreateCustomerProfile" => "CreateCustomerProfile",
		"CustomerProfileType" => "CustomerProfileType",
		"CustomerProfileBaseType" => "CustomerProfileBaseType",
		"CustomerPaymentProfileType" => "CustomerPaymentProfileType",
		"CustomerPaymentProfileBaseType" => "CustomerPaymentProfileBaseType",
		"CustomerAddressType" => "CustomerAddressType",
		"PaymentSimpleType" => "PaymentSimpleType",
		"CreateCustomerProfileResponse" => "CreateCustomerProfileResponse",
		"CreateCustomerProfileResponseType" => "CreateCustomerProfileResponseType",
		"CreateCustomerPaymentProfile" => "CreateCustomerPaymentProfile",
		"ValidationModeEnum" => "ValidationModeEnum",
		"CreateCustomerPaymentProfileResponse" => "CreateCustomerPaymentProfileResponse",
		"CreateCustomerPaymentProfileResponseType" => "CreateCustomerPaymentProfileResponseType",
		"CreateCustomerShippingAddress" => "CreateCustomerShippingAddress",
		"CreateCustomerShippingAddressResponse" => "CreateCustomerShippingAddressResponse",
		"CreateCustomerShippingAddressResponseType" => "CreateCustomerShippingAddressResponseType",
		"GetCustomerProfile" => "GetCustomerProfile",
		"GetCustomerProfileResponse" => "GetCustomerProfileResponse",
		"GetCustomerProfileResponseType" => "GetCustomerProfileResponseType",
		"CustomerProfileMaskedType" => "CustomerProfileMaskedType",
		"CustomerProfileExType" => "CustomerProfileExType",
		"CustomerPaymentProfileMaskedType" => "CustomerPaymentProfileMaskedType",
		"PaymentMaskedType" => "PaymentMaskedType",
		"BankAccountMaskedType" => "BankAccountMaskedType",
		"CreditCardMaskedType" => "CreditCardMaskedType",
		"DriversLicenseMaskedType" => "DriversLicenseMaskedType",
		"CustomerAddressExType" => "CustomerAddressExType",
		"GetCustomerPaymentProfile" => "GetCustomerPaymentProfile",
		"GetCustomerPaymentProfileResponse" => "GetCustomerPaymentProfileResponse",
		"GetCustomerPaymentProfileResponseType" => "GetCustomerPaymentProfileResponseType",
		"GetCustomerShippingAddress" => "GetCustomerShippingAddress",
		"GetCustomerShippingAddressResponse" => "GetCustomerShippingAddressResponse",
		"GetCustomerShippingAddressResponseType" => "GetCustomerShippingAddressResponseType",
		"UpdateCustomerProfile" => "UpdateCustomerProfile",
		"UpdateCustomerProfileResponse" => "UpdateCustomerProfileResponse",
		"UpdateCustomerProfileResponseType" => "UpdateCustomerProfileResponseType",
		"UpdateCustomerPaymentProfile" => "UpdateCustomerPaymentProfile",
		"CustomerPaymentProfileExType" => "CustomerPaymentProfileExType",
		"UpdateCustomerPaymentProfileResponse" => "UpdateCustomerPaymentProfileResponse",
		"UpdateCustomerPaymentProfileResponseType" => "UpdateCustomerPaymentProfileResponseType",
		"UpdateCustomerShippingAddress" => "UpdateCustomerShippingAddress",
		"UpdateCustomerShippingAddressResponse" => "UpdateCustomerShippingAddressResponse",
		"UpdateCustomerShippingAddressResponseType" => "UpdateCustomerShippingAddressResponseType",
		"DeleteCustomerProfile" => "DeleteCustomerProfile",
		"DeleteCustomerProfileResponse" => "DeleteCustomerProfileResponse",
		"DeleteCustomerProfileResponseType" => "DeleteCustomerProfileResponseType",
		"DeleteCustomerPaymentProfile" => "DeleteCustomerPaymentProfile",
		"DeleteCustomerPaymentProfileResponse" => "DeleteCustomerPaymentProfileResponse",
		"DeleteCustomerPaymentProfileResponseType" => "DeleteCustomerPaymentProfileResponseType",
		"DeleteCustomerShippingAddress" => "DeleteCustomerShippingAddress",
		"DeleteCustomerShippingAddressResponse" => "DeleteCustomerShippingAddressResponse",
		"DeleteCustomerShippingAddressResponseType" => "DeleteCustomerShippingAddressResponseType",
		"CreateCustomerProfileTransaction" => "CreateCustomerProfileTransaction",
		"ProfileTransactionType" => "ProfileTransactionType",
		"ProfileTransAuthOnlyType" => "ProfileTransAuthOnlyType",
		"ProfileTransOrderType" => "ProfileTransOrderType",
		"ProfileTransAmountType" => "ProfileTransAmountType",
		"ExtendedAmountType" => "ExtendedAmountType",
		"LineItemType" => "LineItemType",
		"OrderExType" => "OrderExType",
		"ProfileTransAuthCaptureType" => "ProfileTransAuthCaptureType",
		"ProfileTransCaptureOnlyType" => "ProfileTransCaptureOnlyType",
		"CreateCustomerProfileTransactionResponse" => "CreateCustomerProfileTransactionResponse",
		"CreateCustomerProfileTransactionResponseType" => "CreateCustomerProfileTransactionResponseType",
		"ValidateCustomerPaymentProfile" => "ValidateCustomerPaymentProfile",
		"ValidateCustomerPaymentProfileResponse" => "ValidateCustomerPaymentProfileResponse",
		"ValidateCustomerPaymentProfileResponseType" => "ValidateCustomerPaymentProfileResponseType",
	);

	/**
	 * Constructor using wsdl location and options array
	 * @param string $wsdl WSDL location for this service
	 * @param array $options Options for the SoapClient
	 */
	public function __construct($wsdl, $options=array()) {
		foreach(self::$classmap as $wsdlClassName => $phpClassName) {
		    if(!isset($options['classmap'][$wsdlClassName])) {
		        $options['classmap'][$wsdlClassName] = $phpClassName;
		    }
		}
		parent::__construct($wsdl, $options);
	}

	/**
	 * Checks if an argument list matches against a valid argument type list
	 * @param array $arguments The argument list to check
	 * @param array $validParameters A list of valid argument types
	 * @return boolean true if arguments match against validParameters
	 * @throws Exception invalid function signature message
	 */
	public function _checkArguments($arguments, $validParameters) {
		$variables = "";
		foreach ($arguments as $arg) {
		    $type = gettype($arg);
		    if ($type == "object") {
		        $type = get_class($arg);
		    }
		    $variables .= "(".$type.")";
		}
		if (!in_array($variables, $validParameters)) {
		    throw new Exception("Invalid parameter types: ".str_replace(")(", ", ", $variables));
		}
		return true;
	}

	/**
	 * Service Call: IsAlive
	 * Parameter options:
	 * (IsAlive) parameters
	 * (IsAlive) parameters
	 * @param mixed,... See function description for parameter options
	 * @return IsAliveResponse
	 * @throws Exception invalid function signature message
	 */
	public function IsAlive($mixed = null) {
		$validParameters = array(
			"(IsAlive)",
			"(IsAlive)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("IsAlive", $args);
	}


	/**
	 * Service Call: AuthenticateTest
	 * Parameter options:
	 * (AuthenticateTest) parameters
	 * (AuthenticateTest) parameters
	 * @param mixed,... See function description for parameter options
	 * @return AuthenticateTestResponse
	 * @throws Exception invalid function signature message
	 */
	public function AuthenticateTest($mixed = null) {
		$validParameters = array(
			"(AuthenticateTest)",
			"(AuthenticateTest)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("AuthenticateTest", $args);
	}


	/**
	 * Service Call: ARBCreateSubscription
	 * Parameter options:
	 * (ARBCreateSubscription) parameters
	 * (ARBCreateSubscription) parameters
	 * @param mixed,... See function description for parameter options
	 * @return ARBCreateSubscriptionResponse
	 * @throws Exception invalid function signature message
	 */
	public function ARBCreateSubscription($mixed = null) {
		$validParameters = array(
			"(ARBCreateSubscription)",
			"(ARBCreateSubscription)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("ARBCreateSubscription", $args);
	}


	/**
	 * Service Call: ARBUpdateSubscription
	 * Parameter options:
	 * (ARBUpdateSubscription) parameters
	 * (ARBUpdateSubscription) parameters
	 * @param mixed,... See function description for parameter options
	 * @return ARBUpdateSubscriptionResponse
	 * @throws Exception invalid function signature message
	 */
	public function ARBUpdateSubscription($mixed = null) {
		$validParameters = array(
			"(ARBUpdateSubscription)",
			"(ARBUpdateSubscription)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("ARBUpdateSubscription", $args);
	}


	/**
	 * Service Call: ARBCancelSubscription
	 * Parameter options:
	 * (ARBCancelSubscription) parameters
	 * (ARBCancelSubscription) parameters
	 * @param mixed,... See function description for parameter options
	 * @return ARBCancelSubscriptionResponse
	 * @throws Exception invalid function signature message
	 */
	public function ARBCancelSubscription($mixed = null) {
		$validParameters = array(
			"(ARBCancelSubscription)",
			"(ARBCancelSubscription)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("ARBCancelSubscription", $args);
	}


	/**
	 * Service Call: CreateCustomerProfile
	 * Parameter options:
	 * (CreateCustomerProfile) parameters
	 * (CreateCustomerProfile) parameters
	 * @param mixed,... See function description for parameter options
	 * @return CreateCustomerProfileResponse
	 * @throws Exception invalid function signature message
	 */
	public function CreateCustomerProfile($mixed = null) {
		$validParameters = array(
			"(CreateCustomerProfile)",
			"(CreateCustomerProfile)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("CreateCustomerProfile", $args);
	}


	/**
	 * Service Call: CreateCustomerPaymentProfile
	 * Parameter options:
	 * (CreateCustomerPaymentProfile) parameters
	 * (CreateCustomerPaymentProfile) parameters
	 * @param mixed,... See function description for parameter options
	 * @return CreateCustomerPaymentProfileResponse
	 * @throws Exception invalid function signature message
	 */
	public function CreateCustomerPaymentProfile($mixed = null) {
		$validParameters = array(
			"(CreateCustomerPaymentProfile)",
			"(CreateCustomerPaymentProfile)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("CreateCustomerPaymentProfile", $args);
	}


	/**
	 * Service Call: CreateCustomerShippingAddress
	 * Parameter options:
	 * (CreateCustomerShippingAddress) parameters
	 * (CreateCustomerShippingAddress) parameters
	 * @param mixed,... See function description for parameter options
	 * @return CreateCustomerShippingAddressResponse
	 * @throws Exception invalid function signature message
	 */
	public function CreateCustomerShippingAddress($mixed = null) {
		$validParameters = array(
			"(CreateCustomerShippingAddress)",
			"(CreateCustomerShippingAddress)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("CreateCustomerShippingAddress", $args);
	}


	/**
	 * Service Call: GetCustomerProfile
	 * Parameter options:
	 * (GetCustomerProfile) parameters
	 * (GetCustomerProfile) parameters
	 * @param mixed,... See function description for parameter options
	 * @return GetCustomerProfileResponse
	 * @throws Exception invalid function signature message
	 */
	public function GetCustomerProfile($mixed = null) {
		$validParameters = array(
			"(GetCustomerProfile)",
			"(GetCustomerProfile)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("GetCustomerProfile", $args);
	}


	/**
	 * Service Call: GetCustomerPaymentProfile
	 * Parameter options:
	 * (GetCustomerPaymentProfile) parameters
	 * (GetCustomerPaymentProfile) parameters
	 * @param mixed,... See function description for parameter options
	 * @return GetCustomerPaymentProfileResponse
	 * @throws Exception invalid function signature message
	 */
	public function GetCustomerPaymentProfile($mixed = null) {
		$validParameters = array(
			"(GetCustomerPaymentProfile)",
			"(GetCustomerPaymentProfile)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("GetCustomerPaymentProfile", $args);
	}


	/**
	 * Service Call: GetCustomerShippingAddress
	 * Parameter options:
	 * (GetCustomerShippingAddress) parameters
	 * (GetCustomerShippingAddress) parameters
	 * @param mixed,... See function description for parameter options
	 * @return GetCustomerShippingAddressResponse
	 * @throws Exception invalid function signature message
	 */
	public function GetCustomerShippingAddress($mixed = null) {
		$validParameters = array(
			"(GetCustomerShippingAddress)",
			"(GetCustomerShippingAddress)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("GetCustomerShippingAddress", $args);
	}


	/**
	 * Service Call: UpdateCustomerProfile
	 * Parameter options:
	 * (UpdateCustomerProfile) parameters
	 * (UpdateCustomerProfile) parameters
	 * @param mixed,... See function description for parameter options
	 * @return UpdateCustomerProfileResponse
	 * @throws Exception invalid function signature message
	 */
	public function UpdateCustomerProfile($mixed = null) {
		$validParameters = array(
			"(UpdateCustomerProfile)",
			"(UpdateCustomerProfile)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("UpdateCustomerProfile", $args);
	}


	/**
	 * Service Call: UpdateCustomerPaymentProfile
	 * Parameter options:
	 * (UpdateCustomerPaymentProfile) parameters
	 * (UpdateCustomerPaymentProfile) parameters
	 * @param mixed,... See function description for parameter options
	 * @return UpdateCustomerPaymentProfileResponse
	 * @throws Exception invalid function signature message
	 */
	public function UpdateCustomerPaymentProfile($mixed = null) {
		$validParameters = array(
			"(UpdateCustomerPaymentProfile)",
			"(UpdateCustomerPaymentProfile)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("UpdateCustomerPaymentProfile", $args);
	}


	/**
	 * Service Call: UpdateCustomerShippingAddress
	 * Parameter options:
	 * (UpdateCustomerShippingAddress) parameters
	 * (UpdateCustomerShippingAddress) parameters
	 * @param mixed,... See function description for parameter options
	 * @return UpdateCustomerShippingAddressResponse
	 * @throws Exception invalid function signature message
	 */
	public function UpdateCustomerShippingAddress($mixed = null) {
		$validParameters = array(
			"(UpdateCustomerShippingAddress)",
			"(UpdateCustomerShippingAddress)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("UpdateCustomerShippingAddress", $args);
	}


	/**
	 * Service Call: DeleteCustomerProfile
	 * Parameter options:
	 * (DeleteCustomerProfile) parameters
	 * (DeleteCustomerProfile) parameters
	 * @param mixed,... See function description for parameter options
	 * @return DeleteCustomerProfileResponse
	 * @throws Exception invalid function signature message
	 */
	public function DeleteCustomerProfile($mixed = null) {
		$validParameters = array(
			"(DeleteCustomerProfile)",
			"(DeleteCustomerProfile)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("DeleteCustomerProfile", $args);
	}


	/**
	 * Service Call: DeleteCustomerPaymentProfile
	 * Parameter options:
	 * (DeleteCustomerPaymentProfile) parameters
	 * (DeleteCustomerPaymentProfile) parameters
	 * @param mixed,... See function description for parameter options
	 * @return DeleteCustomerPaymentProfileResponse
	 * @throws Exception invalid function signature message
	 */
	public function DeleteCustomerPaymentProfile($mixed = null) {
		$validParameters = array(
			"(DeleteCustomerPaymentProfile)",
			"(DeleteCustomerPaymentProfile)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("DeleteCustomerPaymentProfile", $args);
	}


	/**
	 * Service Call: DeleteCustomerShippingAddress
	 * Parameter options:
	 * (DeleteCustomerShippingAddress) parameters
	 * (DeleteCustomerShippingAddress) parameters
	 * @param mixed,... See function description for parameter options
	 * @return DeleteCustomerShippingAddressResponse
	 * @throws Exception invalid function signature message
	 */
	public function DeleteCustomerShippingAddress($mixed = null) {
		$validParameters = array(
			"(DeleteCustomerShippingAddress)",
			"(DeleteCustomerShippingAddress)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("DeleteCustomerShippingAddress", $args);
	}


	/**
	 * Service Call: CreateCustomerProfileTransaction
	 * Parameter options:
	 * (CreateCustomerProfileTransaction) parameters
	 * (CreateCustomerProfileTransaction) parameters
	 * @param mixed,... See function description for parameter options
	 * @return CreateCustomerProfileTransactionResponse
	 * @throws Exception invalid function signature message
	 */
	public function CreateCustomerProfileTransaction($mixed = null) {
		$validParameters = array(
			"(CreateCustomerProfileTransaction)",
			"(CreateCustomerProfileTransaction)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("CreateCustomerProfileTransaction", $args);
	}


	/**
	 * Service Call: ValidateCustomerPaymentProfile
	 * Parameter options:
	 * (ValidateCustomerPaymentProfile) parameters
	 * (ValidateCustomerPaymentProfile) parameters
	 * @param mixed,... See function description for parameter options
	 * @return ValidateCustomerPaymentProfileResponse
	 * @throws Exception invalid function signature message
	 */
	public function ValidateCustomerPaymentProfile($mixed = null) {
		$validParameters = array(
			"(ValidateCustomerPaymentProfile)",
			"(ValidateCustomerPaymentProfile)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("ValidateCustomerPaymentProfile", $args);
	}


}}

?>
