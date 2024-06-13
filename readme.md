# MuscleMind

MuscleMind is a fitness tracking web application built with Symfony. It allows users to track their workout sessions, monitor their performance, and manage their fitness goals. The application includes features for creating and managing sessions, tracking performance metrics, and visualizing progress through charts.

## Features

- User Authentication and Authorization
- Create and Manage Workout Sessions
- Track Performance Metrics
- Visualize Progress with Charts
- Manage User Roles (Admin, Moderator, User)
- Responsive UI built with Twig templates

## Getting Started

### Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP 8.1 or higher
- Composer
- Symfony CLI
- A web server like Laragon or Nginx
- A database system like MySQL

###  Installation

**Clone the repository**

```bash
git clone https://github.com/Aminebncd/muscleMind.git
cd muscleMind
```

**Install dependencies**

```bash
composer install
```

**Set up environment variables**

Copy the `.env` file and adjust the configuration for your database and other settings.

```bash
cp .env .env.local
```

**Run database migrations**

```bash
php bin/console doctrine:migrations:migrate
```

**Load initial data (optional)**

```bash
use the insert requests in my database.sql file
```

**Start the Symfony server**

```bash
symfony server:start
```

**Access the application**

Open your web browser and navigate to http://localhost:8000.

## Usage

### User Roles

- **Admin**: Can manage users, assign roles, and perform all actions available to moderators and regular users.
- **Moderator**: Can create, edit, and delete resources.
- **User**: Can create and manage their own sessions and track performance.

### Tracking Performance

1. Log In
2. Create a New Program: Navigate to the program creation page and fill in the required details.
3. Schedule those programs in Sessions
4. Track Your Performance: Use the performance tracking forms to log your workout metrics.
5. View Progress: Access your profile to see charts and statistics of your tracked performance.

### Managing Users

Admins can manage user roles and view user details through the admin panel.

### Visualizing Data

The application uses chart.js to visualize user performance and activity data. These charts help users understand their progress over time.

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a new feature branch (`git checkout -b feature/your-feature`).
3. Commit your changes (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature/your-feature`).
5. Create a new Pull Request.

## License

This project is licensed under the MIT License. See the LICENSE file for more information.

## Acknowledgements

- Symfony Framework
- Doctrine ORM
- KnpPaginatorBundle
- Chart.js
