# We gebruiken php:apache omdat we een webserver nodig hebben
FROM php:apache

# Mijn php/code staat in een mapje genoemd src dus ik zet deze vervolgens over naar de container directory
COPY ./src /var/www/html

# En dan moeten we my-sqli installeren
RUN docker-php-ext-install mysqli

#werk directory verzetten (optioneel anders zit je in de root van de container, dit kan ook)
WORKDIR /var/www/html

# COMMENTAAR VOOR DOCENT
# ik weet niet zeker of dit moet.
# mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
