# MuscleMind React Frontend

Interface utilisateur construite avec React 18, Vite et Material UI.

## Installation

```bash
cd frontend
npm install
npm run dev
```

Le serveur Vite écoute sur `http://localhost:5173` et proxifie les appels `/api` vers le backend Symfony.

## Architecture

- `src/pages` : vues (connexion, programmes, sessions)
- `src/components` : composants réutilisables (`ResourceList`, `ResourceForm`)
- `src/context` : contexte global pour l'authentification
- `src/services` : client HTTP Axios + fonctions métiers
- `src/styles.scss` : styles globaux

## Authentification

- Le token JWT est stocké dans `localStorage` via `AuthContext`.
- Le hook `useAuth` expose `login`, `logout`, `token` et `isAuthenticated`.
- Les routes protégées utilisent `PrivateRoute` dans `App.jsx`.

## Appels API

Les données sont chargées avec React Query (`useQuery`, `useMutation`). Les états de chargement/erreur sont affichés via Material UI.

## Tests

Un setup Vitest + React Testing Library est configuré via la commande :

```bash
npm run test
```

Ajoutez vos tests dans `src/components/__tests__` ou `src/pages/__tests__` selon les cas d'utilisation.
