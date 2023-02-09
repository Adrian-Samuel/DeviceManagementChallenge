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
