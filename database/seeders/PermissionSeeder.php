<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public const PERMISSIONS = [
        'dashboard.view', 'profile.view', 'profile.update', 'profile.delete',
        'reunions.view', 'reunions.create', 'reunions.update', 'reunions.delete', 'reunions.export', 'reunions.duplicate',
        'taches.view', 'taches.create', 'taches.update', 'taches.delete', 'taches.reorder',
        'activites.view', 'activites.create', 'activites.update', 'activites.delete',
        'livrables.view', 'livrables.create', 'livrables.update', 'livrables.delete',
        'clients.view', 'clients.create', 'clients.update', 'clients.delete',
        'cr-clienteles.view', 'cr-clienteles.create', 'cr-clienteles.update', 'cr-clienteles.delete', 'cr-clienteles.export',
        'obligations.view', 'obligations.create', 'obligations.update', 'obligations.delete',
        'rapports.view', 'rapports.export',
        'users.view', 'users.create', 'users.update', 'users.delete',
        'roles.view', 'roles.create', 'roles.update', 'roles.delete',
        'permissions.view', 'permissions.create', 'permissions.update', 'permissions.delete',
    ];

    public function run(): void
    {
        foreach (self::PERMISSIONS as $name) Permission::findOrCreate($name, 'web');

        $all = Permission::where('guard_name', 'web')
            ->whereIn('name', self::PERMISSIONS)
            ->get();

        $admin = Role::findOrCreate('admin', 'web');
        $admin->syncPermissions($all);

        $memberCodir = Role::findOrCreate('membre_codir', 'web');
        $memberCodir->syncPermissions($all->reject(fn ($p) => in_array($p->name, [
            'users.create', 'users.update', 'users.delete',
            'roles.view', 'roles.create', 'roles.update', 'roles.delete',
            'permissions.view', 'permissions.create', 'permissions.update', 'permissions.delete',
        ], true)));

        $member = Role::findOrCreate('membre', 'web');
        $member->syncPermissions([
            'dashboard.view', 'profile.view', 'profile.update',
            'reunions.view', 'reunions.create', 'reunions.update', 'reunions.export', 'reunions.duplicate',
            'taches.view', 'taches.create', 'taches.update', 'taches.reorder',
            'activites.view', 'activites.create', 'activites.update',
            'livrables.view', 'livrables.create', 'livrables.update',
            'clients.view', 'clients.create', 'clients.update',
            'cr-clienteles.view', 'cr-clienteles.create', 'cr-clienteles.update', 'cr-clienteles.export',
            'obligations.view', 'obligations.create', 'obligations.update',
            'rapports.view', 'rapports.export', 'users.view',
        ]);

        $invite = Role::findOrCreate('invite', 'web');
        $invite->syncPermissions([
            'dashboard.view', 'profile.view', 'reunions.view', 'taches.view', 'activites.view',
            'livrables.view', 'clients.view', 'cr-clienteles.view', 'obligations.view', 'rapports.view',
        ]);
    }
}
