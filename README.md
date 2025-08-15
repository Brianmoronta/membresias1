# 👤 Sistema de Membresías Privado

Este proyecto fue desarrollado en **Laravel 10+** y es exclusivo para gestión interna de socios, carnets, visitas y control administrativo.

---

## 🛠 ¿Qué incluye?

- Registro de socios y datos personalizados  
- Carnet PDF con diseño moderno y QR único  
- Validación de visitas por IP autorizadas  
- Control de caja, descuentos y tipos de membresía  
- Dashboard para admins y superadmin  
- Envío de correos desde Hostinger SMTP  
- Roles con control granular (servicio, admin, miembro)  
- Escaneo de QR con validación de IP  
- Módulo de cumpleaños y alertas automáticas  

---

## ⚙️ Instalación rápida

1. Clona el repositorio:
```bash
   git clone https://github.com/mguzmane686/gestion_membresias.git
```
2. Entra al proyecto:
```bash
   cd gestion_membresias
```

3. Instala dependencias:
```bash
   composer install
   npm install && npm run build
```


4. Copia y configura el archivo `.env`:
```bash
   cp .env.example .env
   php artisan key:generate
```
5. Crea las tablas:
```bash
   php artisan migrate
```

6. Ejecuta el servidor local:

```bash
   php artisan serve
```
---

## 🧩 Base de Datos

Dentro del directorio `database/sql` encontrarás el archivo `sistema_membresia.sql` para importar la estructura y datos iniciales.

### Restaurar la base de datos:
1. Crea una base de datos vacía con el nombre:
   
   sistema_membresia
   
2. Importa el archivo `.sql` usando tu herramienta favorita (phpMyAdmin, DBeaver, MySQL CLI, etc):
   
   mysql -u root -p sistema_membresia < database/sql/sistema_membresia.sql
   
3. Asegúrate de tener configurado correctamente tu archivo `.env` con las credenciales de conexión.


## 📌 Notas

Este proyecto es privado y fue desarrollado para fines internos.  
Requiere configuración de base de datos, permisos en archivos y entorno Laravel.

---

## 🚧 Pendientes del Proyecto (CMS Web)


## 🧭 Referencia de Diseño

Este proyecto ya cuenta con una página web de inicio **funcional y diseñada previamente**  
Puedes usarla como base visual y estructural para construir el CMS del sitio principal.  
👉 La plantilla se encuentra en:  
`resources/views/welcome.blade.php`

Módulo en desarrollo para controlar dinámicamente el sitio principal del **Club Vista a las Montañas**:

### Funcionalidades por implementar:

1. **Menú de navegación dinámico**
   - Administración desde el panel CMS con base de datos.
   - Ya implementado.

2. **Hero principal (imagen o carrusel)**
   - Imagen destacada editable o carrusel de varias imágenes.

3. **Nuestros planes** (reemplaza sección “Actividades”)
   - Imágenes de carnets con datos no reales.
   - Beneficios por tipo de membresía.
   - Botón para *Comprar Plan*.

4. **Revista**
   - Espacio para subir contenido y publicaciones del área de publicidad.

5. **Beneficios de ser miembro**
   - Contenido administrable desde el CMS.

6. **Testimonios**
   - Sección para mostrar comentarios, imágenes y nombres de miembros reales o ficticios.

7. **Footer**
   - Enlaces y redes sociales configurables desde el panel.

---

## 👨‍💻 Desarrollado por

**Manuel Guzmán**  
[https://app.todovirtual.cloud/](https://app.todovirtual.cloud/)