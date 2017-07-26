Order system
========================
**System include the following components:**

  * REST API;


use PHP7.1, Mysql5.7.19, Symfony3.3

Installation and configuration
--------------

 1 Install required libraries

   php composer.phar install

 2 Create parameters. Need copy app/parameters.yml.dist to app/parameters.yml and add params for BD.

 3 Run migration for BD
 
    php app/console  doctrine:migrations:migrate
    
 4 For REST API need use headers
 
      Accept: application/json
      Content-Type: application/json   
 

 5 REST API is available by url `{base_url}/doc` 
 
 6 There is only one test for example, see `\Tests\LoggerBundle\Services\Creator\LoggerCreatorTest`

 