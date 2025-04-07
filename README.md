# The Haarlem Festival

A website for The Haarlem Festival which is implemented using PHP with the MVC design pattern, leveraging relational databases for data management and ensuring a user-friendly and visually appealing interface using a CSS framework Bootstrap.

<img src="app/public/assets/images/Screenshot.png" width="100%"/>

## Credentials

- Customer:
  - email: 123@mail.com
  - password: 123
- Admin:
  - email: 123admin@mail.com
  - password: 123
- Employee:
  - email: 123emp@mail.com
  - password: 123

## Usage

In a terminal, from the cloned/forked/download project folder, run:

```bash
docker compose up
docker-compose run php composer install
```

NGINX will now serve files in the app/public folder. Visit localhost in your browser to check.
PHPMyAdmin is accessible on localhost:8080

If you want to stop the containers, press Ctrl+C.

Or run:

```bash
docker compose down
```
