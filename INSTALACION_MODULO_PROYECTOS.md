# 🚀 GUÍA DE INSTALACIÓN - MÓDULO DE PROYECTOS

## ✅ PASOS PARA IMPLEMENTAR EL MÓDULO

### **PASO 1: Ejecutar Migraciones**

Las migraciones crean las tablas necesarias en la base de datos.

```bash
# Desde la raíz del proyecto
php artisan migrate

# Si necesitas rollback (revertir):
php artisan migrate:rollback

# Para limpiar y empezar de nuevo (cuidado: borra datos):
php artisan migrate:refresh
```

**Tablas creadas:**
- `categorias` - Categorías de proyectos
- `proyectos` - Proyectos principales
- `actualizaciones_proyecto` - Noticias/actualizaciones
- `donaciones` - Registro de donaciones

---

### **PASO 2: Configurar Almacenamiento de Imágenes**

Las imágenes se guardan en `storage/app/public`. Necesitas crear un enlace simbólico:

```bash
# Crear enlace simbólico
php artisan storage:link

# Verifica que se creó en public/storage
# Si ya existe, elimina y vuelve a ejecutar
```

---

### **PASO 3: Crear Categorías Iniciales** (Opcional)

Puedes crear categorías mediante la CLI de Laravel o el panel admin:

```bash
# Opción 1: Usar artisan tinker
php artisan tinker

# Dentro de tinker:
>>> App\Models\Categoria::create([
  'nombre' => 'Educación',
  'descripcion' => 'Proyectos educativos',
  'icono' => 'fas fa-graduation-cap',
  'color' => '#3498db'
])

>>> App\Models\Categoria::create([
  'nombre' => 'Medio Ambiente',
  'descripcion' => 'Proyectos ambientales',
  'icono' => 'fas fa-leaf',
  'color' => '#27ae60'
])

>>> App\Models\Categoria::create([
  'nombre' => 'Salud',
  'descripcion' => 'Proyectos de salud',
  'icono' => 'fas fa-heart',
  'color' => '#e74c3c'
])

# Salir de tinker
>>> exit
```

O **Opción 2:** Ir a `/admin/categorias` en el navegador (si tienes acceso admin)

---

### **PASO 4: Verificar Rutas**

Verifica que las rutas están registradas:

```bash
php artisan route:list | grep proyectos
```

Deberías ver rutas como:
```
GET|HEAD    /proyectos ........................... proyectos.index
POST        /proyectos ........................... proyectos.store
GET|HEAD    /proyectos/create ................... proyectos.create
GET|HEAD    /proyectos/{id} ..................... proyectos.show
GET|HEAD    /proyectos/{id}/edit ............... proyectos.edit
PUT|PATCH   /proyectos/{id} ..................... proyectos.update
DELETE      /proyectos/{id} ..................... proyectos.destroy
```

---

### **PASO 5: Probar el Módulo**

#### **A. Como Emprendedor:**

1. Regístrate como usuario normal
2. Completa tu perfil de emprendedor en `/perfil/editar`
3. Ve a `/proyectos/create`
4. Completa el formulario y sube imágenes
5. Haz clic en "Crear Proyecto"
6. Tu proyecto aparecerá en estado `pendiente_revision`

#### **B. Como Admin:**

1. Inicia sesión con usuario admin
2. Ve a `/admin/proyectos`
3. Verás proyectos pendientes de revisión
4. Haz clic en un proyecto para verlo
5. Selecciona "Aprobar" o "Rechazar"
6. Si apruebas, el proyecto pasa a estado `activo`

#### **C. Como Donante:**

1. Ve a `/proyectos`
2. Explora y filtra proyectos
3. Haz clic en un proyecto `activo`
4. Ve el detalle y haz clic en "Donar Ahora"
5. (Próximamente: completar pago)

---

## 🔧 CONFIGURACIÓN AVANZADA

### **Cambiar Límite de Tamaño de Imagen**

En `ProyectoController.php`:
```php
'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // En KB
```

Puedes cambiar `2048` (2MB) a otro valor.

### **Cambiar Directorio de Almacenamiento**

En el formulario de creación:
```php
$validated['imagen'] = $request->file('imagen')->store('proyectos/imagenes', 'public');
```

Cambiar `'proyectos/imagenes'` a otra carpeta si lo deseas.

### **Agregar Más Filtros**

En `ProyectoController::index()`, puedes agregar más filtros:
```php
// Añade esto para filtrar por rango de metas
if ($request->has('meta_min') && $request->meta_min) {
    $query->where('objetivo_recaudacion', '>=', $request->meta_min);
}
```

---

## 🐛 TROUBLESHOOTING (Solución de Problemas)

### **Error: "Class not found"**

```
ReflectionException: Class App\Models\Proyecto does not exist
```

**Solución:** Verifica que el archivo esté en la ruta correcta y ejecuta:
```bash
composer dump-autoload
```

### **Error: "Tabla no existe"**

```
QueryException: SQLSTATE[42S02]: Table 'database.proyectos' doesn't exist
```

**Solución:** Ejecuta las migraciones:
```bash
php artisan migrate
```

### **Error: "Storage link no existe"**

Las imágenes no se ven en el navegador.

**Solución:**
```bash
php artisan storage:link
```

### **Error: "CSRF Token Mismatch"**

Al enviar el formulario sale error de token.

**Solución:** Asegúrate de que el formulario incluya:
```blade
@csrf
```

### **Error: "No se puede editar proyecto"**

Mensaje: "No puedes editar un proyecto en este estado"

**Solución:** Solo puedes editar proyectos en estado `draft` o `pendiente_revision`. Los proyectos `activos` no se pueden editar.

---

## 📊 SEEDERS (Datos de Prueba)

Para poblar la base de datos con datos de prueba:

```bash
# Crear seeder
php artisan make:seeder ProyectoSeeder

# En database/seeders/ProyectoSeeder.php, añade:
```

```php
use App\Models\Proyecto;
use App\Models\Categoria;
use App\Models\User;

public function run()
{
    $categorias = Categoria::all();
    $users = User::whereHas('emprendedor')->take(5)->get();
    
    foreach ($users as $user) {
        Proyecto::factory(3)
            ->state([
                'user_id' => $user->id,
                'categoria_id' => $categorias->random()->id,
                'estado' => 'activo'
            ])
            ->create();
    }
}
```

Luego ejecuta:
```bash
php artisan db:seed --class=ProyectoSeeder
```

---

## 🎯 CHECKLIST DE IMPLEMENTACIÓN

- [ ] Migraciones ejecutadas (`php artisan migrate`)
- [ ] Enlace de almacenamiento creado (`php artisan storage:link`)
- [ ] Categorías iniciales creadas
- [ ] Rutas verificadas (`php artisan route:list`)
- [ ] Probado como emprendedor
- [ ] Probado como admin
- [ ] Probado como donante
- [ ] Imágenes se cargan correctamente
- [ ] Validaciones funcionan
- [ ] Base de datos poblada con datos de prueba

---

## 📝 NOTAS IMPORTANTES

1. **Estructura de Carpetas**: Las imágenes se guardan en:
   ```
   storage/app/public/proyectos/imagenes/
   storage/app/public/proyectos/banners/
   ```

2. **Configuración de Base de Datos**: Asegúrate de que `.env` tiene:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=financiamiento_social
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. **Middleware**: Algunos controladores usan middleware que necesita ser creado:
   ```
   app/Http/Middleware/IsAdmin.php
   ```

4. **Notificaciones**: El sistema de notificaciones por email está comentado en los controladores y debe implementarse.

---

## 🚀 PRÓXIMOS PASOS

Después de implementar este módulo, considera:

1. **Integración de Pagos**: Implementar Stripe o PayPal
2. **Notificaciones**: Email para aprobación/rechazo
3. **Sistema de Comentarios**: Donantes puedan comentar
4. **Reportes**: Dashboard con estadísticas
5. **Certificados**: Descargar comprobante de donación

---

## 📞 SOPORTE

Si tienes problemas:

1. Revisa la documentación: `MODULO_PROYECTOS_DOCUMENTACION.md`
2. Verifica los logs: `storage/logs/laravel.log`
3. Usa `php artisan tinker` para debugging
4. Consulta la comunidad de Laravel en stackoverflow.com

---

**Última actualización:** Diciembre 2025  
**Versión:** 1.0  
**Estado:** ✅ Listo para usar
