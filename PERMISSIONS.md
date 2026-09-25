# Comigest — Permissions

L'application utilise `spatie/laravel-permission` avec une autorisation centrale par nom de route et des contrôles `@can(...)` dans les vues.

## Permissions disponibles

### Tableau de bord et profil
- `dashboard.view`
- `profile.view`
- `profile.update`
- `profile.delete`

### Réunions
- `reunions.view`
- `reunions.create`
- `reunions.update`
- `reunions.delete`
- `reunions.export`
- `reunions.duplicate`

### Tâches
- `taches.view`
- `taches.create`
- `taches.update`
- `taches.delete`
- `taches.reorder`

### Activités
- `activites.view`
- `activites.create`
- `activites.update`
- `activites.delete`

### Livrables
- `livrables.view`
- `livrables.create`
- `livrables.update`
- `livrables.delete`

### Clients
- `clients.view`
- `clients.create`
- `clients.update`
- `clients.delete`

### CR clientèle
- `cr-clienteles.view`
- `cr-clienteles.create`
- `cr-clienteles.update`
- `cr-clienteles.delete`
- `cr-clienteles.export`

### Obligations
- `obligations.view`
- `obligations.create`
- `obligations.update`
- `obligations.delete`

### Rapports
- `rapports.view`
- `rapports.export`

### Utilisateurs
- `users.view`
- `users.create`
- `users.update`
- `users.delete`

### Rôles
- `roles.view`
- `roles.create`
- `roles.update`
- `roles.delete`

### Permissions
- `permissions.view`
- `permissions.create`
- `permissions.update`
- `permissions.delete`

## Rôles par défaut

### `admin`
Accès complet. Un `Gate::before` lui donne également l'accès aux nouvelles permissions ajoutées avant un prochain seeding.

### `membre_codir`
Accès complet aux fonctions métier, sans gestion des utilisateurs, rôles et permissions.

### `membre`
Accès opérationnel courant : réunions, tâches, activités, livrables, clients, CR clientèle, obligations et rapports, avec les droits de création/modification nécessaires mais sans suppression des données métier.

### `invite`
Lecture seule sur les principaux modules.

## Installation / synchronisation

Après installation ou mise à jour :

```powershell
php artisan migrate
php artisan db:seed --class=PermissionSeeder
php artisan optimize:clear
```

Pour reconstruire complètement une base de développement :

```powershell
php artisan migrate:fresh --seed
```

Ne pas utiliser `migrate:fresh` sur une base de production contenant des données à conserver.
