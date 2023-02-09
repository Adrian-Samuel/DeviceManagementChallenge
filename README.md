# Mobile Device Management

## To run Tests

Found in `Tests/`

```bash
cd device_management/backend
composer install && ./vendor/bin/phpunit Tests
```

## Routes

Found in `backend/index.php`

- GET /devices -> get all mobile devices
- GET /device/{id} -> gets a single mobile device
- GET /device/{id} -> gets a specific mobile device
- POST /device/ -> Creates a new device
- PUT /device/{id} -> Updates a device's model
- DELETE -> /delete/{id} -> Deletes a specific device

## Backend Todos
-> Add middleware for simpler and more expansive cors handling (on other request methods)
-> Look to see if things could be named better
-> Modularise more of the controller code

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