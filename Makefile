SYMFONY  = bin/console
COMPOSER = composer
PHP_ENV = php

##
## Quality
## -------
##

ARTEFACTS = var/artefacts


phploc: ## PHPLoc (https://github.com/sebastianbergmann/phploc)
	$(PHP_ENV) ./bin/phploc src/


pdepend: artefacts ## PHP_Depend (https://pdepend.org)
	$(PHP_ENV) ./bin/pdepend \
		--summary-xml=$(ARTEFACTS)/pdepend_summary.xml \
		--jdepend-chart=$(ARTEFACTS)/pdepend_jdepend.svg \
		--overview-pyramid=$(ARTEFACTS)/pdepend_pyramid.svg \
		src/

phpmd: artefacts ## PHP Mess Detector (https://phpmd.org)
	$(PHP_ENV) ./bin/phpmd src/ html .phpmd.xml --reportfile $(ARTEFACTS)/phpmd.html

php_codesnifer: ## PHP_CodeSnifer (https://github.com/squizlabs/PHP_CodeSniffer)
	$(PHP_ENV) ./bin/phpcs -v --colors --standard=.phpcs.xml src

phpcpd: ## PHP Copy/Paste Detector (https://github.com/sebastianbergmann/phpcpd)
	$(PHP_ENV) ./bin/phpcpd src

phpmetrics: artefacts ## phpmetrics: ## PhpMetrics (http://www.phpmetrics.org)
	$(PHP_ENV) ./bin/phpmetrics --report-html=$(ARTEFACTS)/phpmetrics src

php-cs-fixer: ## php-cs-fixer (http://cs.sensiolabs.org)
	$(PHP_ENV) ./bin/php-cs-fixer fix --dry-run --using-cache=no --verbose --diff

php-cs-fixer-fix: ## php-cs-fixer fix
	$(PHP_ENV) ./bin/php-cs-fixer fix --using-cache=no --verbose --diff

twigcs: ## twigcs (https://github.com/allocine/twigcs)
	$(PHP_ENV) ./bin/twigcs lint templates

artefacts:
	mkdir -p $(ARTEFACTS)

.PHONY: lint lt ly phploc pdepend phpmd php_codesnifer phpcpd phpdcd phpmetrics php-cs-fixer apply-php-cs-fixer artefacts



.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' Makefile | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help