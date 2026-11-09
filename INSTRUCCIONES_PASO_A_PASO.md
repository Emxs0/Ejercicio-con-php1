# Guía Paso a Paso para Ejecutar el Laboratorio
**Universidad de La Salle — Bases de Datos**  
**Proyecto:** *lasalle_estudiantes*

---

## 📁 Contenido de esta carpeta

- **`lasalle_estudiantes/`**: Proyecto web principal en PHP.
  - `conexion.php`: Conexión segura a MySQL con PDO y manejo de excepciones.
  - `index.php`: Interfaz web con tabla de estudiantes y formulario de registro.
  - `guardar.php`: Procesamiento de datos por POST, validaciones e inserción preparada.
- **`database/`**:
  - `database.sql`: **ÚNICO ARCHIVO SQL**. Contiene la creación de la base de datos `universidad_db`, tabla `estudiantes`, datos de prueba y usuario `app_lasalle`. Todo se ejecuta en un solo clic.
- **`mi_primer_php/`**:
  - `index.php`: Script introductorio del laboratorio (Sección 7).
- **`respuestas_preguntas_comprobacion.md`**:
  - Respuestas desarrolladas para las 7 preguntas evaluativas de la Sección 16.

---

## 🚀 Pasos para ponerlo en marcha

### Paso 1: Encender XAMPP
1. Abre el **XAMPP Control Panel**.
2. Presiona el botón **Start** en la fila de **Apache**.
3. Presiona el botón **Start** en la fila de **MySQL**.
4. Verifica que ambos se pongan en verde y muestren sus números de puerto (usualmente `80/443` para Apache y `3306` para MySQL).

---

### Paso 2: Importar la Base de Datos Única en phpMyAdmin
1. Abre tu navegador e ingresa a:  
   👉 **http://localhost/phpmyadmin/** (o `http://localhost:8080/phpmyadmin/` si tu Apache usa el puerto 8080).
2. Haz clic en la pestaña superior **SQL**.
3. Abre el archivo **`database/database.sql`**, copia todo su contenido, pégalo en el recuadro de phpMyAdmin y haz clic en **Continuar** (o *Go*).  
   *(¡Y listo! Con esto ya queda creada la base de datos `universidad_db`, la tabla con los datos de Ana y Luis, y el usuario de conexión).*

> **Nota:** Si en algún momento prefieres usar directamente la cuenta de administrador por defecto de XAMPP (`root` sin contraseña), abre `lasalle_estudiantes/conexion.php`, cambia `$usuario = 'root';` y `$contrasena = '';`.

---

### Paso 3: Colocar la aplicación en XAMPP (`htdocs`)
1. Copia la carpeta **`lasalle_estudiantes`** ubicada en tu escritorio o en este proyecto.
2. Pégala dentro del directorio raíz de tu servidor web, que normalmente es:  
   📁 **`C:\xampp\htdocs\`**  
   *(Debe quedar: `C:\xampp\htdocs\lasalle_estudiantes\` conteniendo `conexion.php`, `index.php` y `guardar.php`).*

---

### Paso 4: Abrir y probar en el Navegador
1. Ingresa a la siguiente URL en Google Chrome, Edge o Firefox:  
   👉 **http://localhost/lasalle_estudiantes/**  
   *(o http://localhost:8080/lasalle_estudiantes/ si tu puerto de Apache es 8080)*.
2. Deberás ver la tabla con los dos estudiantes iniciales (**Ana Torres** y **Luis Pérez**).
3. Llena el formulario con un nuevo nombre, correo y programa, y presiona **Guardar**.
4. La página se actualizará automáticamente mostrando al nuevo estudiante ingresado en la tabla.

---

## 🛠️ Diagnóstico y Solución de Problemas

- **¿Error de conexión a la base de datos?**
  - Revisa en XAMPP qué puerto tiene asignado MySQL: si es `3307`, edita `lasalle_estudiantes/conexion.php` y coloca `$puerto = '3307';`.
  - Si aparece *Access denied for user*, comprueba que ejecutaste el script `database.sql` o usa `$usuario = 'root'; $contrasena = '';`.
- **¿Página no encontrada (404)?**
  - Verifica que la carpeta `lasalle_estudiantes` esté exactamente dentro de `C:\xampp\htdocs\`.
- **¿Error por correo duplicado?**
  - La columna `correo` tiene una restricción `UNIQUE`. Ingresa una dirección de correo distinta para cada estudiante.
