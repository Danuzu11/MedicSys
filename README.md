# 🏥 MedicSys - Sistema de Citas Médicas

![CakePHP](https://img.shields.io/badge/CakePHP-4.x-blue?logo=cakephp&style=flat-square)
![Build Status](https://img.shields.io/github/workflow/status/cakephp/app/CI?style=flat-square)
![License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)
![PHPStan](https://img.shields.io/badge/PHPStan-level%207-brightgreen.svg?style=flat-square)

Sistema web para la gestión de citas médicas, afiliados y médicos, desarrollado con [CakePHP](https://cakephp.org) 4.x.

---

## 🚀 Características principales

- 👨‍⚕️ Gestión de médicos: alta, edición, búsqueda y visualización.
- 👥 Gestión de usuarios y afiliados: registro, edición, eliminación y búsqueda.
- 📅 Agendamiento de citas médicas.
- 🔔 Alertas y notificaciones.
- 🔒 Autenticación y seguridad.
- 📊 Dashboard administrativo.
- 📄 Historial de citas y reportes.
- 📧 Envío de correos electrónicos.
- 🗂️ Sistema modular y escalable.

---

## 🗂️ Estructura del proyecto

```
MedicSys/
├── src/                # Código fuente (Controladores, Modelos, Vistas)
├── templates/          # Plantillas y layouts
├── config/             # Configuración de la app y rutas
├── tests/              # Pruebas unitarias y fixtures
├── webroot/            # Archivos públicos (CSS, JS, imágenes)
├── bin/                # Scripts CLI
├── logs/               # Logs de la aplicación
├── Db y credenciales/  # Scripts SQL y credenciales de ejemplo
└── README.md           # Este archivo
```
---
## 🏗️ Estructura y resumen de componentes principales

### Controllers (`src/Controller/`)
- **AppController.php**  
  Controlador base del proyecto. Gestiona lógica común para todos los controladores (autenticación, helpers, componentes).
- **ErrorController.php**  
  Maneja las páginas de error personalizadas (404, 500, etc).
- **MedicosController.php**  
  CRUD de médicos: alta, edición, búsqueda, visualización y alertas.
- **PagesController.php**  
  Renderiza páginas estáticas como `home` y `dashboard`.
- **UsersController.php**  
  Gestión de usuarios y afiliados: registro, edición, eliminación, login, historial de citas, ajustes y alertas.

### Models (`src/Model/`)
- **Entity/**  
  Define las entidades principales del sistema (por ejemplo, Médico, Usuario, Afiliado, Cita).
- **Table/**  
  Gestiona la lógica de acceso a datos y reglas de validación para cada entidad (por ejemplo, MedicosTable, UsersTable, AfiliadosTable, CitasTable).
- **Behavior/**  
  Comportamientos reutilizables para modelos (validaciones, timestamps, etc).

### Vistas (`templates/`)
- **Medicos/**  
  Vistas para listar, agregar, editar, buscar y ver médicos.
- **Users/**  
  Vistas para usuarios y afiliados: registro, edición, agendar citas, historial, login, ajustes, alertas.
- **Pages/**  
  Vistas estáticas como `home` y `dashboard`.
- **layout/**  
  Diferentes layouts para la aplicación (principal, login, error, alertas, etc).

> Cada componente está organizado para separar la lógica de negocio, presentación y acceso a datos, siguiendo el patrón MVC de CakePHP.
---
---

## ⚙️ Instalación

1. **Requisitos previos**
   - PHP >= 7.4
   - Composer
   - Base de datos MySQL o compatible

2. **Instalación**
   ```bash
   git clone https://github.com/tuusuario/MedicSys.git
   cd MedicSys
   composer install
   ```

3. **Configuración**
   - Copia `config/app_local.example.php` a `config/app_local.php` y ajusta tus credenciales de BD.
   - Opcional: copia `.env.example` a `.env` y configura variables de entorno.

4. **Migraciones**
   - Importa el archivo SQL `Db y credenciales/medicsysdb.sql` en tu base de datos.

5. **Servidor de desarrollo**
   ```bash
   bin/cake server -p 8765
   ```
   Accede a [http://localhost:8765](http://localhost:8765)

---

## 🧑‍💻 Uso

- Accede con tus credenciales de usuario.
- Navega por el dashboard para gestionar médicos, afiliados y citas.
- Utiliza los formularios para agendar, editar o eliminar citas.
- Visualiza reportes y el historial de citas.

---

## 🛡️ Seguridad

- Autenticación de usuarios.
- Protección CSRF y validaciones.
- Manejo de errores personalizado.

---

## 🧪 Pruebas

Ejecuta las pruebas unitarias con PHPUnit:

```bash
vendor/bin/phpunit
```

---

## 📚 Documentación y soporte

- [Documentación CakePHP](https://book.cakephp.org/4/en/)
- [API CakePHP](https://api.cakephp.org/)
- [Foro CakePHP](https://discourse.cakephp.org/)
- [Slack CakePHP](https://slack-invite.cakephp.org/)

---

## 📝 Licencia

Este proyecto está bajo licencia MIT.

---

## ✨ Créditos

Desarrollado con [CakePHP](https://cakephp.org) por tu equipo.

---

## 📦 Dependencias principales

- CakePHP 4.x
- DebugKit
- Bake
- Migrations

---

## 📌 Notas

- Personaliza los layouts en `templates/layout/`.
- Los controladores principales están en [`src/Controller/`](src/Controller/).
- Los modelos y entidades en [`src/Model/`](src/Model/).
- Las vistas en [`templates/`](templates/).

---

¡Gracias por usar MedicSys! 💙