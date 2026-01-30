# AttendancePro — Système de Gestion de Présence ⏱️

AttendancePro est un système moderne et intuitif de gestion des présences, conçu pour offrir une expérience utilisateur premium tant sur bureau que sur mobile.

## ✨ Fonctionnalités

- **Tableau de bord interactif** : Visualisez en temps réel les statistiques quotidiennes (présents, retards, absents).
- **Gestion des Employés** : Ajoutez, modifiez et gérez les profils complets de vos collaborateurs.
- **Gestion des Départements** : Organisez votre structure d'entreprise simplement.
- **Pointage Temps Réel** : Système de check-in/check-out rapide avec horodatage précis.
- **Design Premium** : Interface moderne basée sur le Glassmorphism, typo Outfit et animations fluides.
- **Mobile-First** : Navigation optimisée pour les smartphones avec menu latéral interactif.

## 🚀 Installation Locale

Suivez ces étapes pour installer le projet sur votre machine :

### 1. Prérequis

Assurez-vous d'avoir installé :
- **PHP** (>= 8.2)
- **Composer**
- **Node.js & NPM**
- **SQLite** (par défaut) ou un autre système de base de données.

### 2. Clonage et Dépendances

```bash
# Clonez le projet (si applicable) ou accédez au dossier
cd attendance-system

# Installez les dépendances PHP
composer install

# Installez les dépendances JavaScript
npm install
```

### 3. Configuration de l'Environnement

```bash
# Créez le fichier .env
cp .env.example .env

# Générez la clé d'application
php artisan key:generate
```

> [!TIP]
> Par défaut, le projet est configuré pour utiliser **SQLite**. Laravel créera automatiquement le fichier `database/database.sqlite` pour vous.

### 4. Base de Données

Exécutez les migrations pour créer les tables et ajoutez des données de test (optionnel) :

```bash
php artisan migrate --seed
```

### 5. Lancement de l'Application

Vous devez lancer deux terminaux :

**Terminal 1 (Serveur PHP) :**
```bash
php artisan serve
```

**Terminal 2 (Compilation Assets) :**
```bash
npm run dev
```

Accédez ensuite à l'adresse suivante dans votre navigateur : `http://localhost:8000`

## 🛠️ Stack Technique

- **Backend** : Laravel 12
- **Frontend** : Blade, Tailwind CSS, Alpine.js
- **Build Tool** : Vite
- **Base de données** : SQLite (ou MySQL/PostgreSQL)

## 📱 Aperçu Mobile

Le système utilise Alpine.js pour une navigation latérale fluide sur mobile, garantissant que toutes les fonctionnalités restent accessibles en déplacement.

---
Développé avec ❤️ pour une gestion du personnel simplifiée.
