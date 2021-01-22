<!DOCTYPE html>

<head>
  <title>Drag and Drop File Upload</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <link rel="shortcut icon" href="/assets/favicon.ico">
</head>

<body>
  <div class="drop-zone">
    <span class="drop-zone__prompt">Drop file here or click to upload</span>
    <input type="file" name="myFile" class="drop-zone__input" display="none" name = 'picture' id = 'picture'>
  </div>

  <script src="main.js"></script>
  </br>
</body>
<style>
    .drop-zone {
  max-width: 200px;
  height: 200px;
  padding: 25px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  font-family: "Quicksand", sans-serif;
  font-weight: 500;
  font-size: 20px;
  cursor: pointer;
  color: #1c3b91;
  border: 4px dashed #1c3b91;
  border-radius: 10px;
}

.drop-zone--over {
  border-style: solid;
}

.drop-zone__input {
  display: none !important;
}

.drop-zone__thumb {
  width: 100%;
  height: 100%;
  border-radius: 10px;
  overflow: hidden;
  background-color: #cccccc;
  background-size: cover;
  position: relative;
}

.drop-zone__thumb::after {
  content: attr(data-label);
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 5px 0;
  color: #ffffff;
  background: rgba(0, 0, 0, 0.75);
  font-size: 14px;
  text-align: center;
}

</style>