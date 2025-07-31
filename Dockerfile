FROM ubuntu:22.04

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        apache2 \
        php \
        php-bcmath \
        php-bz2 \
        php-curl \
        php-gd \
        php-php-gettext \
        php-intl \
        php-ldap \
        php-mbstring \
        php-mysql \
        php-xml \
        php-zip \
        git \
        curl \
        tftp-hpa \
        nfs-common \
	ca-certificates \
    && rm -rf /var/lib/apt/lists/*


RUN a2enmod rewrite \
 && mkdir -p /var/lib/php/sessions \
 && chown -R www-data:www-data /var/lib/php/sessions \
 && sed -i 's|;session.save_path =.*|session.save_path = "/var/lib/php/sessions"|' /etc/php/*/apache2/php.ini

COPY fog.conf /etc/apache2/sites-available/fog.conf
RUN a2dissite 000-default && a2ensite fog

RUN git clone --depth 1 --branch stable https://github.com/FOGProject/fogproject.git /opt/fogproject

RUN rm -rf /var/www/html/* \
    && mkdir -p /var/www/html/fog \
    && cp -R /opt/fogproject/packages/web/. /var/www/html/fog/

RUN mkdir -p /tftpboot \
    && ( [ -d /opt/fogproject/packages/tftpboot ] && cp -R /opt/fogproject/packages/tftpboot/. /tftpboot/ || true )

RUN mkdir -p /images/dev /opt/fog/snapins \
    && chown -R www-data:www-data /images /opt/fog/snapins

COPY config.class.php /var/www/html/fog/lib/fog/config.class.php

RUN touch /var/www/html/fog/fog_login_accepted.log \
    && chown -R www-data:www-data /var/www/html/fog

EXPOSE 80 443

CMD ["apachectl", "-D", "FOREGROUND"]
