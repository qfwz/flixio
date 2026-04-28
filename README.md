# Flixio
Simple movie web app built with PHP & MySQL. A work in progress; currently adding more features.

## Setup
1. Import database.sql
2. Run docker compose up
3. Access http://localhost:8080

## Default Users
Admin:
- username: admin
- password: admin123
User:
- username: user
- password: user123
(passwords are hashed in database)

## Features
![Login](assets/preview/login.png)
- Log in (admin/user roles)

![Dashboard](assets/preview/index.png)
- Dashboard with movie list

![Add](assets/preview/add-movie.png)
- Add movie (admin)

![Edit and Delete](assets/preview/detail.png)
- Edit movie (admin)
- Delete movie (admin)

![Review](assets/preview/add-review.png)
- Add rating & review

## Tech Stack
- PHP
- MySQL
- CSS
- JavaScript
