# Tree example app

## Requirements

- Docker



App has 3 action _print tree_, _move node tree_ and _node sum value_ 

## Print tree

**Options**

| Option        | Description           | Required  |
| ------------- |:-------------:| -----:|
| input      | Data source file | Yes |

**Command**

``docker-compose exec php-fpm bin/console tree:print --input=tree.csv``


## Move tree

**Options**

| Option        | Description           | Required  |
| ------------- |:-------------:| -----:|
| input      | Data source file | Yes |
| id      | Node id | Yes |
| parentId      | New parent node id | Yes |
| output      | Export file name | No |

**Command**

``docker-compose exec php-fpm bin/console tree:move --input tree.csv --id=31 --newParent=13 --output=output.csv``


## Sum tree

**Options**

| Option        | Description           | Required  |
| ------------- |:-------------:| -----:|
| input      | Data source file | Yes |
| id      | Node id | Yes |

**Command**

``docker-compose exec php-fpm bin/console tree:sum --input tree.csv --id=31``


**Run tests**

``docker-compose exec -T php-fpm vendor/bin/phpunit tests/Unit
``
