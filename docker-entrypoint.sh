#!/bin/sh
set -e

PARAMS_FILE="app/config/parameters.php"

# Garante que as pastas graváveis existem (importante se forem volumes vazios)
mkdir -p var/cache var/logs var/sessions img download upload
chown -R www-data:www-data var img download upload app/config modules 2>/dev/null || true

# Só gera parameters.php se ainda não existir (não sobrescreve config já feita,
# nem troca secret/cookie_key de um deploy pro outro — isso derrubaria sessões).
if [ ! -f "$PARAMS_FILE" ] && [ -n "$DB_HOST" ]; then
    echo "Gerando $PARAMS_FILE a partir das variáveis de ambiente..."
    php -r '
        $secret = bin2hex(random_bytes(32));
        $cookieKey = bin2hex(random_bytes(32));
        $cookieIv = base64_encode(random_bytes(24));

        $params = [
            "parameters" => [
                "database_host" => getenv("DB_HOST"),
                "database_port" => getenv("DB_PORT") ?: "",
                "database_name" => getenv("DB_NAME"),
                "database_user" => getenv("DB_USER"),
                "database_password" => getenv("DB_PASSWORD"),
                "database_prefix" => getenv("DB_PREFIX") ?: "ps_",
                "database_engine" => "InnoDB",
                "mailer_transport" => "smtp",
                "mailer_host" => "127.0.0.1",
                "mailer_user" => null,
                "mailer_password" => null,
                "secret" => $secret,
                "ps_caching" => "CacheMemcache",
                "ps_cache_enable" => false,
                "locale" => "pt-BR",
                "use_debug_toolbar" => false,
                "cookie_key" => $cookieKey,
                "cookie_iv" => $cookieIv,
            ],
        ];

        file_put_contents(
            "app/config/parameters.php",
            "<?php return " . var_export($params, true) . ";\n"
        );
    '
    chown www-data:www-data "$PARAMS_FILE"
fi

exec "$@"
