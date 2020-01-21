<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */

// TODO: Move all phpDocs to Models
namespace App\Models{
/**
 * App\Models\Activity
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $text
 * @property string $source_type
 * @property int|null $source_id
 * @property string $ip_address
 * @property string $action
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $source
 * @property-read \App\Models\Task $task
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity whereSourceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity whereUserId($value)
 */
    class Activity extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\Client
 *
 * @property int $id
 * @property string $primary_email
 * @property string|null $primary_number
 * @property string|null $secondary_number
 * @property string|null $billing_address1
 * @property string|null $billing_address2
 * @property string|null $billing_zipcode
 * @property string|null $billing_country
 * @property string|null $shipping_address1
 * @property string|null $shipping_address2
 * @property string|null $shipping_city
 * @property string|null $shipping_state
 * @property string|null $shipping_zipcode
 * @property string|null $shipping_country
 * @property string|null $billing_city
 * @property string|null $billing_state
 * @property string $name
 * @property string|null $vat
 * @property \App\Models\Industry $industry
 * @property string|null $company_type
 * @property int $user_id
 * @property int $industry_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contact[] $contacts
 * @property-read int|null $contacts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Document[] $documents
 * @property-read int|null $documents_count
 * @property-read mixed $assigned_user
 * @property-read mixed $formatted_billing_address
 * @property-read mixed $formatted_shipping_address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Invoice[] $invoices
 * @property-read int|null $invoices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lead[] $leads
 * @property-read int|null $leads_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client my()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBillingAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBillingAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBillingCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBillingCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBillingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBillingZipcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereCompanyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereIndustry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereIndustryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client wherePrimaryEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client wherePrimaryNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereSecondaryNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereShippingAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereShippingAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereShippingCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereShippingCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereShippingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereShippingZipcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereVat($value)
 */
    class Client extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\Comment
 *
 * @property int $id
 * @property string $description
 * @property int $source_id
 * @property string $source_type
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $commentable
 * @property-read \App\Models\Task $task
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereSourceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereUserId($value)
 */
    class Comment extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\Contact
 *
 * @property int $id
 * @property string $name
 * @property string|null $job_title
 * @property string $email
 * @property string|null $primary_number
 * @property string|null $secondary_number
 * @property string|null $address1
 * @property string|null $address2
 * @property string|null $state
 * @property string|null $country
 * @property string|null $zipcode
 * @property string|null $city
 * @property int $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @property-read mixed $formatted_address
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact my()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereJobTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact wherePrimaryNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereSecondaryNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereZipcode($value)
 */
    class Contact extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\Department
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereUpdatedAt($value)
 */
    class Department extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\Document
 *
 * @property int $id
 * @property string $name
 * @property string $size
 * @property string $path
 * @property string $file_display
 * @property int $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereFileDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereUpdatedAt($value)
 */
    class Document extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\Industry
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Industry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Industry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Industry query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Industry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Industry whereName($value)
 */
    class Industry extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\Integration
 *
 * @property int $id
 * @property string $name
 * @property int|null $client_id
 * @property int|null $user_id
 * @property int|null $client_secret
 * @property string|null $api_key
 * @property string|null $api_type
 * @property string|null $org_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereApiType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereClientSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereOrgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereUserId($value)
 */
    class Integration extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\Invoice
 *
 * @property int $id
 * @property string $status
 * @property string|null $invoice_no
 * @property string|null $sent_at
 * @property string|null $payment_received_at
 * @property string|null $due_at
 * @property int $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\InvoiceLine[] $invoiceLines
 * @property-read int|null $invoice_lines_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereDueAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereInvoiceNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice wherePaymentReceivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereUpdatedAt($value)
 */
    class Invoice extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\InvoiceLine
 *
 * @property int $id
 * @property string $title
 * @property string $comment
 * @property int $price
 * @property int $invoice_id
 * @property string|null $type
 * @property int|null $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Invoice $invoice
 * @property-read \App\Models\Task $tasks
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine whereUpdatedAt($value)
 */
    class InvoiceLine extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\Lead
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $status
 * @property int $user_assigned_id
 * @property int $client_id
 * @property int $user_created_id
 * @property \Illuminate\Support\Carbon $contact_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activity[] $activity
 * @property-read int|null $activity_count
 * @property-read \App\Models\Client $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\User $creator
 * @property-read mixed $days_until_contact
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead my()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereContactDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereUserAssignedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereUserCreatedId($value)
 */
    class Lead extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\PermissionRole
 *
 * @property int $permission_id
 * @property int $role_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PermissionRole[] $employee
 * @property-read int|null $employee_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permissions[] $hasperm
 * @property-read int|null $hasperm_count
 * @property-read \App\Models\Setting $settings
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionRole wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionRole whereRoleId($value)
 */
    class PermissionRole extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\Permissions
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereUpdatedAt($value)
 */
    class Permissions extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permissions[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permissions[] $perms
 * @property-read int|null $perms_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $userRole
 * @property-read int|null $user_role_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereUpdatedAt($value)
 */
    class Role extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\RoleUser
 *
 * @property int $user_id
 * @property int $role_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser whereUserId($value)
 */
    class RoleUser extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\Setting
 *
 * @property int $id
 * @property int $task_complete_allowed
 * @property int $task_assign_allowed
 * @property int $lead_complete_allowed
 * @property int $lead_assign_allowed
 * @property int $time_change_allowed
 * @property int $comment_allowed
 * @property string|null $country
 * @property string|null $company
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Task $tasks
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCommentAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereLeadAssignAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereLeadCompleteAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereTaskAssignAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereTaskCompleteAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereTimeChangeAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereUpdatedAt($value)
 */
    class Setting extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\Task
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $status
 * @property int $user_assigned_id
 * @property int $user_created_id
 * @property int $client_id
 * @property int|null $invoice_id
 * @property \Illuminate\Support\Carbon $deadline
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activity[] $activity
 * @property-read int|null $activity_count
 * @property-read \App\Models\Client $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\User $creator
 * @property-read mixed $assigned_user
 * @property-read mixed $creator_user
 * @property-read mixed $days_until_deadline
 * @property-read \App\Models\Invoice|null $invoice
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task my()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereUserAssignedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereUserCreatedId($value)
 */
    class Task extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $address
 * @property string|null $work_number
 * @property string|null $personal_number
 * @property string|null $image_path
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Department[] $department
 * @property-read int|null $department_count
 * @property-read mixed $name_and_department
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lead[] $leads
 * @property-read int|null $leads_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @property-read \App\Models\RoleUser $userRole
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePersonalNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereWorkNumber($value)
 */
    class User extends \Eloquent
    {
    }
}
