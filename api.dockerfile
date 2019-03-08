FROM php:7.1-fpm
# Get repository and install 
RUN apt-get update && apt-get install -y \
        libaio1 \
				vim \
				unzip \
				curl \
				wget \
				build-essential \
				libssl-dev \
				libmcrypt-dev \
				libpq-dev \
				libpng-dev \
                libxml2-dev
			

# Instalação da extenção PHP intl(internationalization)
#RUN docker-php-ext-configure intl && docker-php-ext-install intl 
RUN docker-php-ext-install mcrypt mysqli pgsql pdo pdo_mysql pdo_pgsql
RUN docker-php-ext-install bcmath ctype xml dom
RUN docker-php-ext-install simplexml
RUN docker-php-ext-install soap
RUN apt-get install -y libxslt-dev
RUN docker-php-ext-install xsl 
RUN docker-php-ext-install zip
RUN docker-php-ext-install json
RUN docker-php-ext-install iconv 
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
 
#RUN docker-php-ext-configure mcrypt mysqli pgsql pdo pdo_mysql pdo_pgsql

# instalacao composer
RUN curl -sS http://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

ADD docker/laravel-postinstall.sh /usr/bin/
# Clean
RUN apt-get clean -y