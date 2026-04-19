Informe de Relevamiento y Diseño de Base de Datos

Proyecto: Sistema de Gestión Inmobiliaria (MVP)
Ticket: #001 
Responsables: Mateo Cluchinsky / Marcos Godoy


1. Introducción y Contexto del Negocio
El presente documento detalla el análisis y diseño inicial de la base de datos para la centralización operativa de una agencia inmobiliaria ubicada en Coronel Pringles, Argentina.
Tras la entrevista realizada a la propietaria de una inmobiliaria, se identificó que el principal problema radica en la descentralización de la información (actualmente manejada en planillas de cálculo), lo que genera pérdida de trazabilidad en los contratos, falta de control en los vencimientos de servicios y cálculos manuales de honorarios propensos a errores.


2. Requerimientos Funcionales (RF)
Se han priorizado las funcionalidades críticas para el Producto Mínimo Viable (MVP):

RF1 - Registro Unificado de Personas: El sistema debe gestionar en una única entidad a propietarios e inquilinos para evitar la duplicidad de datos, permitiendo almacenar información fiscal (CUIT/CUIL) y financiera (CBU/Alias).

RF2 - Gestión de Inmuebles por Zona: Clasificación de propiedades por tipo y ubicación geográfica específica.

RF3 - Motor de Comisiones Automáticas: Cálculo de honorarios basado en el porcentaje de comisión predefinido para cada zona geográfica.

RF4 - Administración de Contratos y Obligaciones: Vinculación de inquilinos con propiedades, permitiendo el seguimiento de pagos mensuales y obligaciones adicionales como tasas municipales (ABL), gas y expensas.

RF5 - Sistema de Alertas de Morosidad: Generación de notificaciones automáticas para contratos con saldos pendientes o vencimientos próximos.

RF6 - Auditoría de Operaciones: Registro detallado de acciones (Logs) realizadas por los usuarios para garantizar la integridad y seguridad de la información.


3. Requerimientos No Funcionales (RNF)

RNF1 - Integridad Referencial: Uso de un motor de base de datos relacional (SQL Server) para asegurar la consistencia de los datos.

RNF2 - Seguridad de Acceso: Implementación de perfiles de usuario con contraseñas encriptadas (hashing) y niveles de acceso diferenciados.

RNF3 - Escalabilidad: Diseño preparado para la incorporación futura de ciudades adicionales (ej. Bahía Blanca) mediante tablas maestras de provincias y localidades.


4. Actores del Sistema
Se definen tres roles operativos basados en la estructura de la agencia:

Administrador: Acceso total a la configuración del sistema, gestión de usuarios, definición de porcentajes de comisión por zona y auditoría de logs.

Secretariado: Perfil encargado de la carga operativa de clientes, propiedades y contratos, además del registro diario de cobros.

Profesional (Agente): Acceso a la consulta de estados de contratos y disponibilidad de propiedades para visitas externas.


5. Estrategia de Normalización (3FN)
El modelo de datos ha sido diseñado bajo los estándares de la Tercera Forma Normal (3FN) para optimizar el rendimiento y la integridad:

1FN (Atomicidad): Se descompusieron atributos complejos como "Dirección" y "Nombre Completo" en campos individuales para facilitar búsquedas y reportes precisos.

2FN (Dependencia Funcional): Se eliminaron dependencias parciales mediante la creación de tablas maestras como Tipos_Inmueble y Zonas, asegurando que cada atributo dependa exclusivamente de su clave primaria.

3FN (Eliminación de Transitividad): Se extrajeron datos que no dependían directamente del contrato o la propiedad. Un ejemplo clave es el porcentaje de comisión, el cual reside en la tabla Zonas y no en la tabla Propiedades, evitando inconsistencias si las tarifas por barrio se actualizan.


6. Reglas de Negocio Críticas
Estado de Propiedad: Un inmueble no puede figurar como "Disponible" si tiene un contrato de alquiler activo asociado.

Referencia Geográfica: Toda propiedad debe estar vinculada obligatoriamente a una zona para que el sistema pueda proyectar los honorarios de la operación.

Gestión de Pagos: El sistema no permitirá cerrar un mes de alquiler sin registrar el estado (Pagado/Pendiente) de las obligaciones vinculadas al contrato.


Conclusión del Análisis
El diseño propuesto no solo resuelve el desorden administrativo detectado en la entrevista con Paola, sino que establece una base técnica sólida para automatizar tareas repetitivas y reducir el error humano en los cálculos financieros del negocio.
