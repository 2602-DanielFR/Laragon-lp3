# 📋 MÓDULO DE PROYECTOS - DOCUMENTACIÓN COMPLETA

## 🎯 Descripción General

El módulo de proyectos es el corazón de la plataforma de financiamiento colaborativo. Permite a los **emprendedores** crear y gestionar proyectos, a los **administradores** revisar y aprobar proyectos, y a los **donantes** explorar y contribuir a iniciativas de impacto social y ambiental.

---

## 📁 ESTRUCTURA DEL MÓDULO

### **Migraciones de Base de Datos** 
```
database/migrations/
├── 2025_12_04_200000_create_categorias_table.php
├── 2025_12_04_200001_create_proyectos_table.php
├── 2025_12_04_200002_create_actualizaciones_proyecto_table.php
└── 2025_12_04_200003_create_donaciones_table.php
```

### **Modelos Eloquent**
```
app/Models/
├── Proyecto.php              (Modelo principal de proyectos)
├── Categoria.php             (Categorías de proyectos)
├── ActualizacionProyecto.php (Actualizaciones/noticias del proyecto)
└── Donacion.php              (Registro de donaciones)
```

### **Controladores**
```
app/Http/Controllers/
├── ProyectoController.php        (Operaciones públicas y de emprendedor)
└── Admin/ProyectoController.php  (Revisión y aprobación admin)
```

### **Vistas**
```
resources/views/proyectos/
├── index.blade.php  (Listado y exploración de proyectos)
├── show.blade.php   (Detalle del proyecto)
├── create.blade.php (Crear nuevo proyecto)
└── edit.blade.php   (Editar proyecto existente)
```

---

## 🔑 CARACTERÍSTICAS PRINCIPALES

### **1. GESTIÓN DE PROYECTOS POR EMPRENDEDOR**

#### **Crear Proyecto** (`proyectos.create`, `proyectos.store`)
- Formulario completo con validaciones
- Campos principales:
  - **Título**: Nombre atractivo del proyecto
  - **Descripción Corta**: Resumen para listado (máx 500 caracteres)
  - **Descripción Completa**: Detalle completo del proyecto (mín 50 caracteres)
  - **Categoría**: Clasificación del proyecto
  - **Objetivo de Recaudación**: Meta financiera (mínimo $100)
  - **Fecha de Término**: Fecha límite para el proyecto
  - **Imagen Principal**: Logo/imagen del proyecto
  - **Imagen Banner**: Imagen de encabezado (1920x600px recomendado)

- **Estados del Proyecto**:
  - `draft`: Borrador (solo lectura del emprendedor)
  - `pendiente_revision`: Esperando aprobación de admin
  - `activo`: Proyecto abierto a donaciones
  - `completado`: Meta alcanzada
  - `cancelado`: Cancelado por razones específicas
  - `rechazado`: Rechazado por admin con motivo

#### **Editar Proyecto** (`proyectos.edit`, `proyectos.update`)
- Solo disponible para proyectos en estado `draft` o `pendiente_revision`
- Permite actualizar todos los campos
- Validaciones completas en backend y frontend

#### **Eliminar Proyecto** (`proyectos.destroy`)
- Solo permite eliminar proyectos en estado `draft`
- Elimina imágenes del servidor automáticamente

### **2. EXPLORACIÓN DE PROYECTOS (Público)**

#### **Listado con Filtros** (`proyectos.index`)
- Muestra solo proyectos en estado `activo`
- **Filtros disponibles**:
  - Búsqueda por título/descripción
  - Filtro por categoría
  - Ordenamiento (más recientes, antiguos, más donaciones, cercanos a meta)

- **Información mostrada por proyecto**:
  - Imagen y categoría
  - Título y descripción corta
  - Emprendedor y organización
  - Barra de progreso (% alcanzado)
  - Cantidad de donantes y dinero recaudado

#### **Detalle del Proyecto** (`proyectos.show`)
- Información completa del proyecto
- Datos del emprendedor
- Barra de progreso interactiva
- **Actualizaciones**: Noticias del proyecto en tiempo real
- **Botón de Donación**: Para donantes autenticados
- **Botones de Compartir**: Twitter, Facebook, copiar enlace
- **Información de Estado**: Monto faltante, días restantes, etc.

### **3. GESTIÓN ADMINISTRATIVA**

#### **Listado de Proyectos** (`admin.proyectos.index`)
- Vista filtrable por estado
- Búsqueda avanzada por título, descripción, emprendedor
- Paginación (15 proyectos por página)
- Indicadores de proyectos pendientes, activos, rechazados

#### **Detalle y Acciones** (`admin.proyectos.show`)
- **Aprobar Proyecto**: Cambia a estado `activo`
- **Rechazar Proyecto**: Cambiar a `rechazado` con razón obligatoria
- **Activar Proyecto**: Reactivar proyectos completados/cancelados
- **Cancelar Proyecto**: Pausar recaudación con razón

---

## 💾 ESTRUCTURA DE BASE DE DATOS

### **Tabla: categorias**
```sql
id (Primary Key)
nombre (string, unique)
descripcion (text)
icono (string) - Clase de Font Awesome ej: "fas fa-tree"
color (string) - Color hexadecimal para UI
timestamps (created_at, updated_at)
```

### **Tabla: proyectos**
```sql
id (Primary Key)
user_id (Foreign Key → users)
categoria_id (Foreign Key → categorias)
titulo (string)
descripcion (text)
descripcion_corta (text)
objetivo_recaudacion (decimal)
monto_actual (decimal) - Se actualiza con donaciones
estado (enum: draft, pendiente_revision, activo, completado, cancelado, rechazado)
fecha_inicio (datetime)
fecha_fin (datetime)
imagen (string) - Path almacenado
imagen_banner (string) - Path almacenado
contador_donantes (integer)
contador_donaciones (integer)
porcentaje_alcanzado (decimal) - Calculado: (monto_actual / objetivo_recaudacion) * 100
razon_rechazo (text) - Cuando es rechazado
timestamps (created_at, updated_at)

Índices:
- estado, categoria_id, user_id, fecha_inicio
```

### **Tabla: actualizaciones_proyecto**
```sql
id (Primary Key)
proyecto_id (Foreign Key → proyectos)
titulo (string)
contenido (text)
imagen (string)
timestamps (created_at, updated_at)

Índices:
- proyecto_id
```

### **Tabla: donaciones**
```sql
id (Primary Key)
proyecto_id (Foreign Key → proyectos)
user_id (Foreign Key → users)
monto (decimal)
estado (enum: completada, pendiente, fallida, reembolsada)
referencia (string) - ID de transacción
mensaje (text) - Mensaje del donante
timestamps (created_at, updated_at)

Índices:
- proyecto_id, user_id, estado, created_at
```

---

## 🔐 LÓGICA DE PERMISOS Y VALIDACIONES

### **Permisos de Emprendedor**
- ✅ Crear proyectos
- ✅ Editar proyectos en estado `draft` o `pendiente_revision`
- ✅ Eliminar proyectos en estado `draft`
- ❌ Editar proyectos `activos` o `completados`

### **Permisos de Admin**
- ✅ Ver todos los proyectos (cualquier estado)
- ✅ Aprobar/Rechazar proyectos pendientes
- ✅ Activar/Cancelar proyectos activos
- ✅ Ver motivos de rechazo

### **Permisos de Donante**
- ✅ Ver proyectos públicos (activos)
- ✅ Donar a proyectos activos
- ❌ Editar proyectos

### **Validaciones en Formulario**
```php
[
    'titulo' => 'required|string|max:255',
    'descripcion_corta' => 'required|string|max:500',
    'descripcion' => 'required|string|min:50',
    'categoria_id' => 'required|exists:categorias,id',
    'objetivo_recaudacion' => 'required|numeric|min:100',
    'fecha_fin' => 'required|date|after:today',
    'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    'imagen_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
]
```

---

## 📊 MÉTODOS CLAVE DEL MODELO PROYECTO

```php
// Calcular porcentaje alcanzado
$proyecto->calcularPorcentaje() → float (0-100)

// Obtener estado legible
$proyecto->getEstadoLegible() → string ("Activo", "Completado", etc)

// Badge de Bootstrap
$proyecto->getEstadoBadge() → string ("success", "danger", etc)

// Verificar si puede recibir donaciones
$proyecto->puedeRecibirDonaciones() → bool

// Verificar si meta fue alcanzada
$proyecto->metaAlcanzada() → bool

// Días restantes del proyecto
$proyecto->diasRestantes() → int

// Dinero faltante para meta
$proyecto->montoFaltante() → float
```

---

## 🚀 FLUJO DE TRABAJO COMPLETO

### **Flujo: Emprendedor Publica Proyecto**
1. Emprendedor accede a `Crear Proyecto`
2. Completa formulario con todos los datos
3. Sube imágenes (principal y banner)
4. Envía formulario
5. Sistema valida todos los campos
6. Proyecto se crea en estado `pendiente_revision`
7. Emprendedor recibe confirmación
8. Admin recibe notificación (a implementar)

### **Flujo: Admin Revisa y Aprueba**
1. Admin accede a panel de administración
2. Ve lista de proyectos `pendiente_revision`
3. Hace clic en proyecto para ver detalles
4. Revisa información y documentación
5. Opción A: Aprueba proyecto → Estado cambia a `activo`
6. Opción B: Rechaza con motivo → Estado `rechazado`
7. Sistema notifica a emprendedor

### **Flujo: Donante Explora y Dona**
1. Donante accede a `Explorar Proyectos`
2. Usa filtros y búsqueda para encontrar proyecto
3. Hace clic en proyecto para ver detalles
4. Lee descripción completa y actualizaciones
5. Hace clic en `Donar Ahora`
6. Procede a proceso de pago (a implementar)
7. Donación se registra en base de datos
8. Contadores se actualizan automáticamente

---

## 🛠️ COMANDOS ARTISAN ÚTILES

```bash
# Ejecutar migraciones
php artisan migrate

# Revertir últimas migraciones
php artisan migrate:rollback

# Refrescar base de datos (cuidado: borra datos)
php artisan migrate:refresh

# Crear seeders (para datos de prueba)
php artisan make:seeder CategoriaSeeder
php artisan db:seed
```

---

## 📱 RUTAS IMPLEMENTADAS

### **Públicas**
```
GET  /proyectos                    → Listado de proyectos
GET  /proyectos/{id}              → Detalle de proyecto
```

### **Emprendedor (Auth)**
```
GET  /proyectos/create            → Formulario crear
POST /proyectos                   → Guardar proyecto
GET  /proyectos/{id}/edit         → Formulario editar
PUT  /proyectos/{id}              → Actualizar proyecto
DELETE /proyectos/{id}            → Eliminar proyecto
```

### **Admin (Auth + Admin)**
```
GET    /admin/proyectos                    → Listado admin
GET    /admin/proyectos/{id}               → Detalle admin
POST   /admin/proyectos/{id}/aprobar       → Aprobar
POST   /admin/proyectos/{id}/rechazar      → Rechazar
POST   /admin/proyectos/{id}/activar       → Activar
POST   /admin/proyectos/{id}/cancelar      → Cancelar
```

---

## 🎨 ESTILOS Y COMPONENTES

### **Framework CSS**
- **Tailwind CSS v4** (clases utilitarias)
- **Bootstrap Icons** (iconografía)
- **Font Awesome** (iconos adicionales)

### **Componentes Reutilizables**
- Grid responsivo (1 col mobile, 2 md, 3 lg)
- Formularios con validación visual
- Barras de progreso animadas
- Cards con hover effects
- Modales de confirmación

---

## 🔄 FLUJO DE DATOS Y ACTUALIZACIONES

### **Actualización de Contadores**
Cuando se registra una donación (a implementar):
1. Se crea registro en tabla `donaciones`
2. Se actualiza `monto_actual` en `proyectos`
3. Se recalcula `porcentaje_alcanzado`
4. Se incrementa `contador_donantes` (si es nuevo donante)
5. Se incrementa `contador_donaciones`

### **Estados Automáticos**
- Si `fecha_fin` < `now()` y estado es `activo` → Marcar como `completado`
- Si `monto_actual` >= `objetivo_recaudacion` → Indicar meta alcanzada

---

## ⚠️ CONSIDERACIONES IMPORTANTES

1. **Almacenamiento de Imágenes**: Se guardan en `storage/app/public/proyectos/`
   - Ejecutar: `php artisan storage:link`

2. **Validaciones**:
   - Las fechas deben ser posteriores a hoy
   - El objetivo mínimo es $100
   - Descripciones deben tener contenido mínimo

3. **Seguridad**:
   - Solo emprendedores pueden crear proyectos
   - Solo propietarios pueden editar sus proyectos
   - Solo admins pueden aprobar/rechazar

4. **Próximas Integraciones** (a desarrollar):
   - Gateway de pago (Stripe, PayPal)
   - Sistema de notificaciones por email
   - Sistema de comentarios en proyectos
   - Certificados/comprobantes de donación

---

## 📞 RESUMEN TÉCNICO

**Stack Utilizado:**
- Backend: Laravel 12, PHP 8.2
- Frontend: Blade, Tailwind CSS, Alpine.js
- Base de Datos: MySQL/MariaDB compatible
- Almacenamiento: Sistema de archivos local (configurable)

**Patrones Implementados:**
- MVC (Model-View-Controller)
- Repository Pattern (Modelos con métodos reutilizables)
- Fluent Query Builder
- Eloquent ORM con relaciones

**Total de Líneas de Código**: ~2,500+ (controladores, modelos, vistas, migraciones)

---

**Desarrollado por:** Tu Equipo  
**Fecha:** Diciembre 2025  
**Versión:** 1.0  
**Estado:** En Desarrollo
