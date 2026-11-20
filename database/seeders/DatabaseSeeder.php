<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Team;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Teams
        $teams = [
            'admin' => 'Admin Team',
            'user'  => 'User Team',
        ];

        $teamModels = [];
        foreach ($teams as $name => $displayName) {
            $teamModels[$name] = Team::firstOrCreate(
                ['name' => $name],
                ['display_name' => $displayName, 'description' => $displayName]
            );
        }

        // 2. Seed Permissions
        $permissions = [
            'create' => 'Create records',
            'read'   => 'Read records',
            'update' => 'Update records',
            'delete' => 'Delete records',
        ];

        $permissionModels = [];
        foreach ($permissions as $name => $description) {
            $permissionModels[$name] = Permission::firstOrCreate(
                ['name' => $name],
                ['display_name' => ucfirst($name), 'description' => $description]
            );
        }

        // 3. Seed Roles
        $roles = [
            'admin'       => 'Administrator',
            'user'        => 'Standard User',
            'delegate'    => 'Delegate',
            'liason'      => 'Liaison Officer',
            'interpreter' => 'Interpreter',
            'receiving'   => 'Receiving Officer',
        ];

        $roleModels = [];
        foreach ($roles as $name => $displayName) {
            $roleModels[$name] = Role::firstOrCreate(
                ['name' => $name],
                ['display_name' => $displayName, 'description' => $displayName]
            );
        }

        // Give all permissions to admin role
        $roleModels['admin']->syncPermissions($permissionModels);

        // 4. Provision Initial Administrator Account (Environment-Driven or Secure STDIN, NO Hardcoded Passwords)
        $adminEmail = env('ADMIN_EMAIL');
        $adminPassword = env('ADMIN_PASSWORD');
        $adminName = env('ADMIN_NAME', 'Administrator');

        // Check if supplied via non-interactive STDIN (JSON payload)
        if (!stream_isatty(STDIN)) {
            $rawInput = trim(stream_get_contents(STDIN));
            if ($rawInput === '') {
                throw new \InvalidArgumentException("DatabaseSeeder: STDIN stream is empty. Valid JSON credentials required.");
            }
            $payload = json_decode($rawInput, true);
            if (json_last_error() !== JSON_ERROR_NONE || !is_array($payload)) {
                throw new \InvalidArgumentException("DatabaseSeeder: Invalid JSON received on STDIN: " . json_last_error_msg());
            }
            if (empty($payload['admin_email']) || empty($payload['admin_password'])) {
                throw new \InvalidArgumentException("DatabaseSeeder: Missing required 'admin_email' or 'admin_password' in STDIN payload.");
            }
            $adminEmail = trim($payload['admin_email']);
            $adminPassword = $payload['admin_password'];
            $adminName = !empty($payload['admin_name']) ? trim($payload['admin_name']) : $adminName;
        }

        if (empty($adminEmail)) {
            throw new \RuntimeException("DatabaseSeeder: Administrator email is missing. Must be supplied via STDIN JSON payload or ADMIN_EMAIL environment variable.");
        }
        if (!filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("DatabaseSeeder: Invalid email address format: {$adminEmail}");
        }
        if (trim($adminPassword) === '') {
            throw new \InvalidArgumentException("DatabaseSeeder: Administrator password cannot be empty or whitespace.");
        }

        $admin = User::firstOrCreate(
            ['email' => $adminEmail],
            [
                'uid' => (string) Str::uuid(),
                'name' => $adminName,
                'password' => Hash::make($adminPassword),
                'activated' => 1,
                'status' => 1,
            ]
        );

        // Ensure active status without ever overwriting an existing administrator's password
        $admin->activated = 1;
        $admin->status = 1;
        $admin->save();

        // Assign admin role within admin team
        if (!$admin->hasRole('admin', $teamModels['admin'])) {
            $admin->addRole($roleModels['admin'], $teamModels['admin']);
        }

        // Sync all permissions
        $admin->syncPermissions($permissionModels, $teamModels['admin']);

        if ($this->command) {
            $this->command->info("Administrator account provisioned: {$adminEmail}");
        }
    }
}
