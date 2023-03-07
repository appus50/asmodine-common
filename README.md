# Librairie Asmodine Symfony

## Documentation Diverse

[Command](./doc/command.md)

## Documentation Dans le code

### Morpho
#### Body

En cas de doute voir des schémas correspondant à la recherche : "body measurement chart" [exemple](https://de.123rf.com/photo_97129652_woman-body-measurement-chart-scheme-for-measurement-human-body-for-sewing-clothes-female-figure-fron.html).

[Code](src/Domain/Body.php) => [Traduction](translations/morpho.fr.yaml)

#### Eye / Hair / Skin

Code :
- [Eye](src/Domain/Morphotype/Eye.php)
- [Hair](src/Domain/Morphotype/Hair.php)
- [Skin](src/Domain/Morphotype/Skin.php)

Traduction :
- [Traduction](translations/morpho.fr.yaml)

## Exceptions

Les exceptions inclus dans ce bundle sont traduites et envoyer dans le channel **exception**.

Pensez à ajouter les configs suivantes
 

````yaml
framework:
    translator:
        paths:
            - '%kernel.project_dir%/vendor/asmodine/common/translations'
````
 
/config/packages/monolog.yaml

`````yaml
monolog:
    channels: ['exception']

`````

## Logger Factory

Pour utiliser la class LoggerFactory, ajouter ceci dans le fichier **kernel.php** de l'appli.

````php
    protected function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new LoggerFactoryPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 1);
    }
````
