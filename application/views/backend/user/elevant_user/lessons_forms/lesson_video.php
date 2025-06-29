<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar nueva lección</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background: #fff;
      color: #222;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    .modal-container {
      background: #fafafa;
      max-width: 600px;
      margin: 40px auto;
      border-radius: 12px;
      border: 1.5px solid #ededed;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 24px;
    }
    .modal-header {
      font-size: 1.8rem;
      font-weight: bold;
      margin-bottom: 18px;
      color: #111;
    }
    .modal-body {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }
    label {
      font-size: 1rem;
      font-weight: 600;
      margin-bottom: 6px;
      color: #333;
    }
    input[type="text"], select, input[type="file"], textarea {
      width: 100%;
      padding: 12px;
      border: 1.5px solid #ededed;
      border-radius: 8px;
      font-size: 1rem;
      background: #f9f9f9;
      color: #222;
      box-sizing: border-box;
    }
    textarea {
      resize: vertical;
      min-height: 80px;
    }
    .alert {
      background: #e8f5e9;
      color: #0b875b;
      border-radius: 8px;
      padding: 12px;
      font-size: 1rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .alert a {
      color: #007bff;
      text-decoration: underline;
      font-weight: 600;
      cursor: pointer;
    }
    .checkbox-area {
      font-size: 1rem;
      margin-top: 12px;
    }
    .checkbox-area input[type="checkbox"] {
      margin-right: 8px;
    }
    .submit-btn {
      background: #00c48c;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 1.2rem;
      padding: 12px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.2s;
    }
    .submit-btn:hover {
      background: #009e6d;
    }
    .footer-close {
      background: #6c757d;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      padding: 10px;
      cursor: pointer;
      margin-top: 12px;
      transition: background 0.2s;
    }
    .footer-close:hover {
      background: #343a40;
    }
  </style>
</head>
<body>
<div class="modal-container">
  <div class="modal-header">Agregar nueva lección</div>
  <form class="modal-body">
    <div class="alert">
      Tipo de lección: <strong>Archivo de video.</strong>
      <a href="#">Cambiar</a>
    </div>
    <label for="titulo">Título</label>
    <input type="text" id="titulo" name="titulo" placeholder="Escribe el título de la lección">

    <label for="seccion">Sección</label>
    <select id="seccion" name="seccion">
      <option>Basic Development</option>
      <!-- Agrega más opciones aquí -->
    </select>

    <label for="video">Subir archivo de video</label>
    <input type="file" id="video" name="video" accept="video/*">
    <div style="font-size: 0.9rem; color: #666;">Tamaño máximo: 256M</div>

    <label for="duracion">Duración</label>
    <input type="text" id="duracion" name="duracion" placeholder="0:00:00">

    <label for="caption">Subtítulos (.vtt)</label>
    <input type="file" id="caption" name="caption" accept=".vtt">
    <div style="font-size: 0.9rem; color: #666;">Selecciona tu archivo de subtítulos</div>

    <label for="resumen">Resumen</label>
    <textarea id="resumen" name="resumen" placeholder="Escribe un resumen de la lección"></textarea>

    <div class="checkbox-area">
      <label><input type="checkbox" name="leccion_gratis"> Marcar como lección gratuita</label>
    </div>
    <button class="submit-btn" type="submit">Agregar lección</button>
  </form>
  <button class="footer-close" onclick="document.querySelector('.modal-container').style.display='none'">Cerrar</button>
</div>
</body>
</html>
