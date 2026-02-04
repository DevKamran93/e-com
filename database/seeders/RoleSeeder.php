<?php
namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Clear cached permissions (Spatie keeps a cache for performance)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Define your Roles
        $roles = [
            'admin'    => 'Administrator with full access',
            'manager'  => 'Can edit content',
        ];

        foreach ($roles as $name => $description) {
            // Spatie's findOrCreate handles the "check if exists" logic automatically
            Role::findOrCreate($name, 'web');
            // Note: Spatie's default table doesn't have a 'description' column.
            // If you added one via a migration, you can update it like this:
            // Role::where('name', $name)->update(['description' => $description]);
        }

        $this->command->info('Roles seeded and cache cleared!');
    }
}
