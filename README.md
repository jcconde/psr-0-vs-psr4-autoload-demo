# PSR-0 y PSR-4 Autoload Demo (PHP)

Este proyecto es un ejemplo mínimo que muestra cómo funcionan los estándares de autoloading PSR-0 y PSR-4 con Composer en PHP. Incluye dos clases `HelloWorld` ubicadas en diferentes estructuras de directorios para ilustrar las convenciones de cada PSR y cómo Composer las resuelve automáticamente.

## Requisitos
- PHP 8.x (funciona también con versiones 7.x comunes)
- Composer 2.x

## Estructura del proyecto
```
.
├─ composer.json
├─ index.php
├─ src/
│  ├─ PSR0/
│  │  └─ Demo/HelloWorld.php  ← clase cargada vía PSR-0
│  └─ PSR4/
│     └─ Demo/HelloWorld.php  ← clase cargada vía PSR-4
└─ vendor/                     ← generado por Composer
```

## Instalación
1. Instala dependencias y genera autoloaders:
   ```bash
   composer install
   ```
   Si ya existe `vendor/`, puedes refrescar el autoloader con:
   ```bash
   composer dump-autoload
   ```

## Ejecución rápida
Ejecuta el archivo principal para ver ambos saludos:
```bash
php index.php
```
Salida esperada:
```
Hello from PSR-0!
Hello from PSR-4!
```

## ¿Cómo funciona aquí el autoloading?
- En `composer.json` se declaran dos reglas de autoload:
  ```json
  {
    "autoload": {
      "psr-0": {
        "PSR0\\Demo\\": "src/PSR0/"
      },
      "psr-4": {
        "PSR4\\Demo\\": "src/PSR4/"
      }
    }
  }
  ```
- PSR-0 (legacy): el namespace `PSR0\Demo` se mapea a `src/PSR0/`. Las barras del namespace se convierten en directorios. Ej.: `PSR0\Demo\HelloWorld` → `src/PSR0/Demo/HelloWorld.php`.
- PSR-4 (recomendado): el namespace raíz `PSR4\Demo` se mapea a `src/PSR4/`. Composer resuelve la clase `PSR4\Demo\HelloWorld` en `src/PSR4/Demo/HelloWorld.php` sin reglas especiales heredadas.

En `index.php` se importan ambas clases y se instancian:
```php
use PSR0\Demo\HelloWorld as HelloWorld0;
use PSR4\Demo\HelloWorld as HelloWorld4;

$psr0 = new HelloWorld0();
$psr4 = new HelloWorld4();

echo $psr0->greet() . PHP_EOL;
echo $psr4->greet() . PHP_EOL;
```

## Comandos útiles
- Regenerar autoloaders después de mover/añadir clases:
  ```bash
  composer dump-autoload -o
  ```
  La opción `-o` (optimize) genera un classmap optimizado para producción.

## Notas
- PSR-0 está obsoleto; se muestra sólo con fines educativos. Para nuevos proyectos, usa PSR-4.
- Este repositorio mantiene ambas variantes para comparar estructuras y resolver dudas de migración.

---
Última actualización: 2025-11-06
