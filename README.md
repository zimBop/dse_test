1. Docker setup
    * Go to the 'laradock' directory
    
    * Before first launch copy env-example.local into .env:
        ```
        cp env-example.local .env
        ```
    
    * On project first launch run: 
        ```
        sudo docker-compose build
        ```
        In case of building issues, try: `sudo docker-compose build --no-cache`
    
    * To run docker containers:
        ```
        sudo docker-compose up -d
        ```
    
    * Run 'bash' inside the 'workspace' container:
        ```
        sudo docker-compose exec -u laradock workspace bash
        ```
2. Laravel setup

    * Run commands from 'workspace' container:
        ```
        composer install
    
    * Copy .env.example into .env:
        ```
        cp .env.example .env
        ```
      
    * Apply migrations:
        ```
        php artisan migrate
        ```
      
    * Seed DB (for testing purposes)
         ```
        php artisan db:seed
        ```
