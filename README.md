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

By default, newly registered users have a standard role. To perform administrative actions, you must manually elevate a user to the admin role within the SQLite database.

To get the docker id just run the following command
```bash
docker ps
```
and then you can access the container by running the following command:

```bash
docker exec -it container_id sh
```

then you need to open the database in the sqlite3 command line interface by running the following command:
```bash
sqlite3 Data/database.db
```
to exit the sqlite3 command line interface, you can type `.exit` and press enter.

then you can update the role of the user to admin by running the following SQL command:
```sql
update users set role = 'admin' where email = '(the email you used to create the user)';
```

or you can create an admin user directly

However, you will need to hash the password for the application to recognize it as valid. You can generate a secure password hash locally using this command:
```bash
php -r 'echo password_hash("your_password_here", PASSWORD_DEFAULT);'
```
Then you can insert the new user inside the users table.

```sql
insert into users (name, email, password, role) values ('Admin', 'admin@gmail.com', '(HashedPassword)', 'admin');
```

And there we go! You can now access the application as admin by logging in with the email and password you used to create the admin user.