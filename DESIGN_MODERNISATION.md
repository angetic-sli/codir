# Modernisation UI — CODIR APP

Interface modernisée et responsive, inspirée des principes observés sur PrepaENA : hiérarchie visuelle claire, hero avec CTA, cartes, statistiques, espaces généreux et navigation simple.

## Changements
- Landing page complète (`resources/views/welcome.blade.php`)
- Nouveau système visuel partagé (`public/css/codir-modern.css`)
- Navigation admin responsive avec sidebar mobile
- Dashboard modernisé
- Authentification et profil harmonisés
- Les vues CRUD existantes bénéficient automatiquement des nouveaux styles via le layout admin
- Aucun code ou contenu de PrepaENA n’a été copié ; seule l’inspiration UX/UI générale a été retenue.

## Lancement
```bash
npm ci
npm run build
php artisan serve
```
