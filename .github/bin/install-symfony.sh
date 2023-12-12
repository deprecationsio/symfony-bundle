composer require --no-update "symfony/config=$1.*" "symfony/dependency-injection=$1.*" "symfony/http-kernel=$1.*"
composer update --prefer-dist --no-interaction --no-ansi --no-progress
