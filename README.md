# PHP Starter Template

This is a simple starter template for PHP projects. It provides a basic directory structure and configuration files to help you kickstart your PHP projects.

## Features

- Directory structure for organized development.
- Autoloading setup for efficient class loading.
- Easy pagination.
- Easy validation.

## Getting Started

1. **Clone the Repository:**

```bash
git clone https://github.com/xentixar/php_starter_template.git
```

2. **Navigate to the Project Directory:**

```bash
cd php_starter_template
```

3. **Create a .env file:**
```bash
cp .env.example .env
```

4. **Navigate to the .env file and configure database**

5. **Navigate to the .env file and replace the 'APP_URI' value to your actual directory**

6. **Navigate to the .htaccess file and replace the 'RewriteBase' value to your actual directory**

7. **Run the project:**

Start server and open browser and paste the following url :  

```bash
localhost/your_directory
```

This should display a index.php page of src directory.

## Directory Structure

php_starter_template/  
│  
├── config/  
│   └── app.php  
│   └── database.php  
│   └── environment.php  
│   └── pagination.php  
│   └── rule.php  
│   └── validation.php  
│  
├── public/  
│   └── css  
│   └── images  
│   └── js  
│  
├── src/  
│   └── index.php  
│  
├── vendor/  
│   └── autoload.php  
│  
├── .env.example  
├── .gitignore  
├── .htaccess  
└── README.md  


- **config/:** Directory for the php configuration files.
- **public/:** Directory for your assets.
- **src/:** Directory for your PHP source files.
- **vendor/:** Autoload files and composer dependencies if needed.
- **.env.example:** Environment example file.
- **.gitignore:** Git ignore file to exclude certain files/directories.
- **.htaccess:** Htaccess file to redirect all requests to src directory.
- **README.md:** Project documentation file.

## Usage

1. **Add Your Code:**

    Add your PHP code files inside the `src/` directory.

2. **Don't forget to include autoload.php file of vendor directory**

3. **To use pagination refer to the following link:**
    [Easy Pagination in PHP](https://github.com/xentixar/easy_pagination_in_php)

4. **To use validation refer to the following link:**
    [Easy Form Validation in PHP](https://github.com/xentixar/easy_php_form_validation)

5. **Start Coding:**

    Start building your PHP project! Refer to the example files for guidance.

## Contributing

1. Fork the repository.
2. Create a new branch: `git checkout -b feature-name`.
3. Commit your changes: `git commit -m 'Add new feature'`.
4. Push to the branch: `git push origin feature-name`.
5. Submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE). Feel free to use and modify it according to your needs.

Happy coding!
