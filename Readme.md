Se pretende realizar una aplicación para usuarios de una universidad donde puedan registrar
sus calificaciones.
Para ello se requiere de un portal web que debe cumplir los siguientes requisitos:
PANTALLA INICIAL
- El portal web debe contener una pantalla inicial con acceso a otras 2 pantallas: una de
login y una de registro.
REGISTRO
- La pantalla de registro debe contener un formulario con los siguientes campos:
o Nombre del alumno/a.
o Apellidos del alumno/a.
o Contraseña
o Repetir contraseña
o Fecha de nacimiento.
o Email.
o Teléfono.
o Check de aceptación de términos y condiciones del portal.
- El formulario de registro debe realizar las siguientes validaciones:
o Que todos los campos estén rellenos.
o Que el campo contraseña y repetir contraseña sean iguales.
o Que la fecha sea formato dd/mm/yyyy.
o Que el alumno/a tenga más de 18 años.
o Que el email tenga formato correcto.
o Que el teléfono tenga 9 dígitos.
o Que el check de aceptación esté marcado.
- Una vez validado el formulario se guardarán todos los datos en la tabla ALUMNOS de
la base de datos.

LOGIN
- Contendrá el campo email y contraseña para poder acceder al portal.
- El formulario de registro debe realizar las siguientes validaciones:
o Que todos los campos estén rellenos.
o Que el email tenga formato correcto.
o Que el email exista en base de datos y la contraseña sea válida.
- Una vez realizado el login, el alumno es dirigido a su panel privado.

PANEL PRIVADO DE ALUMNO/A
- En esta pantalla el alumno/a puede ver una lista de sus calificaciones, así como la
media final de las mismas.
- También dispondrá de un campo numérico junto a un botón de guardado donde podrá
introducir nuevas calificaciones. Este campo debe cumplir los siguientes requisitos:
o Deberá ser numérico.
o No podrá ser menor que 0.
o No podrá ser mayor que 10.
- El alumno/a podrá ir introduciendo notas al mismo tiempo que la lista de notas y la
media de las mismas se van actualizando.

BASE DE DATOS
- Será una base de datos MySQL.
- Como se intuye en el enunciado, la base de datos contendrá solo 2 tablas: una para los
datos de alumnos/as y otra para las calificaciones de los mismos.

PUNTOS A VALORAR
Aunque no es estrictamente necesario realizar estas tareas, se valorará positivamente la
realización de las mismas.
- Encriptar las contraseñas a la hora de guardarlas en base de datos.
- Control de errores y mostrar mensajes de error a la hora de realizar cualquier proceso
(registro, login, guardar calificaciones, etc)
- Uso de sesiones para mantener la cuenta de usuario siempre activa.
- Uso de javascript para la realización de solicitudes de forma asíncrona.
- Creatividad a la hora de maquetar y disponer los distintos elementos en pantalla.
- Podrán realizarse las mejoras que el desarrollador/a considere necesarias, aunque no
estén descritos en este documento. De ser así, especificar que mejoras o desarrollos
extra se han realizado en un documento de texto adjunto para poder tenerlos en
consideración.
PROPÓSITO Y CONSIDERACIONES
El propósito de esta prueba es contemplar las nociones y metodologías utilizadas por el
desarrolador/a por lo que es preferible realizar el desarrollo desde 0 en lenguaje nativo en vez
de utilizar frameworks como Laravel, Symphony o similares, aunque están permitidos si así se
prefiere.
Podrá hacerse uso de librerías o dependencias externas que el desarrollador/a crea necesarias.
Se entregará una capeta comprimida que contendrá el código fuente del portal y un archivo
SQL para poder construir la base de datos.
El archivo SQL puede contener datos de pruebas si se desea, aunque no es obligatorio.