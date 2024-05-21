FROM php:apache
RUN docker-php-ext-install mysqli
COPY . /var/www/html/

#de imagemoest php:apache zijn
FROM php:apache
#de php code in de image plaatsen zodat deze aan de verdere data zoals html en php code kan
COPY ./src /var/www/html
# de mysqli extensie downloaden en installeren in de image en de config file in de image zetten
RUN docker-php-ext-install mysqli && mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
#dit zou alles moeten zijn
