<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create roles
        $roleNames = [
            'admin', // Has access to all permissions
            'guest', // Minimal access, mostly viewing public content
            'user',  // Standard user access, with permissions for basic interactions
            'editor', // Permissions related to content creation and management
            'financial_manager', // Manages financial aspects and reports
            'content_curator', // Manages content curation, publication, and archiving
            'system_administrator', // Manages system settings, security policies, and updates
            'event_organizer', // Manages event creation, scheduling, and ticketing
            'support_agent', // Manages customer support tickets and knowledge base
            // Additional roles for expanded granularity
            'post_manager', // Specialized role for managing posts specifically
            'user_manager', // Specialized role for managing user accounts and roles
            'order_manager', // Manages orders, refunds, and financial transactions related to orders
            'profile_manager', // Manages user profiles, including editing and privacy settings
            'report_analyst', // Specialized role for viewing and analyzing various reports
        ];
        foreach ($roleNames as $roleName) {
            Role::findOrCreate($roleName);
        }

        // Define permissions
        // Define permissions
        $permissions = [
            'post_management' => [
                'create_post',
                'edit_post',
                'delete_post',
                'archive_post',
                'publish_post',
                'unpublish_post',
                'feature_post',
                'unfeature_post',
                'approve_post',
                'reject_post',
                'restore_post',
                'permanently_delete_post',
                'view_archived_posts',
                'update_post_status',
            ],
            'user_management' => [
                'create_user',
                'edit_user',
                'delete_user',
                'ban_user',
                'unban_user',
                'activate_user',
                'deactivate_user',
                'assign_role',
                'remove_role',
                'reset_password',
                'change_email',
                'view_banned_users',
                'view_inactive_users',
                'promote_user',
                'demote_user',
            ],
            'view_posts' => [
                'view_posts',
                'view_archived_posts',
                'view_unpublished_posts',
                'view_featured_posts',
                'view_private_posts',
                'view_public_posts',
                'view_rejected_posts',
                'view_all_posts',
                'view_own_posts',
                'view_user_posts',
                'view_category_posts',
                'view_tagged_posts',
            ],
            'profile_management' => [
                'edit_own_profile',
                'change_own_password',
                'upload_profile_photo',
                'remove_profile_photo',
                'edit_own_preferences',
                'view_own_activity_log',
                'update_contact_information',
                'update_bio',
                'update_social_links',
                'make_profile_private',
                'make_profile_public',
                'view_own_private_data',
                'delete_own_account',
            ],
            // New permission group for demonstration
            'order_management' => [
                'create_order',
                'edit_order',
                'delete_order',
                'view_order',
                'update_order_status',
                'cancel_order',
                'refund_order',
                'process_order',
                'archive_order',
                'unarchive_order',
                'export_order_data',
                'import_order_data',
                'view_archived_orders',
                'send_order_confirmation',
            ],
            'financial_management' => [
                'view_financial_reports',
                'edit_financial_settings',
                'process_refunds',
                'manage_pricing',
                'view_transactions',
                'export_financial_data',
                'import_financial_data',
                'update_tax_rates',
                'manage_invoices',
                'manage_payments',
                'view_payment_methods',
                'add_payment_method',
                'remove_payment_method',
                'configure_payment_gateways',
            ],
            'content_curation' => [
                'create_content',
                'edit_content',
                'delete_content',
                'publish_content',
                'unpublish_content',
                'feature_content',
                'archive_content',
                'restore_content',
                'approve_content',
                'reject_content',
                'tag_content',
                'categorize_content',
                'assign_content_creator',
                'remove_content_creator',
                'view_content_analytics',
            ],
            'system_settings' => [
                'view_system_settings',
                'edit_system_settings',
                'update_security_policies',
                'configure_email_settings',
                'manage_api_keys',
                'perform_system_updates',
                'backup_system_data',
                'restore_system_data',
                'view_system_logs',
                'configure_third_party_integrations',
                'manage_user_sessions',
                'reset_system_settings',
                'configure_notification_settings',
            ],
            'event_management' => [
                'create_event',
                'edit_event',
                'delete_event',
                'publish_event',
                'unpublish_event',
                'archive_event',
                'restore_event',
                'manage_event_tickets',
                'view_event_reports',
                'check_in_attendees',
                'cancel_event',
                'reschedule_event',
                'configure_event_settings',
                'assign_event_coordinator',
                'remove_event_coordinator',
            ],
            'customer_support' => [
                'respond_to_tickets',
                'view_tickets',
                'close_tickets',
                'escalate_tickets',
                'assign_tickets',
                'create_support_articles',
                'edit_support_articles',
                'delete_support_articles',
                'view_support_statistics',
                'manage_support_channels',
                'configure_autoresponder_settings',
                'update_ticket_status',
                'view_closed_tickets',
                'generate_support_reports',
            ],
        ];


        // Assign permissions to roles
        $this->assignPermissionsToRole('admin', array_keys($permissions), $permissions);

        // Guest role - limited access, example shown for illustrative purposes
        $this->assignPermissionsToRole('guest', ['view_posts'], $permissions);

        // User role - standard user access
        $this->assignPermissionsToRole('user', ['profile_management', 'view_posts'], $permissions);

        // Editor role - content creation and management
        $this->assignPermissionsToRole('editor', ['post_management', 'content_curation'], $permissions);

        // Further roles based on the new groups
        $this->assignPermissionsToRole('financial_manager', ['financial_management'], $permissions);
        $this->assignPermissionsToRole('content_curator', ['content_curation'], $permissions);
        $this->assignPermissionsToRole('system_administrator', ['system_settings'], $permissions);
        $this->assignPermissionsToRole('event_organizer', ['event_management'], $permissions);
        $this->assignPermissionsToRole('support_agent', ['customer_support'], $permissions);
        // Assign permissions to the 'post_manager' role
        $this->assignPermissionsToRole('post_manager', ['post_management'], $permissions);

        // Assign permissions to the 'user_manager' role
        $this->assignPermissionsToRole('user_manager', ['user_management'], $permissions);

        // Assign permissions to the 'order_manager' role
        $this->assignPermissionsToRole('order_manager', ['order_management'], $permissions);

        // Assign permissions to the 'profile_manager' role
        $this->assignPermissionsToRole('profile_manager', ['profile_management'], $permissions);

        // Assign permissions to the 'report_analyst' role
        // Assuming 'report_analyst' has access across several reporting-related permissions
        $this->assignPermissionsToRole('report_analyst', ['financial_management', 'view_posts', 'system_settings', 'event_management', 'customer_support'], $permissions);

    }

    /**
     * Assign permissions to a specific role.
     *
     * @param string $roleName
     * @param array $permissionGroups
     * @param array $permissions
     */
    protected function assignPermissionsToRole(string $roleName, array $permissionGroups, array $permissions)
    {
        $role = Role::findByName($roleName);
        $allPermissions = collect([]);
    
        foreach ($permissionGroups as $groupName) {
            // Collect permissions for each group
            $groupPermissions = collect($permissions[$groupName])->map(function ($permissionName) {
                return Permission::findOrCreate($permissionName);
            });
    
            // Merge current group permissions into all permissions
            $allPermissions = $allPermissions->merge($groupPermissions);
        }
    
        // After collecting all permissions, sync them at once
        $role->syncPermissions($allPermissions);
    }
}
