# Ruta del proyecto
cd "E:\Datos de los usuarios\mhuertasr\Documentos\GitHub\el_turista_back"

# Crear entidad Usuario
Write-Output "yes`n`n`nyes`n" | php bin/console make:user Usuario

Write-Output "nombre`nstring`n`nno`nfecha_creacion`ndate`nno`neliminado`nboolean`nno`n" | php bin/console make:entity Usuario

# Crear entidad Cliente
Write-Output "nombre`nstring`n`nno`nemail`nstring`n`nno`ntelefono`nstring`n`nno`ndireccion`nstring`n`nno`npais`nstring`n`nno`neliminado`nboolean`nno`n" | php bin/console make:entity Cliente

# Crear entidad Propiedad
Write-Output "nombre`nstring`n`nno`ndireccion`nstring`n`nno`nciudad`nstring`n`nno`ndescripcion`ntext`nno`ntipo`nstring`n`nno`ncapacidad`ninteger`nno`namenidades`ntext`nno`neliminado`nboolean`nno`n" | php bin/console make:entity Propiedad

# Crear entidad Habitacion
Write-Output "nombre`nstring`n`nno`ndescripcion`ntext`nno`ncapacidad`ninteger`nno`nprecio_por_noche`ndecimal`n`n2`nno`nestado`nstring`n`nno`neliminado`nboolean`nno`npropiedad`nrelation`nPropiedad`nManyToOne`nno`n`n`n`n" | php bin/console make:entity Habitacion

# Crear entidad Reserva
Write-Output "fecha_entrada`ndate`nno`nfecha_salida`ndate`nno`nestado`nstring`n`nno`nnumero_personas`ninteger`nno`neliminado`nboolean`nno`ncliente`nrelation`nCliente`nManyToOne`nno`n`n`n`nhabitacion`nrelation`nHabitacion`nManyToOne`nno`n`n`n`n" | php bin/console make:entity Reserva

# Crear entidad Servicio_Adicional
Write-Output "nombre`nstring`n`nno`ndescripcion`ntext`nno`nprecio`ndecimal`n`n2`nno`ntipo`nstring`n`nno`neliminado`nboolean`nno`n" | php bin/console make:entity Servicio_Adicional

# Crear entidad Reserva_Servicio_Adicional (Tabla intermedia entre Reserva y Servicio_Adicional)
Write-Output "cantidad`ninteger`nno`nfecha_servicio`ndate`nno`ndetalles`ntext`nno`neliminado`nboolean`nno`nreserva`nrelation`nReserva`nManyToOne`nno`n`n`n`nservicio_adicional`nrelation`nServicioAdicional`nManyToOne`nno`n`n`n`n" | php bin/console make:entity Reserva_Servicio_Adicional

# Crear entidad Nota_Servicio
Write-Output "fecha_emision`ndate`nno`ndetalles_servicio`ntext`nno`nestado`nstring`n`nno`nfecha_realizacion`ndate`nno`neliminado`nboolean`nno`nreserva`nrelation`nReserva`nManyToOne`nno`n`n`n`n" | php bin/console make:entity Nota_Servicio

# Ejecución final
php bin/console make:migration

php bin/console doctrine:migrations:migrate --no-interaction
