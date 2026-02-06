# Full Installation Guide

**Thomas Blog website** is a platform where you can create and manager your own blogs. It is built using PHP and it follows the MVC architecture pattern. to allow users to easily create and manage their content. This guide will walk you through the installation process step by step.

---

## Features

- Simple blog and post creation
- MVC architecture
- User authentication and management
- SQLite3 database integration

---

## Requirements

Ensure the following are installed on your system:

- PHP (higher recommended)
- Composer (PHP dependency manager)
- Git (for cloning the repository)

---

## Installation Steps

### 1. Clone the Repository

#### Linux/macOS:
```bash
git clone https://github.com/ThomasLucking/php-blog.git
cd php-blog
```

### 2. Setup the localhost:

Once you have cloned the repository, you can start the localserver by running the docker containuer by executing the following command in your terminal from the root directory of the project:
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

first you have to access the SQLITE database by running the following command in your terminal from the root directory of the project:
```bash
docker compose exec app sqlite3 Data/database.db
```
this will connect you to the SQLite3 CLI, then you can run the following command to create a new user:

```sql
update users set role = 'admin' where email = '(the email you used to create the user)';
```

or you can create directly an admin user by running this command, you will first have to hash the password you want to use for the admin user using the following command in your terminal:

However, you will need to hash the password otherwise the application will not recognize it as a valid password, you can hash the password using the following website I found online:

(Click here)[https://bcrypt-generator.com/]


```sql
insert into users (name, email, password, role) values ('Admin', 'admin@gmail.com', '(HashedPassword)', 'admin');
```

And there we go! You can now access the application as admin by logging in with the email and password you used to create the admin user.