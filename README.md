# Full Installation Guide

**Thomas Blog website** is a platform where you can create and manage your own blogs. It is built using PHP and it follows the MVC architecture pattern to allow users to easily create and manage their content. This guide will walk you through the installation process step by step.

---

## Features

- Simple blog and post creation
- MVC architecture
- User authentication and management
- SQLite3 database integration

---

## Requirements

Ensure the following are installed on your system:

- Git (for cloning the repository)
- Docker (for running the application in a containerized environment)

---

## Installation Steps

### 1. Clone the Repository

#### Linux/macOS:
```bash
git clone https://github.com/ThomasLucking/php-blog.git
cd php-blog
```

### 2. Setup the localhost:

Once you have cloned the repository, you can start the local server by running the docker container by executing the following command in your terminal from the root directory of the project:
```bash
docker compose up -d
```
then the container will start up on the port 0.0.0.0:8000 and you can access the application by going to localhost:8000 in your browser.

### 3. Launch the application:

Finally, after setting up the project you can now go to the localhost:8000 by typing this in your favorite browser!
```
localhost:8000
``` 
### 4. Using the application: 

Then you can create an account and start creating your own blogs and posts! You can also manage your account and update your profile information.

### 5. Accessing the application as admin:

To access the application as admin you will have to manually create the admin user in the database. You can do this by running the following command in your terminal:

```bash
docker compose exec app sqlite3 Data/database.db
```
First you will run the schema.sql file to create the database.db then you can run the sqlite3 CLI to enter the database and run SQL commands to create an admin user. You can run the following command to import the schema.sql file into the database:
```bash
cat public/schema.sql | docker compose exec app sqlite3 Data/database.db
```

**Note:** If the database.db file was created in your root directory, you must move it into the Data folder to ensure it is saved correctly by Docker:
```bash
mv database.db Data/database.db
```

then you can update the role of your user to admin by running the following command:

```sql
update users set role = 'admin' where email = '(the email you used to create the user)';
```

or you can create an admin user directly

However, you will need to hash the password for the application to recognize it as valid. You can generate a secure password hash locally using this command:
```bash
php -r 'echo password_hash("your_password_here", PASSWORD_DEFAULT);'
```

```sql
insert into users (name, email, password, role) values ('Admin', 'admin@gmail.com', '(HashedPassword)', 'admin');
```

And there we go! You can now access the application as admin by logging in with the email and password you used to create the admin user.