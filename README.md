# Mobile Device Management

## To run BackEnd

1. Navigate to the backend directory `cd backend`
2. Copy over the .example.env file `mv .env.example .env`
3. Create a database (postgres), on a mac you can use `brew servies start postgresql`
4. Manually create a database `CREATE DATABASE {database_name}`
5. Ensure the name along with the database credentials matches what you put in the .env file
6. Install dependencies `composer install`
7. Run setup script: `bash startup.sh`
8. You should be running the app on port 8000

## To run Tests

Found in `Tests/`

```bash
cd device_management/backend
composer install && ./vendor/bin/phpunit Tests
```

## Routes Defined

Found in `backend/index.php`

- GET /devices -> get all mobile devices
- GET /device/{id} -> gets a single mobile device
- GET /device/{id} -> gets a specific mobile device
- POST /device/ -> Creates a new device
- PUT /device/{id} -> Updates a device's model
- DELETE -> /delete/{id} -> Deletes a specific device

API Schema example
```bash
     { "id": "7f46c158-c2de-494d-b414-6219ac269384",
        "model": "Amazon Fire Phone",
        "os": "Android 4.2.2 Jelly Bean",
        "brand": "Amazon",
        "release_date": "2014-07",
        "received_datatime": "2023-02-09 00:00:00",
        "is_new": false,
        "created_datetime": "2023-02-09 17:11:42",
        "update_datetime": "2023-02-09 17:11:42"
    }
```

## Backend Todos

-> Add middleware for simpler and more expansive cors handling (on other request methods)
-> Look to see if things could be named better
-> Modularise more of the controller code
-> Abstract away start up process by creating docker images and user docker-compose for everything

## To Run FrontEnd

```bash
cd frontend && yarn install && yarn dev
```

## FrontEnd Todos

    - Add edit form
    - Fix registration form
    - Split components up
    - Prehaps some end-to end testing with cypress
    - Improve the design
