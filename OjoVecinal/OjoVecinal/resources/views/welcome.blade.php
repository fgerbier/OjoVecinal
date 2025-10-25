<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Ojo Vecinal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
<!-- Tipografía moderna -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <!-- Leaflet -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>

<body class="bg-blue-100 font-['Inter'] text-gray-800">
@include('layouts.navigation')

<div class="flex justify-center items-start min-h-screen w-full py-10">
  <!-- Contenedor principal -->
  <div class="container mx-auto px-4 lg:px-16 flex flex-col lg:flex-row gap-8">

    <!-- Formulario -->
    <div class="w-full lg:w-2/3 bg-white p-8 rounded-2xl shadow-2xl">
      <h1 class="text-3xl font-bold text-blue-900 uppercase mb-6">Reporta un incidente</h1>

      <form method="POST" action="{{ route('reportes.store') }}" enctype="multipart/form-data" class="space-y-5">
  @csrf

  <div class="grid md:grid-cols-2 gap-4">
    <div>
      <label for="titulo" class="block text-sm font-semibold">Título<span class="text-red-500">*</span></label>
      <p class="text-xs text-gray-500 mb-1">Escribe un título breve para el incidente.</p>
      <input type="text" name="titulo" id="titulo" required class="w-full p-2 rounded-lg border border-gray-300" placeholder="Ej. Robo en esquina" />
    </div>
    <div>
      <label for="fecha_incidente" class="block text-sm font-semibold">Fecha y hora <span class="text-red-500">*</span></label>
      <p class="text-xs text-gray-500 mb-1">Indica cuándo ocurrió el incidente.</p>
      <input type="datetime-local" name="fecha_incidente" id="fecha_incidente" required class="w-full p-2 rounded-lg border border-gray-300" />
    </div>
    <div>
      <label for="nombre" class="block text-sm font-semibold">Tu nombre <span class="text-red-500">*</span></label>
      <p class="text-xs text-gray-500 mb-1">Puedes dejar tu nombre si lo deseas.</p>
      <input type="text" name="nombre" id="nombre" class="w-full p-2 rounded-lg border border-gray-300" />
    </div>
    <div>
      <label for="email" class="block text-sm font-semibold">Correo electrónico <span class="text-red-500">*</span></label>
      <p class="text-xs text-gray-500 mb-1">Te contactaremos solo si es necesario.</p>
      <input type="email" name="email" id="email" class="w-full p-2 rounded-lg border border-gray-300" placeholder="correo@ejemplo.com" />
    </div>
  </div>

  <div>
    <label for="categorias" class="block text-sm font-semibold">Categoría <span class="text-red-500">*</span></label>
    <p class="text-xs text-gray-500 mb-1">Selecciona el tipo de incidente.</p>
    <select name="categorias" id="categorias" required class="w-full p-2 rounded-lg border border-gray-300">
      <option value="" disabled selected>Selecciona una categoría</option>
      <option value="robo">Robo</option>
      <option value="violencia">Violencia</option>
      <option value="incendio">Incendio</option>
      <option value="emergencia_medica">Emergencia médica</option>
      <option value="otros">Otros</option>
    </select>
  </div>

  <div>
    <label for="descripcion" class="block text-sm font-semibold">Descripción <span class="text-red-500">*</span></label>
    <p class="text-xs text-gray-500 mb-1">Cuéntanos más detalles sobre lo ocurrido.</p>
    <textarea name="descripcion" id="descripcion" rows="3" required class="w-full p-2 rounded-lg border border-gray-300" placeholder="Describe lo sucedido..."></textarea>
  </div>

  <div>
    <label for="foto" class="block text-sm font-semibold">Archivo adjunto <span class="text-red-500">*</span></label>
    <p class="text-xs text-gray-500 mb-1">Puedes subir fotos si los tienes.</p>
    <input type="file" name="foto" id="foto" accept="image/*" class="w-full p-2 rounded-lg border border-gray-300 bg-gray-50" />
  </div>

  <!-- Ubicación -->
  <div>
    <label for="ubicacion_aproximada" class="block text-sm font-semibold">Ubicación del incidente <span class="text-red-500">*</span></label>
    <p class="text-xs text-gray-500 mb-1">Presiona el botón para usar tu ubicación actual.</p>
    <div class="relative mt-1">
      <input type="text" id="ubicacion_aproximada" name="ubicacion_aproximada" placeholder="Se completará automáticamente"
        class="w-full pl-4 pr-10 py-2 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        readonly />
      <button type="button" onclick="usarUbicacionActual()" title="Usar mi ubicación actual"
        class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-blue-700">
        <i class="fas fa-location-crosshairs"></i>
      </button>
    </div>
    <input type="hidden" name="latitud" id="latitud" />
    <input type="hidden" name="longitud" id="longitud" />
  </div>

  <div class="text-right">
    <button type="submit" class="bg-blue-800 text-white px-6 py-2 rounded-lg hover:bg-blue-900 transition">
      Enviar reporte
    </button>
  </div>
</form>

     
    </div>

    <!-- Información lateral -->
    <div class="w-full lg:w-1/3 bg-blue-900 text-white rounded-2xl p-8">
      <h2 class="text-2xl font-bold uppercase mb-4">¿Dónde estamos?</h2>
      <p class="text-gray-200 mb-6">
        Tu reporte será revisado por nuestro equipo vecinal. Ayuda a construir un barrio más seguro.
      </p>

      <div class="mb-4">
        <h3 class="text-xl font-semibold">Oficina central</h3>
        <p class="text-gray-300">Av. Seguridad 123, Barrio Unido</p>
      </div>

      <div class="mb-4">
        <h3 class="text-xl font-semibold">Contáctanos</h3>
        <p class="text-gray-300">Tel: +56 9 1234 5678</p>
        <p class="text-gray-300">Email: contacto@ojovecinal.cl</p>
      </div>

      <div class="flex space-x-3 mt-4">
        <a href="#" class="bg-white text-blue-900 w-8 h-8 rounded-full text-center pt-1"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="bg-white text-blue-900 w-8 h-8 rounded-full text-center pt-1"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </div>
</div>

<!-- Leaflet Script -->
<script>
  function usarUbicacionActual() {
    if (!navigator.geolocation) {
      alert("Tu navegador no soporta geolocalización.");
      return;
    }

    navigator.geolocation.getCurrentPosition(async (pos) => {
      const lat = pos.coords.latitude;
      const lon = pos.coords.longitude;
      document.getElementById('latitud').value = lat;
      document.getElementById('longitud').value = lon;

      const url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`;
      try {
        const res = await fetch(url);
        const data = await res.json();
        if (data.display_name) {
          document.getElementById('ubicacion_aproximada').value = data.display_name;
        } else {
          document.getElementById('ubicacion_aproximada').value = `Lat: ${lat}, Lon: ${lon}`;
        }
      } catch {
        document.getElementById('ubicacion_aproximada').value = `Lat: ${lat}, Lon: ${lon}`;
      }
    }, () => {
      alert("No se pudo obtener tu ubicación.");
    });
  }
</script>



</body>
</html>
