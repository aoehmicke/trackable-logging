DOCKER_CMD = docker
DOCKER_BUILD = $(DOCKER_CMD) build

NGINX_IMAGE = trackable-loggin-nginx:latest

nginx-build:
	$(DOCKER_BUILD) -t $(NGINX_IMAGE) ./nginx

nginx-run:
	$(DOCKER_CMD) run --rm -p 8080:8080 $(NGINX_IMAGE)

nuxt-dev:
	cd nuxt/app && npm run dev -- -o

nuxt-upgrade:
	cd nuxt/app && npm update

symfony-upgrade:
	cd symfony/service && composer update