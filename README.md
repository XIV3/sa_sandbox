# Sandbox: Instant Throwaway WordPress Sites

<p align="center">
  <img src="public/favicon.ico" width="100" alt="Sandbox Logo">
</p>

<p align="center">
  <a href="https://github.com/serveravatar/sandbox/blob/main/LICENSE"><img src="https://img.shields.io/badge/License-MIT-blue.svg" alt="License"></a>
  <a href="#"><img src="https://img.shields.io/badge/PHP-8.1+-green.svg" alt="PHP Version"></a>
  <a href="#"><img src="https://img.shields.io/badge/Laravel-10.x-red.svg" alt="Laravel Version"></a>
</p>

## 📋 Overview

Sandbox is an open-source platform for creating self-destructing WordPress sites. It allows you to instantly deploy temporary WordPress environments that automatically delete after a configurable time period. Perfect for testing, demos, client presentations, and short-term projects.

### ✨ Key Features

- **Instant Deployment**: Create throwaway WordPress sites in 30 seconds
- **Self-Destructing**: Sites automatically delete after a configurable time period
- **No Setup Required**: Everything works out of the box with zero configuration
- **Fully Secured**: SSL certificates installed automatically on all sites
- **Shareable**: Public site information pages with all credentials
- **Admin Dashboard**: Manage all throwaway sites from a central admin panel
- **Email Notifications**: Optional reminders before sites are deleted
- **Highly Configurable**: Customize domain, expiration times, and more

## 🚀 The Main Instance

The quickest way to see Sandbox in action is to visit [https://sandbox.serveravatar.com](https://sandbox.serveravatar.com) and create a throwaway WordPress site with one click.

## 🔧 Installation

### Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL 5.7+ or MariaDB 10.3+
- Node.js and NPM
- A ServerAvatar account with API access (for server integration)
- Cloudflare account with API access (optional, for DNS management)

### Step 1: Clone the Repository

```bash
git clone https://github.com/serveravatar/sandbox.git
cd sandbox
```

### Step 2: Install PHP Dependencies

```bash
composer install
```

### Step 3: Install Frontend Dependencies and Build Assets

```bash
npm install
npm run build
```

### Step 4: Set Up Environment Variables

```bash
cp .env.example .env
php artisan key:generate
```

Edit the `.env` file to configure your database connection:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sandbox
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Step 5: Run Migrations and Seed Database

```bash
php artisan migrate
php artisan db:seed
```

### Step 6: Configure the Admin User

Navigate to the `/register` page in your browser and create the first user. After the first user is created, registrations can be disabled from the System Settings.

### Step 7: Configure System Settings

Log into the admin dashboard at `/admin` and navigate to the Settings page to configure:

- **Default Deletion Time**: How long temporary sites will exist before auto-deletion
- **Domain Name**: The domain to use for temporary sites
- **ServerAvatar API Integration**: Connect to your ServerAvatar account
- **Cloudflare Integration**: Connect to your Cloudflare account (optional)
- **SMTP Settings**: Configure email notifications

### Step 8: Set Up the Laravel Scheduler

The application uses Laravel's scheduler to run recurring tasks like site expiration checks. Add the scheduler to your crontab:

```bash
crontab -e
```

Then add this line to run the scheduler every minute:

```
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

This will ensure that expired sites are automatically cleaned up based on the configuration.

### Step 9: Run the Application (Development)

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser to access the application.


## 🔐 ServerAvatar API Configuration

Sandbox integrates with [ServerAvatar](https://serveravatar.com) to create and manage WordPress sites. To configure this integration:

1. Create a ServerAvatar account if you don't have one
2. Generate an API key from your ServerAvatar dashboard
3. In the Sandbox admin dashboard, go to Settings
4. Enter your ServerAvatar API URL, API key, and Organization ID
5. Test the connection

## ☁️ Cloudflare Integration (Optional)

For automatic DNS management and SSL certificates:

1. Create a Cloudflare account if you don't have one
2. Add your domain to Cloudflare and set up your DNS records
3. Generate an API key from your Cloudflare dashboard
4. In the Sandbox admin dashboard, go to Settings
5. Enter your Cloudflare Zone ID, API key, and domain
6. Upload your SSL certificate and private key
7. Test the connection

## 📧 Email Configuration

To enable email notifications for site creation and deletion reminders:

1. In the Sandbox admin dashboard, go to Settings
2. Configure your SMTP settings
3. Set up the sender name and email address
4. Test the email configuration

## 🛠️ Usage

### Create Temporary Sites

- Visit the homepage as an anonymous user to create a public temporary site
- Log in to the admin dashboard to create and manage sites
- Configure reminder emails for auto-deletion notifications

### Admin Dashboard Features

- View all created sites with status and expiration information
- Manage server connections for site deployment
- Configure system settings
- Toggle site creation from the homepage

## 🎯 Customization

### Change Default Deletion Time

1. Go to the admin dashboard → Settings
2. Select a different value for "Default Site Deletion Time"
3. Save your changes

### Update Domain Configuration

1. Go to the admin dashboard → Settings
2. Update the domain field with your custom domain
3. Ensure your Cloudflare configuration matches this domain
4. Save your changes

### Toggle Homepage Site Creation

1. Go to the admin dashboard → Settings
2. Check or uncheck "Allow site creation from homepage"
3. Save your changes

## 💡 Common Issues

### API Connection Problems

If you're having trouble connecting to the ServerAvatar API:
- Verify your API key is correct
- Ensure your Organization ID is correct
- Check that the API URL is formatted properly
- Check your server's outbound connection

### SSL Certificate Issues

If SSL certificates aren't being installed correctly:
- Make sure your Cloudflare API connection is working
- Verify your SSL certificate and private key are properly formatted
- Check that your domain is properly configured in Cloudflare

### Email Notification Issues

If email notifications aren't being sent:
- Verify your SMTP settings
- Check that your sender email address is valid
- Test the email configuration from the Settings page

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch: `git checkout -b feature/amazing-feature`
3. Commit your changes: `git commit -m 'Add some amazing feature'`
4. Push to the branch: `git push origin feature/amazing-feature`
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgements

- [Laravel](https://laravel.com) - The web framework used
- [ServerAvatar](https://serveravatar.com) - Server and application management API
- [Cloudflare](https://cloudflare.com) - DNS and SSL management
- [Bootstrap](https://getbootstrap.com) - Frontend framework
- [Tailwind CSS](https://tailwindcss.com) - Admin UI styling
- [Alpine.js](https://alpinejs.dev) - JavaScript framework

---

<p align="center">
  Made with ❤️ by <a href="https://serveravatar.com">ServerAvatar</a>
</p>