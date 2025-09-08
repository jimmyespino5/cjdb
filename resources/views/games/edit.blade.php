@extends('layouts.app')

@section('titulo')
    Editar Juego
@endsection



@section('contenido')
<div class="md:flex md:items-center">
    <div class="md:w-full p-10  bg-white rounded-lg shadow-xl mt-10 md:mt-0">
        
        <form action="{{route('journeys.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-5 gap-3 p-3 text-center">
                <div class="mb-5 col-span-2">
                    <label for="number" class="mb-2 block uppercase text-gray-500 font-bold">
                        Numero de jornada
                    </label>
                    <input 
                    id="number"
                    name="number"
                    type="text"
                    placeholder="Numero de jornada"
                    class="border p-3 rounded-lg @error('number') border-red-500 @enderror "
                    value="{{old('number')}}"
                    />
                    @error('name')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                    @enderror    
                    <input type="hidden" name="tournment" id="tournment" value="{{$tournment->id}}" >
                </div>

                <div class="mb-5 col-start-4 col-span-2">
                    <label for="date" class="mb-2 block uppercase text-gray-500 font-bold">
                        Fecha
                    </label>
                    <input 
                    id="date"
                    name="date"
                    type="date"
                    placeholder="Numero del date del jugador"
                    class="border p-3 rounded-lg @error('date') border-red-500 @enderror "
                    value="{{old('date')}}"
                    />
                    @error('date')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="gol_a" class="mb-2 block uppercase text-gray-500 font-bold">
                        Goles
                    </label>
                    <input 
                    id="gol_a"
                    name="gol_a"
                    type="text"
                    placeholder="Goles"
                    class="border p-3 rounded-lg @error('gol_a') border-red-500 @enderror "
                    value="{{old('gol_a')}}"
                    />
                    <input type="hidden" name="tournment" id="tournment" value="{{$tournment->id}}" >
                </div>
                <div class="mb-5 ">
                    <label for="team_a" class="mb-2 block uppercase text-gray-500 font-bold">
                        Equipo A
                    </label>
                    <select name="team_a" id="team_a" class="border p-3  rounded-lg ">
                        <option value="0"> Seleccione equipo </option>
                        @foreach ($tournment->equipos as $team)
                            <option value="{{$team->id}}" > {{$team->name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5 ">
                    VS
                </div>
                <div class="mb-5 col-start-4">
                    <label for="team_b" class="mb-2 block uppercase text-gray-500 font-bold">
                        Equipo B
                    </label>
                    <select name="team_b" id="team_b" class="border p-3 rounded-lg ">
                            <option value="0"> Seleccione equipo </option>
                        @foreach ($tournment->equipos as $team)
                            <option value="{{$team->id}}"> {{$team->name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label for="gol_b" class="mb-2 block uppercase text-gray-500 font-bold">
                        Goles
                    </label>
                    <input 
                    id="gol_b"
                    name="gol_b"
                    type="text"
                    placeholder="Goles"
                    class="border p-3 rounded-lg @error('gol_b') border-red-500 @enderror "
                    value="{{old('gol_b')}}"
                    />

                    <input type="hidden" name="tournment" id="tournment" value="{{$tournment->id}}" >
                </div>

                <div class="w-8/12 lg:w-6/12 px-5">
                    <img src="{{asset('img/button_gol.png')}}" alt="imagen usuario">
                </div>
                <div class="flex flex-wrap">
                    <div id="players_a" class="bg-cyan-950 m-5 rounded-md p-4 text-3xl font-bold flex justify-center w-15 text-white"  > 1 </div> {{-- style="display: none" --}}
                    <div id="players_a" class="bg-cyan-950 m-5 rounded-md p-4 text-3xl font-bold flex justify-center w-15 text-white"  > 1 </div> {{-- style="display: none" --}}
                    <div id="players_a" class="bg-cyan-950 m-5 rounded-md p-4 text-3xl font-bold flex justify-center w-15 text-white"  > 1 </div> {{-- style="display: none" --}}

                </div>
                <div class="w-8/12 lg:w-6/12 px-5 col-start-4">
                    <img src="{{asset('img/button_gol.png')}}" alt="imagen usuario">
                </div>



                <div class="mb-5 col-start-3">
                    <input 
                    type="submit"
                    value="Guardar Juego"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold  p-3 text-white rounded-lg "
                    />
                </div>

            </div>
        </form>

    </div>
</div>

<style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      padding: 20px;
    }
    h1 {
      text-align: center;
      color: #333;
    }
    .section {
      background: #fff;
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 8px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    th, td {
      padding: 8px;
      border: 1px solid #ccc;
      text-align: center;
    }
    th {
      background-color: #eee;
    }
    button {
      padding: 8px 14px;
      margin: 10px 0;
      cursor: pointer;
    }

    /* Modal styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 10;
      left: 0; top: 0;
      width: 100%; height: 100%;
      background-color: rgba(0,0,0,0.5);
    }
    .modal-content {
      background-color: #fff;
      margin: 10% auto;
      padding: 20px;
      width: 300px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
    }
    .modal-content input, .modal-content select {
      width: 100%;
      margin: 8px 0;
      padding: 6px;
    }
    .close {
      float: right;
      font-size: 20px;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <h1>📋 Control de Torneo Futsal</h1>



  
<div class="flex flex-row col-span-2  justify-center ">
    
    <!-- Goles -->
    <div class="section">
        <h2>⚽ Goles</h2>
        <button onclick="openModal('goalModal')">Agregar Gol</button>
        <table id="goalTable">
            <tr><th>Jugador</th><th>Equipo</th><th>Minuto</th></tr>
        </table>
    </div>
    
    <!-- Tarjetas -->
    <div class="section">
        <h2>🟨 Tarjetas</h2>
        <button onclick="openModal('cardModal')">Agregar Tarjeta</button>
        <table id="cardTable">
            <tr><th>Jugador</th><th>Equipo</th><th>Tipo</th><th>Minuto</th></tr>
        </table>
    </div>
    
</div>
  <!-- Faltas -->
  <div class="section">
    <h2>❌ Faltas</h2>
    <button onclick="openModal('foulModal')">Agregar Falta</button>
    <table id="foulTable">
      <tr><th>Jugador</th><th>Equipo</th><th>Descripción</th><th>Minuto</th></tr>
    </table>
  </div>

  <!-- Modales -->
  <div id="goalModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('goalModal')">&times;</span>
      <h3>Agregar Gol</h3>
      <input type="text" id="goalPlayer" placeholder="Jugador">
      <input type="text" id="goalTeam" placeholder="Equipo">
      <input type="number" id="goalMinute" placeholder="Minuto">
      <button onclick="addGoal()">Guardar</button>
    </div>
  </div>

  <div id="cardModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('cardModal')">&times;</span>
      <h3>Agregar Tarjeta</h3>
      <input type="text" id="cardPlayer" placeholder="Jugador">
      <input type="text" id="cardTeam" placeholder="Equipo">
      <select id="cardType">
        <option value="">Tipo</option>
        <option value="Amarilla">Amarilla</option>
        <option value="Roja">Roja</option>
      </select>
      <input type="number" id="cardMinute" placeholder="Minuto">
      <button onclick="addCard()">Guardar</button>
    </div>
  </div>

  <div id="foulModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('foulModal')">&times;</span>
      <h3>Agregar Falta</h3>
      <input type="text" id="foulPlayer" placeholder="Jugador">
      <input type="text" id="foulTeam" placeholder="Equipo">
      <input type="text" id="foulDesc" placeholder="Descripción">
      <input type="number" id="foulMinute" placeholder="Minuto">
      <button onclick="addFoul()">Guardar</button>
    </div>
  </div>

  <script>
    function openModal(id) {
      document.getElementById(id).style.display = 'block';
    }
    function closeModal(id) {
      document.getElementById(id).style.display = 'none';
    }

    function addGoal() {
      const player = document.getElementById('goalPlayer').value;
      const team = document.getElementById('goalTeam').value;
      const minute = document.getElementById('goalMinute').value;
      const table = document.getElementById('goalTable');
      const row = table.insertRow();
      row.innerHTML = `<td>${player}</td><td>${team}</td><td>${minute}'</td>`;
      closeModal('goalModal');
    }

    function addCard() {
      const player = document.getElementById('cardPlayer').value;
      const team = document.getElementById('cardTeam').value;
      const type = document.getElementById('cardType').value;
      const minute = document.getElementById('cardMinute').value;
      const table = document.getElementById('cardTable');
      const row = table.insertRow();
      row.innerHTML = `<td>${player}</td><td>${team}</td><td>${type}</td><td>${minute}'</td>`;
      closeModal('cardModal');
    }

    function addFoul() {
      const player = document.getElementById('foulPlayer').value;
      const team = document.getElementById('foulTeam').value;
      const desc = document.getElementById('foulDesc').value;
      const minute = document.getElementById('foulMinute').value;
      const table = document.getElementById('foulTable');
      const row = table.insertRow();
      row.innerHTML = `<td>${player}</td><td>${team}</td><td>${desc}</td><td>${minute}'</td>`;
      closeModal('foulModal');
    }
  </script>

</body>


@endsection