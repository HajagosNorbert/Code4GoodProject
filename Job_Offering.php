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
<form action="Handlers/Job_Offering_Handler.php" method="POST">
    
    <!-- később vezetjük be a kategóriákat
    <p>Munka típusa: <select>
  <option value="ml1">Fizikai</option>
  <option value="ml2">Szellemi</option>
     </select></p>
     -->
    <p>Felajánlandó óraszám: <select>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
     </select></p>
     
<p>Ajánlat cime<input type="text" name="cim" placeholder="pl.: Favágás,fűnyírás akármi.. xd"></p>
<p>Elvárások a munka vállaló felé:
    <p> <textarea name="elvaras" id="myTextArea" rows="6" cols="80">Írd be az elvárásaid a munka vállaló diák felé.</textarea></p>
    <p>A munka leírása:
        <p> <textarea name="leiras" id="myTextArea" rows="6" cols="80">Milyen körülmények között, milyen munka mit kell csinálni stb..</textarea></p>

        <!-- Google Maps ez helyett -->
        <p>A munkahely elvégzésére alkalmas pontos cím. <input type="text" name="helyszin" placeholder="Megye, Város, Utca, Házszám/ajtó"></p>
                
    <p>Munka kezdeti időpontja:
    
    <!--
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
-->

                        
                   
    <input type="submit" class="gomb2" name="submit" value="Ajánlás">
</form>
</div>
<div class="copy">
    @copyright Kanyári Krisztofer. 2018-2019
</div>
<?php include 'Footer.php' ?>