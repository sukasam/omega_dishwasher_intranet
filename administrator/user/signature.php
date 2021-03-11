<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Signature Pad demo</title>
  <meta name="description" content="Signature Pad - HTML5 canvas based smooth signature drawing using variable width spline interpolation.">

  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">

  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">

  <link rel="stylesheet" href="../css/signature-pad.css">

</head>
<body onselectstart="return false">
  
  <div id="signature-pad" class="signature-pad">
    <div class="signature-pad--body">
      <canvas></canvas>
    </div>
    <div class="signature-pad--footer">
      <div class="description">Sign above</div>

      <div class="signature-pad--actions">
        <div>
          <button type="button" class="button clear" data-action="clear">Clear</button>
          <button type="button" class="button" data-action="change-color" style="display: none;">Change color</button>
          <button type="button" class="button" data-action="undo" style="display: none;">Undo</button>

        </div>
        <div>
          <button type="button" class="button save" data-action="save-png" style="display: none;">Save as PNG</button>
          <button type="button" class="button save" data-action="save-signature">Save Signature</button>
          <button type="button" class="button save" data-action="save-jpg" style="display: none;">Save as JPG</button>
          <button type="button" class="button save" data-action="save-svg" style="display: none;">Save as SVG</button>

        </div>
      </div>
    </div>
  </div>

  <script src="../js/signature_pad.umd.js"></script>
  <script src="../js/app_signature.js"></script>
</body>
</html>
