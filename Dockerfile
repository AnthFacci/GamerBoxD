# Use uma imagem base do PHP com Apache
FROM php:8.0-apache

# Instale dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo_mysql zip

# Configure o Apache
RUN a2enmod rewrite

# Copie arquivos do aplicativo para o contêiner
COPY . /var/www/html/

# Configure permissões
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponha a porta 80 do contêiner
EXPOSE 80

# Comando inicial
CMD apache2-foreground
