<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = collect([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'role' => 'admin',
            ],
            [
                'name' => 'Guest',
                'email' => 'guest@guest.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'role' => 'guest',
            ],
            [
                'name' => 'Standard User',
                'email' => 'user@user.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'role' => 'user',
            ],
            [
                'name' => 'Editor',
                'email' => 'editor@editor.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'role' => 'editor',
            ],
            // Additional users for new roles
            [
                'name' => 'Financial Manager',
                'email' => 'finance@finance.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'role' => 'financial_manager',
            ],
            [
                'name' => 'Content Curator',
                'email' => 'content@content.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'role' => 'content_curator',
            ],
            [
                'name' => 'System Administrator',
                'email' => 'sysadmin@sysadmin.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'role' => 'system_administrator',
            ],
            [
                'name' => 'Event Organizer',
                'email' => 'event@event.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'role' => 'event_organizer',
            ],
            [
                'name' => 'Support Agent',
                'email' => 'support@support.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'role' => 'support_agent',
            ],
            [
                'name' => 'Post Manager',
                'email' => 'postmanager@posts.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'role' => 'post_manager',
            ],
            [
                'name' => 'User Manager',
                'email' => 'usermanager@users.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'role' => 'user_manager',
            ],
            [
                'name' => 'Order Manager',
                'email' => 'ordermanager@orders.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'role' => 'order_manager',
            ],
            [
                'name' => 'Profile Manager',
                'email' => 'profilemanager@profiles.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'role' => 'profile_manager',
            ],
            [
                'name' => 'Report Analyst',
                'email' => 'reportanalyst@reports.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'role' => 'report_analyst',
            ],
        ]);

        $users->each(function ($user) {
            // Extract and remove the role from the user array
            $roleName = $user['role'];
            unset($user['role']);

            // Insert the user into the database
            $createdUser = User::create($user);

            // Check if the role exists and assign it to the user
            if ($role = Role::where('name', $roleName)->first()) {
                $createdUser->assignRole($role);
            }
        });
    }
}
