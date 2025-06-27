# API Humano

✨ **API Humano** es un micro-framework en PHP diseñado para crear APIs REST de forma clara, humana y expresiva.  
Cada endpoint se declara con comandos que se leen como una historia: `PostOn`, `PostIn`, `PosValidate`, `PostRespond`, etc.

## 🚀 Filosofía

- 📖 Legible: el código se entiende como si fuera lenguaje natural.
- 🔩 Ligero: sin frameworks pesados ni dependencias externas.
- 🧱 Modular: cada acción tiene su función clara y separada.
- 🔐 Seguro: incluye validación, seguridad por API Key y manejo global de errores.
- 🧪 Escalable: listo para crecer hacia validaciones, autenticación y base de datos.

---

## 🧠 Ejemplo de uso

```php
PostOn('/api/v1/users', function () {
    PostIn(function($data) {
        PosValidate($data, ['name', 'email']);
        PostSecure(); // Valida API KEY

        PostAction(function () use ($data) {
            $user = [
                'id' => rand(100,999),
                'name' => $data['name'],
                'email' => $data['email']
            ];
            PostRespond('Usuario creado.', $user, 201);
        });
    });
});
```

---

## 📦 Comandos disponibles

### Verbos HTTP

- `PostOn(route, callback)`
- `GetOn(route, callback)`
- `PutOn(route, callback)`
- `PatchOn(route, callback)`
- `DeleteOn(route, callback)`

### Entrada y Validación

- `PostIn(callback)`
- `PutIn(callback)`
- `PatchIn(callback)`
- `PosValidate(data, camposRequeridos)`
- `PosExpect(data, esquemaDeTipos)` → (`email`, `string`, `integer`)

### Seguridad

- `PostSecure()` → Valida `X-API-KEY: 123456`

### Respuesta

- `PostRespond(mensaje, datos, códigoHTTP)`
- Funciona igual para `GetRespond`, `PutRespond`, etc.

### Otros

- `PostLog("mensaje")` → Guarda en `logs/app.log`
- Handler global de errores (`try-catch` automático)

---

## 🛠 Estructura del proyecto

```
api-humano/
├── public/              # index.php (punto de entrada)
├── app/Routes/          # tus rutas con comandos tipo PostOn
├── core/                # router, sintaxis, respuestas
├── logs/                # logs del sistema
└── .htaccess            # reescritura para Apache
```

---

## 🔐 Seguridad

Por defecto valida el header:

```
X-API-KEY: 123456
```

Este valor se puede modificar en `PostSecure()`.

---

## 📥 Instalación rápida

1. Coloca los archivos en tu servidor local (ej. XAMPP, Laragon, etc.)
2. Apunta tu servidor a la carpeta `/public`
3. Prueba en Postman o curl:

```bash
curl -X POST http://localhost/api/v1/users \
  -H "Content-Type: application/json" \
  -H "X-API-KEY: 123456" \
  -d '{ "name": "Dennis", "email": "djmcit@gmail.com" }'
```

---

## ✨ Autor

Creado con 💡 por **Dennis Mejia** (@djmcit)

---

## 🧩 Licencia

Este proyecto es libre de usar, modificar y adaptar para fines educativos o comerciales.

---

