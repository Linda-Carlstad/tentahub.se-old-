<p align="center"><img src="https://lindacarlstad.se/img/logo.png"></p>

# Linda Carlstad

## Description
TBA 

## Installation

#### - Unix
Follow the official Laravel documentation for a detailed walkthrough using any Unix system, like macOS or any distribution on Linux.

[Laravel documentation](https://laravel.com/docs/5.8/installation)

#### - Windows
Follow this excellent guide to run a Laravel project on your Windows based computer.

[Codementor guide](https://www.codementor.io/magarrent/how-to-install-laravel-5-xampp-windows-du107u9ji)

When steps above are done, do these steps to get going.

Fetch the project to your machine. Locate the project on your machine via the terminal and follow the steps below. 

Install all composer dependencies: 
```
composer install
```

Install all NPM dependencies: 
```
npm install
```

Copy and generate application key: 
```
cp .env.example .env
php artisan key:generate
```

Create a database in MySQL on your computer. 

Edit the `.env` file with your database credidentials. 
Here is an example:
```
DB_PORT=3306
DB_DATABASE=tentahub
DB_USERNAME=root
DB_PASSWORD=root
```

Create and seed database:
```
php artisan migrate:refresh --seed
```

Run this to generate CSS and JS files:
```
npm run dev
```

Run the local development server: 
```
php artisan serve
```

## Usage
TBA


## Contributing
#### - Issues
- Screenshot the problem
- Open a new issue
- Give it a meaningful title
- Describe the issue clearly
- Upload the screenshot
- Add useful labels
- Submit issue

#### - Coding
- See the [issue list](https://github.com/Linda-Carlstad/tentahub.se/issues)
- Assign yourself to an issue
- Open a new branch
- Create your _beautiful_ code
- Create a pull request

## Software
Recommended apps to get going fast:
- Atom/Sublime/PHPStorm
- MAMP
- Sequal Pro
- Google Chrome/Mozilla FireFox
- Sketch (design tool)

## Credits
Special thanks to Linda Carlstad It-committee 2019/2020 for creating this website.
