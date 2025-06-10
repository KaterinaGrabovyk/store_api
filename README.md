# Store API

**Store API** is a simple PHP and MySQL API project containerized with Docker, created to explore and strengthen my skills in backend development.

## Table of Contents
1. [Programs required](#programs_required)
2. [Installation](#installation)
3. [Contributing](#contributing)
   
## Programs_required
To run this program you are required to have VScode and Docker.

## Installation
1. Create folder where you would copy repo to
2. Open console and clone the repository:
    ```bash
    git clone https://github.com/KaterinaGrabovyk/book-notes.git https://github.com/KaterinaGrabovyk/store_api.git [YOUR FOLDER NAME]
    ```
3. cd into folder
4. create ***.env*** file, copy paste text from **.env.example** and fill with your data. [*](*)
5. Start Docker
6. in console, run this:
    ```bash
    docker-compose up -d --build
    docker-compose exec app composer install
    ```
7. make sure that container works in docker
8. open browser and go to **http://localhost:8000/**.
## * If you has problems with DB, try those params:

 ```bash
  DB_HOST=db
DB_USER=root
DB_PASSWORD=root
 ``` 
## Contributing
Contributions are welcome! To contribute:
1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes and commit them (`git commit -m 'Add feature'`).
4. Push to the branch (`git push origin feature-branch`).
5. Create a Pull Request.

## Built With
- PHP
- MySql
- Docker

