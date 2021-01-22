<link rel="stylesheet" href="plogincss.css">
<h2>fancybox v3.5 - Inline content</h2>

<hr class="my-5" />

<div class="row mb-4">
  <div class="card-deck col-9">

    <div class="card">
      <div class="card-body">
        <p>
          #1 - Default example
        </p>
        <p class="mb-0">
          <a data-fancybox data-src="#modal" href="javascript:;" class="btn btn-primary">Open demo</a>
        </p>

        <div style="display: none;" id="modal">
          <h2>Hello!</h2>
          <p>You are awesome!</p>
        </div>

      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <p>
          #2 - Custom open/close animation
        </p>
        <p class="mb-0">
          <a data-fancybox data-animation-duration="700" data-src="#animatedModal" href="javascript:;" class="btn btn-primary">Open demo</a>
        </p>

        <div style="display: none;" id="animatedModal" class="animated-modal">
          <h2>Hello!</h2>
          <p>This is animated content! Cool, right?</p>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <p>
          #3 - Modal window
        </p>

        <p class="mb-0">
          <a data-fancybox data-src="#trueModal" data-modal="true" href="javascript:;" class="btn btn-primary">Open demo</a>
        </p>

        <div style="display: none;max-width:600px;" id="trueModal">
          <h2>I'm a modal!</h2>
          <p>You can close me only by pressing custom button below.</p>
          <p>It would also be possible to prevent closing using `beforeClose` callback.</p>
          <p><button data-fancybox-close class="btn">Close me</button></p>
        </div>
      </div>
    </div>

  </div>
</div>
<div class="row mb-4">
  <div class="card-deck col-9">

    <div class="card">
      <div class="card-body">
        <p>
          #4 - Custom options
        </p>

        <p>
          <a data-fancybox data-options='{"src": "#exampleModal", "touch": false, "smallBtn" : false}' href="javascript:;" class="btn btn-primary">Open demo</a>
        </p>

        <div style="display: none;max-width:500px;" id="exampleModal">
          <h2>¡Hola!</h2>
          <p>You can chose to display small close button (customizable using `btnTpl.smallBtn` option; you can put any html here) or display the toolbar instead.</p>
        </div>
      </div>
    </div>


    <div class="card">
      <div class="card-body">
        <p>
          #5 - Make element selectable/clickable
        </p>

        <p>
          <a data-fancybox data-src="#selectableModal" href="javascript:;" class="btn btn-primary">Open demo</a>
        </p>

        <div style="display: none;max-width:500px;" id="selectableModal">
          <h2 data-selectable="true">Ciao!</h2>
          <p data-selectable="true">Sometimes you would want to disable "touch" feature. <br />For example, when you want to make your content selectable.</p>
        </div>
      </div>
    </div>

  </div>
</div>