# Respuestas a las Preguntas de Comprobación (Sección 16)
**Universidad de La Salle — Asignatura: Bases de Datos**  
**Docente:** Gabriel Barrera · 2026  
**Guía:** *De MySQL a una aplicación web con PHP*

---

### 1. ¿Por qué `http://localhost:3306` no es una dirección válida para abrir phpMyAdmin?
- **Razón técnica:** El puerto `3306` corresponde al socket de red del motor de bases de datos **MySQL/MariaDB**, el cual se comunica usando un protocolo binario propietario de MySQL, no el protocolo **HTTP/HTTPS** que interpretan los navegadores web.
- **Cómo se abre:** `phpMyAdmin` es una aplicación web escrita en PHP que corre bajo el servidor web **Apache** (usualmente en el puerto `80` o `8080`). Por tanto, la URL correcta es:
  - `http://localhost/phpmyadmin/` (o `http://localhost:8080/phpmyadmin/`).

---

### 2. ¿Cuál es la diferencia entre Apache y MySQL?
| Característica | Apache | MySQL / MariaDB |
| :--- | :--- | :--- |
| **Rol** | Servidor web HTTP | Sistema de Gestión de Bases de Datos Relacionales (RDBMS) |
| **Función principal** | Recibe peticiones de clientes/navegadores, ejecuta el intérprete de PHP y devuelve documentos HTML, CSS o JSON. | Almacena, organiza, indexa y recupera datos estructurados en tablas y esquemas. |
| **Protocolo/Puerto** | HTTP (80 / 8080) | Protocolo MySQL (3306 / 3307) |
| **Lenguaje de operación**| Directivas de servidor / scripts PHP | Consultas SQL (`SELECT`, `INSERT`, `UPDATE`, etc.) |

---

### 3. ¿Por qué un archivo PHP no debe abrirse con doble clic?
- Al hacer doble clic sobre un archivo `.php`, el sistema operativo lo abre en el navegador usando el protocolo local `file:///C:/...`.
- El navegador web no tiene un motor intérprete de PHP integrado; sólo entiende HTML, CSS y JavaScript. Si se abre con doble clic, el navegador simplemente mostrará el código PHP en texto plano o descargará el archivo.
- Para ejecutarse, el código PHP **debe ser procesado por el servidor web (Apache) a través de una petición HTTP** (`http://localhost/...`), donde el servidor ejecuta la lógica, procesa la base de datos y le envía al navegador únicamente el resultado final en HTML.

---

### 4. ¿Qué cambia en `conexion.php` si MySQL escucha en el puerto 3307?
- En el archivo `conexion.php` se debe actualizar la variable del puerto:
  ```php
  $puerto = '3307';
  ```
- Al cambiarla, la cadena DSN (Data Source Name) enviada al constructor de PDO:
  `"mysql:host=$servidor;port=$puerto;dbname=$baseDatos;charset=utf8mb4"`
  apuntará al puerto `3307` donde el motor MySQL está escuchando, evitando el error `SQLSTATE[HY000] [2002] Connection refused`.

---

### 5. ¿Qué diferencia existe entre `query()`, `prepare()` y `execute()`?
- **`query()`:** Ejecuta una instrucción SQL de forma inmediata y directa en una sola llamada. Se debe usar **únicamente para consultas estáticas/fijas** donde no intervienen variables enviadas por usuarios (por ejemplo: `SELECT * FROM estudiantes`).
- **`prepare()`:** Compila y analiza la sintaxis SQL en el motor de base de datos creando un objeto `PDOStatement`, usando marcadores de posición (`:nombre` o `?`). Separa la estructura SQL de los datos.
- **`execute()`:** Envía los valores de los parámetros y ejecuta la consulta previamente compilada. **Garantiza protección contra ataques de Inyección SQL (SQL Injection)**, ya que el motor trata los datos como literales y no como código ejecutable.

---

### 6. ¿Por qué no debemos mostrar directamente en HTML los datos de la base sin `htmlspecialchars()`?
- Porque los datos almacenados en la base de datos pueden contener caracteres con significado especial en HTML como `<`, `>`, `&`, `"`, `'`.
- Si un usuario inserta texto malicioso como `<script>alert('XSS')</script>` y se muestra directamente, el navegador lo interpretará como código JavaScript en vivo, provocando una vulnerabilidad de **Cross-Site Scripting (XSS)**.
- `htmlspecialchars($dato, ENT_QUOTES, 'UTF-8')` convierte estos caracteres en sus respectivas entidades HTML seguras (por ejemplo, `<` se convierte en `&lt;`), neutralizando el ataque y mostrando el texto tal como fue escrito.

---

### 7. ¿Por qué es preferible `app_lasalle` frente a `root`?
- **Principio de mínimo privilegio:** La cuenta `root` es la superadministradora del motor; tiene privilegios globales para crear/borrar bases de datos (`DROP DATABASE`), apagar el servidor, modificar archivos del sistema o crear usuarios con control total.
- La cuenta `app_lasalle` se creó con **permisos estrictamente limitados** a `SELECT` e `INSERT` únicamente sobre la base de datos `universidad_db`.
- **Mitigación de riesgos:** Si la aplicación web llegase a sufrir una vulnerabilidad o brecha de seguridad, el atacante no podría ejecutar comandos destructivos (`DROP TABLE`, `DELETE`, `GRANT`), protegiendo la integridad del servidor de base de datos.
