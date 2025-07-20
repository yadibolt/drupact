# Drupact

Drupact is a decoupled Drupal + React project designed for API-driven development. It includes authentication, essential API endpoints, and a pre-configured PostgreSQL database to help you get started quickly.

---

## 🚀 Quick Start

### Prerequisites

- Git
- PostgreSQL
- PHP + Composer (Drupal-compatible version)
- Node.js + npm
- Web server (Apache, Nginx, or local stack like XAMPP/OpenServerPanel)

### Setup Steps

#### 1. Clone the Repository

```bash
git clone https://github.com/yadibolt/drupact.git
```

#### 2. Install PostgreSQL

Make sure PostgreSQL is running and you have created a database for Drupal.

#### 3. Install Drupal Dependencies

```bash
cd drupact/drupal
composer install
```

#### 4. Restore Database

Use the backup in the `.files/` folder to restore the PostgreSQL database. Example:

```bash
psql -U your_user -d your_database < .files/db_backup.sql
```

#### 5. Configure Drupal Settings

```bash
cp ../.files/settings.example.php sites/default/settings.php
```

#### 6. Copy the Drupal Files Directory

```bash
cp -r ../.files/files sites/default/files
```

#### 7. Install React Dependencies

```bash
cd ../react
npm install
```

---

## 🧑‍💻 Development Workflow

### React Frontend

```bash
cd react
npm run dev
```

- Visit the app at `http://localhost:<port_number>`

### Drupal Backend

- Start Apache/Nginx or a local server stack (e.g. XAMPP)
- Update `trusted_host_patterns`, `database name`, `database password` etc. in `settings.php` if necessary

---

## 🚀 Production Build & Deployment

### Build React App

```bash
cd react
npm run build
```

### Deploy

- Upload files to your server
- Set up Apache/Nginx
- Configure DNS and proxy settings

---

## 📬 Contact / Issues

Found a bug? Open an issue or pull request on GitHub.
