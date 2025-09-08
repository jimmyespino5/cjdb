@extends('layouts.app')

@section('titulo')
    Asistencia Escuela de Futbol Don Bosco
@endsection

@section('contenido')
<div class="md:flex md: items-center md:justify-center md:gap-10 md:items-center md:col">
    <h1>Web NFC Sample</h1>
    <p class="availability">
      Available in <a target="_blank" href="https://www.chromestatus.com/feature/6261030015467520">Chrome 89+</a> |
      <a target="_blank" href="https://github.com/googlechrome/samples/blob/gh-pages/web-nfc/">View on GitHub</a> |
      <a target="_blank" href="https://www.chromestatus.com/samples">Browse Samples</a>
    </p>
    <h3>Background</h3>
<p>
Web NFC aims to provide sites the ability to read and write to NFC tags when
they are brought in close proximity to the user’s device (usually 5-10 cm, 2-4
inches). The current scope is limited to NDEF, a lightweight binary message
format. Low-level I/O operations (e.g. ISO-DEP, NFC-A/B, NFC-F) and Host-based
Card Emulation (HCE) are not supported within the current scope.
</p>

<button id="scanButton">Scan</button>
<button id="writeButton">Write</button>
<button id="makeReadOnlyButton">Make Read-Only</button>

<script>
  var ChromeSamples = {
    log: function() {
      var line = Array.prototype.slice.call(arguments).map(function(argument) {
        return typeof argument === 'string' ? argument : JSON.stringify(argument);
      }).join(' ');

      document.querySelector('#log').textContent += line + '\n';
    },

    clearLog: function() {
      document.querySelector('#log').textContent = '';
    },

    setStatus: function(status) {
      document.querySelector('#status').textContent = status;
    },

    setContent: function(newContent) {
      var content = document.querySelector('#content');
      while(content.hasChildNodes()) {
        content.removeChild(content.lastChild);
      }
      content.appendChild(newContent);
    }
  };
</script>

<h3>Live Output</h3>
<div id="output" class="output">
  <div id="content"></div>
  <div id="status"></div>
  <pre id="log"></pre>
</div>


<script>
  if (/Chrome\/(\d+\.\d+.\d+.\d+)/.test(navigator.userAgent)){
    // Let's log a warning if the sample is not supposed to execute on this
    // version of Chrome.
    if (89 > parseInt(RegExp.$1)) {
      ChromeSamples.setStatus('Warning! Keep in mind this sample has been tested with Chrome ' + 89 + '.');
    }
  }
</script>



<script>
log = ChromeSamples.log;

if (!("NDEFReader" in window))
  ChromeSamples.setStatus("Web NFC is not available. Use Chrome on Android.");
</script>


  
    
      <script>
      
      scanButton.addEventListener("click", async () => {
  log("User clicked scan button");

  try {
    const ndef = new NDEFReader();
    await ndef.scan();
    log("> Scan started");

    ndef.addEventListener("readingerror", () => {
      log("Argh! Cannot read data from the NFC tag. Try another one?");
    });

    ndef.addEventListener("reading", ({ message, serialNumber }) => {
      log(`> Serial Number: ${serialNumber}`);
      log(`> Records: (${message.records.length})`);
    });
  } catch (error) {
    log("Argh! " + error);
  }
});

writeButton.addEventListener("click", async () => {
  log("User clicked write button");

  try {
    const ndef = new NDEFReader();
    await ndef.write("Hello world!");
    log("> Message written");
  } catch (error) {
    log("Argh! " + error);
  }
});

makeReadOnlyButton.addEventListener("click", async () => {
  log("User clicked make read-only button");

  try {
    const ndef = new NDEFReader();
    await ndef.makeReadOnly();
    log("> NFC tag has been made permanently read-only");
  } catch (error) {
    log("Argh! " + error);
  }
});
</script>
@endsection