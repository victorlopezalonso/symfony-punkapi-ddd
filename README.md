# Symfony DDD PunkApi
API Rest para obtener un listado de cervezas que combinen con una comida pasada por parámetro y poder ver el detalle de una cerveza concreta.

Proyecto creado en symfony 5.4 usando DDD, arquitectura hexagonal y gestión de ramas con git flow.

### Tareas por hacer
- [ ] Crear controlador para el servicio de búsqueda, gestionar validaciones y transformar objeto de respuesta.
- [ ] Añadir función al repositorio existente y crear servicio de aplicación y test unitario para mostrar los datos de una cerveza especifica según el ID proporcionado.
- [ ] Añadir funcionalidad al repositorio de PunkApi y test de integración para el servicio de detalle de una cerveza.
- [ ] Crear controlador para el servicio de detalle y transformar objeto de respuesta.
- [ ] Cachear las peticiones a PunkApi temporalmente mediante FileSystem o Redis.
- [ ] Construir documentación del API mediante OpenAPI.
- [ ] Crear test funcionales mediante Behat.

### Tareas completadas ✓
- [x] Análisis de proyecto e investigación del API que provee [PunkApi](https://punkapi.com/documentation/v2).
- [x] Inicialización del proyecto con Symfony 5.4.
- [x] Mover código de src a app para desacoplar el framework de la arquitectura y asociar src con vendor del proyecto.
- [x] Añadir dependencias de Symfony, php-cs-fixer, PHPUnit y Guzzle.
- [x] Crear normalizador de respuestas, errores y excepciones de API.
- [x] Añadir interfaz de repositorio de cervezas.
- [x] Añadir servicio de aplicación y test unitario para buscar una cerveza mediante una cadena de caracteres. (El campo a filtrar será "food").
- [x] Añadir al dominio el modelo y los value objects necesarios.
- [x] Crear repositorio de PunkApi en la capa de infraestructura.
- [x] Test de integración para el servicio de búsqueda.
