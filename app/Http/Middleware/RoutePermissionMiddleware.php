<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoutePermissionMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->route()?->getName();
        $permission = $this->permissionFor($routeName);

        if ($permission && ! $request->user()->can($permission)) {
            abort(403, 'Vous n’avez pas la permission d’effectuer cette action.');
        }

        return $next($request);
    }

    private function permissionFor(?string $routeName): ?string
    {
        if (! $routeName) return null;

        $exact = [
            'dashboard' => 'dashboard.view',
            'profile.edit' => 'profile.view', 'profile.update' => 'profile.update', 'profile.destroy' => 'profile.delete',
            'reunions.index' => 'reunions.view', 'reunions.create' => 'reunions.create', 'reunions.store' => 'reunions.create',
            'reunions.show' => 'reunions.view', 'reunions.edit' => 'reunions.update', 'reunions.update' => 'reunions.update',
            'reunions.destroy' => 'reunions.delete', 'reunions.export.excel' => 'reunions.export', 'reunions.export.pdf' => 'reunions.export',
            'reunions.export.detail.excel' => 'reunions.export', 'reunions.export.detail.pdf' => 'reunions.export',
            'reunions.duplicate' => 'reunions.duplicate', 'reunions.taches.reorder' => 'taches.reorder', 'reunions.taches.destroy' => 'taches.delete',
            'rapports.codir.index' => 'rapports.view', 'rapports.codir.export.excel' => 'rapports.export', 'rapports.codir.export.pdf' => 'rapports.export',
            'roles.index' => 'roles.view', 'roles.create' => 'roles.create', 'roles.store' => 'roles.create',
            'roles.edit' => 'roles.update', 'roles.update' => 'roles.update', 'roles.destroy' => 'roles.delete',
            'permissions.index' => 'permissions.view', 'permissions.create' => 'permissions.create', 'permissions.store' => 'permissions.create',
            'permissions.edit' => 'permissions.update', 'permissions.update' => 'permissions.update', 'permissions.destroy' => 'permissions.delete',
        ];

        if (isset($exact[$routeName])) return $exact[$routeName];

        if (in_array($routeName, ['cr-clienteles.export.excel', 'cr-clienteles.export.pdf'], true)) {
            return 'cr-clienteles.export';
        }

        foreach (['activites', 'taches', 'livrables', 'clients', 'cr-clienteles', 'obligations', 'users'] as $resource) {
            $prefix = $resource . '.';
            if (! str_starts_with($routeName, $prefix)) continue;
            $action = substr($routeName, strlen($prefix));
            return match ($action) {
                'index', 'show' => $resource . '.view',
                'create', 'store' => $resource . '.create',
                'edit', 'update' => $resource . '.update',
                'destroy' => $resource . '.delete',
                default => null,
            };
        }

        return null;
    }
}
