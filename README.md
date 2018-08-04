# Football API


### Installation
```sh
$ git clone git clone git@github.com:serjyeah/footballapi.git
$ cd footballapi
$ composer install
```
Edit .env file to change parameter of the DB connection. Then run:
```sh
$ bin/console doctrine:migrations:migrate
$ bin/console doctrine:fixtures:load
```
### ToDo

- Create validation for input data
- Catch exceptions and show error responses in a nice way
- Create OpenApi documentation

### Usage
*Get all teams of a specific league*
``
[GET] /league/{id}/teams 
``
#### Response
``
[
    {
        "id": 1,
        "name": "AC London",
        "strip": "red"
    },
    {
        "id": 6,
        "name": "Bagshot",
        "strip": "black and white"
    },
    {
        "id": 7,
        "name": "Cadbury Athletic",
        "strip": "orange"
    },
    {
        "id": 9,
        "name": "Callington Town",
        "strip": "white"
    }
]
``
*Create a football team*

``
[POST] /league/{id}/team
``
#### Payload

`` {"name":"tavria",
"strip":"pink"}`` 

#### Response

``["ok"]``

*Modify all attributes of a football team*

``[PATCH] /team/{id}``

#### Payload

`` {"name":"tavria",
"strip":"pink",
"league": 6}``

#### Response

``{
    "id": 4,
    "name": "tavria",
    "strip": "pink"
}``

*Delete a league*

``[DELETE] /league/{id}``





