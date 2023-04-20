# card-slider
Este es un slider animado de tarjetas de personal programado en HTML, CSS, PHP y JS Vanilla.
El código genera automáticamente cada tarjeta a partir de un array.

Cada tarjeta contiene una foto, un nombre y un enlace a un ID; estos 3 elementos pertenecen a los elementos del array ya mencionado.

Las fotos con los nombres de archivo (filename) correspondientes están dentro del directorio llamado "ppl" y son asignados automáticamente dependiendo del contenido del elemento llamado "filename" en el array, que debe corresponder con el nombre de un archivo «jpg» dentro del directorio ya mencionado.

El desplazamiento de las tarjetas es horizontal, para moverse de un extremo al otro se puede hacer manualmente de uno en uno por medio de los botones de «avanzar» y «retroceder» situados en los extremos, o bien se puede realizar el desplazamiento rápido en orden alfabético al pasar el cursor (mouseover), o tambien haciendo click en dispositivos móviles, sobre el índice de letras bajo el slider.

El índice de letras añade o elimina letras automáticamente dependiendo de si existen o no nombres con iniciales correspondientes al alfabeto.

Incluye una función que sortea un problema que se relaciona con el uso de caracteres especiales (htmlentities) en Español que ocurren cuando la primer letra de un nombre debería ir acentuada (por ejemplo Álvaro, o Ícaro) pero que ha sido necesario retirarle el acento en la base de datos (y por lo tanto en el arreglo) para poder indexarle la letra del alfabeto en el menú (pues en la Base de Datos los caracteres acentuados normalmente se almacenan como entidades html como &aacute; en lugar de Á).

Utiliza 3 íconos de Fontawesome, dos para las flechas de «retroceder» y «avance», y otro para el símbolo de «abrir en ventana nueva». En este caso FontAwesome es invocado desde cdn.
## Origen de elementos en slider
El origen de los elementos proviene de un array asociativo que si bien en este caso viene "hardcoded", muy fácilmente se puede utilizar un array que se nutra de datos de una Base de Datos SQL, en tanto que esta conserve la misma estructura de los datos:
id - nombre - filename
