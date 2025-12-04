# ⚡ INSTRUCCIONES RÁPIDAS - MÓDULO PROYECTOS

## 🎯 QUÉ HACER AHORA

### **OPCIÓN 1: Empezar Inmediatamente (5 minutos)**

```bash
# 1. Abre terminal en la raíz del proyecto
cd c:\UDH\OCTAVO SEMESTRE\LP3\PROYECTO FINAL\Laragon-lp3

# 2. Ejecuta las migraciones
php artisan migrate

# 3. Crea el enlace de almacenamiento
php artisan storage:link

# 4. ¡Listo! Ahora puedes acceder a:
# http://localhost:8000/proyectos
```

---

### **OPCIÓN 2: Poblar con Datos de Prueba (10 minutos)**

```bash
# Abre artisan tinker
php artisan tinker

# Crea categorías de ejemplo
App\Models\Categoria::create(['nombre' => 'Educación', 'descripcion' => 'Proyectos educativos', 'icono' => 'fas fa-graduation-cap', 'color' => '#3498db'])
App\Models\Categoria::create(['nombre' => 'Medio Ambiente', 'descripcion' => 'Proyectos ambientales', 'icono' => 'fas fa-leaf', 'color' => '#27ae60'])
App\Models\Categoria::create(['nombre' => 'Salud', 'descripcion' => 'Proyectos de salud', 'icono' => 'fas fa-heart', 'color' => '#e74c3c'])

# Salir
exit
```

---

## 📚 LEE PRIMERO (en este orden)

1. **README_MODULO_PROYECTOS.md** ← COMIENZA AQUÍ
   - Resumen ejecutivo
   - Qué se desarrolló
   - Características principales

2. **INSTALACION_MODULO_PROYECTOS.md**
   - Pasos de instalación
   - Configuración
   - Troubleshooting

3. **MODULO_PROYECTOS_DOCUMENTACION.md**
   - Detalles técnicos
   - Estructura de BD
   - Métodos de modelos

4. **RESUMEN_VISUAL_MODULO.md**
   - Diagramas
   - Flujos de usuario
   - Casos de uso

---

## 🎨 PROBAR EL MÓDULO

### **Como Emprendedor:**
1. Ve a http://localhost:8000/register
2. Crea una cuenta
3. Completa tu perfil de emprendedor
4. Ve a http://localhost:8000/proyectos/create
5. Crea tu primer proyecto

### **Como Admin:**
1. Crea un usuario admin en la BD
2. Ve a http://localhost:8000/admin/proyectos
3. Revisa y aprueba/rechaza proyectos

### **Como Donante:**
1. Crea una cuenta normal
2. Ve a http://localhost:8000/proyectos
3. Explora proyectos disponibles
4. Mira los detalles

---

## 🗂️ ARCHIVOS IMPORTANTES

**Controladores:**
- `app/Http/Controllers/ProyectoController.php`
- `app/Http/Controllers/Admin/ProyectoController.php`

**Modelos:**
- `app/Models/Proyecto.php`
- `app/Models/Categoria.php`
- `app/Models/ActualizacionProyecto.php`
- `app/Models/Donacion.php`

**Vistas:**
- `resources/views/proyectos/index.blade.php` (listado)
- `resources/views/proyectos/show.blade.php` (detalle)
- `resources/views/proyectos/create.blade.php` (crear)
- `resources/views/proyectos/edit.blade.php` (editar)

**Migraciones:**
- `database/migrations/2025_12_04_200000_create_categorias_table.php`
- `database/migrations/2025_12_04_200001_create_proyectos_table.php`
- `database/migrations/2025_12_04_200002_create_actualizaciones_proyecto_table.php`
- `database/migrations/2025_12_04_200003_create_donaciones_table.php`

---

## 🔍 VERIFICAR INSTALACIÓN

```bash
# Verificar que las migraciones se ejecutaron
php artisan migrate:status

# Verificar que las rutas están registradas
php artisan route:list | grep proyectos

# Verificar que los modelos existen
php artisan tinker
>>> App\Models\Proyecto::count()
>>> App\Models\Categoria::count()
```

---

## ⚙️ CONFIGURACIÓN IMPORTANTE

### **Archivo .env** (verificar que exista)
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=financiamiento_social
DB_USERNAME=root
DB_PASSWORD=
```

### **Almacenamiento**
```bash
# Si las imágenes no se ven, ejecuta:
php artisan storage:link
```

---

## 🚀 PRÓXIMAS INTEGRACIONES

**Próximamente podrás:**
1. ✅ Procesar pagos (Stripe, PayPal)
2. ✅ Enviar emails de notificación
3. ✅ Sistema de comentarios
4. ✅ Certificados de donación
5. ✅ Dashboard de estadísticas

---

## 💬 SOPORTE RÁPIDO

**Si tienes problema:**

1. **Error de migraciones**: `php artisan migrate:rollback` luego `php artisan migrate`
2. **Imágenes no se ven**: `php artisan storage:link`
3. **Clase no encontrada**: `composer dump-autoload`
4. **Token CSRF**: Asegúrate de incluir `@csrf` en formularios
5. **Permiso denegado**: Verifica que eres propietario del proyecto

---

## 📋 CHECKLIST DE IMPLEMENTACIÓN

- [ ] Ejecuté `php artisan migrate`
- [ ] Ejecuté `php artisan storage:link`
- [ ] Creé categorías iniciales
- [ ] Probé crear un proyecto (como emprendedor)
- [ ] Probé ver proyectos (como donante)
- [ ] Probé aprobar proyecto (como admin)
- [ ] Las imágenes se carga correctamente
- [ ] Leí la documentación principal

---

## 📞 ARCHIVOS DE DOCUMENTACIÓN

En la carpeta raíz encontrarás:

```
✅ README_MODULO_PROYECTOS.md ........... Resumen ejecutivo
✅ INSTALACION_MODULO_PROYECTOS.md .... Pasos de instalación  
✅ MODULO_PROYECTOS_DOCUMENTACION.md .. Documentación técnica
✅ RESUMEN_VISUAL_MODULO.md ........... Diagramas y flujos
```

---

## 🎯 EMPEZAR AHORA

```bash
# Copia y pega en la terminal (desde la raíz del proyecto):

php artisan migrate && php artisan storage:link

# Luego accede a:
# http://localhost:8000/proyectos

# ¡Listo! 🎉
```

---

**Versión:** 1.0  
**Última actualización:** Diciembre 2025  
**Estatus:** ✅ LISTO PARA USAR
