<?php include 'Header.php';?>
<div id="kepes">
</div>
<div class="margo">
</div>
<div class="first">
    Állás hírdetése:
</div>
<br>
<div>
<form action="Handlers/Diak_Registration_Handler.php" method="POST">
    <p>Munka típusa: <select>
  <option value="ml1">Fizikai</option>
  <option value="ml2">Szellemi</option>
     </select></p>
    <p>Felajánlandó óraszám: <select>
  <option value="h1">1</option>
  <option value="h2">2</option>
  <option value="h3">3</option>
  <option value="h4">4</option>
  <option value="h5">5</option>
  <option value="h6">6</option>
  <option value="h7">7</option>
  <option value="h8">8</option>
     </select></p>
    <p>A munka megnevezése:<input type="text" name="munka" placeholder="pl.: Favágás,fűnyírás akármi.. xd"></p>
    <p>Elvárások a munka vállaló felé:
        <p> <textarea name="elvaras" id="myTextArea" rows="6" cols="80">Írd be az elvárásaid a munka vállaló diák felé.</textarea></p>
        <p>A munka leírása:
            <p> <textarea name="elvaras" id="myTextArea" rows="6" cols="80">Milyen körülmények között, milyen munka mit kell csinálni stb..</textarea></p>
            <p>A munkahely elvégzésére alkalmas pontos cím. <input type="text" name="cim" placeholder="Megye, Város, Utca, Házszám/ajtó"></p>
            <p>Esetleges iskolai választék: ( Nem kötelező ) // fb-n leírom:
             <select>
	<option value="nv">Nem választok</option>	
	<option value="gd">Gábor Dénes</option>
	<option value="hs">Hansági</option>
	<option value="mr">MÓRA</option>
	<option value="dk">Deák</option>
               </select>
                
    <p>Mettől - Meddig aktuális az állás hirdetés?:
    <select>
	<option value="éééé">2018</option>
	<option value="éééé">2019</option>
	<option value="éééé">2020</option>
	<option value="éééé">2021</option>
	<option value="éééé">2022</option>
	<option value="éééé">2023</option>
	<option value="éééé">2024</option>
	<option value="éééé">2025</option>
	<option value="éééé">2026</option>
	<option value="éééé">2027</option>
	</select>
   
    <select>
	<option value="hh">01</option>
	<option value="hh">02</option>
	<option value="hh">03</option>
	<option value="hh">04</option>
	<option value="hh">05</option>
	<option value="hh">06</option>
	<option value="hh">07</option>
	<option value="hh">08</option>
	<option value="hh">09</option>
	<option value="hh">10</option>
	<option value="hh">11</option>
	<option value="hh">12</option>
	</select>
   
    <select>
	<option value="nn">01</option>
	<option value="nn">02</option>
	<option value="nn">03</option>
	<option value="nn">04</option>
	<option value="nn">05</option>
	<option value="nn">06</option>
	<option value="nn">07</option>
	<option value="nn">08</option>
	<option value="nn">09</option>
	<option value="nn">10</option>
	<option value="nn">11</option>
	<option value="nn">12</option>
	<option value="nn">13</option>
	<option value="nn">14</option>
	<option value="nn">15</option>
	<option value="nn">16</option>
	<option value="nn">17</option>
	<option value="nn">18</option>
	<option value="nn">19</option>
	<option value="nn">20</option>
	<option value="nn">21</option>
	<option value="nn">22</option>
	<option value="nn">23</option>
	<option value="nn">24</option>
	<option value="nn">25</option>
	<option value="nn">26</option>
	<option value="nn">27</option>
	<option value="nn">28</option>
	<option value="nn">29</option>
	<option value="nn">30</option>
	<option value="nn">31</option>
	</select> - 
    <select>
	<option value="éééé">2018</option>
	<option value="éééé">2019</option>
	<option value="éééé">2020</option>
	<option value="éééé">2021</option>
	<option value="éééé">2022</option>
	<option value="éééé">2023</option>
	<option value="éééé">2024</option>
	<option value="éééé">2025</option>
	<option value="éééé">2026</option>
	<option value="éééé">2027</option>
	</select>
   
    <select>
	<option value="hh">01</option>
	<option value="hh">02</option>
	<option value="hh">03</option>
	<option value="hh">04</option>
	<option value="hh">05</option>
	<option value="hh">06</option>
	<option value="hh">07</option>
	<option value="hh">08</option>
	<option value="hh">09</option>
	<option value="hh">10</option>
	<option value="hh">11</option>
	<option value="hh">12</option>
	</select>
   
    <select>
	<option value="nn">01</option>
	<option value="nn">02</option>
	<option value="nn">03</option>
	<option value="nn">04</option>
	<option value="nn">05</option>
	<option value="nn">06</option>
	<option value="nn">07</option>
	<option value="nn">08</option>
	<option value="nn">09</option>
	<option value="nn">10</option>
	<option value="nn">11</option>
	<option value="nn">12</option>
	<option value="nn">13</option>
	<option value="nn">14</option>
	<option value="nn">15</option>
	<option value="nn">16</option>
	<option value="nn">17</option>
	<option value="nn">18</option>
	<option value="nn">19</option>
	<option value="nn">20</option>
	<option value="nn">21</option>
	<option value="nn">22</option>
	<option value="nn">23</option>
	<option value="nn">24</option>
	<option value="nn">25</option>
	<option value="nn">26</option>
	<option value="nn">27</option>
	<option value="nn">28</option>
	<option value="nn">29</option>
	<option value="nn">30</option>
	<option value="nn">31</option>
	</select>


                        
                   
    <input type="submit" class="gomb2" name="daiakRegistrationSubmit" value="Elküldés">
</form>
</div>
<div class="copy">
    @copyright Kanyári Krisztofer. 2018-2019
</div>
<?php include 'Footer.php' ?>