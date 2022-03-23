build_phpstan_image:
	cd docker && docker build . -f phpstan.Dockerfile -t php-param-generator/phpstan:latest && cd -

phpstan:
	docker run -v ${PWD}:/app --rm php-param-generator/phpstan:latest analyse -c /app/build/config/phpstan.neon

unit:
	composer phpunit

test: phpstan
	composer testall

psalm:
	composer psalm

infection:
	composer infection

infection-after-phpunit:
	composer infection-after-phpunit
