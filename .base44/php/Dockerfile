# Sandbox-only runtime image for this Laravel app (used by docker-compose.base44.yml).
#
# It only bakes in the PHP extensions and tooling the app needs — the application
# source is bind-mounted from the sandbox at runtime, so code edits never require
# an image rebuild.
FROM php:8.0-cli

# php:8.0 is the last PHP 8.0 line and is based on Debian bullseye, which has moved off
# the live mirrors — package downloads from deb.debian.org now 404. Point apt at the
# Debian archive (and skip its expired Release check) to get the two CLI tools Composer
# needs to unpack dists. pdo_mysql is compiled from the bundled sources: the image ships
# the build toolchain, so no extra dev packages are required.
RUN set -eux; \
    sed -i 's|deb.debian.org|archive.debian.org|g' /etc/apt/sources.list; \
    apt-get -o Acquire::Check-Valid-Until=false update; \
    apt-get install -y --no-install-recommends unzip git; \
    rm -rf /var/lib/apt/lists/*; \
    docker-php-ext-install -j"$(nproc)" pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
