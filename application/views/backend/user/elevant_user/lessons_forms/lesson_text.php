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
    input[type="text"], select, textarea {
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
    .toolbar {
      display: flex;
      gap: 8px;
      padding: 8px;
      background: #f9f9f9;
      border: 1.5px solid #ededed;
      border-radius: 8px;
    }
    .toolbar button {
      background: none;
      border: none;
      font-size: 1rem;
      cursor: pointer;
    }
    .toolbar select {
      padding: 6px;
      border: 1.5px solid #ededed;
      border-radius: 8px;
      font-size: 1rem;
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
    <div style="background: #e3f2fd; padding: 12px; border-radius: 8px; font-size: 1rem; color: #1976d2;">
      Tipo de lección: <strong>Texto.</strong>
      <a href="#" style="color: #007bff; text-decoration: underline; font-weight: 600;">Cambiar</a>
    </div>
    <label for="titulo">Título</label>
    <input type="text" id="titulo" name="titulo" placeholder="Escribe el título de la lección">

    <label for="seccion">Sección</label>
    <select id="seccion" name="seccion">
      <option>Basic Development</option>
      <!-- Agrega más opciones aquí -->
    </select>

    <label for="ingresa_texto">Ingresa tu texto</label>
    <div class="toolbar">
      <button type="button" title="Negrita"><b>B</b></button>
      <button type="button" title="Cursiva"><i>I</i></button>
      <button type="button" title="Subrayado"><u>U</u></button>
      <select>
        <option>Arial</option>
        <option>Nunito</option>
      </select>
      <button type="button" title="Resaltar" style="background: #ffeb3b; color: #222;">A</button>
      <button type="button" title="Lista"><b>&bull;</b></button>
      <button type="button" title="Numerada">1.</button>
      <button type="button" title="Tabla">&#9638;</button>
      <button type="button" title="Imagen">&#128247;</button>
      <button type="button" title="Archivo">&#128206;</button>
      <button type="button" title="Enlace">&#128279;</button>
      <button type="button" title="Código">&lt;/&gt;</button>
      <button type="button" title="Eliminar">&#10006;</button>
    </div>
    <textarea id="ingresa_texto" name="ingresa_texto" placeholder="Escribe el contenido de la lección"></textarea>

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
